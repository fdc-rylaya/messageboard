<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

	public function beforeFilter() {
	    parent::beforeFilter();
	    $this->Auth->allow('login','add', 'logout','thankYou');
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->Auth->loggedIn()) {
			return $this->redirect(array('action' => 'profile'));
		}
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('The user has been saved.'));
				return $this->redirect(array('action' => 'thankYou'));
			} else {
				$this->Flash->error(__('The user could not be saved. Please, try again.'));
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
	public function edit() {

		$user = $this->getAuthUser();
		if (!$this->User->exists($this->Auth->User('id'))) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$this->request->data['User']['id'] = $user['id'];
			
			if (!empty($this->request->data['User']['image']['tmp_name']) && 
				is_uploaded_file($this->request->data['User']['image']['tmp_name']) && 
				$this->validImage($this->request->data['User']['image']['type'])
				) {
					$filename = basename($this->request->data['User']['image']['name']); 
					$time=strtotime(date('Y-m-d H:i:s'));
					$filePath = $_SERVER['DOCUMENT_ROOT'] .'/img/'.$time.'-'.$filename;
				    move_uploaded_file($this->data['User']['image']['tmp_name'], $filePath);

				    $this->request->data['User']['image'] = $time.'-'.$filename;
			}
			else {
				$this->request->data['User']['image'] = $user['image'];
			}

			$this->set('user',$user);

			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('The user has been saved.'));
				return $this->redirect(array('action' => 'profile'));
			} else {
				$this->Flash->error(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$this->set('user',$user);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->User->delete()) {
			$this->Flash->success(__('The user has been deleted.'));
		} else {
			$this->Flash->error(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}


	public function thankYou(){
		return $this->render('ThankYou');
	}


	public function login() {
		if ($this->Auth->loggedIn()) {
			return $this->redirect(array('action' => 'profile'));
		}
	    if ($this->request->is('post')) {
	        if ($this->Auth->login()) {


	        	//add login time, ip
	        	$this->User->id = $this->Auth->User('id');
	        	$this->User->saveField('last_login_time',date('Y-m-d H:i:s'));
	        	$this->User->saveField('created_ip',$this->request->clientIp());
	        	$this->User->saveField('modified_ip',$this->request->clientIp());
	        	

	            //return $this->redirect($this->Auth->redirectUrl());
	            return $this->redirect(array('action' => 'profile'));
	        }
	        $this->Flash->error(__('Invalid username or password, try again'));
	    }
	}

	public function logout() {
	    return $this->redirect($this->Auth->logout());
	}

	public function profile(){
		if (!$this->Auth->loggedIn()) {
			return $this->redirect('/users/login');
		}
		
		$this->set('user', $this->getAuthUser());
	}
}
