<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['display']);
        if (strcmp($this->request->params['action'], 'login') !== 0) {
            $this->layout = 'dashboard';
            $user = $this->Auth->User();
            if (!empty($user)) {
                if ($this->isAdmin($user)) {
                    if (!in_array($this->request->params['action'], ['index', 'logout'])) {
                        return $this->redirect(['prefix' => 'admin', 'controller' => 'Users', 'action' => 'index']);
                    }
                } else {
                    $this->Flash->error('Vui lòng đăng nhập bằng tài khoản quản trị!');
                    return $this->redirect(['prefix' => 'admin', 'controller' => 'Users', 'action' => 'login']);
                }
            } else {
                $this->Flash->error('Bạn chưa đăng nhập');
                return $this->redirect(['prefix' => 'admin', 'controller' => 'Users', 'action' => 'login']);
            }
        }
    }


    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->layout = 'dashboard';
        $this->paginate = [
            'contain' => ['Roles']
        ];
        $this->set('users', $this->paginate($this->Users));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Roles', 'Comments', 'Posts']
        ]);
        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success('The user has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The user could not be saved. Please, try again.');
            }
        }
        $roles = $this->Users->Roles->find('list', ['limit' => 200]);
        $this->set(compact('user', 'roles'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success('The user has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The user could not be saved. Please, try again.');
            }
        }
        $roles = $this->Users->Roles->find('list', ['limit' => 200]);
        $this->set(compact('user', 'roles'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success('The user has been deleted.');
        } else {
            $this->Flash->error('The user could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }

    public function login()
    {
        $this->layout = 'form';
//        if ($this->request->session()->read('User.id')) {
//            return $this->redirect('/admin/users');
//        }
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                $this->Flash->success(__('Chào bạn, <strong>' . $user["username"] . '</strong>'));
                return $this->redirect($this->Auth->redirectUrl(['prefix' => 'admin', 'controller' => 'Users', 'action' => 'index']));
            }
            $this->Flash->error(__('Thông tin đăng nhập không đúng. <br> Bạn vui lòng đăng nhập lại!'));
        }
    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }


}
