<?php
/**
 * Author: ansidev
 * Date: 22/04/2015
 * Time: 9:29 PM
 */

namespace App\View\Helper;


use Cake\View\Helper;
use Cake\View\View;

class ContentHelper extends Helper
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

    private function str_word_count($string, $format = null)
    {
        $charlist = 'àáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđ';
        $charlist .= 'ÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỔỖƠỜỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝỴỶỸĐ';
        return str_word_count($string, $format, $charlist);
    }

    public function echoShortText($body, $length = 400)
    {
        $body = strip_tags(html_entity_decode($body));
        if (empty($body)) {
            return '';
        } else {
            if (strlen($body) <= $length) {
                return $body;
            } else {
//                $pos_arr = array_keys($body_arr);
//                foreach ($pos_arr as $num) {
//                    $pos =
//                }
                $result = trim(substr($body, 0, $length));
                $body_arr = $this->str_word_count($result, 2);
                $key_arr = array_keys($body_arr);
                $pos = end($key_arr);
                $pos = prev($key_arr);
                $pos = strlen($body_arr[$pos]) + $pos;
                $result = trim(substr($body, 0, $pos));
//                if (strlen($result) <= $length) {
//                    return $result;
//                } else {
                    return $result . '...' . '<br>';
//                }
            }
        }

    }
}
