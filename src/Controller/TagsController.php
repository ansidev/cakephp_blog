<?php
namespace App\Controller;

use Cake\Event\Event;
use Cake\I18n\Time;

/**
 * Tags Controller
 *
 * @property \App\Model\Table\TagsTable $Tags
 */
class TagsController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
//        $this->Auth->allow(['autoSlug']);
        if (in_array($this->request->param('action'), ['index', 'add', 'edit', 'view'])) {
            $this->layout = 'dashboard';
        }
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('tags', $this->paginate($this->Tags));
        $this->set('_serialize', ['tags']);
    }

    /**
     * View method
     *
     * @param string|null $id Tag id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tag = $this->Tags->get($id, [
            'contain' => ['Posts']
        ]);
        $this->set('tag', $tag);
        $this->set('_serialize', ['tag']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tag = $this->Tags->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->data;
            $data['created_at'] = $data['updated_at'] = Time::now();
            $tag = $this->Tags->patchEntity($tag, $data);
            if ($this->Tags->save($tag)) {
                $this->Flash->success('Tag đã được tạo.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('Đã có lỗi xảy ra. Bạn vui lòng thực hiện lại!');
            }
        }
        $posts = $this->Tags->Posts->find('list', ['limit' => 200]);
        $this->set(compact('tag', 'posts'));
        $this->set('_serialize', ['tag']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Tag id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tag = $this->Tags->get($id, [
            'contain' => ['Posts']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tag = $this->Tags->patchEntity($tag, $this->request->data);
            if ($this->Tags->save($tag)) {
                $this->Flash->success('The tag has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The tag could not be saved. Please, try again.');
            }
        }
        $posts = $this->Tags->Posts->find('list', ['limit' => 200]);
        $this->set(compact('tag', 'posts'));
        $this->set('_serialize', ['tag']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Tag id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tag = $this->Tags->get($id);
        if ($this->Tags->delete($tag)) {
            $this->Flash->success('The tag has been deleted.');
        } else {
            $this->Flash->error('The tag could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }

    /**
     * Hien thi bai viet thuoc co tag
     * @param null $id
     * @param $slug
     */
    public function display($id = null, $slug)
    {
        $this->layout = 'front_page';
        $tag = $this->Tags->get($id, [
            'contain' => ['Posts'],
            'conditions' => [
                'Tags.slug' => $slug
            ]
        ]);
        $this->set('tag', $tag);
        $this->set('_serialize', ['tag']);
    }

    /**
     * Tự động tạo slug
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function autoSlug($title)
    {
        $_model = $this->request->param('controller');
        $this->autoRender = false;
        $this->request->allowMethod(['post']);
        if (!empty($title)) {
            $slug = $this->_toSlug($title);
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
                $this->response->body(json_encode(['slug' => $rs]));
                return $this->response;
            } else {
                $this->set(
                    [
                        'slug' => $rs,
                        '_serialize' => [
                            'slug'
                        ]
                    ]
                );
            }
        }
    }
}
