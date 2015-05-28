<?php
/**
 * Author: ansidev
 * Date: 22/04/2015
 * Time: 9:29 PM
 */

namespace App\View\Helper;


use Cake\View\Helper;
use Cake\View\View;

class MyHtmlHelper extends Helper
{
//    use StringTemplateTrait;
    public $helpers = ['Html'];
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

    public function script($url, array $options = []) {
        $default_options = [
            'block' => 'script'
        ];
        $options = array_merge($default_options, $options);
        return $this->Html->script($url, $options);
    }

    public function listItem($title, $options = [])
    {
        if ($title === null) {
            return '';
        }
        $options += ['class' => 'list-group-item', 'escape' => false];
        $url = (!empty($options['url'])) ? $options['url'] : '';
        unset($options['url']);
        return $this->Html->link($title, $url, $options);
    }

    public function listGroup($list = [], $options = [])
    {
        if ($list === null) {
            return '';
        }
        $output_list = '';
        foreach ($list as $item) {
            $output_list .= $this->listItem($item);
        }
        $options['class'] = 'list-group';
        return $this->Html->tag('div', $output_list, $options);
    }

    protected function _parseUserInfo($userInfo)
    {
        if (empty($userInfo)) {
            return '';
        }
        return $userInfo[0] . ': ' . $userInfo[1];
    }

    public function createInfoItem($info, $options = [])
    {
        if ($info === null) {
            return '';
        }
        $options += ['class' => 'list-group-item', 'escape' => false];
        $title = $this->_parseUserInfo($info);
        return $this->Html->tag('li', $title, $options);
    }

    public function createUserInfo($info = [], $options = [])
    {
        if ($info === null) {
            return '';
        }
        $output_info = '';
        foreach ($info as $item) {
            $output_info .= $this->createInfoItem($item);
        }
        $options['class'] = 'list-group';
        return $this->Html->tag('div', $output_info, $options);
    }


}
