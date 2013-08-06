<?php
App::uses('AppController', 'Controller');
/**
 * Events Controller
 *
 * @property Event $Event
 */

//require_once('facebook/facebook.php');

// function defination to convert array to xml
function array_to_xml($student_info, &$xml_student_info) {
    foreach($student_info as $key => $value) {
        if(is_array($value)) {
            if(!is_numeric($key)){
                $subnode = $xml_student_info->addChild("$key");
                array_to_xml($value, $subnode);
            }
            else{
                //$subnode = $xml_student_info->addChild("");
                array_to_xml($value, $xml_student_info);
            }
        }
        else {
            $xml_student_info->addChild("$key","$value");
        }
    }
}

class EventsController extends AppController
{

    //var $helpers = Array('Form', 'Tinymce');

    public $components = array('RequestHandler');
    public $helpers = array('Text');
    public $uses = array('Event', 'EventEmail', 'EventEmailConfig');

    var $__fbApiKey = '549616571765083';
    var $__fbSecret = '1a13e632d224c8310ef6914c766df371';

    //for local test
    //var $__fbApiKey = '144734069055490';
    //var $__fbSecret = '783af0d0c0aeee9c4cb51b4536901be5';
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
        $this->response->type('xml'); 
        
        $this->Event->id = $id;
        if (!$this->Event->exists()) {
            throw new NotFoundException(__('Invalid event'));
        }
        if ($this->RequestHandler->isRss()) {
            $event = $this->Event->read(null, $id);
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

    public function email_stat($id = null) {
        $this->Event->id = $id;
        if (!$this->Event->exists()) {
            throw new NotFoundException(__('Invalid event'));
        }

        $event = $this->Event->read(null, $id);
        $event_emails = $this->Event->EventEmail->find('all', array('recursive' => -1, 'conditions' => array('EventEmail.event_id' => $id)));

        $fb_share = 0;
        $tw_share = 0;

        foreach($event_emails as $e){

            if(!empty($e['EventEmail']['fb_share'])){
                $fb_share = $fb_share + $e['EventEmail']['fb_share'];
            }
            if(!empty($e['EventEmail']['tw_share'])){
                $tw_share = $tw_share + $e['EventEmail']['tw_share'];
            }
        }

        $this->set(compact('event', 'event_emails','fb_share','tw_share'));
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
        ini_set('memory_limit', '5012M');

        foreach ($event_actions as $ea) {
            $url = 'http://appevent.s3.amazonaws.com/'. $ea['EventAction']['photo'];
            $data = @file_get_contents($url, false);
            if ($data !== false) {
                $zip->addFromString($ea['EventAction']['photo'], $data);
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

    public function download_email_post($event_id = null) {
        $this->autoRender = false;

        $this->Event->id = $event_id;
        if (!$this->Event->exists()) {
            throw new NotFoundException(__('Invalid event'));
        }
        $event_emails = $this->Event->EventEmail->find('all', array('recursive' => -1, 'conditions' => array('EventEmail.event_id' => $event_id)));

        $rows[] = array_keys($this->Event->EventEmail->getColumnTypes());

        foreach ($event_emails as $event_email) {
            $rows[] = $event_email['EventEmail'];
        }

        $this->exportCSV($rows);
    }

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

        if(isset($_GET['event_id'])){
            $options = array(
                'conditions' => array(
                    'Event.id' => $_GET['event_id'],
                ),
                'order' => array('Event.view_order' => 'asc', 'Event.created' => 'desc')
            );

        }
        else {
            $options = array(
                'conditions' => array(
                    'Event.date_end >=' => date('Y-m-d'),
                    'Event.status' => 1,
                ),
                'order' => array('Event.view_order' => 'asc', 'Event.created' => 'desc')
            );
        }
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

    public function delete_overlay() {
        $this->autoRender = false;

        $event_id = $this->request->data['event_id'];
        $overlay = 'img_overlay_'.$this->request->data['overlay'];


        App::uses('ConnectionManager', 'Model');
        $db = ConnectionManager::getDataSource('default');

        $sql = "update events set $overlay=null where id='$event_id' ";
        $db->rawQuery($sql);

        $this->response->type('json');
        $this->RequestHandler->respondAs('json');
        echo json_encode(array('response' => 'success'));
    }

    public function delete_email_image() {
        $this->autoRender = false;

        $id = $this->request->data['id'];

        App::uses('ConnectionManager', 'Model');
        $db = ConnectionManager::getDataSource('default');

        $sql = "update event_email_config set image_right=null where id='$id' ";
        $db->rawQuery($sql);

        $this->response->type('json');
        $this->RequestHandler->respondAs('json');
        echo json_encode(array('response' => 'success'));
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

                    $href = isset($event_config['EventEmailConfig']['href_right'])? ($event_config['EventEmailConfig']['href_right']) : '#';
                    $image_columnB = '<a href="'.$href.'"> <img style="display: block;" src="'.$host . $event_config['EventEmailConfig']['image_right'].'" alt="Pixta"/></a>';
                }
                //newly added end

                if(isset($event_config['EventEmailConfig']['email_from']) && trim($event_config['EventEmailConfig']['email_from'])!=='') {

                    $email_from =  $event_config['EventEmailConfig']['email_from'];
                    $temp = explode("<",$email_from);

                    if(!empty($temp[1])){
                        $email_from = array(preg_replace('/[";<>&*~|#]/', '', $temp[1]) => preg_replace('/[";<>&*~|#]/', '', $temp[0]));
                    }
                    else {
                        $email_from = preg_replace('/[";<>&*~|#]/', '', $temp[0]);
                    }
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

                $fb_share = "http://www.pixta.com.au/events/share/?photo=".$_GET['photo']."&event_email_id=" .$event_email_id."&email_config_id=".$email_config_id;

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

    public function trace_share($event_email_id=null)
    {
        $this->autoRender = false;

        $media_share = $_GET['media']."_share";

        $this->Event->EventEmail->query("update event_emails set $media_share = ifnull($media_share, 0) + 1 where id = $event_email_id");

        if($media_share == 'fb_share'){

            echo "<script type='text/javascript'>top.location.href = 'http://facebook.com';</script>";
            exit();
        }
        else if(isset($_GET['share_url'])){
            echo "<script type='text/javascript'>top.location.href = '".$_GET['share_url']."';</script>";
            exit();
        }
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
            'fileUpload' => true,
            'cookie' => false
        ));

        if ($this->facebook->getUser()) {

            $accessToken = $this->facebook->getAccessToken();

            //get image in local from bucket
            $image = file_get_contents('http://appevent.s3.amazonaws.com/'.$_GET['photo']);
            $save_file = fopen('img/email_image/'.$_GET['photo'], 'w');
            fwrite($save_file, $image);
            fclose($save_file);
            $file = IMAGES . 'email_image' . DS . $_GET['photo'];

            $event_config =  $this->EventEmailConfig->find('first', array('conditions'=>array('EventEmailConfig.id'=>$_GET['email_config_id']), 'recursive'=>1));

            $facebook_msg = 'PIXTA is now on the App Store';

            if(!empty($event_config['Event']['facebook_msg'])){
                $facebook_msg = $event_config['Event']['facebook_msg'];
            }
            if(!empty($event_config['Event']['facebook_url'])){
                $facebook_msg = $facebook_msg . '  ' .$event_config['Event']['facebook_url'];
            }

            //add to wall
            $attachment = array('message' => $facebook_msg,
                'name' => $facebook_msg,
                'caption' => $facebook_msg,
                'link' => 'http://www.pixta.com.au',
                'description' => 'Pixta Image Share',
                'picture' => 'http://appevent.s3.amazonaws.com/'.$_GET['photo'],
                'image'=> '@' . realpath($file)
            );



            $this->facebook->api("/me/photos", "post", $attachment);


            $event_email_id = $_GET['event_email_id'];

            //destroy session
            //$this->facebook->destroySession();

            if($event_email_id > 0)
                $this->redirect('/events/trace_share/'.$event_email_id.'/?media=fb');
            else
                $this->redirect('http://www.facebook.com');

        } else {

            $loginUrl = $this->facebook->getLoginUrl(
                array('scope' => 'publish_stream')

            );

            echo "<script type='text/javascript'>top.location.href = '$loginUrl';</script>";
            exit();
            //$this->redirect($loginUrl);
        }
    }

    public function resend_email() {
        $this->autoRender = false;
        $email_config = Configure::read('email_config');
        $image_header = $email_config['image_header'];
        $image_footer = $email_config['image_footer'];
        $image_bg = $email_config['image_bg'];
        $image_columnA = $email_config['image_columnA'];

        //image right configurable with html/custom href N.B: Do not remove img tag from here!
        $image_columnB = '<a href="#"> <img style="display: block;" src="'.$email_config['image_columnB'].'"  alt="Pixta"/></a>';
        $email_from = $email_config['email_from'];

        $event_email =  $this->EventEmail->find('first', array('conditions'=>array('id'=>$_GET['email_id']), 'recursive'=>-1));

        $event_id = $event_email['EventEmail']['event_id'];
        $email_from = $event_email['EventEmail']['email_from'];
        $email_to = $event_email['EventEmail']['email_to'];
        $subject = $event_email['EventEmail']['subject'];
        $photo = $event_email['EventEmail']['photo'];

        $event_email_id = $this->Event->EventEmail->getLastInsertId();

        $host = 'http://www.pixta.com.au';
        $event_config =  $this->EventEmailConfig->find('first', array('conditions'=>array('event_id'=>$event_id), 'recursive'=>-1));

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

                $href = isset($event_config['EventEmailConfig']['href_right'])? ($event_config['EventEmailConfig']['href_right']) : '#';
                $image_columnB = '<a href="'.$href.'"> <img style="display: block;" src="'.$host . $event_config['EventEmailConfig']['image_right'].'" alt="Pixta"/></a>';
            }
            //newly added end

            if(isset($event_config['EventEmailConfig']['email_from']) && trim($event_config['EventEmailConfig']['email_from'])!=='') {

                $email_from =  $event_config['EventEmailConfig']['email_from'];
                $temp = explode("<",$email_from);

                if(!empty($temp[1])){
                    $email_from = array(preg_replace('/[";<>&*~|#]/', '', $temp[1]) => preg_replace('/[";<>&*~|#]/', '', $temp[0]));
                }
                else {
                    $email_from = preg_replace('/[";<>&*~|#]/', '', $temp[0]);
                }
            }
            if(isset($event_config['EventEmailConfig']['subject']) && trim($event_config['EventEmailConfig']['subject'])!=='') {
                $subject =  $event_config['EventEmailConfig']['subject'];
            }
        }

        if(empty($subject)){
            $subject = $subject;
        }
        if (empty($email_to)) {
            die(json_encode(array('error' => 'email not given')));
        }
        else {
            $to=preg_split("([, ;\n])", $email_to);

            //Fb share url

            //$fb_share = "http://www.facebook.com/share.php?u=http://appevent.s3.amazonaws.com/".$_GET['photo'];
            //http://facebook.com/dialog/feed?app_id=144734069055490&link=http://appevent.s3.amazonaws.com/i_20130614082959.jpg&redirect_uri=https://www.pixta.com.au/events/trace_share/23/?media=fb
            //$fb_share = "http://facebook.com/dialog/feed?app_id=".$this->fbappid."&link=http://appevent.s3.amazonaws.com/".$_GET['photo']."&redirect_uri=https://www.pixta.com.au/events/trace_share/".$event_email_id."/?media=fb";

            $email_config_id = 0;
            if(!empty($event_config['EventEmailConfig']['id']))
                $email_config_id = $event_config['EventEmailConfig']['id'];

            $fb_share = "http://www.pixta.com.au/events/share/?photo=".$photo."&email_config_id=" .$event_email_id;

            //twitter share url

            $tw_share = "https://twitter.com/share?url=http://appevent.s3.amazonaws.com/".$photo;

            //instagram share url

            $ig_share = '';
            $image_columnA = 'http://appevent.s3.amazonaws.com/'.$photo; //replaceing leftsided image by get params

            App::uses('CakeEmail', 'Network/Email');
            $email = new CakeEmail();
            $email->from($email_from);
            $email->to($to);
            $email->subject($subject);
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

            $success = $email->send();
        }
        if($success)
            $res = 'Email has been sent successfully';
        else
            $res = 'Email is not sent. please try again.';


        $this->response->type('json');
        $this->RequestHandler->respondAs('json');
        echo json_encode(array('response' => $res));
    }

    public function xml($id = null){

        $this->autoRender = false;

        $event = $this->Event->read(null, $id);
        //$xmlObject = Xml::fromArray($event);
        //$xmlString = $xmlObject->asXML();

        $item = array();

        $item['name'] = $event['Event']['name'];
        $item['description'] = $bodyText = preg_replace('=\(.*?\)=is', '', $event['Event']['shortdescription_line_1']." ".$event['Event']['shortdescription_line_2']);
        $item['created'] = $event['Event']['created'];


        $item['overlay'] = array();

        for ($i = 1; $i <= 5; $i++) {
            if (!empty($event['Event']["img_overlay_$i"])) $item["overlay"][] = array('url'=>FULL_BASE_URL . $event['Event']["img_overlay_$i"]);
        }

        $item["photos"] = array();

        for ($i = 1; $i <= count($event['EventAction']); $i++) {
            $item["photos"][] = array('photo' => array(
//                'device' => $event['EventAction'][$i - 1]['phone_type'],
                'url' => S3_IMG_URL .'/'. $event['EventAction'][$i - 1]['photo'],
                'date' => date('m-d-Y H:i', strtotime($event['EventAction'][$i - 1]['created'])),
            ));
        }

        $xml = new SimpleXMLElement("<?xml version=\"1.0\"?><event></event>");
        array_to_xml($item, $xml);

        header('Content-Type: text/xml');
        echo $xml->asXML();

        die('');
    }


    public function fb_post_public_page() {
        $this->autoRender = false;

        $this->facebook = new Facebook(array(
            'appId'  => $this->__fbApiKey,
            'secret' => $this->__fbSecret,
            'fileUpload' => true,
            'cookie' => false
        ));

        if ($this->facebook->getUser()) {

            $event_actions = $this->Event->EventAction->find('all', array('recursive' => 1,
                //'conditions' => array('EventAction.event_id' => $event_id),
                'limit' => '5'
            ));
            //echo "<pre>";
            //print_r($event_actions);
            //echo "</pre>";

            foreach ($event_actions as $ea) {
                $public_page = "http://www.facebook.com/Syntaxperfect";
                $page_id = '520410234667909';
                $http_post = '/'.$page_id.'/photos';

                $url = 'http://appevent.s3.amazonaws.com/'. $ea['EventAction']['photo'];
                $image = @file_get_contents($url, false);
                if ($image !== false) {
                    $save_file = fopen('img/email_image/'.$ea['EventAction']['photo'], 'w');
                    fwrite($save_file, $image);
                    fclose($save_file);
                    $file = IMAGES . 'email_image' . DS . $ea['EventAction']['photo'];


                    $attachment = array(
                        'source' => '',
                        'picture' => 'http://appevent.s3.amazonaws.com/'.$ea['EventAction']['photo'],
                        'image'=> '@' . realpath($file)
                    );
                    $this->facebook->api($http_post, "post", $attachment);
                }
            }
        }
    }
}
