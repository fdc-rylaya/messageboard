<?php
App::uses('AppController', 'Controller');


/**
 * Messages Controller
 *
 * @property Message $Message
 * @property PaginatorComponent $Paginator
 */
class MessagesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','RequestHandler');
	public $helpers = array('Js');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->loadModel('User');
		
		//get all user messages
		$messages = $this->Message->find('all', array(
				'conditions' => array(
					'OR' => array(
						array('Message.to_id' => $this->Auth->User('id')),
            			array('Message.from_id' => $this->Auth->User('id'))
					)
				)
			)
		);
					
		//ready for strip
		$inIds = array();
		foreach ($messages as $key => $message) {
			array_push($inIds, $message['Message']['to_id']);
			array_push($inIds, $message['Message']['from_id']);
		}
		
		$users = $this->User->find('all', array(
				'conditions' => array(
					'User.id' => array_unique($inIds), //remove duplicate id
					'User.id !=' => $this->Auth->User('id')
				),
				'order' => array('User.id' => 'desc')
			)
		);

		

		$this->set('users',$users);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {

		//open socket
		// $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
		// socket_bind($socket, 'localhost');
		// socket_listen($socket);
		// socket_accept($socket);


		$this->loadModel('User');
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('User does not exist'));
		}
		
		$user = $this->getAuthUser();
		$message = $this->Message->find('first', array(
				'conditions' => array(
					'Message.from_id' => array($id,$this->Auth->User('id')),
					'Message.to_id' => array($id,$this->Auth->User('id'))
				),
				'order' => array('Message.id' => 'desc')
			)
		);

		$toUser = $this->User->find('first', array(
				'conditions' => array(
					'User.id' => $id
				)
			)
		);
		//debug($toUser);
		$this->set('toUser', $toUser);
		$this->set('from', $user);
		$this->set('to_id',$id);
		$this->set('from_id',$user['id']);
		$this->set('last_id', $message['Message']['id']);
		$this->set('created', $message['Message']['created']);
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Message->create();
			if ($this->Message->save($this->request->data)) {
				//$this->Flash->success(__('The message has been saved.'));
				$this->loadModel('User');
				$user = $this->getAuthUser();
				$toUser = $this->getToUser($this->request->data['to_id']);
				$lastId = $this->Message->getLastInsertID();
				$message = $this->Message->find('first',array(
		    		'conditions' => array(
		    				'Message.id' => $lastId
			    			)
			    	)
		    	);
				$this->layout = null;
				$this->set(compact('user', 'toUser','message'));
				$this->render('json/message');
				//return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The message could not be saved. Please, try again.'));
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
		if (!$this->Message->exists($id)) {
			throw new NotFoundException(__('Invalid message'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Message->save($this->request->data)) {
				$this->Flash->success(__('The message has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The message could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Message.' . $this->Message->primaryKey => $id));
			$this->request->data = $this->Message->find('first', $options);
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
		$this->Message->id = $id;
		if (!$this->Message->exists()) {
			throw new NotFoundException(__('Invalid message'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Message->delete()) {	
			$this->layout = null;
			$this->render('json/success');
		} else {
			$this->layout = null;
			$this->render(false);
		}
		
	}


	public function fetchMessages($id = null) {
		$this->loadModel('User');
		$this->Paginator->settings = array(
				'conditions' => array(
					'Message.from_id' => array($id,$this->Auth->User('id')),
					'Message.to_id' => array($id,$this->Auth->User('id'))
				),
				'limit' => 5,
				'order' => array('Message.id' => 'desc')
	    );

	    // similar to findAll(), but fetches paged results
	    $messages = $this->Paginator->paginate('Message');


	    $toUser = $this->getToUser($id);

		$user = $this->getAuthUser();
		$this->layout = null ;
		$this->set(compact('user', 'toUser','messages'));
		$this->set('_serialize', array('user','toUser','messages'));
		if(!empty($messages)){
			$this->render('json/messages');	
		}
		
	}

	public function create(){
		$currentUser = $this->getAuthUser();
		$this->set('from_id',$currentUser['id']);
	}

	public function search(){

		$user = $this->getAuthUser();
	    $toUser = $this->getToUser($this->request->data['to_id']);
	    $messages = $this->Message->find('all', array(
	    		'conditions' => array(
					'Message.from_id' => array($user['id'],$toUser['User']['id']),
					'Message.to_id' => array($user['id'],$toUser['User']['id']),
					"OR" => array (
				        "Message.content LIKE" => "%".$this->request->data['search']."%"
				    )
    			),
    			'order' => array('Message.id' => 'desc')
	    	)
	    );

	    $this->layout = null ;
		$this->set(compact('user', 'toUser','messages'));
		if(!empty($messages)){
			$this->render('json/messages');	
		} else {
			$this->render(null);	
		}
	}

	public function latest(){
		$user = $this->getAuthUser();
		$toUser = $this->getToUser($this->request->data['to_id']);
		
		$latestMessage = $this->Message->find('first',array(
    		'conditions' => array(
    				'Message.from_id' => array($user['id'],$this->request->data['to_id']),
					'Message.to_id' => array($user['id'],$this->request->data['to_id'])
	    		),
				'order' => array('Message.id' => 'desc')
	    	)
    	);

    	$message = ($latestMessage['Message']['id'] != $this->request->data['last_id']) ? $latestMessage : '';
		$this->layout = null;
		$this->set(compact('user', 'toUser','message'));
		if(!empty($message)){
			$this->set('last_id',$message['Message']['id']);
			$this->set('from_id',$user['id']);
			$this->set('to_id',$this->request->data['to_id']);
			$this->render('json/message');	
		} else {
			$this->render(false);
		}

	}

	public function send(){
		if ($this->request->is('post')) {
			$user = $this->getAuthUser();
			$toId = $this->getToUser($this->request->data['to_id']);
			$content = $this->request->data['content'];
		
			$this->Message->create();

			if ($this->Message->save($this->request->data)) {
				$this->set(compact('user','toId','content'));
				$this->layout = null;
				$this->render('json/success');
			} 
		} else {
			$this->layout = null;
			$this->render(false);	
		}
	}
}

