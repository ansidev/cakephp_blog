<?php
/**
 * Author: ansidev
 * Date: 23/04/2015
 * Time: 8:12 AM
 */

namespace App\View\Helper;


use Cake\View\Helper;

class JsHelper extends Helper
{
    public $helpers = ['Html'];
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
     * Initialize DataTable method
     *
     * @param string CSS Selector
     * @param array DataTable options. Please read the DataTable Documentation.
     * @return string Javascript code can initialize dataTable
     */
    function dataTable($selector, $options = [])
    {
        $default_options = ['responsive' => true, 'table_tools' => true];
        $options = array_merge($default_options, $options);
        $json = '{
    "dom": "\'T<\"clear\">lfrtip\'",
    "tableTools": {
        "sRowSelect": "os",
        "aButtons": [
            "select_all",
            "select_none"
        ]
    }
}';
        $table_tools = json_decode($json, true);

        $template = '';
        if ($options['table_tools'] == true) {
            unset($options['table_tools']);
            $options = array_merge($table_tools, $options);
            $template .= $this->Html->script('data-tables.table-tools.js');
            $template .= $this->Html->css('data-tables.table-tools.css');
        }
        if (!empty($selector)) {
            $template .= "<script>
            $(document).ready(function () {
                $('" . $selector . "').DataTable(" . json_encode($options) . ");
            });
        </script>";
        }
        return $template;
    }

}
