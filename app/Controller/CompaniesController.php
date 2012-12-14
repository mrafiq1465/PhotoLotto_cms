<?php
App::uses('AppController', 'Controller');
/**
 * Companies Controller
 *
 * @property Company $Company
 */
class CompaniesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Company->recursive = 0;
		$this->set('companies', $this->paginate(null,array('Company.status' => 1)));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Company->id = $id;
		if (!$this->Company->exists()) {
			throw new NotFoundException(__('Invalid company'));
		}
		$this->set('company', $this->Company->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Company->create();
			if ($this->Company->save($this->request->data)) {
				$this->Session->setFlash(__('The company has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The company could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Company->id = $id;
		if (!$this->Company->exists()) {
			throw new NotFoundException(__('Invalid company'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Company->save($this->request->data)) {
				$this->Session->setFlash(__('The company has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The company could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Company->read(null, $id);
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
		$this->Company->id = $id;
		if (!$this->Company->exists()) {
			throw new NotFoundException(__('Invalid company'));
		}
		if ($this->Company->saveField('status',0)) {
			$this->Session->setFlash(__('Company deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Company was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

    public function export(){
        $this->autoRender = false;
        $excluded_rows = array('id', 'updated_by');

        $rows[] = array_filter(array_keys($this->Company->getColumnTypes()), function ($item) use ($excluded_rows) {
            if(in_array($item, $excluded_rows)){
                return false;
            } else {
                return $item;
            }
        });

        $companies = $this->Company->find('all',array('recursive'=> -1));
        foreach ($companies as $company) {
            foreach($excluded_rows as $exclude){
                unset($company['Company'][$exclude]);
            }
            $rows[] = $company['Company'];
        }

        //todo: very bad memory hungry code... will have to fix it soon ...

        $temp_file_name = '/tmp/' . mt_rand(1,1000000000) . '.csv';
        $fp = fopen($temp_file_name, 'w');
        foreach($rows as $row){
            fputcsv($fp, $row);
        }
        fclose($fp);
        $FileName = 'Event-submissions-' . date("d-m-y").'.csv';
        header('Content-Disposition: inline; filename="'.$temp_file_name.'"');
        header("Content-Transfer-Encoding: Binary");
        header("Content-length: ".filesize($temp_file_name));
        header('Content-Type: application/excel');
        header('Content-Disposition: attachment; filename="'.$FileName.'"');
        readfile($temp_file_name);
    }

}
