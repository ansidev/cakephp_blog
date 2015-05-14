<?php

namespace App\Controller\Admin;


use App\Controller\AppController;

class HomeController extends AppController
{

    public function index()
    {
        $this->layout = 'dashboard';
        $this->loadModel('Users');
        $this->loadModel('Posts');
        $this->loadModel('Comments');
        $this->loadModel('Categories');
        $users = $this->Users->find('list')->count();
        $posts = $this->Posts->find('list')->count();
        $comments = $this->Comments->find('list')->count();
        $categories = $this->Categories->find('list')->count();
        $this->set(compact('users', 'posts', 'comments', 'categories'));
//        $this->set('users', $users);
//        $this->set('waiting_posts', $waiting_posts);
        $this->set('default_grid', false);
    }
}
