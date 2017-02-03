<?php
App::uses('AppController', 'Controller');
/**
 * AlertDetails Controller
 *
 * @property AlertDetail $AlertDetail
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class AlertDetailsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

	public function beforeFilter() {
	    parent::beforeFilter();
	    $this->Security->unlockedActions = array('add', 'admin_edit', 'admin_add');
		if( $this->RequestHandler->isPost() && ( ($this->action == 'add') || ($this->action == 'admin_bulk_action') ) ){
		    $this->Security->validatePost = false;
		    $this->Security->enabled = false;
		    $this->Security->csrfCheck = false;
		}
	    $this->Auth->allow( 'view');
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->AlertDetail->recursive = 0;
		$this->set('alertDetails', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->AlertDetail->exists($id)) {
			throw new NotFoundException(__('Invalid alert detail'));
		}
		$options = array('conditions' => array('AlertDetail.' . $this->AlertDetail->primaryKey => $id));
		$this->set('alertDetail', $this->AlertDetail->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->AlertDetail->create();
			if ($this->AlertDetail->save($this->request->data)) {
				$this->Session->setFlash(__('The alert detail has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The alert detail could not be saved. Please, try again.'));
			}
		}
		$alerts = $this->AlertDetail->Alert->find('list');
		$this->set(compact('alerts'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		// if (!$this->AlertDetail->exists($id)) {
		// 	throw new NotFoundException(__('Invalid alert detail'));
		// }
		if ($this->request->is(array('post', 'put'))) {
			// $this->AlertDetail->saveAll($this->AlertDetail->saveAll($this->request->data));
			//pr($this->request->data);
			//die;
			if ($this->AlertDetail->saveMany($this->request->data['AlertDetail'])) {
				$this->Session->setFlash(__('The items has been updated.'));
				return $this->redirect($this->referer());
			} else {
				$this->Session->setFlash(__('The alert detail could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('AlertDetail.' . $this->AlertDetail->primaryKey => $id));
			$this->request->data = $this->AlertDetail->find('first', $options);
		}
		$alerts = $this->AlertDetail->Alert->find('list');
		$this->set(compact('alerts'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->AlertDetail->id = $id;
		if (!$this->AlertDetail->exists()) {
			throw new NotFoundException(__('Invalid alert detail'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->AlertDetail->delete()) {
			$this->Session->setFlash(__('The alert detail has been deleted.'));
		} else {
			$this->Session->setFlash(__('The alert detail could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->AlertDetail->id = $id;
		if (!$this->AlertDetail->exists()) {
			throw new NotFoundException(__('Invalid item'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->AlertDetail->delete()) {
			$this->Session->setFlash(__('The item has been deleted.'));
		} else {
			$this->Session->setFlash(__('The item could not be deleted. Please, try again.'));
		}
		return $this->redirect($this->referer());
	}

	/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->AlertDetail->id = $id;
		if (!$this->AlertDetail->exists()) {
			throw new NotFoundException(__('Invalid item'));
		}
		$this->request->data['AlertDetail']['despatch'] = 1;
		// pr($this->request->data);
		// die;
		if ($this->AlertDetail->save($this->request->data)) {
			$this->Session->setFlash(__('The item has been added to despatch.'));
		} else {
			$this->Session->setFlash(__('The item could not be added to despatch. Please, try again.'));
		}
		return $this->redirect($this->referer());
	}
}
