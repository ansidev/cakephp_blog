<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
            'loginRedirect' => [
                'controller' => 'Users',
                'action' => 'index'
            ],
            'loginAction' => [
                'prefix' => false,
                'controller' => 'Users',
                'action' => 'login',
            ],
            'logoutRedirect' => [
                'prefix' => false,
                'controller' => 'Users',
                'action' => 'login'
            ],
            'authError' => 'Đăng nhập để đến trang quản trị'
        ]);
    }

    public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['display']);
    }

    /**
     * Ham kiem tra co nguoi dung dang nhap hay chua.
     * @return bool true if user logged in, false if no logged in user.
     */
    public function isLoggedIn()
    {
//        $user_id = $this->request->session()->read('User.id');
        $user = $this->Auth->User();
        if (!empty($user)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Ham kiem tra user co quyen truy cap action khong.
     * @param null $user
     * @return bool
     */
    public function isAuthorized($user = null)
    {
        // Any registered user can access public functions
        if (empty($this->request->params['prefix'])) {
            return true;
        }

        // Only admins can access admin functions
        if ($this->request->params['prefix'] === 'admin') {
            return (bool)($this->isAdmin($user));
        }

        // Default deny
        return false;
    }

    /**
     * Ham kiem tra mot user co phai la administrator khong.
     * @param $user User can kiem tra
     * @return bool
     */
    public function isAdmin($user)
    {
        // Admin can access every action
        if (!empty($user['role_id']) && $user['role_id'] === 1) {
            return true;
        }
        return false;
    }

    public function beforeRender(Event $event)
    {
        parent::beforeRender($event);
//        if (!empty($this->request->params['prefix']) && $this->request->params['prefix'] === 'admin') {
//            $this->layout = 'dashboard';
//        }
    }
}
