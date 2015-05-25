<?php
/**
 * Author: ansidev
 * Date: 22/04/2015
 * Time: 9:29 PM
 */

namespace App\View\Helper;


use Cake\View\Helper;
use Cake\View\View;

class MyFormHelper extends Helper
{
//    use StringTemplateTrait;
    public $helpers = ['Form', 'Html'];
//    protected $_defaultConfig = [
//        'templates' => [
//            'listContainer' => '<div class="list-group"{{attrs}}>{{content}}</div>',
//            'listItem' => '<li class="list-group-item"{{attrs}}>{{title}}</li>',
//        ]
//    ];

    /**
     * Construct the widgets and binds the default context providers
     *
     * @param \Cake\View\View $View The View this helper is being attached to.
     * @param array $config Configuration settings for the helper.
     */
    public function __construct(View $View, array $config = [])
    {
        parent::__construct($View, $config);
    }

    /**
     * Initialize search form
     *
     * @param url Target URL
     * @return string Search form 's HTML code
     */
    function searchForm($url)
    {
        $form = $this->Html->tag('span', null, ['class' => 'glyphicon glyphicon-search']);
        $form = $this->Form->button($form, ['type' => 'submit', 'class' => 'btn btn-danger']);
        $form = $this->Html->tag('span', $form, ['class' => 'input-group-btn']);
        $form = $this->Html->tag('input', $form, ['type' => 'text', 'class' => 'form-control', 'name' => 's', 'id' => 'search-form']);
        $form = $this->Html->div('input-group', $form);
        $form = $this->Form->create(null, ['type' => 'get', 'url' => $url]) . $form;
        $form .= $this->Form->end();
        return $form;
    }
}
