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
        if ($this->request->param('prefix') === 'admin') {
            $this->layout = 'dashboard';
        }
        if (in_array($this->request->param('_ext'), ['json', 'rss'])) {
            $allowed_actions = [
                'Posts' => [
                    'feed' => ['rss'],
                    'autoSlug' => ['json']
                ],
                'Media' => [
                    'index' => ['json']
                ]
            ];
            $controller = $this->request->param('controller');
            $action = $this->request->param('action');
            $ext = $this->request->param('_ext');
            if (!array_key_exists($controller, $allowed_actions)) {
                $this->_returnError('', '/');
            } else if (!array_key_exists($action, $allowed_actions[$controller])) {
                $this->_returnError('', '/');
            } else if (!in_array($ext, $allowed_actions[$controller][$action])) {
                $this->_returnError('', '/');
            }
        }
    }


    public function beforeRender(Event $event)
    {
        parent::beforeRender($event);
//        if (!empty($this->request->params['prefix']) && $this->request->params['prefix'] === 'admin') {
//            $this->layout = 'dashboard';
//        }
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
     * Ham lay thong tin nguoi dung dang login
     * @return array|null Mang chua thong tin nguoi dung
     */
    public function getUserId()
    {
        return $this->Auth->User('id');
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

    /**
     * Hàm tạo slug từ một string
     * Original source: http://code.freetuts.net/tao-slug-tu-dong-bang-javascript-va-php-199.html
     * @param $str Chuỗi truyền vào
     * @return string Chuỗi slug trả về
     */
    protected function _toSlug($str)
    {
        $str = trim(mb_strtolower($str));
        $str = preg_replace('/([\_|\+|\=|.|\s]+)/', '-', $str);
        $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
        $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
        $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
        $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
        $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
        $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
        $str = preg_replace('/(đ)/', 'd', $str);
        $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
        return $str;
    }

    protected function _toTitleCase($title)
    {
        if (!is_string($title)) {
            $rs = '';
        } else {
            $rs = explode(' ', $title);
            foreach ($rs as $i => $word) {
                $rs[$i] = ucfirst($word);
            }
            $rs = implode(' ', $rs);
        }
        return $rs;
    }

    protected function _returnError($message = '', $url = false)
    {
        if (empty($message)) {
            $message = 'Không tìm thấy trang hoặc bạn không được phép truy cập.';
        }
        $this->Flash->error(__($message));
        if ($url !== false) {
            return $this->redirect($url);
        }
    }

    protected function _returnSuccess($message = '', $url = false)
    {
        if (empty($message)) {
            $message = 'Không tìm thấy trang hoặc bạn không được phép truy cập.';
        }
        $this->Flash->success(__($message));
        if ($url !== false) {
            return $this->redirect($url);
        }
    }

    protected function jsonRemoveUnicodeSequences($str)
    {
        $result = preg_replace("/\\\\u([a-f0-9]{4})/e", "iconv('UCS-4LE','UTF-8',pack('V', hexdec('U$1')))", json_encode($str));
        $result = str_replace('\\n', '', $result);
        $result = str_replace('\\r', '', $result);
        $result = str_replace('\\', '', $result);
        $result = str_replace('"{', '{', $result);
        $result = str_replace('}"', '}', $result);
        return $result;
    }
}
