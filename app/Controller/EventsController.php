<?php
App::uses('AppController', 'Controller');
/**
 * Events Controller
 *
 * @property Event $Event
 */


class EventsController extends AppController {

    //var $helpers = Array('Form', 'Tinymce');

    /**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Event->recursive = 0;
        $event_conditions = array();
        if(isset($_GET['company'])) $event_conditions['Event.company_id'] = $_GET['company'];
        if($this->isAdmin()){
            $events = $this->paginate(null,array($event_conditions));
        } else {
            $event_conditions['Event.status'] = 1;
           // $event_conditions['Event.updated_by'] = 1;
            $events = $this->paginate(null,$event_conditions);
        }
        $companies = $this->Event->Company->find('list');
        if($this->isAdmin()) $companies = array(''=> 'All')+ $companies;
        $this->set(compact('events','companies'));

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
		$this->set('event', $this->Event->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Event->create();
            $user_data = $this->Session->read('User');
            $this->request->data['Event']['updated_by'] = $user_data['id'];
            if(isset($this->request->data['Event']['img_thumb'])) {
                $thumb_path_uploaded = $this->request->data['Event']['img_thumb']['tmp_name'];
                $thumb_path_uploaded_name = $this->request->data['Event']['img_thumb']['name'];
                $this->request->data['Event']['img_thumb'] = '';
            }
            for($i=1;$i<=5;$i++){
                if(isset($this->request->data['Event']["img_overlay_$i"]['tmp_name'])){
                    $overlay_path_uploaded[] = $this->request->data['Event']["img_overlay_$i"]['tmp_name'];
                    $overlay_path_uploaded_name[] = $this->request->data['Event']["img_overlay_$i"]['name'];
                    $this->request->data['Event']["img_overlay_$i"] = '';
                }
            }

            if ($this->Event->save($this->request->data)) {
                if(isset($this->request->data['Event']['img_thumb'])){
                    $thumb_path_uploaded_name = WWW_ROOT . '/img/events/' . $this->Event->id . '-' . $thumb_path_uploaded_name;
                    move_uploaded_file( $thumb_path_uploaded , $thumb_path_uploaded_name);
                    $this->request->data['Event']['img_thumb'] = $thumb_path_uploaded_name;
                }
                for($i=1;$i<=5;$i++){
                    if(isset($this->request->data['Event']["img_overlay_$i"])){
                        $overlay_path_uploaded_name[$i-1] = WWW_ROOT . '/img/events/' . $this->Event->id . "-$i-" . $overlay_path_uploaded_name[$i-1];
                        move_uploaded_file($overlay_path_uploaded[$i-1],$overlay_path_uploaded_name[$i-1]);
                        $this->request->data['Event']["img_overlay_$i"] = $overlay_path_uploaded_name[$i-1];
                    }
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
		if (!$this->Event->exists()) {
			throw new NotFoundException(__('Invalid event'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
            $user_data = $this->Session->read('User');
            $this->request->data['Event']['updated_by'] = $user_data['id'];

            if(!empty($this->request->data['Event']['img_thumb']['tmp_name'])) {
                $thumb_path_uploaded = $this->request->data['Event']['img_thumb']['tmp_name'];
                $thumb_path_uploaded_name = '/img/events/' . $this->Event->id .'-' . $this->request->data['Event']['img_thumb']['name'];
                $this->request->data['Event']['img_thumb'] = '';
            } else {
                unset($this->request->data['Event']['img_thumb']);
            }
            for($i=1;$i<=5;$i++){
                if(!empty($this->request->data['Event']["img_overlay_$i"]['tmp_name'])){
                    $overlay_path_uploaded[] = $this->request->data['Event']["img_overlay_$i"]['tmp_name'];
                    $overlay_path_uploaded_name[] = '/img/events/' . $this->Event->id . "-$i-" . $this->request->data['Event']["img_overlay_$i"]['name'];
                    $this->request->data['Event']["img_overlay_$i"] = '';
                } else {
                    unset($this->request->data['Event']["img_overlay_$i"]);
                }
            }

            if ($this->Event->save($this->request->data)) {
                if (!empty($thumb_path_uploaded)) {
                    move_uploaded_file($thumb_path_uploaded, WWW_ROOT . $thumb_path_uploaded_name);
                    $this->request->data['Event']['img_thumb'] = $thumb_path_uploaded_name;
                } elseif (!empty($this->request->data['Event']['img_thumb_delete'])) {
                    $this->request->data['Event']['img_thumb'] = '';
                }
                for ($i = 1; $i <= 5; $i++) {
                    if (!empty($overlay_path_uploaded[$i - 1])) {
                        move_uploaded_file($overlay_path_uploaded[$i - 1], WWW_ROOT . $overlay_path_uploaded_name[$i-1]);
                        $this->request->data['Event']["img_overlay_$i"] = $overlay_path_uploaded_name[$i-1];

                    } elseif (!empty($this->request->data['Event']["img_overlay_{$i}_delete"])) {
                        $this->request->data['Event']["img_overlay_$i"] = '';
                    }
                }

                $this->Event->save($this->request->data);
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

    public function report($id = null) {
        $this->Event->id = $id;
        if (!$this->Event->exists()) {
            throw new NotFoundException(__('Invalid event'));
        }
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
		if ($this->Event->saveField('status',0)) {
			$this->Session->setFlash(__('Event deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Event was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

    public function eventlist(){
        $this->autoRender = false;
        $params = array_keys($_GET);
        if(!empty($params)) $params_formatted = array('fields' => $params);
        $options = array(
            'recursive' => 0,
            'status' => 1
        );
       /*
        if(!empty($params)){
            $options = array_merge($options,$params_formatted);
        }
       */
       // var_dump($params_formatted);

