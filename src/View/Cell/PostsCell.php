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
     * Display recent post method.
     *
     * @return void
     */
    public function recent_posts()
    {
        $_model = $this->_name;
        $this->loadModel($_model);
        $recent_posts = $this->$_model->find('all', [
            'conditions' => [
                'Posts.status' => 3
            ],
            'limit' => 10,
            'order' => ['created_at' => 'DESC']
        ]);
        $this->set('recent_posts', $recent_posts);
    }
}
