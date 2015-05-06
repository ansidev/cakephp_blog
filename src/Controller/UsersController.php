<?php
namespace App\Controller;

use Cake\Auth\DefaultPasswordHasher;
use Cake\Event\Event;
use Cake\I18n\Time;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $user = $this->Auth->User();
        if (!empty($user)) {
            if ($this->isAdmin($user)) {
                return $this->redirect(['prefix' => 'admin', 'controller' => 'Users', 'action' => 'index']);
            }
        }
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
        $this->Auth->allow(['register', 'logout']);
        if (in_array($this->request->param('action'), ['register', 'login'])) {
            $this->layout = 'form';
        }
        if (in_array($this->request->param('action'), ['index', 'update_info'])) {
            $this->layout = 'dashboard';
        }
        if (strcmp($this->request->params['action'], 'login') === 0) {
            if (!empty($user)) {
                return $this->_goToDashboard($user);
            }
        }
    }

    protected function _goToDashboard($user)
    {
//        debug($user); die;
//        debug($this->isAdmin($user)); die;
        if ($this->isAdmin($user)) {
            return $this->redirect(['prefix' => 'admin', 'controller' => 'Users', 'action' => 'index']);
        } else {
            return $this->redirect($this->Auth->redirectUrl());
        }
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
//        $this->layout = 'dashboard';
        $this->paginate = [
            'contain' => ['Roles']
        ];
        $user = $this->Users->get($this->Auth->User('id'), [
            'contain' => ['Roles', 'Comments', 'Posts']
        ]);
        $this->set('user', $user);
        $this->set('users', $this->paginate($this->Users));
        $this->set('_serialize', ['users']);
        $this->loadModel('Posts');
        $post = $this->Posts->newEntity();
        $this->set(compact('post'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view()
    {
        $id = $this->Auth->User('id');
        $this->layout = 'front_view';
        $user = $this->Users->get($id, [
            'contain' => ['Roles', 'Comments', 'Posts']
        ]);
        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    public function login()
    {
//        $this->layout = 'form';
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                $this->Flash->success(__('Chào bạn, <strong>' . $user['username'] . '</strong>', ['escape' => false]));
                return $this->_goToDashboard($user);
            }
            $this->Flash->error(__('Thông tin đăng nhập không đúng. <br> Bạn vui lòng đăng nhập lại!'));
        }
    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

    /**
     * Register method
     *
     * @return void Redirects on successful register, renders view otherwise.
     */
    public function register()
    {
        if ($this->isLoggedIn()) {
            return $this->redirect(['controller' => 'Users', 'action' => 'index']);
        } else {
            $user = $this->Users->newEntity();
            if ($this->request->is('post')) {
                $user = $this->Users->patchEntity($user, $this->request->data);
                $user['role_id'] = 3; //Role = User
                $user['created_at'] = $user['updated_at'] = Time::now();
                if ($this->Users->save($user)) {
                    $this->Flash->success('Bạn đã đăng ký tài khoản thành công!');
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error('Đã có lỗi xảy ra, bạn vui lòng đăng ký lại! <br> Rất xin lỗi vì sự bất tiện này!');
                }
            }
//        $roles = $this->Users->Roles->find('list', ['limit' => 200]);
//        $this->set(compact('user', 'roles'));
            $this->set(compact('user'));
            $this->set('_serialize', ['user']);
        }
    }

    /**
     * Update info method
     *
     * @param string|null $id User id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function update_info()
    {
        $id = $this->Auth->User('id');
        $user = $this->Users->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $update_data = $this->request->data;
            $new_password = $update_data['new_password'];
            $confirm_password = $update_data['confirm_password'];
            $dph = new DefaultPasswordHasher();
            if (!$dph->check($update_data['current_password'], $user['password'])) {
                $this->Flash->error('Mật khẩu của bạn không chính xác. <br> Vui lòng thực hiện lại!');
            } else {
                //Kiểm tra password mới
                if (empty($new_password)) {
                    if (!empty($confirm_password)) {
                        $this->Flash->error('Bạn chưa nhập password mới.');
                    }
                } else {
                    if (empty($confirm_password)) {
                        $this->Flash->error('Bạn chưa xác nhận password mới.');
                    } else {
                        if (strcmp($new_password, $confirm_password) !== 0) {
                            $this->Flash->error('Chuỗi xác nhận không trùng với password mới. <br> Vui lòng kiểm tra lại.');
                        } else {
                            $update_data['password'] = $dph->hash($update_data['new_password']);
                            $update_data['updated_at'] = Time::now();
                            $user = $this->Users->patchEntity($user, $update_data);
                            if ($this->Users->save($user)) {
                                $this->Flash->success('Thông tin của bạn đã được cập nhật!');
                                return $this->redirect(['action' => 'index']);
                            } else {
                                $this->Flash->error('Cập nhật thông tin không thành công. Bạn vui lòng thử lại sau!');
                            }
                        }
                    }
                }


            }
        }
//        $roles = $this->Users->Roles->find('list', ['limit' => 200]);
//        $this->set(compact('user', 'roles'));
        $this->set(compact('user'));
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
}
