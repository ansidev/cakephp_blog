<?php
namespace App\Controller;

use Cake\Core\Configure;
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
        $this->Upload->uploadDir .= DS . Time::now()->i18nFormat('YYYY/MM/dd');
        $this->Upload->fileVar = 'file';
        if (in_array($this->request->param('action'), ['upload']) && $this->request->is('post')) {
            $data = $this->request->data;
            if (empty($data['file'])) {
                $this->Upload->fileVar = 'thumbnail_url';
            }
            $name = $data[$this->Upload->fileVar]['name'];
            if (empty($data['title'])) {
                $data['title'] = str_replace('-', ' ', $this->_toSlug(pathinfo($name)['filename']));
            }
            $data['title'] = ucfirst($data['title']);
            if (empty($data['slug'])) {
                $data['slug'] = $this->autoSlug($data['title']);
            }
            $data[$this->Upload->fileVar]['name'] = $this->__processFileName($data[$this->Upload->fileVar]['name']);
            $data[$this->Upload->fileVar]['name'] = $data['slug'] . '-' . Time::now()->i18nFormat('YYYY-MM-dd');
//            $img_size = getimagesize($data[$this->Upload->fileVar]['tmp_name']);
//            if ($img_size) {
//                $data[$this->Upload->fileVar]['name'] .= '-w' . $img_size[0] . '-h' . $img_size[1] . '-' . md5_file($data["file"]["tmp_name"]);
//            }
            $data[$this->Upload->fileVar]['name'] .= '.' . pathinfo($name)['extension'];
            $this->request->data = $data;
        }
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index($display = true)
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $this->set('display', $display);
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


    private function __url($relative_path)
    {
        return Configure::read('App.rootUrl') . $relative_path;
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
            $data = $this->request->data;
            if (!empty($this->Upload->finalFile)) {
                $data['user_id'] = $this->Auth->User('id');
                $data['relative_path'] = $this->Upload->finalFile;
                $data['mime_type'] = $data[$this->Upload->fileVar]['type'];
                $data['file_name'] = $data[$this->Upload->fileVar]['name'];
                if (empty($data['description'])) {
                    $data['description'] = $data['title'];
                }
                $description = [
                    'title' => $data['title'],
                    'file_name' => $data['file_name'],
                    'mime_type' => $data['mime_type'],
                    'relative_path' => $data['relative_path'],
                    'url' => $this->__url($data['relative_path']),
                    'description' => $data['description']
                ];
                $data['description'] = json_encode($description);
                $data['media_type'] = 1;
                $data['status'] = 1;
                $data['created_at'] = $data['updated_at'] = Time::now();
                $media = $this->Media->patchEntity($media, $data);
                // Neu file upload thanh cong thi luu thong tin vao database
                if ($this->Media->save($media)) {
                    if ($this->request->is('ajax')) {
                        $this->response->body(json_encode(['url' => $this->__url($data['relative_path'])]));
                        return $this->response;
                    }

                    $this->Flash->success('Tập tin đã được upload thành công.');
//                    if (!$this->request->is('requested')) {
                    return $this->redirect(['action' => 'index']);
//                    }
                }
            } else {
                $this->Flash->error('Đã có lỗi trong quá trình upload.');
                foreach ($this->Upload->errors as $error) {
                    $this->Flash->error($error);
                }
                return $this->redirect(['action' => 'index']);
            }
        }
//        $users = $this->Media->Users->find('list', ['limit' => 200]);
//        $this->set(compact('media', 'users'));
        $this->set(compact('media'));
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
                $this->Flash->success('Thông tin đã được cập nhật.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('Đã có lỗi xảy ra, bạn vui lòng thử lại');
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
            $this->Flash->success('Thông tin về tập tin đã được xóa khỏi cơ sở dữ liệu.');
        } else {
            $this->Flash->error('Đã có lỗi xảy ra, bạn vui lòng thử lại.');
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

    private function __processFileName($filename) {
        $result = str_replace('[', '', $filename);
        $result = str_replace('"', '', $filename);
        $result = str_replace(']', '', $filename);
        return $result;
    }
}
