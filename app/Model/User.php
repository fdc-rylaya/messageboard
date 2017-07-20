<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

//use lib\Cake\Utility\Security;
/**
 * User Model
 *
 */
class User extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

	public $validate = array(
        'name' => array(
		        'minmax' => array(
		            'rule' => array('lengthBetween', 5, 20),
		            'message' => 'Must have 5 to 20 characters',            
		        	'required' => true
		        )
	    	),
        'email' => array(
        		'unique' => array(
        			'rule'=>'isUnique',
        			'message' => 'Must be unique'
    			),
    			'email' => array(
        			'rule'=>'email',
        			'message' => 'Not a valid email address',
        			'required' => true
    			)
        	),
        'password' => array(
        		'confirm_password' => array(
        			'rule' => array('confirmPassword'),
        			'message' => "Password confirmation does not match"
        		)
        	),
        'image' => array(
                'rule' => array(
                    'extension',
                    array('gif', 'jpeg', 'png', 'jpg')
                ),
                'message' => 'Please supply a valid image.',
                'required' => false,
                'allowEmpty' => false
            ),
        'gender' => array(
                'required' => array(
                    'rule' => array('notBlank'),
                    'message' => 'Is required.',
                    'required' => true,
                    'on' => 'update'
                )
            ),
        'birthdate' => array(
                'required' => array(
                    'rule' => array('notBlank'),
                    'message' => 'Is required.',
                    'required' => true,
                    'on' => 'update'
                )
            ),
        'hubby' => array(
               'required' => array(
                    'rule' => array('notBlank'),
                    'message' => 'Is required.',
                    'required' => true,
                    'on' => 'update'
                )
            )
    );

	public function confirmPassword() {
        if ($this->data['User']['confirm_password'] == $this->data['User']['password']) {
        	return true;
        }

        return false;
    }

    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $passwordHasher = new BlowfishPasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash(
                $this->data[$this->alias]['password']
            );
        }
        return true;
    }

}
