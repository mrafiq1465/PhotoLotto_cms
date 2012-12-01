<?php
App::uses('AppModel', 'Model');
/**
 * Event Model
 *
 * @property User $User
 */
class Event extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'updated_by',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
