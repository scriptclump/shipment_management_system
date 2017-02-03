<?php
App::uses('AppController', 'Controller');
/**
 * IcargoAddresses Controller
 *
 * @property IcargoAddress $IcargoAddress
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class IcargoAddressesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');


	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('display');
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->IcargoAddress->recursive = 0;
		$this->set('icargoAddresses', $this->Paginator->paginate());
		$this->set('title_for_layout', 'ICargoBox Address');
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->IcargoAddress->exists($id)) {
			throw new NotFoundException(__('Invalid icargo address'));
		}
		$options = array('conditions' => array('IcargoAddress.' . $this->IcargoAddress->primaryKey => $id));
		$this->set('icargoAddress', $this->IcargoAddress->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->IcargoAddress->create();
			if ($this->IcargoAddress->save($this->request->data)) {
				$this->Session->setFlash(__('The icargo address has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The icargo address could not be saved. Please, try again.'));
			}
		}
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->IcargoAddress->exists($id)) {
			throw new NotFoundException(__('Invalid icargo address'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->IcargoAddress->save($this->request->data)) {
				$this->Session->setFlash(__('The icargo address has been saved.'));
				return $this->redirect(array('action' => 'edit/1'));
			} else {
				$this->Session->setFlash(__('The icargo address could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('IcargoAddress.' . $this->IcargoAddress->primaryKey => $id));
			$this->request->data = $this->IcargoAddress->find('first', $options);
		}
		$this->set('title_for_layout', 'ICargoBox Address');
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->IcargoAddress->id = $id;
		if (!$this->IcargoAddress->exists()) {
			throw new NotFoundException(__('Invalid icargo address'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->IcargoAddress->delete()) {
			$this->Session->setFlash(__('The icargo address has been deleted.'));
		} else {
			$this->Session->setFlash(__('The icargo address could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function display() {
		return $icargobox_address = $this->IcargoAddress->find('first', array(
			'fields'     => array('IcargoAddress.name, IcargoAddress.address_one, IcargoAddress.address_two, IcargoAddress.city, IcargoAddress.state, IcargoAddress.zip_code'),
			'conditions' => array('IcargoAddress.status' => '1')
	    ));
	}

}
