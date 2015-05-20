<?php
namespace App\Controller;

use Cake\Event\Event;
use Cake\I18n\Time;

/**
 * Posts Controller
 *
 * @property \App\Model\Table\PostsTable $Posts
 */
class PostsController extends AppController
{

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
        $this->Auth->allow(['read']);
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
                'Posts.user_id' => $this->Auth->User('id'),
            ]
        ];
        $this->set('posts', $this->paginate($this->Posts));
        $this->set('_serialize', ['posts']);
    }

    public function display()
    {
        $this->layout = 'front_page';
        $this->paginate = [
            'contain' => ['Users'],
//            'contain' => ['ParentPosts', 'Users'],
            'conditions' => [
//                'Posts.parent_id' => 0,
                'Posts.status' => 3,
            ],
            'order' => ['Posts.created_at' => 'DESC'],
            'limit' => 2
        ];
        $this->set('posts', $this->paginate($this->Posts));
        $recent_posts = $this->Posts->find('all', [
            'conditions' => [
                'Posts.status' => 3
            ],
            'limit' => 10,
            'order' => ['created_at' => 'DESC']
        ]);
        $categories = $this->Posts->Categories->find('all', ['limit' => 10, 'order' => ['Categories.name' => 'ASC']]);
        $tags = $this->Posts->Tags->find('all', ['limit' => 10, 'order' => ['Tags.name' => 'ASC']]);
        $this->set(compact('recent_posts', 'categories', 'tags'));
        $this->set('_serialize', ['posts']);
    }

