<?php
/**
 * Author: ansidev
 * Date: 22/04/2015
 * Time: 9:29 PM
 */

namespace App\View\Helper;


use Cake\ORM\TableRegistry;
use Cake\View\Helper;

class PostHelper extends Helper
{
    protected $_status = [
        0 => 'Draft',
        1 => 'Waiting for approved',
        2 => 'Approved',
        3 => 'Published',
        4 => 'Trashed',
        5 => 'Archived',
    ];

    public function statusToString($status = null)
    {
        if ($status === null) {
            return '';
        }
        return $this->_status[$status];
    }

    public function getCategories($id)
    {
        if ($id === null) {
            return '';
        }
        $object = TableRegistry::get('PostsCategories');
        $query = $object->find()
            ->select(['Categories.name'])
            ->innerJoin(
                ['Categories' => 'categories'],
                [
                    'PostsCategories.category_id = Categories.id'
                ])
            ->where(['PostsCategories.post_id' => $id])
            ->all()
            ->toArray();
        $result = [];
        foreach ($query as $row) {
            $result[] = $row->Categories['name'];
        };
        return implode(', ', $result);
    }

    public function getTags($id)
    {
        if ($id === null) {
            return '';
        }
        $object = TableRegistry::get('PostsTags');
        $query = $object->find()
            ->select(['Tags.name'])
            ->innerJoin(
                ['Tags' => 'tags'],
                [
                    'PostsTags.tag_id = Tags.id'
                ])
            ->where(['PostsTags.post_id' => $id])
            ->all()
            ->toArray();
        $result = [];
        foreach ($query as $row) {
            $result[] = $row->Tags['name'];
        };
        return implode(', ', $result);
    }

    public function getCommentsCount($id)
    {
        if ($id === null) {
            return '';
        }
        $object = TableRegistry::get('Comments');
        $query = $object->find()
            ->select(['Comments.id'])
            ->where(['Comments.post_id' => $id])
            ->all();
        return $query->count();
    }
}
