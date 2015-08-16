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
    public $helpers = ['Html', 'Url'];
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

    /**
     * Initialize FileInput method
     * Homepage: http://plugins.krajee.com/file-input
     * @param string CSS Selector
     * @param array FileInput options. Please read the FileInput Documentation.
     * @return string Javascript code can initialize dataTable
     */
    function fileInput($selector, $options = [])
    {
        $default_options = [
            'uploadUrl' => $this->Html->Url->build(['controller' => 'Media', 'action' => 'upload']),
            'uploadAsync' => true,
            'showUpload' => false,
            'showPreview' => false,
            'showRemove' => false,
            'maxFileCount' => 100
//            'uploadExtraData' => false
//                'function() {
//                return {
//                    description: $("#description").val()
//            }'
        ];

        if (!empty($options['uploadExtraData'])) {
            foreach ($options['uploadExtraData'] as $key => $val) {
                $options['uploadExtraData'][$key] = $this->setUploadExtraData($val);
            }
        }
        $template = '';
        $template .= $this->Html->script('fileinput/fileinput');
        $template .= $this->Html->css('fileinput');
        $options = array_merge($default_options, $options);
        if (!empty($selector)) {
            $template .= "<script>
            $(document).ready(function () {
                $('" . $selector . "').fileinput(" . $this->jsonRemoveUnicodeSequences(json_encode($options)) . ");
            });
        </script>";
        }

        return $template;
    }

    public function setUploadExtraData($selector)
    {
        $return = '';
        $return .= '$';
        $return .= '(';
        $return .= '"';
        $return .= $selector;
        $return .= '"';
        $return .= ')';
        $return .= '.';
        $return .= 'val';
        $return .= '(';
        $return .= ')';
        return $return;
    }

    protected function jsonRemoveUnicodeSequences($str)
    {
        $result = preg_replace("/\\\\u([a-f0-9]{4})/e", "iconv('UCS-4LE','UTF-8',pack('V', hexdec('U$1')))", json_encode($str));
        $result = str_replace('\\n', '', $result);
        $result = str_replace('\\r', '', $result);
        $result = str_replace('\\', '', $result);
        $result = str_replace('"{', '{', $result);
        $result = str_replace('}"', '}', $result);
        return $result;
    }

}
