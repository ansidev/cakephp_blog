<?php
namespace App\View\Cell;

use Cake\View\Cell;

/**
 * Categories cell
 */
class CategoriesCell extends Cell
{
    protected $_name = 'Categories';

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
        $categories = $this->$_model->find(
            'all',
            [
                'conditions' => [
                    'Categories.parent_id' => 0,
                ],
                'limit' => 10,
                'order' => [
                    $_model . '.name' => 'ASC'
                ]
            ]
        );
        $this->set('categories', $categories);
    }
}
