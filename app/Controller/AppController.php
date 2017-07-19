<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		https://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	public $components = array(
		'RequestHandler',
        'Flash',
        'Auth' => array(
            'loginRedirect' => array(
                'controller' => 'users',
                'action' => 'index'
            ),
            'logoutRedirect' => array(
                'controller' => 'pages',
                'action' => 'display',
                'home'
            ),
            'authenticate' => array(
                'Form' => array(
                    'passwordHasher' => 'Blowfish',
                    'fields' => array(
	                    'username' => 'email',
	                    'password' => 'password'
	                ),
                )
            )
        )
    );

    public function beforeFilter() {
        $this->Auth->allow('index', 'view');
    }

    public function beforeRender(){
        $this->layout = ($this->request->is("ajax")) ? "ajax" : "default";
    }


    //get currently logged user w/ last login.
    public function getAuthUser() {
        $this->loadModel('User');
    	if ($this->Auth->loggedIn()) { 
	    	$options = array('conditions' => array('User.' . $this->User->primaryKey => $this->Auth->User('id')));
			$user = $this->User->find('first', $options);
			return $user['User'];
		}
		return [];
    }

    //check image type
    public function validImage($type){
        return (in_array($type, array("image/png", "image/jpeg", "image/gif"))) ? true : false;
    }

    public function getToUser($id){
        $this->loadModel('User');
        $toUser = $this->User->find('first',array(
                    'conditions' => array(
                            'User.id' => $id
                        )
                )
            );
        return $toUser;
    }
}
