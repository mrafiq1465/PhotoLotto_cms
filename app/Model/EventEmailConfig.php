<?php
App::uses('AppModel', 'Model');
/**
 * EventAction Model
 *
 * @property Event $Event
 */
class EventEmailConfig extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
    public $useTable = 'event_email_config';
    public $belongsTo = array(
		'Event' => array(
			'className' => 'Event',
			'foreignKey' => 'event_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

}
