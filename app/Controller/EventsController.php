<?php
App::uses('AppController', 'Controller');
/**
 * Events Controller
 *
 * @property Event $Event
 */

//require_once('facebook/facebook.php');

class EventsController extends AppController
{

    //var $helpers = Array('Form', 'Tinymce');

    public $components = array('RequestHandler');
    public $helpers = array('Text');
    public $uses = array('Event', 'EventEmail', 'EventEmailConfig');
    public $fbappid = '144734069055490';

    var $__fbApiKey = '549616571765083';
    var $__fbSecret = '1a13e632d224c8310ef6914c766df371';
    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Event->recursive = 0;
        $event_conditions = array();
        $event_conditions['Event.status'] = 1;
        if (isset($_GET['company'])) {
            $event_conditions['Event.company_id'] = $_GET['company'];
        }
        if (isset($_GET['eventtype'])) {
            $event_conditions['Event.eventtype'] = $_GET['eventtype'];
        }

        $options = array(
            'conditions' => array(
                $event_conditions
            ),
            'order' => array('Event.view_order' => 'asc')
        );

        $events = $this->Event->find('all', $options);

       // $events = Set::sort($events, '{n}.Event.view_order', 'asc');
        $companies = $this->Event->Company->find('list');
        if ($this->isAdmin()) $companies = array('' => 'All') + $companies;
        $this->set(compact('events', 'companies'));

    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        $this->Event->id = $id;
        if (!$this->Event->exists()) {
            throw new NotFoundException(__('Invalid event'));
        }
        if ($this->RequestHandler->isRss()) {
            $event = $this->Event->read(null, $id);
            // You should import Sanitize
           //var_dump($event);

            return $this->set(compact('event'));
        }
        $this->set('event', $this->Event->read(null, $id));
    }

    function process_upload($event_id, $field) {
        if (isset($this->request->data['Event'][$field]['error']) && $this->request->data['Event'][$field]['error'] == 0) {
            $uploaded_file = $this->request->data['Event'][$field]['tmp_name'];
            $uploaded_file_name = $this->request->data['Event'][$field]['name'];
            $uploaded_file_name = '/img/events/' . $event_id . '-' . $uploaded_file_name;
            //$uploaded_file_name = 'img' . DS . 'events' . DS . $event_id . '-' . $uploaded_file_name;
            if (!move_uploaded_file($uploaded_file, WWW_ROOT . $uploaded_file_name)) {
                throw new NotFoundException(__('Permission not available in upload directory'));
            }
            $this->request->data['Event'][$field] = $uploaded_file_name;
            //$this->request->data['Event'][$field] = 'events/'  . $event_id . '-' . $this->request->data['Event'][$field]['name'];
        } elseif (is_array($this->request->data['Event'][$field]) && $this->request->data['Event'][$field]['error'] <> 0) {
            unset($this->request->data['Event'][$field]);
        } elseif (isset($this->request->data['Event'][$field . "_delete"])) {
            $this->request->data[$field] = '';
        }
    }



    function process_email_config_upload($event_id, $field) {
        if (isset($this->request->data['EventEmailConfig'][$field]['error']) && $this->request->data['EventEmailConfig'][$field]['error'] == 0) {
            $uploaded_file = $this->request->data['EventEmailConfig'][$field]['tmp_name'];

            $uploaded_file_name = $this->request->data['EventEmailConfig'][$field]['name'];
            $uploaded_file_name = '/img/email_configs/' . $event_id . '-' . $uploaded_file_name;
            //$uploaded_file_name = 'img' . DS . 'events' . DS . $event_id . '-' . $uploaded_file_name;
            if (!move_uploaded_file($uploaded_file, WWW_ROOT . $uploaded_file_name)) {
                throw new NotFoundException(__('Permission not available in upload directory'));
            }
            $this->request->data['EventEmailConfig'][$field] = $uploaded_file_name;
            //$this->request->data['Event'][$field] = 'events/'  . $event_id . '-' . $this->request->data['Event'][$field]['name'];
        } elseif (is_array($this->request->data['EventEmailConfig'][$field]) && $this->request->data['EventEmailConfig'][$field]['error'] <> 0) {
            unset($this->request->data['EventEmailConfig'][$field]);
        } elseif (isset($this->request->data['EventEmailConfig'][$field . "_delete"])) {
            $this->request->data[$field] = '';
        }
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        $this->layout = 'event';

        if ($this->request->is('post')) {
            $this->Event->create();

            $user_data = $this->Session->read('User');

            $this->request->data['Event']['updated_by'] = $user_data['id'];

            if (!empty($this->request->data['Event']['date_start']) ||
                count(array_filter($this->request->data['Event']['date_start'])) < count($this->request->data['Event']['date_start'])
            ) {
                $this->request->data['Event']['date_start'] = $this->request->data['Event']['date_start']['year'] . "-" .
                    $this->request->data['Event']['date_start']['month'] . "-" .
                    $this->request->data['Event']['date_start']['day'];
            } else {
                $this->request->data['Event']['date_start'] = '';
            }

            if (!empty($this->request->data['Event']['date_end']) ||
                count(array_filter($this->request->data['Event']['date_end'])) < count($this->request->data['Event']['date_end'])
            ) {
                $this->request->data['Event']['date_end'] = $this->request->data['Event']['date_end']['year'] . "-" .
                    $this->request->data['Event']['date_end']['month'] . "-" .
                    $this->request->data['Event']['date_end']['day'];
            } else {
                $this->request->data['Event']['date_end'] = '';
            }


            $temp_data = $this->request->data['Event'];
            unset($this->request->data['Event']['public_logo']);
            for ($i = 1; $i <= 5; $i++) {
                unset($this->request->data['Event']["img_overlay_$i"]);
            }

            if ($this->Event->save($this->request->data)) {
                $this->request->data['Event'] = array_merge($this->request->data['Event'], $temp_data);
                $this->process_upload($this->Event->id, 'public_logo');
                for ($i = 1; $i <= 5; $i++) {
                    $this->process_upload($this->Event->id, "img_overlay_$i");
                }
                $this->Event->save($this->request->data);

                $this->Session->setFlash(__('The event has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The event could not be saved. Please, try again.'));
            }
        }
        $companies = $this->Event->Company->find('list');
        $this->set(compact('companies'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        $this->Event->id = $id;
        $this->layout = 'event';
        if (!$this->Event->exists()) {
            throw new NotFoundException(__('Invalid event'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $user_data = $this->Session->read('User');
            $this->request->data['Event']['updated_by'] = $user_data['id'];

            $this->process_upload($id, 'public_logo');
            for ($i = 1; $i <= 5; $i++) {
                $this->process_upload($id, "img_overlay_$i");
            }


            if ($this->Event->save($this->request->data)) {
                $this->Session->setFlash(__('The event has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The event could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->Event->read(null, $id);
        }

        $companies = $this->Event->Company->find('list');
        $this->set(compact('companies'));
    }

    public  function email_config($event_id = null){
        $this->layout = 'event';
        $image_parts = array('background', 'header', 'footer', 'right');

        $event_config =  $this->EventEmailConfig->find('first', array('conditions'=>array('event_id'=>$event_id), 'recursive'=>-1));

        //print_r($this->request->data); exit;

        if($this->request->is('post') || $this->request->is('put')){

            if($event_config)
                $this->EventEmailConfig->id = $event_config['EventEmailConfig']['id'];
            else
                $this->EventEmailConfig->create();


            $this->request->data['EventEmailConfig']['event_id']=$event_id;

            $user_data = $this->Session->read('User');
            $temp_data = $this->request->data['EventEmailConfig'];
            foreach($image_parts as $part){
                unset($this->request->data['EventEmailConfig']['image_'.$part]);
            }

            if ($this->EventEmailConfig->save($this->request->data)) {
                $this->request->data['EventEmailConfig'] = array_merge($this->request->data['EventEmailConfig'], $temp_data);
                foreach($image_parts as $part){
                    $this->process_email_config_upload($event_id, "image_$part");
                }
                $this->EventEmailConfig->save($this->request->data);

                $this->Session->setFlash(__('The event has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The event Config could not be saved. Please, try again.'));
            }
        } else {

            $this->request->data = $event_config;
        }


    }


    public function event_custom($id = null) {

        $this->layout = 'event2';

        $event = $this->Event->find('first', array(
            'conditions' => array('Event.event_url' => $id),
        ));

         $this->set(compact('event', 'event'));

        //$event = $this->Event->read(null, $id);
        //$event_actions = $this->Event->EventAction->find('all',array('recursive'=> -1, 'conditions' => array('EventAction.event_id' => $id)));

    }

    public function report($id = null) {
        $this->Event->id = $id;
        if (!$this->Event->exists()) {
            throw new NotFoundException(__('Invalid event'));
        }

        $event = $this->Event->read(null, $id);
        $event_actions = $this->Event->EventAction->find('all', array('recursive' => -1, 'conditions' => array('EventAction.event_id' => $id)));
        $now = time();
        if (strtoupper($event['Event']['stage']) == 'SCHEDULED') {
            if ($now > strtotime($event['Event']['date_start']) && $now < strtotime($event['Event']['date_end'])) {
                $event['Event']['status'] = 'RUNNING';
            } elseif ($now < strtotime($event['Event']['date_start'])) {
                $event['Event']['status'] = 'SCHEDULED';
            } else {
                $event['Event']['status'] = 'CLOSED';
            }
        } else {
            $event['Event']['status'] = 'DRAFT';
        }

        $this->set(compact('event', 'event_actions'));
    }

    public function download_submissions($event_id = null, $event_action_id = null) {
        $this->autoRender = false;
        if (!empty($event_action_id)) {
            $this->Event->EventAction->id = $event_action_id;
            if (!$this->Event->EventAction->exists()) {
                throw new NotFoundException(__('Invalid event'));
            }
        }
        $this->Event->id = $event_id;
        if (!$this->Event->exists()) {
            throw new NotFoundException(__('Invalid event'));
        }
        $rows[] = array_keys($this->Event->EventAction->getColumnTypes());
        if (empty($event_action_id)) {
            $event_actions = $this->Event->EventAction->find('all', array('recursive' => -1, 'conditions' => array('EventAction.event_id' => $event_id)));
        } else {
            $event_actions = $this->Event->EventAction->find('all', array('recursive' => -1, 'conditions' => array('EventAction.id' => $event_action_id)));
        }

        foreach ($event_actions as $event_action) {
            $rows[] = $event_action['EventAction'];
        }

        //todo: very bad memory hungry code... will have to fix it soon ...
        $this->exportCSV($rows);

        /*$temp_file_name = '/tmp/' . mt_rand(1, 1000000000) . '.csv';
        $fp = fopen($temp_file_name, 'w');
        foreach ($rows as $row) {
            fputcsv($fp, $row);
        }
        fclose($fp);
        $FileName = 'Event-submissions-' . date("d-m-y") . '.csv';
        header('Content-Disposition: inline; filename="' . $temp_file_name . '"');
        header("Content-Transfer-Encoding: Binary");
        header("Content-length: " . filesize($temp_file_name));
        header('Content-Type: application/excel');
        header('Content-Disposition: attachment; filename="' . $FileName . '"');
        readfile($temp_file_name);*/
    }

    public function download_image($event_id = null) {
        $this->autoRender = false;

        $this->Event->id = $event_id;

        if (!$this->Event->exists()) {
            throw new NotFoundException(__('Invalid event'));
        }

        $event = $this->Event->read(null, $event_id);
        $event_actions = $this->Event->EventAction->find('all', array('recursive' => -1, 'conditions' => array('EventAction.event_id' => $event_id)));

        $zip = new ZipArchive();
        $filename = '../tmp/image-zips/' . mt_rand(1, 1000000000) . '.zip';

        //$fp = fopen($temp_file_name, 'w');

        if ($zip->open($filename, ZIPARCHIVE::CREATE)!==TRUE) {
            exit("cannot open <$filename>\n");
        }

        set_time_limit(count($event_actions) * 10);
        ini_set('memory_limit', '512M');

        foreach ($event_actions as $ea) {
            $url = 'http://appevent.s3.amazonaws.com/'. $ea['EventAction']['photo'];
            $data = @file_get_contents($url, false);
            if ($data !== false) {
                var_dump($zip->addFromString($ea['EventAction']['photo'], $data));
            }
        }

        //echo "numfiles: " . $zip->numFiles . "\n";
        //echo "status:" . $zip->status . "\n";
        $zip->close();

        //$filename = '../tmp/image-zips/656895736.zip';

        $FileName = 'Event-images-' . date("d-m-y") . '.zip';
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Transfer-Encoding: binary');
        header("Content-length: " . filesize($filename));
        header('Content-Disposition: attachment; filename="' . $FileName . '"');
        ob_clean();
        flush();
        readfile($filename);
    }

    /**
     * delete method
     *
     * @throws MethodNotAllowedException
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        if (!$this->request->is('post')) {
            //throw new MethodNotAllowedException();
        }
        $this->Event->id = $id;
        if (!$this->Event->exists()) {
            throw new NotFoundException(__('Invalid event'));
        }
        if ($this->Event->saveField('status', 0)) {
            $this->Session->setFlash(__('Event deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Event was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    public function duplicate($id = null) {
        $this->Event->id = $id;
        $new_record = $this->Event->findById($this->Event->id);
        unset($new_record['Event']['id']);

        $this->Event->create();

        if ($this->Event->save($new_record)) {
            $this->redirect(array('action' => 'index'));
        } else {
            // throw new Exception(__('Error in creating event));
        }
    }


    public function eventlist() {
        $this->autoRender = false;
        $params = array_keys($_GET);
        if (!empty($params)) $params_formatted = array('fields' => $params);
        $options = array(
            'conditions' => array(
                'Event.date_end >=' => date('Y-m-d'),
                'Event.status' => 1,
            ),
            'order' => array('Event.view_order' => 'asc', 'Event.created' => 'desc')
        );

        $events = $this->Event->find('all', $options);
        $events_array = array();
        $i = 0;

        //we need to show the events that has status =1 & date_end >= today's date.

        foreach ($events as $event) {

            $overlay_img_count = 0;
            $events_array[$i]['id'] = $event['Event']['id'];
            $events_array[$i]['name'] = $event['Event']['name'];
            $events_array[$i]['password'] = $event['Event']['event_password'];
            $events_array[$i]['event_type'] = $event['Event']['eventtype'];
            $events_array[$i]['shortdescription_line_1'] = $event['Event']['shortdescription_line_1'];
            $events_array[$i]['shortdescription_line_2'] = $event['Event']['shortdescription_line_2'];
            if(empty($event['Company']['name'])){
                $events_array[$i]['company_name'] = "";
            }else {
                $events_array[$i]['company_name'] = $event['Company']['name'];
            }

            if(!empty($event['EventEmailConfig'][0]['subject'])){
                $events_array[$i]['email_subject'] = $event['EventEmailConfig'][0]['subject'];
            }
            else {
                $events_array[$i]['email_subject'] = "Hi you've been sent a photo via PIXTA.. ..";
            }

            $events_array[$i]['facebook_msg'] = $event['Event']['facebook_msg'] .' '. $event['Event']['facebook_url'];
            $events_array[$i]['facebook_url'] = $event['Event']['facebook_url'];
            $events_array[$i]['twitter_msg'] = $event['Event']['twitter_msg'];
            if ($event['Event']['html_before_on'] == 1) {
                $events_array[$i]['html_before'] = $event['Event']['html_before'];
            } else {
                $events_array[$i]['html_before'] = '';
            }
            if ($event['Event']['html_after_on'] == 1) {
                $events_array[$i]['html_after'] = $event['Event']['html_after'];
            } else {
                $events_array[$i]['html_after'] = '';
            }
            if ($event['Event']['t_c_on'] == 1) {
                $events_array[$i]['t_c'] = $event['Event']['t_c'];
            } else {
                $events_array[$i]['t_c'] = '';
            }

            $events_array[$i]['img_thumb'] = FULL_BASE_URL . $event['Event']['public_logo'];

            if (!empty($this->request->query['gpslat']) && !empty($this->request->query['gpslong']) &&
                !empty($event['Event']['gpslat']) && !empty($event['Event']['gpslong']) &&
                $this->request->query['gpslat'] != '0.000000' && $this->request->query['gpslong'] != '0.000000' &&
                $this->request->query['gpslat'] != '0' && $this->request->query['gpslong'] != '0' &&
                $event['Event']['eventtype'] == 'location-based') {
                $events_array[$i]['distance'] = $this->calculate_distance($this->request->query['gpslat'], $this->request->query['gpslong'], $event['Event']['gpslat'], $event['Event']['gpslong']) . ' km';
            } else {
                $events_array[$i]['distance'] = 0;
            }
            if(empty($event['Event']['event_radius'])){
                $events_array[$i]['event_radius'] = "";
            }else {
                $events_array[$i]['event_radius'] = $event['Event']['event_radius'];
            }
            $overlay_img_count = 1;
            for ($j = 1; $j <= 5; $j++) {
                if (!empty($event['Event']["img_overlay_$j"])) {
                    $events_array[$i]["img_overlay_$overlay_img_count"] = FULL_BASE_URL . $event['Event']["img_overlay_$j"];
                    $overlay_img_count++;
                }
            }

            $events_array[$i]['number_of_overlay'] = $overlay_img_count - 1;
            $i++;

        }
        $events_array = Set::sort($events_array, '{n}.distance', 'asc');
        //$events_array = Set::sort($events_array, '{n}.{s}.{n}', 'SORT_ASC');

        $this->response->type('json');
        $this->RequestHandler->respondAs('json'); /* I've tried 'json', 'JSON', 'application/json' but none of them work */
        echo json_encode($events_array);
    }

    public function event_action() {
        $this->autoRender = false;
        if (!empty($_GET)) {
            $this->request->data = $this->Event->read(null, $_GET['event_id']);

            $success = $this->Event->EventAction->save(array(
                'EventAction' => array(
                    'event_id' => $_GET['event_id'],
                    'phone_type' => $_GET['phone_type'],
                    'action_name' => $_GET['action'],
                    'phone_id' => $_GET['phone_id'],
                    'photo' => $_GET['photo'],
                    'blacklist' => $this->request->data['Event']['auto_moderate'],
                )
            ));
        }
        $this->response->type('json');
        $this->RequestHandler->respondAs('json'); /* I've tried 'json', 'JSON', 'application/json' but none of them work */
        echo json_encode(array('response' => !empty($success)));
    }

    public function event_email_bk() {
        $this->autoRender = false;
        if (!empty($_GET)) {
            $this->request->data = $this->Event->read(null, $_GET['event_id']);

            $success = $this->Event->EventEmail->save(array(
                'EventEmail' => array(
                    'event_id' => $_GET['event_id'],
                    'phone_type' => $_GET['phone_type'],
                    'action_name' => $_GET['action'],
                    'phone_id' => $_GET['phone_id'],
                    'photo' => $_GET['photo'],
                    'email_from' => 'no-reply@pixta.com.au',
                    'email_to' => $_GET['email_to'],
                    'subject' => $_GET['subject'],
                    'message' => $_GET['message'],
                )
            ));

            if (empty($_GET['email_to'])) {
                die(json_encode(array('error' => 'email not given')));
            }
            else {
                $to=preg_split("([, ;\n])", $_GET['email_to']);

                $image = file_get_contents('http://appevent.s3.amazonaws.com/'.$_GET['photo']);
                $save_file = fopen('img/email_image/'.$_GET['photo'], 'w');
                fwrite($save_file, $image);
                fclose($save_file);

                App::uses('CakeEmail', 'Network/Email');
                $email = new CakeEmail();
                $email->from('no-reply@pixta.com.au');
                $email->to($to);
                $email->subject($_GET['subject']);
                $email->template('event_email', 'event_email');
                $email->attachments(array('img/email_image/'.$_GET['photo']));
                $email->viewVars(array('photo' => $_GET['photo']));
                $email->viewVars(array('message' =>  $_GET['message']));
                $email->emailFormat('both');

                $email->send($_GET['message']);
            }

        }
        $this->response->type('json');
        $this->RequestHandler->respondAs('json'); /* I've tried 'json', 'JSON', 'application/json' but none of them work */
        echo json_encode(array('response' => !empty($success)));
    }

    public function event_email() {
        $this->autoRender = false;
        $email_config = Configure::read('email_config');
        $image_header = $email_config['image_header'];
        $image_footer = $email_config['image_footer'];
        $image_bg = $email_config['image_bg'];
        $image_columnA = $email_config['image_columnA'];

        //image right configurable with html/custom href N.B: Do not remove img tag from here!
        $image_columnB = '<a href="#"> <img style="display: block;" src="'.$email_config['image_columnB'].'"  alt="Pixta"/></a>';
        $email_from = $email_config['email_from'];


        if (!empty($_GET)) {

            $success = $this->Event->EventEmail->save(array(
                'EventEmail' => array(
                    'event_id' => $_GET['event_id'],
                    'phone_type' => $_GET['phone_type'],
                    'action_name' => $_GET['action'],
                    'phone_id' => $_GET['phone_id'],
                    'photo' => $_GET['photo'],
                    'email_from' => $email_from,
                    'email_to' => $_GET['email_to'],
                    'subject' => $_GET['subject'],
                    'message' => $_GET['message'],
                )
            ));

            $subject = '';
            $event_email_id = $this->Event->EventEmail->getLastInsertId();

            $host = 'http://www.pixta.com.au';
            $event_config =  $this->EventEmailConfig->find('first', array('conditions'=>array('event_id'=>$_GET['event_id']), 'recursive'=>-1));


            if(!empty($event_config)){

                if(isset($event_config['EventEmailConfig']['image_header']) && trim($event_config['EventEmailConfig']['image_header'])!=='') {
                    $image_header = $host . $event_config['EventEmailConfig']['image_header'];
                }
                if(isset($event_config['EventEmailConfig']['image_footer']) && trim($event_config['EventEmailConfig']['image_footer'])!=='') {
                    $image_footer = $host . $event_config['EventEmailConfig']['image_footer'];
                }
                if(isset($event_config['EventEmailConfig']['image_background']) && trim($event_config['EventEmailConfig']['image_background'])!=='') {
                    $image_bg = $host . $event_config['EventEmailConfig']['image_background'];
                }
                if(isset($event_config['EventEmailConfig']['image_left']) && trim($event_config['EventEmailConfig']['image_left'])!=='') {
                    $image_columnA = $host . $event_config['EventEmailConfig']['image_left'];
                }
                //event email config new logic - if html present then ignore all other options otherwise should add href on image tag.

                if(isset($event_config['EventEmailConfig']['html_right']) && trim($event_config['EventEmailConfig']['html_right'])!=='') {

                    $image_columnB = $event_config['EventEmailConfig']['html_right'];

                } else if(isset($event_config['EventEmailConfig']['image_right']) && trim($event_config['EventEmailConfig']['image_right'])!=='') {

                    $href = isset($event_config['EventEmailConfig']['image_right'])? isset($event_config['EventEmailConfig']['image_right']) : '#';
                    $image_columnB = '<a href="'.$href.'"> <img style="display: block;" src="'.$host . $event_config['EventEmailConfig']['image_right'].'" alt="Pixta"/></a>';

                }
                //newly added end

                if(isset($event_config['EventEmailConfig']['email_from']) && trim($event_config['EventEmailConfig']['email_from'])!=='') {
                    $email_from =  $event_config['EventEmailConfig']['email_from'];
                }
                if(isset($event_config['EventEmailConfig']['subject']) && trim($event_config['EventEmailConfig']['subject'])!=='') {
                    $subject =  $event_config['EventEmailConfig']['subject'];
                }
            }

            if(empty($subject)){
                $subject = $_GET['subject'];
            }
            if (empty($_GET['email_to'])) {
                die(json_encode(array('error' => 'email not given')));
            }
            else {
                $to=preg_split("([, ;\n])", $_GET['email_to']);

                //Fb share url


                //$fb_share = "http://www.facebook.com/share.php?u=http://appevent.s3.amazonaws.com/".$_GET['photo'];
                //http://facebook.com/dialog/feed?app_id=144734069055490&link=http://appevent.s3.amazonaws.com/i_20130614082959.jpg&redirect_uri=https://www.pixta.com.au/events/trace_share/23/?media=fb
                //$fb_share = "http://facebook.com/dialog/feed?app_id=".$this->fbappid."&link=http://appevent.s3.amazonaws.com/".$_GET['photo']."&redirect_uri=https://www.pixta.com.au/events/trace_share/".$event_email_id."/?media=fb";

                $email_config_id = 0;
                if(!empty($event_config['EventEmailConfig']['id']))
                    $email_config_id = $event_config['EventEmailConfig']['id'];

                $fb_share = "http://www.pixta.com.au/events/share/?photo=".$_GET['photo']."&email_config_id=" .$email_config_id;

                //twitter share url

                $tw_share = "https://twitter.com/share?url=http://appevent.s3.amazonaws.com/".$_GET['photo'];

                //instagram share url

                $ig_share = '';
                $image_columnA = 'http://appevent.s3.amazonaws.com/'.$_GET['photo']; //replaceing leftsided image by get params


                App::uses('CakeEmail', 'Network/Email');
                $email = new CakeEmail();
                $email->from($email_from);
                $email->to($to);
                $email->subject($_GET['subject']);
                $email->template('pixta', 'pixta');
                $email->viewVars(array('image_header' => $image_header));
                $email->viewVars(array('image_footer' => $image_footer));
                $email->viewVars(array('image_bg' => $image_bg));
                $email->viewVars(array('image_columnA' => $image_columnA));
                $email->viewVars(array('image_columnB' => $image_columnB));

                //call back params
                $email->viewVars(array('host'=>$host));
                $email->viewVars(array('event_email_id' => $event_email_id));
                $email->viewVars(array('fb_share' => $fb_share));
                $email->viewVars(array('tw_share' => $tw_share));
                $email->viewVars(array('ig_share' => $ig_share));
                $email->viewVars(array('share_url' => $image_columnA));

                $email->emailFormat('both');

                $email->send();
                $success = true;
            }

        }
        $this->response->type('json');
        $this->RequestHandler->respondAs('json');
        echo json_encode(array('response' => !empty($success)));
    }

    /*
     * Trace Count for social sharing.
     *
     * */
    public function trace_share($event_email_id=null)
    {
        $media_share = $_GET['media']."_share";

        $this->Event->EventEmail->query("update event_emails set $media_share = ifnull($media_share, 0) + 1 where id = $event_email_id");

        if(isset($_GET['share_url']))
            $this->set('redirect_url',$_GET['share_url']);
        else
            $this->redirect('/');

    }


    function photo_update() {
        $this->autoRender = false;

        $event_action_id = $this->request->data['id'];
        $blacklist = $this->request->data['blacklist'];

        $this->Event->EventAction->id = $event_action_id;
        $success = $this->Event->EventAction->save(array(
            'EventAction' => array(
                'blacklist' => $blacklist,
            )
        ));
        $this->response->type('json');
        $this->RequestHandler->respondAs('json');
        echo json_encode(array('response' => !empty($success)));
    }

    function rank_update() {
        $this->autoRender = false;

        $id = $this->request->data['id'];
        $rank = $this->request->data['rank'];

        $this->Event->id = $id;
        $event = $this->Event->read(null, $id);

        $view_order =  $event['Event']['view_order'] ;

        App::uses('ConnectionManager', 'Model');
        $db = ConnectionManager::getDataSource('default');


        if($rank == 'up'){

            $sql_1 = "update events set view_order=view_order+1 where view_order='$view_order' - 1";
            $sql_1 = "update events set view_order=view_order+1 where view_order='$view_order' - 1";
            $db->rawQuery($sql_1);
            $sql_2 = "update events set view_order=view_order-1 where id='$id'";
            $db->rawQuery($sql_2);
        }
        if($rank == 'down'){

            $sql_3 = "update events set view_order=view_order-1 where view_order='$view_order' + 1";
            $db->rawQuery($sql_3);
            $sql_4 = "update events set view_order=view_order+1 where id='$id'";
            $db->rawQuery($sql_4);
        }

        $success = 'success';

        $this->response->type('json');
        $this->RequestHandler->respondAs('json');
        echo json_encode(array('response' => !empty($success)));
    }

    function photo_update_all() {
        $this->autoRender = false;

        $event_id = $this->request->data['event_id'];
        $blacklist = $this->request->data['blacklist'];

        /*
        $this->Event->EventAction->event_id = $event_id;

         $this->Event->EventAction->save(array(
            'EventAction' => array(
                'event_id' => $event_id,
                'blacklist' => $blacklist,
            )
        ));
*/
        $sql = "update event_actions set blacklist = '$blacklist' where event_id = '$event_id'";

        App::uses('ConnectionManager', 'Model');
        $db = ConnectionManager::getDataSource('default');
        $db->rawQuery($sql);

        //var_dump($success);

        $success = true;
        $this->response->type('json');
        $this->RequestHandler->respondAs('json');
        echo json_encode(array('response' => !empty($success)));

    }

    function action_image() {
        $this->autoRender = false;

        $event_id = $this->request->data['event_id'];
        $event_action_id = $this->request->data['event_action_id'];

        $event_actions = $this->Event->EventAction->find('all', array('recursive' => -1, 'conditions' => array('EventAction.event_id' => $event_id, 'EventAction.id >' => $event_action_id, 'EventAction.blacklist !=' => 1), 'order' => array('EventAction.id' => 'asc')));

        //print_r($event_actions);

        $this->response->type('json');
        $this->RequestHandler->respondAs('json');
        echo json_encode(array('response' => $event_actions));
    }

    /**
     *
     * Dynamically generates a .csv file by looping through the results of a sql query.
     *
     */

    public function exportCSV($results)
    {
    	ini_set('max_execution_time', 600); //increase max_execution_time to 10 min if data set is very large

    	//create a file
    	$filename = "export_".date("Y.m.d").".csv";
    	$csv_file = fopen('php://output', 'w');

    	header('Content-type: application/csv');
    	header('Content-Disposition: attachment; filename="'.$filename.'"');

    	// The column headings of your .csv file
    	//$header_row = array("ID", "Event ID", "Phone ID", "Blacklist", "Phone Type", "Action Name", "Photo", "Created");
    	//fputcsv($csv_file,$header_row,',','"');

    	// Each iteration of this while loop will be a row in your .csv file where each field corresponds to the heading of the column
    	foreach($results as $result)
    	{
    		fputcsv($csv_file,$result,',','"');
    	}

    	fclose($csv_file);
    }


    public function share() {

        $this->autoRender = false;

        $this->facebook = new Facebook(array(
            'appId'  => $this->__fbApiKey,
            'secret' => $this->__fbSecret,
            'fileUpload' => true
        ));

        if ($this->facebook->getUser()) {

            //get image in local from bucket
            $image = file_get_contents('http://appevent.s3.amazonaws.com/'.$_GET['photo']);
            $save_file = fopen('img/email_image/'.$_GET['photo'], 'w');
            fwrite($save_file, $image);
            fclose($save_file);
            $file = IMAGES . 'email_image' . DS . $_GET['photo'];

            //add to wall
            $attachment = array('message' => 'PIXTA is now on the App Store',
                'name' => 'PIXTA is now on the App Store',
                'caption' => 'PIXTA is now on the App Store',
                'link' => 'http://www.pixta.com.au',
                'description' => 'Pixta Image Share',
                'picture' => 'http://appevent.s3.amazonaws.com/'.$_GET['photo'],
                'image'=> '@' . realpath($file)
            );

            $this->facebook->api("/me/photos", "post", $attachment);

            // $this->facebook->api("/me/feed" , 'post', json_encode($attachment));
            // $result = $this->facebook->api('/me/feed/','post',);

            $email_config_id = $_GET['email_config_id'];
            if($email_config_id > 0)
                $this->redirect('/events/trace_share/'.$email_config_id.'/?media=fb');

        } else {

            $loginUrl = $this->facebook->getLoginUrl(
                array('scope' => 'publish_stream')
            );
            echo "<script type='text/javascript'>top.location.href = '$loginUrl';</script>";
            exit();
            //$this->redirect($loginUrl);
        }

    }


    /*
        protected $comp_config = array(
            'app_permissions' => 'email,publish_actions,publish_stream'
        );



        // https://graph.facebook.com/oauth/access_token?client_id=160999394058419&client_secret=4d3d580a7d07334878b26942c77d1d7a&grant_type=client_credentials
        //protected $app_access_token = '160999394058419|S6I7SP_eWkKii5pNgp9moEcbS9M';

        //protected $user_access_token = 'CAACSbZAexILMBAOIubRXjdwLdWBlk5zSRwHZAfRg0YWZAqZC0Fb7lrOzGteGJG97hXLpQmiN74dvYz5nchtp5hIIzHNMgpqEhAvQkGwLm9KF7nleJFHOVKXIfvZAhCQKI6k9eYwDyQSBEsN9d7Bvj';

        protected function error_response($msg) {
            var_dump($msg);
            die('---');
        }

        protected function no_account_callback($get)
        {

        }

        protected function account_callback($user)
        {

        }

        function logged_in()
        {
            header('Access-Control-Allow-Origin: *');
            if (isset($_SESSION['fb_connected'])) {
                echo '{"connected": true}';
            }
            else {
                echo '{"connected": false}';
            }
            die('');
        }


    function script() {
        header('Access-Control-Allow-Origin: *');
        $session = session_id();
        header('Content-type: text/javascript');

        echo <<<SCRIPT
                window.api_friendly_fb_connect = function ($, window, undefined) {
                    var _fb_connected = false;

                    $(".connect,.share").click(function() {
                        var win = window.open("http://www.pixta.com.au/events/login/?psession={$session}", "facebook_connect", "left=20,top=20,width=721,height=587,toolbar=0,resizable=0");

                        var closed = false;
                        var iter = 1;
                        var self = $(this);

                        var debug = 0;

                        var callback = function() {
                            if (debug) console.log(iter);
                            iter += 1;

                            if (win && win.closed !== false) {
                                if (debug) console.log("awaiting response");

                                function checkConnect() {

                                    if (_fb_connected) {
                                        if (debug) console.log("connected");
                                        var src = self.closest(".fb-like");

                                        //console.log(src);
                                        //console.log(data);
                                        if (self.hasClass('share')) {
                                            src.html("Shared");

                                            var data = {
                                                name: src.attr("data-name"),
                                            link: src.attr("data-link"),
                                            message: src.attr("data-message"),
                                            picture: src.attr("data-picture"),
                                            description: src.attr("data-description")
                                        };
                                        $.post("http://www.pixta.com.au/events/share/?psession={$session}", data);
                                    }
                                        else {
                                            src.html("Liked");

                                            var data = {
                                                id: src.attr('data-id')
                                        };
                                        $.post("http://www.pixta.com.au/events/like/?psession={$session}", data);
                                    }
                                    }
                                    else {
                                        if (debug) console.log("not connected");
                                    }


                                }
                                $.getJSON("http://www.pixta.com.au/events/logged_in/?psession={$session}", function(data) {
                                        //console.log(data);
                                if (data['connected']==true || data['connected']=="true") {
                                            _fb_connected = true;
                                        }
                                checkConnect();
                            });

                            }
                            else setTimeout(callback, 250);
                        };
                        setTimeout(callback, 250);
                        return false;
                    });
                };
    SCRIPT;

        die('');
    }


    function html()
    {
        header('Access-Control-Allow-Origin: *');

        echo <<<HTML
            <a class="share" href="#" style="display:block;float:left;">Share</a>

        HTML;
        die('');
    }

    protected function _destroy()
    {
        // We need to clear out any stale/previously hanging
        $this->facebook->destroySession();
        setcookie('fbs_' . $this->facebook->getAppId(), '', time() - 100, '/', $_SERVER['HTTP_HOST']);
        //setcookie('fb_connected', '', time() - 100, '/', $_SERVER['HTTP_HOST']);
        if (isset($_SESSION['fb_connected'])) {
            unset($_SESSION['fb_connected']);
        }
    }

        protected function _login() {
            $session = session_id();
            $redirect_uri = (isset($_SERVER['HTTPS']) ? "https://" : "http://")
                . $_SERVER['HTTP_HOST'] . ''//$_SERVER['SCRIPT_NAME']
                . '/facebook/login_return/?'
                . (!empty($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] . '&' : '')
                . "psession={$session}";

            $auth_config = array(
                'scope' => $this->comp_config['app_permissions'], //Extended Permissions requested from the API at time of login
                //'display' => 'popup', //Dialog Form Factors used to display login page
                'redirect_uri' => $redirect_uri //Callback URL once user is authenticated
            );
            echo "Connecting with facebook. Please wait...";
            $login_url = $this->facebook->getLoginUrl($auth_config);
            header('Location: ' . $login_url);
            die('');
        }


        function login()
        {
            $this->_destroy();

            // Now drive the user to Facebook redirect for login/permission/etc.
            //$user = $this->get_facebook_user();

            $this->_login();

        }


        function login_return()
        {
            header('Access-Control-Allow-Origin: *');
            $user = $this->get_facebook_user();
            $user_data = var_export($user, true);
            $error_data = var_export($_GET, true);

            // if returned without error but still we don't have user info
            // then how come we reached this page ?
            // so retry login in facebook !
            if (!empty($user)) {
                $this->account_callback($user);
                $_SESSION['fb_connected'] = 1;
            }
            else if (isset($_GET['error_reason'])) {
                $this->no_account_callback($_GET);
            }
            else {

                // keep a session information to track number of tries.
                // if this is the first try then
                if (!isset($_SESSION['connect_return_nouser'])) {
                    $_SESSION['connect_return_nouser'] = 1;

                    // sleep 1 sec to ensure a delay between successive requests
                    // to sync using delays/timers. We should revisit this.
                    sleep(1);
                    $this->_login();
                }
            }
            unset($_SESSION['connect_return_nouser']);

            //setcookie('fb_connected', true, time() + 1000000, '/', $_SERVER['HTTP_HOST']);
            echo '
            <html>

            <script type="text/javascript">
                //window.opener._fb_connected = ' . (!empty($user) ? 'true' : 'false') . ';

                window.close();
            </script>
            </html>
            ';
            die('');
        }


        protected function get_facebook_user()
        {
            try {
                $user_id = $this->facebook->getUser();
                if ($user_id) {
                    return array('fb_user_id' => $user_id, 'access_token' => $this->facebook->getAccessToken());
                }
            } catch (Exception $e) {
                var_dump($e);
            }

            return null;
        }

        public function share() {
            header('Access-Control-Allow-Origin: *');

            //$attachment = $_POST;

            array(
                 'message' => "test",
                 'name'    => "Test Title",
                 'link'    => $uri,
                 'description' => $desc,
                 'picture' => $pic,
                 'actions' => json_encode(array('name' => $action_name,'link' => $action_link))
            );




            $user = $this->get_facebook_user();

            if(!$user)
                $this->login();

            $attachment['access_token'] = $user['access_token'];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,'https://graph.facebook.com/' . $user['fb_user_id'].'/feed');
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $attachment);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  //to suppress the curl output
            $result = curl_exec($ch);
            echo $result;
            curl_close ($ch);
            die('');
        }

        public function view_user_access_token() {
            $this->facebook->setAccessToken(null);
            echo $this->facebook->getAccessToken();
            var_dump($this->facebook);
            die('');
        }

        */
}
