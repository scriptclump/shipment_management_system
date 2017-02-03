<?php
App::uses('AppController', 'Controller');
/**
 * Communications Controller
 *
 * @property Communication $Communication
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class CommunicationsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

	public function beforeFilter() {
        parent::beforeFilter();
        //Here, we disable the Security component for Ajax requests and for the "fineupload" action
        if( $this->RequestHandler->isPost() && ($this->action == 'admin_add' || ($this->action == 'add')) ){
			$this->Security->validatePost = false;
			$this->Security->enabled      = false;
			$this->Security->csrfCheck    = false;
        }
    }

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Communication->recursive = 0;
		$this->set('communications', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Communication->exists($id)) {
			throw new NotFoundException(__('Invalid communication'));
		}
		$options = array('conditions' => array('Communication.' . $this->Communication->primaryKey => $id));
		$this->set('communication', $this->Communication->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Communication->create();
			$this->Communication->saveField('ip_address', $_SERVER['REMOTE_ADDR']);
			$this->Communication->saveField('to_id', 2);
			if ($this->Communication->save($this->request->data)) {
				$this->Session->setFlash(__('Your message has been sent.'));
				return $this->redirect($this->referer());
			} else {
				$this->Session->setFlash(__('The communication could not be saved. Please, try again.'));
			}
		}
		$alerts = $this->Communication->Alert->find('list');
		$this->set(compact('alerts'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Communication->exists($id)) {
			throw new NotFoundException(__('Invalid communication'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Communication->save($this->request->data)) {
				$this->Session->setFlash(__('The communication has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The communication could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Communication.' . $this->Communication->primaryKey => $id));
			$this->request->data = $this->Communication->find('first', $options);
		}
		$alerts = $this->Communication->Alert->find('list');
		$this->set(compact('alerts'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Communication->id = $id;
		if (!$this->Communication->exists()) {
			throw new NotFoundException(__('Invalid communication'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Communication->delete()) {
			$this->Session->setFlash(__('The communication has been deleted.'));
		} else {
			$this->Session->setFlash(__('The communication could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Communication->recursive = 0;
		$this->set('communications', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Communication->exists($id)) {
			throw new NotFoundException(__('Invalid communication'));
		}
		$options = array('conditions' => array('Communication.' . $this->Communication->primaryKey => $id));
		$this->set('communication', $this->Communication->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Communication->create();
			$this->Communication->saveField('ip_address', $_SERVER['REMOTE_ADDR']);
			if ($this->Communication->save($this->request->data)) {
				$this->Session->setFlash(__('The communication has been saved.'));
				return $this->redirect($this->referer());
			} else {
				$this->Session->setFlash(__('The communication could not be saved. Please, try again.'));
			}
		}
		// $alerts = $this->Communication->Alert->find('list');
		// $this->set(compact('alerts'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Communication->exists($id)) {
			throw new NotFoundException(__('Invalid communication'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Communication->save($this->request->data)) {
				$this->Session->setFlash(__('The communication has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The communication could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Communication.' . $this->Communication->primaryKey => $id));
			$this->request->data = $this->Communication->find('first', $options);
		}
		$alerts = $this->Communication->Alert->find('list');
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
		$this->Communication->id = $id;
		if (!$this->Communication->exists()) {
			throw new NotFoundException(__('Invalid communication'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Communication->delete()) {
			$this->Session->setFlash(__('The communication has been deleted.'));
		} else {
			$this->Session->setFlash(__('The communication could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
