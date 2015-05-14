<?php
namespace App\Controller;

use Cake\Event\Event;
use Cake\I18n\Time;

/**
 * Media Controller
 *
 * @property \App\Model\Table\MediaTable $Media
 */
class MediaController extends AppController
{
    public $components = ['Upload'];

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->layout = 'dashboard';
//        $this->Upload->fileVar = 'file';
        $this->Upload->uploadDir .= '/' . Time::now()->i18nFormat('YYYY/MM/dd');
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $this->set('media', $this->paginate($this->Media));
        $this->set('_serialize', ['media']);
    }

    /**
     * View method
     *
     * @param string|null $id Media id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $media = $this->Media->get($id, [
            'contain' => ['Users']
        ]);
        $this->set('media', $media);
        $this->set('_serialize', ['media']);
    }

    /**
     * Upload method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function upload()
    {
        $media = $this->Media->newEntity();
        if ($this->request->is('post')) {
            $now = Time::now();
            $data = $this->request->data;
//            debug($this->request->data); die;
            $data['user_id'] = $this->Auth->User('id');
            if (empty($data['description'])) {
                $data['description'] = $data['title'];
            }
            $data['url'] = $this->Upload->uploadDir . '/' . $data['file']['name'];
//            $data['file_name'] = $data['file']['name'];
            $data['file_name'] = $this->Upload->finalFile;
            $data['media_type'] = 1;
            $data['status'] = 1;
            $data['created_at'] = $data['updated_at'] = $now;
//            debug($data); die;
            $media = $this->Media->patchEntity($media, $data);
            if ($this->Media->save($media)) {
                $this->Flash->success('The media has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The media could not be saved. Please, try again.');
            }
        }
        $users = $this->Media->Users->find('list', ['limit' => 200]);
        $this->set(compact('media', 'users'));
        $this->set('_serialize', ['media']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Media id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $media = $this->Media->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $media = $this->Media->patchEntity($media, $this->request->data);
            if ($this->Media->save($media)) {
                $this->Flash->success('The media has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The media could not be saved. Please, try again.');
            }
        }
        $users = $this->Media->Users->find('list', ['limit' => 200]);
        $this->set(compact('media', 'users'));
        $this->set('_serialize', ['media']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Media id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $media = $this->Media->get($id);
        if ($this->Media->delete($media)) {
            $this->Flash->success('The media has been deleted.');
        } else {
            $this->Flash->error('The media could not be deleted. Please, try again.');
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
