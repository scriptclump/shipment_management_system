<?php
App::uses('AppModel', 'Model');
/**
 * Department Model
 *
 * @property City $City
 */
class Department extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';
	public $actsAs = array(
			'Search.Searchable'
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'City' => array(
			'className' => 'City',
			'foreignKey' => 'city_id',
			'conditions' => '',
			'fields' => '',
			'order' => 'Department.title'
		)
	);

	public $filterArgs = array(
        'city_id' => array(
            'type' => 'value',
            'field' => 'city_id'
        ),
        'title' => array(
            'type' => 'like',
            'field' => 'title'
        ),
        'status' => array(
            'type' => 'value',
            'field' => 'status'
        )
    );
}