//    /**
//     * View method
//     *
//     * @param string|null $id Post id.
//     * @return void
//     * @throws \Cake\Network\Exception\NotFoundException When record not found.
//     */
//    public function view($id = null)
//    {
//        $this->layout = 'front_page';
//        $post = $this->Posts->get($id, [
//            'contain' => ['ParentPosts', 'Users', 'Categories', 'Tags', 'Comments', 'ChildPosts'],
//            'conditions' => ['Posts.status' => 3]
//        ]);
//        $associated_post = $this->Posts->find('threaded', [
//            'contain' => ['ParentPosts', 'Users', 'Categories', 'Tags', 'Comments', 'ChildPosts'],
//            'conditions' => ['Posts.id' => $id]
//        ])->toArray();
//        if (empty($post)) {
//            return $this->redirect(['action' => 'display']);
//        }
//        $categories = $this->Posts->Categories->find('all', ['limit' => 10]);
//        $this->set(compact('categories'));
//        $this->set(compact('associated_post'));
//        $this->set('post', $post);
//        $this->set('_serialize', ['post']);
//    }

    /**
     * Read method
     *
     * @param string|null $id Post id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function read($slug = null, $id = null)
    {
        $conditions = [
            'Posts.slug' => $slug
        ];
        $conditions['Posts.status'] = 3;
        if ($this->request->query('preview') && $this->isLoggedIn()) {
            unset($conditions['Posts.status']);
        }
        if ($this->request->query('preview') && !$this->isLoggedIn()) {
            $this->_returnError('Không tìm thấy trang hoặc bạn không được phép truy cập.', '/');
        }
        $this->layout = 'front_page';
        $post = $this->Posts->get($id, [
            'contain' => ['ParentPosts', 'Users', 'Categories', 'Tags', 'ChildPosts'],
            'conditions' => $conditions
        ]);
        if ($post['user_id'] !== $this->Auth->User('id')) {
            $this->_returnError('Không tìm thấy trang hoặc bạn không được phép truy cập.', '/');
        }
        $this->loadModel('Comments');
        $comment = $this->Comments->newEntity();
//        $post = $this->Posts->find('all', [
//            'contain' => ['ParentPosts', 'Users', 'Categories', 'Tags', 'Comments', 'ChildPosts'],
//            'conditions' => [
//                'Posts.id' => $id,
//                'Posts.status' => 3
//            ]
//        ])->toArray();
//        if (!$post) {
////            return $this->redirect(['action' => 'display']);
//        } else {
        $categories = $this->Posts->Categories->find('all', ['limit' => 10, 'order' => ['Categories.name' => 'ASC']]);
        $tags = $this->Posts->Tags->find('all', ['limit' => 10, 'order' => ['Tags.name' => 'ASC']]);
        $recent_posts = $this->Posts->find('all', [
            'conditions' => [
                'Posts.status' => 3
            ],
            'limit' => 10,
            'order' => ['created_at' => 'DESC']
        ]);
        $published_comments = $this->Posts->Comments->find(
            'all',
            [
                'conditions' => [
                    'Comments.post_id' => $id,
                    'Comments.status' => 3,
                    'Comments.parent_id' => 0,
                ],
                'limit' => 10,
                'order' => ['Comments.created_at' => 'DESC']
            ]);
        $this->set(compact('recent_posts', 'categories', 'tags', 'comment', 'published_comments'));
//        $this->set(compact('associated_post', 'level'));
        $this->set('post', $post);
        $this->set('_serialize', ['post']);
//        }
    }

    /**
     * Write new post method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function write()
    {
        $this->layout = 'dashboard';
        $post = $this->Posts->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->data;
            $data['user_id'] = $this->Auth->User('id');
            $data['status'] = 1;
            $data['created_at'] = $data['updated_at'] = Time::now();
            $post = $this->Posts->patchEntity($post, $data);
            if ($this->Posts->save($post)) {
                $this->Flash->success('Bài viết đã được chuyển đến quản trị viên để duyệt đăng.');
                return $this->redirect(['action' => 'index']);
            } else {
                $data['slug'] = $this->autoSlug($data['title']);
                $post = $this->Posts->patchEntity($post, $data);
                if ($this->Posts->save($post)) {
                    $this->Flash->success('Bài viết đã được chuyển đến quản trị viên để duyệt đăng.');
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error('Đã có lỗi xảy ra. Bạn vui lòng thử lại!');
                }
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
            $data['body'] = h($data['body']);
            $data['status'] = 0;
            $data['user_id'] = $this->Auth->user('id');
            $data['slug'] = $this->autoSlug($data['title']);
            $data['created_at'] = $data['updated_at'] = Time::now();

            $post = $this->Posts->patchEntity($post, $data);
            if ($this->Posts->save($post)) {
                $this->Flash->success('Bản nháp đã được tạo!');
                return $this->redirect(['controller' => 'Users', 'action' => 'index']);
            } else {
                $this->Flash->error('Đã có lỗi xảy ra, bạn vui lòng thực hiện lại!');
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
            $data = $this->request->data;
            $data['updated_at'] = Time::now();

            $post = $this->Posts->patchEntity($post, $data);
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
        $post->status = 4;
        if ($this->Posts->save($post)) {
            $this->Flash->success('Bài đăng đã được chuyển vào thùng rác');
        } else {
            $this->Flash->error('Đã có lỗi xảy ra, bạn vui lòng thử lại!');
        }
        return $this->redirect(['action' => 'index']);
    }

    /**
     * Restore method
     *
     * @param string|null $id Post id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function restore($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $post = $this->Posts->get($id);
        $post->status = 1;
        if ($this->Posts->save($post)) {
            $this->Flash->success('Bài đăng đã được chuyển sang trạng thái chờ đăng!');
        } else {
            $this->Flash->error('Đã có lỗi xảy ra, bạn vui lòng thử lại!');
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


    /**
     * Auto generate slug method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function autoSlug($title)
    {
        $_model = $this->request->param('controller');
        $this->request->allowMethod(['post', 'ajax']);
        if (!empty($title)) {
            $slug = $this->_toSlug($title);
            if ($this->request->is('ajax')) {
                $this->layout = 'ajax';
            }
            $slugs = $this->$_model->find('list', [
                'valueField' => 'slug',
                'conditions' => [
                    $_model . '.slug' => $slug
                ]
            ]);
            if ($slugs->count() === 0) {
                $rs = $slug;
            } else {
                $slugs = $this->$_model->find('list', [
                    'valueField' => 'slug',
                    'conditions' => [
                        $_model . '.slug LIKE' => $slug . '-%'
                    ],
                    'order' => [
                        $_model . '.slug' => 'ASC'
                    ]
                ]);
                if ($slugs->count() === 0) {
                    $rs = $slug . '-2';
                } else {
                    $slug_arr = array_values($slugs->toArray());
                    $i = 3;
                    while (true) {
                        $str = $slug . '-' . $i;
                        if (!in_array($str, $slug_arr)) {
                            $rs = $str;
                            break;
                        } else {
                            $i++;
                        }
                    }
                }
            }
            if ($this->request->is('ajax')) {
                $this->response->body(json_encode([0 => $rs]));
                return $this->response;
            } else {
                return $rs;
            }
        }
    }
}
