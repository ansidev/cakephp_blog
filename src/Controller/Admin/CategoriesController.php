<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\I18n\Time;

/**
 * Categories Controller
 *
 * @property \App\Model\Table\CategoriesTable $Categories
 */
class CategoriesController extends AppController
{

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
        $this->Auth->deny();
        if (in_array($this->request->param('action'), ['index', 'add', 'edit', 'view'])) {
            $this->layout = 'dashboard';
        }
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


    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['ParentCategories']
        ];
        $this->set('categories', $this->paginate($this->Categories));
        $this->set('_serialize', ['categories']);
    }

    /**
     * View method
     *
     * @param string|null $id Category id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $category = $this->Categories->get($id, [
            'contain' => ['ParentCategories', 'Posts', 'ChildCategories']
        ]);
        $this->set('category', $category);
        $this->set('_serialize', ['category']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $category = $this->Categories->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->data;
            $data['slug'] = $this->autoSlug($data['name']);
            if (empty($data['parent_id'])) {
                $data['parent_id'] = 0;
            }
            $data['path'] = 0;
            $data['created_at'] = $data['updated_at'] = Time::now();
            $category = $this->Categories->patchEntity($category, $data);
            $result = $this->Categories->save($category);
            if ($result) {
                if ($result->parent_id === 0) {
                    $result->path = $result->id;
                } else {
                    $temp = $this->Categories->get($result->parent_id);
                    if (!empty($temp)) {
                        $result->path = $temp->path . '-' . $result->id;
                    } else {
                        $this->Flash->error('Chủ đề không tồn tại');
                    }
                }
                if ($this->Categories->save($result)) {
                    $this->Flash->success('Chủ đề ' . $result->name . ' đã được tạo thành công.');
                } else {
                    $this->Flash->error('Đã xảy ra lỗi. Bạn vui lòng thực hiện lại thao tác');
                }
            }
            return $this->redirect(['action' => 'index']);
        }
        $categories = $this->Categories->find('list', ['limit' => 200]);
//        $posts = $this->Categories->Posts->find('list', ['limit' => 200]);
        $this->set(compact('category', 'categories', 'posts'));
        $this->set('_serialize', ['category']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Category id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $category = $this->Categories->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->data;
            if (empty($data['parent_id'])) {
                $data['parent_id'] = 0;
                $data['path'] = 0;
            } else {
                $temp = $this->Categories->get($data['parent_id']);
                if (!empty($temp)) {
                    $data['path'] = $temp->path . '-' . $id;
                } else {
                    $this->Flash->error('Bình luận không tồn tại hoặc chưa được duyệt đăng.');
                }
            }
            $data['created_at'] = $data['updated_at'] = Time::now();
            $category = $this->Categories->patchEntity($category, $data);
            if ($this->Categories->save($category)) {
                $this->Flash->success('Các thông tin đã được lưu lại');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('Đã có lỗi xảy ra, bạn vui lòng thực hiện lại hành động.');
            }
        }
        $categories = $this->Categories->find('list', [
            'limit' => 200,
            'conditions' => [
                'NOT' => [
                    'Categories.id' => $id,
                ]
            ]
        ]);
        $posts = $this->Categories->Posts->find('list', ['limit' => 200]);
        $this->set(compact('category', 'categories', 'posts'));
        $this->set('_serialize', ['category']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Category id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $category = $this->Categories->get($id);
        if ($this->Categories->delete($category)) {
            $this->Flash->success('The category has been deleted.');
        } else {
            $this->Flash->error('The category could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
