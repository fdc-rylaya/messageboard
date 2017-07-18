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
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->loadModel('User');

		$users = $this->User->find('all', array(
		    'joins' => array(
		        array(
		            'table' => 'messages',
		            'alias' => 'message',
		            'type' => 'INNER',
		            'conditions' => array(
		                'user.id = message.to_id'
		            )
		        )
		    ),
		    'conditions' => array(
		        'User.id !=' => $this->Auth->User('id')
		    ),
		    'fields' => array('User.*')
		));
	
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
		$this->loadModel('User');
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('User does not exist'));
		}

		$this->Paginator->settings = array(
				'conditions' => array(
					'Message.from_id' => array($id,$this->Auth->User('id')),
					'Message.to_id' => array($id,$this->Auth->User('id'))
				),
				'limit' => 3,
				'order' => array('Message.id' => 'asc')
	    );

	    // similar to findAll(), but fetches paged results
	    $messages = $this->Paginator->paginate('Message');


	    $toUser = $this->User->find('first',array(
		    		'conditions' => array(
		    				'User.id' => $id
		    			)
		    	)
	    	);

		debug($this->getAuthUser());


		$this->set('user', $this->getAuthUser());
		$this->set('toUser', $toUser);
		$this->set('messages', $messages);
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
				$this->Flash->success(__('The message has been saved.'));
				return $this->redirect(array('action' => 'index'));
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
			$this->Flash->success(__('The message has been deleted.'));
		} else {
			$this->Flash->error(__('The message could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
