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
     * Display recent post method.
     *
     * @return void
     */
    public function recent_comments()
    {
        $_model = $this->_name;
        $this->loadModel($_model);
        $recent_comments = $this->$_model->find('all', [
            'conditions' => [
                $_model.'.status' => 3
            ],
            'limit' => 10,
            'order' => ['created_at' => 'DESC']
        ]);
        $this->set('recent_comments', $recent_comments);
    }
}
