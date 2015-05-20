<?php
namespace App\View\Cell;

use Cake\View\Cell;

/**
 * Tags cell
 */
class TagsCell extends Cell
{
    protected $_name = 'Tags';

    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    /**
     * Display all categories method.
     *
     * @return void
     */
    public function display()
    {
        $_model = $this->_name;
        $this->loadModel($_model);
        $tags = $this->$_model->find(
            'all',
            [
                'limit' => 10,
                'order' => [
                    $_model . '.name' => 'ASC'
                ]
            ]
        );
        $this->set('tags', $tags);
    }
}
