<?php
namespace App\View\Cell;

use Cake\View\Cell;

/**
 * Posts cell
 */
class CommentsCell extends Cell
{

    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    protected $_name = 'Comments';

    /**
     * Default display method.
     *
     * @return void
     */
    public function display()
    {
    }

    /**
     * Display recent comments method.
     * Default: 10 recent comments.
     *
     * @return void
     */
    public function recent_comments($limit = 10)
    {
        $_model = $this->_name;
        $this->loadModel($_model);
        $recent_comments = $this->$_model->find('all', [
            'conditions' => [
                $_model.'.status' => 3
            ],
            'limit' => $limit,
            'order' => ['created_at' => 'DESC']
        ]);
        $this->set('recent_comments', $recent_comments);
    }
}
