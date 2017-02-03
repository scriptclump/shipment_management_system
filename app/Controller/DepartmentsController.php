<?php
App::uses('AppController', 'Controller');
/**
 * Departments Controller
 *
 * @property Department $Department
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class DepartmentsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'Search.Prg');

	public function beforeFilter() {
        parent::beforeFilter();
        //Here, we disable the Security component for Ajax requests and for the "fineupload" action
        if( $this->RequestHandler->isPost() && ( ($this->action == 'admin_bulk_action') ) ){
            $this->Security->validatePost = false;
            $this->Security->enabled = false;
            $this->Security->csrfCheck = false;
        }
        $this->Auth->allow('display');
    }

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Prg->commonProcess();
		$this->Paginator->settings['limit'] = 50;
        $this->Paginator->settings['conditions'] = $this->Department->parseCriteria($this->Prg->parsedParams());
        $this->set('departments', $this->Paginator->paginate());
        $cities = $this->Department->City->find('list', array(
	        'order' => array('City.title')
	    ));
        $this->set('cities', $cities );
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Department->exists($id)) {
			throw new NotFoundException(__('Invalid department'));
		}
		$options = array('conditions' => array('Department.' . $this->Department->primaryKey => $id));
		$this->set('department', $this->Department->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Department->create();
			if ($this->Department->save($this->request->data)) {
				$this->Session->setFlash(__('The department has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The department could not be saved. Please, try again.'));
			}
		}
		$cities = $this->Department->City->find('list', array(
	        'order' => array('City.title')
	    ));
		$this->set(compact('cities'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Department->exists($id)) {
			throw new NotFoundException(__('Invalid department'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Department->save($this->request->data)) {
				$this->Session->setFlash(__('The department has been saved.'));
				if ($this->referer() != '/') {
		            return $this->redirect($this->referer());
		        }
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The department could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Department.' . $this->Department->primaryKey => $id));
			$this->request->data = $this->Department->find('first', $options);
		}
		$cities = $this->Department->City->find('list', array(
	        'order' => array('City.title')
	    ));
		$this->set(compact('cities'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Department->id = $id;
		if (!$this->Department->exists()) {
			throw new NotFoundException(__('Invalid department'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Department->delete()) {
			$this->Session->setFlash(__('The department has been deleted.'));
		} else {
			$this->Session->setFlash(__('The department could not be deleted. Please, try again.'));
		}

		$pos = strpos($this->referer(), 'view');
		if ($pos !== false) {
			return $this->redirect(array('action' => 'index'));
		} else{
			if ($this->referer() != '/') {
	            return $this->redirect($this->referer());
	        }
		}
		return $this->redirect(array('action' => 'index'));
	}
	/**
	 * bulk action method
	 *
	 * @return void
	 */
	public function admin_bulk_action() {
		$this->request->onlyAllow('post', 'bulk_action');
		if( count($this->request->data['Department']['del_item']) > 0 ){
			foreach ($this->request->data['Department']['del_item'] as $key => $value) {
				$ids[] = $value;
			}

			if( $this->request->data['Department']['do_action'] == "activate" ){
				if( $this->Department->updateAll( array('Department.status'=>1), array('Department.id'=>$ids) ) ){
	                $this->Session->setFlash(__('Selected departments are activated.', true));
	            }
	        }

	        if( $this->request->data['Department']['do_action'] == "deactivate" ){
				if( $this->Department->updateAll( array('Department.status'=>0), array('Department.id'=>$ids) ) ){
	                $this->Session->setFlash(__('Selected departments are deactivated.', true));
	            }
	        }

	        if( $this->request->data['Department']['do_action'] == "delete" ){
				if( count($this->request->data['Department']['del_item']) > 0 ){
					foreach ($this->request->data['Department']['del_item'] as $key => $value) {
						$this->Department->id = $value;
						if (!$this->Department->exists()) {
							throw new NotFoundException(__('Invalid alert'));
						}
						if ($this->Department->delete()) {
							$this->Session->setFlash(__('The department (#id '.$value.') has been deleted.'),'success');
						} else {
							$this->Session->setFlash(__('The department could not be deleted. Please, try again.'),'error');
						}
					}
				} else{
					$this->Session->setFlash(__('Please select at least one item.'),'error');
				}
			}
		} else{
			$this->Session->setFlash(__('Please select at least one item.'),'error');
		}

		if ($this->referer() != '/') {
            return $this->redirect($this->referer());
        }
		return $this->redirect(array('action' => 'index'));
	}

	public function display(){
		return $departments = $this->Department->find('list', array(
			'fields'     => array('Department.title'),
			'conditions' => array('Department.status' => '1')
	    ));
	}
}
