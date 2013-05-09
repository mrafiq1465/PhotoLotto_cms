<?php
App::uses('AppController', 'Controller');
/**
 * Events Controller
 *
 * @property Event $Event
 */


class EventsController extends AppController
{

    //var $helpers = Array('Form', 'Tinymce');

    public $components = array('RequestHandler');
    public $helpers = array('Text');

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Event->recursive = 0;
        $event_conditions = array();
        if (isset($_GET['company'])) $event_conditions['Event.company_id'] = $_GET['company'];
        if ($this->isAdmin()) {
            $events = $this->paginate(null, array($event_conditions));
        } else {
            $event_conditions['Event.status'] = 1;
            // $event_conditions['Event.updated_by'] = 1;
            $events = $this->paginate(null, $event_conditions);
        }
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
           var_dump($event);

            return $this->set(compact('event'));
        }
        $this->set('event', $this->Event->read(null, $id));
    }

    function process_upload($event_id, $field) {
        if (isset($this->request->data['Event'][$field]['error']) && $this->request->data['Event'][$field]['error'] == 0) {
            $uploaded_file = $this->request->data['Event'][$field]['tmp_name'];
            $uploaded_file_name = $this->request->data['Event'][$field]['name'];
            $uploaded_file_name = '/img/events/' . $event_id . '-' . $uploaded_file_name;
            if (!move_uploaded_file($uploaded_file, WWW_ROOT . $uploaded_file_name)) {
                throw new NotFoundException(__('Permission not available in upload directory'));
            }
            ;
            $this->request->data['Event'][$field] = $uploaded_file_name;
        } elseif (is_array($this->request->data['Event'][$field]) && $this->request->data['Event'][$field]['error'] <> 0) {
            unset($this->request->data['Event'][$field]);
        } elseif (isset($this->request->data['Event'][$field . "_delete"])) {
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

    public function event_custom($id = null) {

        $this->layout = 'event2';
        $event = $this->Event->find('first', array(
            'conditions' => array('Event.name' => $id),
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

        $temp_file_name = '/tmp/' . mt_rand(1, 1000000000) . '.csv';
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
        readfile($temp_file_name);
    }

    public function download_image($event_id = null) {
        $this->autoRender = false;

        $this->Event->id = $event_id;

        if (!$this->Event->exists()) {
            throw new NotFoundException(__('Invalid event'));
        }

        $event = $this->Event->read(null, $event_id);
        $event_actions = $this->Event->EventAction->find('all', array('recursive' => -1, 'conditions' => array('EventAction.event_id' => $event_id)));


        print_r($event_actions);



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
        );

        $events = $this->Event->find('all', $options);
        //var_dump($events);
        $events_array = array();
        $i = 0;

        //we need to show the events that has status =1 & date_end >= today's date.

        foreach ($events as $event) {

            $overlay_img_count = 0;
            $events_array[$i]['id'] = $event['Event']['id'];
            $events_array[$i]['name'] = $event['Event']['name'];
            $events_array[$i]['event_type'] = $event['Event']['eventtype'];
            $events_array[$i]['shortdescription_line_1'] = $event['Event']['shortdescription_line_1'];
            $events_array[$i]['shortdescription_line_2'] = $event['Event']['shortdescription_line_2'];
            $events_array[$i]['company_name'] = $event['Company']['name'];
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

            $events_array[$i]['img_thumb'] = FULL_BASE_URL . $event['Event']['img_thumb'];

            if (!empty($this->request->query['gpslat']) && !empty($this->request->query['gpslong']) &&
                !empty($event['Event']['gpslat']) && !empty($event['Event']['gpslong']) &&
                $this->request->query['gpslat'] != '0.000000' && $this->request->query['gpslong'] != '0.000000' &&
                $this->request->query['gpslat'] != '0' && $this->request->query['gpslong'] != '0' &&
                $event['Event']['eventtype'] == 'location-based'
            ) {
                $events_array[$i]['distance'] = $this->calculate_distance($this->request->query['gpslat'], $this->request->query['gpslong'], $event['Event']['gpslat'], $event['Event']['gpslong']) . ' km';
            } else {
                $events_array[$i]['distance'] = 0;
            }

            $events_array[$i]['event_radius'] = 0;
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

    public function event_email() {
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

}
