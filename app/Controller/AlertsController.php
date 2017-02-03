<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Alerts Controller
 *
 * @property Alert $Alert
 * @property PaginatorComponent $Paginator
 */
class AlertsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
	var $uses = array('Alert', 'AlertDetail', 'Currency');

	public function beforeFilter() {
	    parent::beforeFilter();
	    $this->Security->unlockedActions = array('add', 'edit', 'admin_edit', 'admin_add');
		if( $this->RequestHandler->isPost() && ( ($this->action == 'add') || ($this->action == 'edit') || ($this->action == 'admin_bulk_action') ) ){
			$this->Security->validatePost = false;
			$this->Security->enabled      = false;
			$this->Security->csrfCheck    = false;
		}
	    $this->Auth->allow( 'view' );
	}

/**
 * description method
 *
 * @return void
 */
	public function description( $status = null ) {
		$alerts = $this->Alert->find();
		$this->Paginator->settings = array('order' => array('Alert.created' => 'desc'), 'limit' => '20');

		if( $status == 'recibidos' ){
           $status = 1;
        } else if( $status == 'consolidation' ){
           $status = 2;
        } else if( $status == 'pago-pendiente' ){
           $status = 3;
        } else if( $status == 'despachado' ){
           $status = 4;
        } else if( $status == 'entregado-a-la-transportadora' ){
           $status = 5;
        } else if( $status == 'entregado' ){
           $status = 6;
        } else if( $status == 'pendiente' ){
           $status = 0;
        }
        $status_str = __('PEDIDOS ');
        if( isset($status) ){
        	if($status == 0){
				$this->Paginator->settings = array('conditions' => array('Alert.status' => $status));
				$status_str = __('PEDIDOS PENDIENTES');
			} else{
				$this->Paginator->settings = array('conditions' => array('Alert.status !=' => 0));
				$status_str = __('PEDIDOS RECIBIDOS');
			}
        }

		$conditions = array("Alert.user_id" => $this->Auth->User('id') );
		$alerts     = $this->paginate('Alert', $conditions);
		$this->set( compact( 'alerts', 'status_str' ) );
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Alert->exists($id)) {
			throw new NotFoundException(__('Invalid alert'));
		}
		$options = array('conditions' => array('Alert.' . $this->Alert->primaryKey => $id));
		$this->set('alert', $this->Alert->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			foreach($this->request->data['AlertDetail'] as $key => $value) {
				if( $value['body'] == "" && $value['qty'] == "" && $value['declaration_amt'] == "" ){
					unset($this->request->data['AlertDetail'][$key]);
				}
			}
			$this->request->data['Alert']['user_id'] = $this->Auth->user('id');
			$this->Alert->create();
			if ($this->Alert->saveAll($this->request->data)) {
				$this->Session->setFlash(__('The alert has been saved.'),'frontend_success');
				return $this->redirect(array('action' => 'description'));
			} else {
				$this->Session->setFlash(__('The alert could not be saved. Please, try again.'),'frontend_error');
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
		if (!$this->Alert->exists($id)) {
			//throw new NotFoundException(__('Invalid alert'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Alert->save($this->request->data)) {
				$this->Session->setFlash(__('The alert has been saved.'), 'frontend_success');
				return $this->redirect($this->referer());
			} else {
				$this->Session->setFlash(__('The alert could not be saved. Please, try again.'), 'frontend_error');
			}
		} else {
			$options = array('conditions' => array(	'Alert.' . $this->Alert->primaryKey => $id, 'Alert.user_id' => $this->Auth->user('id')),
				'contain' => array(
						'User' => array(
							'fields' => array('email'),
				            'Profile' => array(
				                'fields' => array('fname', 'lname')
				            )
				        ),
				        'AlertDetail',
				        'Communication' => array(
							'fields' => array('count(*) AS unread'),
							'conditions' => array('status' => 0, 'from_id' => 2 )
				        )
			    )
			);
			$alert = $this->Alert->find('first', $options);
			if( count($alert) < 1 ){
				$this->Session->setFlash(__('Kindy, login with the proper id to check this section.'), 'frontend_error');
				return $this->redirect(array('action' => 'description'));
			}
		}
		$users = $this->Alert->User->find('list');
		$currency = $this->Currency->find('first', array('fields' => array('amount') ));
		$this->set(compact('users', 'alert', 'currency'));
		// pr($alert);
		// die;
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Alert->id = $id;
		if (!$this->Alert->exists()) {
			throw new NotFoundException(__('Invalid alert detail'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Alert->delete()) {
			$this->Session->setFlash(__('The item has been deleted.'),'frontend_success');
		} else {
			$this->Session->setFlash(__('The item could not be deleted. Please, try again.'), 'frontend_error');
		}
		return $this->redirect($this->referer());
	}

	public function shipping( $id = null ){
		if (!$this->Alert->exists($id)) {
			//throw new NotFoundException(__('Invalid alert'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Alert->save($this->request->data)) {
				$this->Session->setFlash(__('The alert has been saved.'), 'frontend_success');
				return $this->redirect($this->referer());
			} else {
				$this->Session->setFlash(__('The alert could not be saved. Please, try again.'), 'frontend_error');
			}
		} else {
			$options = array('conditions' => array(	'Alert.' . $this->Alert->primaryKey => $id, 'Alert.user_id' => $this->Auth->user('id')));
			$alert = $this->Alert->find('first', $options);
			if( count($alert) < 1 ){
				$this->Session->setFlash(__('Kindy, login with the proper id to check this section.'), 'frontend_error');
				return $this->redirect(array('action' => 'description'));
			}
		}
		$users = $this->Alert->User->find('list');
		$currency = $this->Currency->find('first', array('fields' => array('amount') ));
		$this->set(compact('users', 'alert', 'currency'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Alert->recursive = 2;
		$this->Paginator->settings = array(
			'order'   => array('Alert.created' => 'desc'),
			'limit'   => '20',
			'contain' => array(
					'User' => array(
						'fields' => array('email'),
			            'Profile' => array(
			                'fields' => array('fname', 'lname')
			            )
			        ),
			        'Communication' => array(
						'fields' => array('count(*) AS unread'),
						'conditions' => array('status' => 0, 'to_id' => 2 )
			        )
		    )
		);
		$this->set('alerts', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Alert->exists($id)) {
			throw new NotFoundException(__('Invalid alert'));
		}
		$options = array('conditions' => array('Alert.' . $this->Alert->primaryKey => $id));
		$this->set('alert', $this->Alert->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Alert->create();
			if ($this->Alert->save($this->request->data)) {
				$this->Session->setFlash(__('The alert has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The alert could not be saved. Please, try again.'));
			}
		}
		$users = $this->Alert->User->find('list', array(
			        'fields' => array('User.id', 'User.email'),
			        'conditions' => array(
			        					"NOT" => array(
									        "User.group_id" => array("1", "2", "3")
									    )
									),
			        'recursive' => 0
			    ));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Alert->exists($id)) {
			throw new NotFoundException(__('Invalid alert'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Alert->save($this->request->data)) {
				$Email = new CakeEmail();
				// Email to users.
				// echo $this->request->data['Alert']['status'];
				// pr($this->request->data);
				// die;
				if(isset($this->request->data['Alert']['status'])){
					$status = @$this->request->data['Alert']['status'];
				} else{
					$status = '';
				}
				// Recibido
				if( $status == 1 ){
					$Email->template('recibido_member', 'default')
					    ->emailFormat('html')
					    ->to($this->request->data['User']['email'])
					    ->subject('ICargoBox.com - Recibido un paquete')
					    ->viewVars(
						    	array(
									'alert_id' => $this->request->data['Alert']['id']
						    	)
					    	)
					    ->from('sender@icargobox.com')
					    ->helpers(array('Html', 'Text'))
					    ->send();
				}
				// Consolidación
				if( $status == 2 ){
					$Email->template('consolidacion_member', 'default')
					    ->emailFormat('html')
					    ->to($this->request->data['User']['email'])
					    ->subject('ICargoBox.com - Consolidación')
					    ->viewVars(
						    	array(
									'alert_id' => $this->request->data['Alert']['id']
						    	)
					    	)
					    ->from('sender@icargobox.com')
					    ->helpers(array('Html', 'Text'))
					    ->send();
				}
				// Pago Pendiente
				if( $status == 3 ){
					$Email->template('pago_pendiente_member', 'default')
					    ->emailFormat('html')
					    ->to($this->request->data['User']['email'])
					    ->subject('ICargoBox.com - Pago Pendiente')
					    ->viewVars(
						    	array(
									'alert_id' => $this->request->data['Alert']['id']
						    	)
					    	)
					    ->from('sender@icargobox.com')
					    ->helpers(array('Html', 'Text'))
					    ->send();
				}
				$this->Session->setFlash(__('The alert has been saved.'));
				return $this->redirect($this->referer());
			} else {
				$this->Session->setFlash(__('The alert could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Alert.' . $this->Alert->primaryKey => $id));
			$this->request->data = $this->Alert->find('first', $options);
		}
		$users = $this->Alert->User->find('list', array(
			        'fields' => array('User.id', 'User.email'),
			        'conditions' => array(
			        					"NOT" => array(
									        "User.group_id" => array("1", "2", "3")
									    )
									),
			        'recursive' => 0
			    ));
		$currency = $this->Currency->find('first', array('fields' => array('amount') ));
		$this->set(compact('users', 'currency'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Alert->id = $id;
		if (!$this->Alert->exists()) {
			throw new NotFoundException(__('Invalid alert'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Alert->delete()) {
			$this->Session->setFlash(__('The alert has been deleted.'));
		} else {
			$this->Session->setFlash(__('The alert could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function admin_communications( $id = null, $user_id = null ){
		$sql = "SELECT `Communication`.`from_id`, `Communication`.`ip_address`, `Profile`.`fname`, `Profile`.`lname`, `Communication`.`message`, `Communication`.`created`
				FROM `bs_users` AS `User`, `bs_communications` AS `Communication`
				LEFT JOIN `bs_profiles` `Profile` ON `Communication`.`from_id` = `Profile`.`user_id`
				WHERE
					CASE
						WHEN `Communication`.`from_id` = '$user_id'
							THEN `Communication`.`to_id` = `User`.id
						WHEN `Communication`.`to_id` = '$user_id'
							THEN `Communication`.`from_id` = `User`.`id`
					END
				AND ( `Communication`.`from_id` = '$user_id' OR `Communication`.`to_id` = '$user_id' )
				AND `Communication`.`alert_id` = '$id'
				ORDER BY `Communication`.`id` DESC";
		$data = $this->Alert->query($sql);
		$this->set('data', $data);
		$this->Alert->query("UPDATE `bs_communications` AS `Communication`
							SET `Communication`.`status` = 1
							WHERE `Communication`.`from_id` = $user_id AND `Communication`.`alert_id` = $id ");
	}

	public function communications( $id = null ){
		$user_id = $this->Auth->user('id');
		$options = array('conditions' => array(	'Alert.' . $this->Alert->primaryKey => $id, 'Alert.user_id' => $this->Auth->user('id')),
				'fields' => array('Alert.id'),
				'contain' => array(
						'User' => array(
							'fields' => array('email')
				        )
			    )
			);
		$alert = $this->Alert->find('first', $options);
		if( count($alert) < 1 ){
			$this->Session->setFlash(__('Kindy, login with the proper id to check this section.'), 'frontend_error');
			return $this->redirect(array('action' => 'description'));
		}
		$sql = "SELECT `Communication`.`from_id`, `Communication`.`ip_address`, `Profile`.`fname`, `Profile`.`lname`, `Communication`.`message`, `Communication`.`created`
				FROM `bs_users` AS `User`, `bs_communications` AS `Communication`
				LEFT JOIN `bs_profiles` `Profile` ON `Communication`.`from_id` = `Profile`.`user_id`
				WHERE
					CASE
						WHEN `Communication`.`from_id` = '$user_id'
							THEN `Communication`.`to_id` = `User`.id
						WHEN `Communication`.`to_id` = '$user_id'
							THEN `Communication`.`from_id` = `User`.`id`
					END
				AND ( `Communication`.`from_id` = '$user_id' OR `Communication`.`to_id` = '$user_id' )
				AND `Communication`.`alert_id` = '$id'
				ORDER BY `Communication`.`id` DESC";
		$data = $this->Alert->query($sql);
		$this->set('data', $data);

		$this->Alert->query("UPDATE `bs_communications` AS `Communication`
							SET `Communication`.`status` = 1
							WHERE `Communication`.`from_id` = 2 AND `Communication`.`to_id` = $user_id AND `Communication`.`alert_id` = $id ");
	}


}
