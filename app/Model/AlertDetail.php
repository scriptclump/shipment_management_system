<?php
App::uses('AppModel', 'Model');
/**
 * AlertDetail Model
 *
 * @property Alert $Alert
 */
class AlertDetail extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'alert_id';

	public function beforeSave($options = array()){
		// pr($this->data);
		// debug($this->data);
		// debug($this->Submission->invalidFields());
		// debug($this->validationErrors);
		// die;
	}


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Alert' => array(
			'className' => 'Alert',
			'foreignKey' => 'alert_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
