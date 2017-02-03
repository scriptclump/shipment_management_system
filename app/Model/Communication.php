<?php
App::uses('AppModel', 'Model');
/**
 * Communication Model
 *
 * @property Alert $Alert
 */
class Communication extends AppModel {


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
