<?php
namespace App\Controller;

use Cake\I18n\Time;

/**
 * Comments Controller
 *
 * @property \App\Model\Table\CommentsTable $Comments
 */
class CommentsController extends AppController
{

//    /**
//     * Index method
//     *
//     * @return void
//     */
//    public function index()
//    {
//        $this->paginate = [
//            'contain' => ['Users', 'Posts']
//        ];
//        $this->set('comments', $this->paginate($this->Comments));
//        $this->set('_serialize', ['comments']);
//    }
//
//    /**
//     * View method
//     *
//     * @param string|null $id Comment id.
//     * @return void
//     * @throws \Cake\Network\Exception\NotFoundException When record not found.
//     */
//    public function view($id = null)
//    {
//        $comment = $this->Comments->get($id, [
//            'contain' => ['Users', 'Posts']
//        ]);
//        $this->set('comment', $comment);
//        $this->set('_serialize', ['comment']);
//    }

    /**
     * Write comment method
     *
     * @return void Redirects on successful post comment, renders view otherwise.
     */
    public function write()
    {
        $this->autoRender = false;
        $comment = $this->Comments->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->data;
//            debug($data); die;
            $data['user_id'] = $this->getUserId();
            if (empty($data['parent_id'])) {
                $data['parent_id'] = 0;
                $data['path'] = 0;
            }
            $data['status'] = 1;
            $data['created_at'] = $data['updated_at'] = Time::now();
            $comment = $this->Comments->patchEntity($comment, $data);
            $result = $this->Comments->save($comment);
            if ($result) {
                if ($result->parent_id === 0) {
                    $result->path = $result->id;
                } else {
                    $temp = $this->Comments->get($result->parent_id);
                    if (!empty($temp)) {
                        $result->path = $temp->path . '-' . $result->id;
                    } else {
                        $this->Flash->error('Bình luận không tồn tại hoặc chưa được duyệt đăng.');
                    }
                }
                if ($this->Comments->save($result)) {
                    $this->Flash->success('Bình luận đã được chuyển đến quản trị viên để duyệt đăng.');
                } else {
                    $this->Flash->error('Đã xảy ra lỗi. Bạn vui lòng đăng lại bình luận.');
                }
            } else {
                $this->Flash->error('Đã xảy ra lỗi. Bạn vui lòng đăng lại bình luận.');
            }
        } else {
            $this->Flash->error('Đã xảy ra lỗi. Bạn vui lòng đăng lại bình luận.');
        }
        return $this->redirect($this->request->referer());
    }

//    /**
//     * Edit method
//     *
//     * @param string|null $id Comment id.
//     * @return void Redirects on successful edit, renders view otherwise.
//     * @throws \Cake\Network\Exception\NotFoundException When record not found.
//     */
//    public function edit($id = null)
//    {
//        $comment = $this->Comments->get($id, [
//            'contain' => []
//        ]);
//        if ($this->request->is(['patch', 'post', 'put'])) {
//            $comment = $this->Comments->patchEntity($comment, $this->request->data);
//            if ($this->Comments->save($comment)) {
//                $this->Flash->success('The comment has been saved.');
//                return $this->redirect(['action' => 'index']);
//            } else {
//                $this->Flash->error('The comment could not be saved. Please, try again.');
//            }
//        }
//        $users = $this->Comments->Users->find('list', ['limit' => 200]);
//        $posts = $this->Comments->Posts->find('list', ['limit' => 200]);
//        $this->set(compact('comment', 'users', 'posts'));
//        $this->set('_serialize', ['comment']);
//    }
//
//    /**
//     * Delete method
//     *
//     * @param string|null $id Comment id.
//     * @return void Redirects to index.
//     * @throws \Cake\Network\Exception\NotFoundException When record not found.
//     */
//    public function delete($id = null)
//    {
//        $this->request->allowMethod(['post', 'delete']);
//        $comment = $this->Comments->get($id);
//        if ($this->Comments->delete($comment)) {
//            $this->Flash->success('The comment has been deleted.');
//        } else {
//            $this->Flash->error('The comment could not be deleted. Please, try again.');
//        }
//        return $this->redirect(['action' => 'index']);
//    }
}
