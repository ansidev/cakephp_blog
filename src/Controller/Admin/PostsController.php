<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Admin Posts Controller
 *
 * @property \App\Model\Table\PostsTable $Posts
 */
class PostsController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->layout = 'dashboard';
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
            'contain' => ['ParentPosts', 'Users', 'Categories', 'Tags', 'Comments'],
            'conditions' => [
                'Posts.parent_id' => 0,
                'Posts.status IN' => [1, 2, 3, 4]
            ]
        ];
        $this->set('posts', $this->paginate($this->Posts));
        $this->set('_serialize', ['posts']);
    }

    public function display()
    {
        $this->layout = 'front_page';
        $this->paginate = [
            'contain' => ['ParentPosts', 'Users'],
            'conditions' => [
                'Posts.parent_id' => 0,
                'Posts.status' => 3,
            ]
        ];
        $this->set('posts', $this->paginate($this->Posts));
        $categories = $this->Posts->Categories->find('all', ['limit' => 10]);
        $this->set(compact('categories'));
        $this->set('_serialize', ['posts']);
    }

    /**
     * View method
     *
     * @param string|null $id Post id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->layout = 'front_page';
        $post = $this->Posts->get($id, [
            'contain' => ['ParentPosts', 'Users', 'Categories', 'Tags', 'Comments', 'ChildPosts'],
//            'conditions' => ['Posts.status' => 3]
        ]);
//        $associated_post = $this->Posts->find('threaded', [
//            'contain' => ['ParentPosts', 'Users', 'Categories', 'Tags', 'Comments', 'ChildPosts'],
//            'conditions' => ['Posts.id' => $id]
//        ])->toArray();
//        if (empty($post)) {
//            return $this->redirect(['action' => 'display']);
//        }
        $categories = $this->Posts->Categories->find('all', ['limit' => 10]);
        $this->set(compact('categories'));
        $this->set(compact('associated_post'));
        $this->set('post', $post);
        $this->set('_serialize', ['post']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function write()
    {
        $post = $this->Posts->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->data;
            $data['slug'] = $this->_toSlug($data['title']);
            $data['user_id'] = $this->Auth->User('id');
            $post = $this->Posts->patchEntity($post, $data);
            if ($this->Posts->save($post)) {
                $this->Flash->success('The post has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The post could not be saved. Please, try again.');
            }
        }
        $parentPosts = $this->Posts->ParentPosts->find('list', ['limit' => 200]);
        $users = $this->Posts->Users->find('list', ['limit' => 200]);
        $categories = $this->Posts->Categories->find('list', ['limit' => 200]);
        $tags = $this->Posts->Tags->find('list', ['limit' => 200]);
        $this->set(compact('post', 'parentPosts', 'users', 'categories', 'tags'));
        $this->set('_serialize', ['post']);
    }

    /**
     * Quick draft method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function quick_draft()
    {
        $post = $this->Posts->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->data;
            $data['status'] = 0;
            $data['user_id'] = $this->Auth->user('id');

            $post = $this->Posts->patchEntity($post, $data);
            if ($this->Posts->save($post)) {
                $this->Flash->success('Bản nháp đã được tạo!');
                return $this->redirect(['controller' => 'Users', 'action' => 'index']);
            } else {
                $this->Flash->error('Đã có lỗi xảy ra, bạn vui lòng thực hiện lại việc đăng bài!');
            }
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Post id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->layout = 'dashboard';
        $post = $this->Posts->get($id, [
            'contain' => ['Categories', 'Tags']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $post = $this->Posts->patchEntity($post, $this->request->data);
            if ($this->Posts->save($post)) {
                $this->Flash->success('Bài viết đã được lưu lại.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('Đã có lỗi xảy ra. Bạn vui lòng thử lại.');
            }
        }
        $parentPosts = $this->Posts->ParentPosts->find('list', ['limit' => 200]);
        $users = $this->Posts->Users->find('list', ['limit' => 200]);
        $categories = $this->Posts->Categories->find('list', ['limit' => 200]);
        $tags = $this->Posts->Tags->find('list', ['limit' => 200]);
        $this->set(compact('post', 'parentPosts', 'users', 'categories', 'tags'));
        $this->set('_serialize', ['post']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Post id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $post = $this->Posts->get($id);
        if ($this->Posts->delete($post)) {
            $this->Flash->success('The post has been deleted.');
        } else {
            $this->Flash->error('The post could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }

    /**
     * Permanent Delete method
     *
     * @param string|null $id Post id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function permanent_delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $post = $this->Posts->get($id);
        if ($this->Posts->delete($post)) {
            $this->Flash->success('Bài đăng đã được xóa');
        } else {
            $this->Flash->error('Đã có lỗi xảy ra, bạn vui lòng thử lại!');
        }
        return $this->redirect(['action' => 'index']);
    }


}