        $events = $this->Event->find('all', $options);
        //var_dump($events);
        $events_array = array();
        $i=0;

        foreach($events as $event){
             $overlay_img_count = 0;
             $events_array[$i]['id'] = $event['Event']['id'];
             $events_array[$i]['name'] = $event['Event']['name'];
             $events_array[$i]['shortdescription'] = $event['Event']['shortdescription'];
             $events_array[$i]['company_name'] = $event['Company']['name'];
             $events_array[$i]['facebook_msg'] = $event['Event']['facebook_msg'];
             $events_array[$i]['facebook_url'] = $event['Event']['facebook_url'];
             $events_array[$i]['twitter_msg'] = $event['Event']['twitter_msg'];
             $events_array[$i]['html_before'] = $event['Event']['html_before'];
             $events_array[$i]['html_after'] = $event['Event']['html_after'];
             $events_array[$i]['img_thumb'] = FULL_BASE_URL . $event['Event']['img_thumb'];

            if(!empty($this->request->query['gpslat']) && !empty($this->request->query['gpslong']) && !empty($event['Event']['gpslat']) && !empty($event['Event']['gpslong'])){
                 $events_array[$i]['distance'] = $this->calculate_distance($this->request->query['gpslat'],$this->request->query['gpslong'],$event['Event']['gpslat'],$event['Event']['gpslong']) . ' km';
             }
             else {
                 $events_array[$i]['distance'] = 0;
             }
             if(!empty( $event['Event']['img_overlay_1'])){
                $events_array[$i]['img_overlay_1'] = FULL_BASE_URL . $event['Event']['img_overlay_1'];
                 $overlay_img_count ++;
             }
             if(!empty( $event['Event']['img_overlay_2'])){
                $events_array[$i]['img_overlay_2'] = FULL_BASE_URL . $event['Event']['img_overlay_2'];
                 $overlay_img_count ++;
             }
             if(!empty( $event['Event']['img_overlay_3'])){
                $events_array[$i]['img_overlay_3'] = FULL_BASE_URL . $event['Event']['img_overlay_3'];
                 $overlay_img_count ++;
             }
             if(!empty( $event['Event']['img_overlay_4'])){
                $events_array[$i]['img_overlay_4'] = FULL_BASE_URL . $event['Event']['img_overlay_4'];
                 $overlay_img_count ++;
             }
             if(!empty( $event['Event']['img_overlay_5'])){
                $events_array[$i]['img_overlay_5'] = FULL_BASE_URL . $event['Event']['img_overlay_5'];
                 $overlay_img_count ++;
             }
            $events_array[$i]['number_of_overlay'] = $overlay_img_count;

            $i++;

        }
        $events_array = Set::sort($events_array, '{n}.distance', 'asc');
        //$events_array = Set::sort($events_array, '{n}.{s}.{n}', 'SORT_ASC');

        $this->response->type('json');
        $this->RequestHandler->respondAs('json'); /* I've tried 'json', 'JSON', 'application/json' but none of them work */
        echo json_encode($events_array);
    }

    public function event_action(){
        $this->autoRender = false;
        if(!empty($_GET)){
            $success = $this->Event->EventAction->save(array(
                'EventAction' => array(
                    'event_id' => $_GET['event_id'],
                    'phone_type' => $_GET['phone_type'],
                    'action_name' => $_GET['action'],
                    'phone_id' => $_GET['phone_id'],
                    'photo' => $_GET['photo'],
                )
            ));
        }
        $this->response->type('json');
        $this->RequestHandler->respondAs('json'); /* I've tried 'json', 'JSON', 'application/json' but none of them work */
        echo json_encode(array('response' => !empty($success)));
    }
/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Event->recursive = 0;
		$this->set('events', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->Event->id = $id;
		if (!$this->Event->exists()) {
			throw new NotFoundException(__('Invalid event'));
		}
		$this->set('event', $this->Event->read(null, $id));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Event->create();
			if ($this->Event->save($this->request->data)) {
				$this->Session->setFlash(__('The event has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The event could not be saved. Please, try again.'));
			}
		}
		$users = $this->Event->User->find('list');
		$this->set(compact('users'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->Event->id = $id;
		if (!$this->Event->exists()) {
			throw new NotFoundException(__('Invalid event'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Event->save($this->request->data)) {
				$this->Session->setFlash(__('The event has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The event could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Event->read(null, $id);
		}
		$users = $this->Event->User->find('list');
		$this->set(compact('users'));
	}

/**
 * admin_delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Event->id = $id;
		if (!$this->Event->exists()) {
			throw new NotFoundException(__('Invalid event'));
		}
		if ($this->Event->delete()) {
			$this->Session->setFlash(__('Event deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Event was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
