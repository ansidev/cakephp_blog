<?php
/**
 * Author: ansidev
 * Date: 23/04/2015
 * Time: 8:12 AM
 */

namespace App\View\Helper;


use Cake\View\Helper;
use Cake\View\StringTemplateTrait;

class JsHelper extends Helper
{
//    use StringTemplateTrait;
//    protected $_defaultConfig = [
//        'templates' => [
//            'javascriptblock' => '<script{{attrs}}>{{content}}</script>',
//            'javascriptstart' => '<script>',
//            'javascriptlink' => '<script src="{{url}}"{{attrs}}></script>',
//            'javascriptend' => '</script>'
//
//        ]
//    ];

    /**
     * Initialize method
     *
     * @param string CSS Selector
     * @param array DataTable options. Please read the DataTable Documentation.
     * @return string Javascript code can initialize dataTable
     */
    function dataTable($selector, $options = [])
    {
        $template = '';
        if (!empty($selector)) {
            $template = "<script>
            $(document).ready(function () {
                $('" . $selector . "').DataTable(" . json_encode($options) . ");
            });
        </script>";
        }
        return $template;
    }

}
