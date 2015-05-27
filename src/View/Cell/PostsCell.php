<?php
namespace App\View\Cell;

use Cake\View\Cell;

/**
 * Posts cell
 */
class PostsCell extends Cell
{

    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    protected $_name = 'Posts';

    /**
     * Default display method.
     *
     * @return void
     */
    public function display()
    {
    }

    /**
     * Display popular posts method.
     * Default: 10 recent posts.
     *
     * @return void
     */
    public function popular_posts($limit = 10)
    {
        $_model = $this->_name;
        $this->loadModel($_model);
        $popular_posts = $this->$_model->find('all', [
            'conditions' => [
                $_model.'.status' => 3
            ],
            'limit' => $limit,
            'order' => ['clicked' => 'DESC']
        ]);
        $this->set('popular_posts', $popular_posts);
    }

    /**
     * Display popular posts method.
     * Default: 10 recent posts.
     *
     * @return void
     */
    public function recent_posts($limit = 10)
    {
        $_model = $this->_name;
        $this->loadModel($_model);
        $recent_posts = $this->$_model->find('all', [
            'conditions' => [
                $_model.'.status' => 3
            ],
            'limit' => $limit,
            'order' => ['created_at' => 'DESC']
        ]);
        $this->set('recent_posts', $recent_posts);
    }
}
