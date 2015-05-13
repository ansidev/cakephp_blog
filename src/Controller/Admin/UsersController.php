<?php
namespace App\Controller\Admin;

use Cake\Auth\DefaultPasswordHasher;
use App\Controller\AppController;
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
        if (in_array($this->request->params['action'], ['login', 'logout'])) {
            $this->redirect(['prefix' => false, 'controller' => 'Users', 'action' => $this->request->params['action']]);
        } else {
            $this->layout = 'dashboard';
            $user = $this->Auth->User();
            if (!empty($user)) {
                if (!$this->isAdmin($user)) {
                    $this->Flash->error('Bạn không phải là quản trị viên! Vui lòng <a href="/users/logout">đăng nhập</a>  bằng tài khoản quản trị!');
                    return $this->redirect(['prefix' => false, 'controller' => 'Users', 'action' => 'login']);
                }
            } else {
                $this->Flash->error('Bạn chưa đăng nhập');
                $this->redirect(['prefix' => false, 'controller' => 'Users', 'action' => 'login']);
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
    public function view()
    {
        $id = $this->Auth->User('id');
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
            $user['created_at'] = $user['updated_at'] = Time::now();
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
     * Update info method
     *
     * @param string|null $id User id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function update_info($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
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

//    public function login()
//    {
//        $this->layout = 'form';
//        if ($this->request->session()->read('User.id')) {
//            return $this->redirect('/admin/users');
//        }
//        if ($this->request->is('post')) {
//            $user = $this->Auth->identify();
//            if ($user) {
//                $this->Auth->setUser($user);
//                $this->Flash->success(__('Chào bạn, <strong>' . $user["username"] . '</strong>'));
//                return $this->redirect($this->Auth->redirectUrl(['prefix' => 'admin', 'controller' => 'Users', 'action' => 'index']));
//            }
//            $this->Flash->error(__('Thông tin đăng nhập không đúng. <br> Bạn vui lòng đăng nhập lại!'));
//        }
//    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }


}
