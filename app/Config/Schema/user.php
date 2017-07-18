<?php 
class UserSchema extends CakeSchema {

	public function before($event = array()) {
		return true;
	}

	public function after($event = array()) {
	}

	public $user = array(
        'id' => array(
            'type' => 'integer',
            'null' => false,
            'default' => null,
            'length' => 10,
            'key' => 'primary'
        ),
        'name' => array(
            'type' => 'string',
            'length' => 50
        ),
        'email' => array(
            'type' => 'string',
            'length' => 100
        ),
        'password' => array(
            'type' => 'string',
            'length' => 255
        ),
        'image' => array(
            'type' => 'string',
            'length' => 50,
            'null' => true,
            'default'=>null
        ),
        'gender' => array(
            'type' => 'char',
            'length' => 1,
            'null' => true,
            'default'=>null
        ),
        'birthdate' => array(
            'type' => 'date',
            'null' => true,
            'default'=>null
        ),
        'hubby' => array(
            'type' => 'text',
            'null' => true,
            'default'=>null
        ),
        'last_login_time' => array(
            'type' => 'datetime'
        ),
        'created' => array(
            'type' => 'datetime'
        ),
        'modified' => array(
            'type' => 'datetime'
        ),
        'created_ip' => array(
            'type' => 'string',
            'length'=>20
        ),
        'modified_ip' => array(
            'type' => 'string',
            'length'=>20
        ),
    );

}
