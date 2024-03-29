<?php
/**
 * Author: ansidev
 * Date: 22/04/2015
 * Time: 9:29 PM
 */

namespace App\View\Helper;


use Cake\Datasource\ModelAwareTrait;
use Cake\ORM\Entity;
use Cake\ORM\Query;
use Cake\ORM\TableRegistry;
use Cake\View\Helper;
use Cake\View\View;

class MenuHelper extends Helper
{
    use ModelAwareTrait;
    public $helpers = ['Form', 'UserInfo', 'Time', 'Url', 'Html'];

    protected $_defaultConfig = [
        'parent_id' => 'parent_id',
        'path' => 'path',
        'model' => null
    ];

    public function __construct(View $view, $config = [])
    {
        parent::__construct($view, $config);
    }

    private function __getModel($class)
    {
        $_define = [
//            'Cake\ORM\Query' => 'Query',
            'App\Model\Entity\Post' => 'Posts',
            'App\Model\Entity\Comment' => 'Comments',
            'App\Model\Entity\Category' => 'Categories',
        ];
        $this->config('model', $_define[$class]);
        return $_define[$class];
    }

    public function childCount(Entity $node, $direct = false)
    {
        $model = $this->__getModel(get_class($node));
        $id = $node->get('id');
        $node = TableRegistry::get($model);
        return $node->childCount($node->get($id), $direct);
    }

    public function getLevel(Entity $object)
    {
        $model = $this->__getModel(get_class($object));
        $id = $object->get('id');
        $object = TableRegistry::get($model);
        return $object->getLevel($object->get($id)) - 1;
    }

    public function findChildren(Entity $object)
    {
        $model = $this->__getModel(get_class($object));
        $id = $object->get('id');
        $object = TableRegistry::get($model);
        if (!in_array($model, ['Categories', 'Tags'])) {
            $children = $object->find('children', ['for' => $id])
                ->find('threaded')
                ->where([$model . '.status' => 3])
                ->toArray();
        } else {
            $children = $object->find('children', ['for' => $id])
                ->find('threaded')
                ->toArray();
        }
        return $children;
    }

    public function createElement(Entity $object)
    {

    }

    public function createCommentBox($node, $post_id, $level = 0)
    {
        $html = '';
        $root = false;
        if ($node instanceof Query) {
            $model = 'Query';
            $root = true;
        }
        if ($node instanceof Entity) {
            $model = $this->__getModel(get_class($node));
        }

        if ($root) {
            $level = 1;
        } else {
            $level = $this->getLevel($node);
            $user = $this->UserInfo->getUserInfo($node->get('user_id'));
            $html .= '<article class="row" id="comment-id-' . $node->get('id') . '">';
            $html .= '<div class="col-md-2 col-sm-2 col-md-offset-' . $level . ' hidden-xs">';
            $html .= '<figure class="thumbnail">';
            $html .= $this->UserInfo->get_gravatar($user['email'], 80, 'mm', 'g', true);
            $html .= '<figcaption class="text-center">' . $user['username'] . '</figcaption>';
            $html .= '</figure>';
            $html .= '</div>';
            $html .= '<div class="col-md-' . (10 - $level) . ' col-sm-' . (9 - $level) . '">';
            $html .= '<div class="panel panel-default arrow left">';
            $html .= '<div class="panel-body" id="comment-' . $node->get('id') . '">';
            $html .= '<header class="text-left">';
            $html .= '<time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> ';
            $html .= 'Đăng vào ' . $this->Time->format($node->get('created_at'), 'dd MMM, y HH:mm:ss');
            $html .= '</time>';
            $html .= '</header>';
            $html .= '<div class="comment-post">';
            $html .= '<p>' . htmlspecialchars_decode($node->get('body')) . '</p>';
            $html .= '</div>';
            $html .= '<p class="text-right">';
            $html .= '<button class="btn btn-default btn-sm btn-reply">';
            $html .= '<i class="fa fa-reply" id="' . $node->get('id') . '" path="' . $node->get('path') . '" post-id="' . $post_id . '"></i> Reply';
            $html .= '</button>';
            $html .= '</p>';
            $html .= '<div class="reply-box" style="display: none">';
            $html .= $this->Form->create(null, ['url' => ['controller' => 'Comments', 'action' => 'write']]);
            $html .= $this->Form->input('body', ['type' => 'textarea', 'class' => 'form-control', 'rows' => 7, 'label' => 'Phản hồi']);
            $html .= $this->Form->hidden('post_id', ['value' => h($post_id)]);
            $html .= $this->Form->hidden('parent_id', ['value' => h($node->get('id'))]);
            $html .= $this->Form->hidden('path', ['value' => h($node->get('path'))]);
            $html .= $this->Form->button(__('Phản hồi'), ['class' => 'btn btn-success']);
            $html .= ' ';
            $html .= $this->Form->button(__('Hủy'), ['type' => 'button', 'class' => 'btn btn-success btn-cancel']);
            $html .= $this->Form->end();
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</article>';
            if ($this->childCount($node, true) !== 0) {
                $childNodes = $this->findChildren($node);
                foreach ($childNodes as $child) {
                    $html .= $this->createCommentBox($child, $post_id, $this->getLevel($child));
                }
            }
        }
        return $html;
    }

    /**
     * @param mixed $node Phần tử gốc trong danh sách
     * @param int $level Cấp của phần tử đang xét trong danh sách so với phần tử gốc
     * @param int $output Mã xuất ra cho phần tử đang xét
     * Các giá trị: <br>
     * <p>1: Link </p>
     * <p>2: Plain Text có phân cấp</p>
     * @return array Mảng chứa cấu trúc danh sách
     */
    public function createMultiLevelList($node, $level = 1, $output = 1)
    {
        $list = [];
        $root = false;
        if ($node instanceof Query) {
            $model = 'Query';
            $root = true;
        }

        if ($node instanceof Entity) {
            $model = $this->__getModel(get_class($node));
        }
//        if (!($node instanceof Category)) {
//            return '';
//        } else {
//            $model = 'Category';
//        }

        if ($root) {
            $level = 0;
            foreach ($node as $item) {
                $list = array_merge($list, $this->createMultiLevelList($item, $level, $output));
            }
        } else {
            $parent_name = $node->get('name');
            switch ($output) {
                case 1:
                default:
                    $key = $this->Html->link(__($parent_name), $this->Url->build(['_name' => 'cat-display', 'slug' => $node->get('slug'), 'id' => $node->get('id')]));
                    break;
                case 2:
                    $key = $parent_name;
                    break;
            }
            $list[$key] = [];
            if ($this->childCount($node, true) !== 0) {
                $childNodes = $this->findChildren($node);
                foreach ($childNodes as $child) {
                    $list[$key] = $this->createMultiLevelList($child, $this->getLevel($child), $output);
                }
            }
        }
        return $list;
    }
}
