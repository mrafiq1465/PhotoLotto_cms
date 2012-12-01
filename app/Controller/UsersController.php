<?php


App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
		$roles = $this->User->Role->find('list');
		$this->set(compact('roles'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->User->read(null, $id);
		}
		$roles = $this->User->Role->find('list');
		$this->set(compact('roles'));
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
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->User->delete()) {
			$this->Session->setFlash(__('User deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

    function login() {
        if ($this->isLoggedin()) {
            $this->redirect('/users/profile');
            exit;
        }

        if (!empty($this->data)) {
            $this->Session->delete('Message.flash');

            $dbuser = $this->User->find('first', array('recursive' => -1, 'conditions' => array(
                'OR' => array(
                    array('User.name' => $this->data['User']['name']),
                    array('User.email' => $this->data['User']['name'])
                )
            )));

            if(!empty($dbuser) && ($dbuser['User']['password'] == $this->data['User']['password'] )){
                $this->User->save($dbuser);

                // write the username to a session

                $this->Session->write($dbuser);
                // redirect the user
                //$this->Session->setFlash('You have successfully logged in.'); // Richard asked us to remove this message 2008-10-02 JB
                if ($this->Session->check('goto')) {
                    $url = $this->Session->read('goto');
                    $this->Session->delete('goto');
                } else {
                    $url = $this->data['User']['goto'];
                }

                $url = (empty($url)) ? '/' : $url;
                if ($dbuser['User']['username'] == 'admin'){
                    $this->redirect('/admin/');
                }
                $this->redirect($url);
            }
            else {
                $this->Session->setFlash('Either your username or password is incorrect.', FALSE, FALSE, 'login');
            }
        }
        if (!$this->Session->check('goto')) {
            $this->Session->write('goto', $this->referer());
            $this->set('goto', $this->referer());
        } else {
            $this->set('goto', $this->Session->read('goto'));
        }
    }

    function logout() {
        // delete the user session
        $this->Session->destroy();
        // redirect to posts index page
        $this->Session->setFlash('You have successfully logged out.');
        $this->redirect('/');
    }

}

