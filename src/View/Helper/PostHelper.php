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
        0 => 'Bản nháp',
        1 => 'Chờ duyệt',
        2 => 'Đã duyệt',
        3 => 'Đã xuất bản',
        4 => 'Trong thùng rác',
        5 => 'Lưu trữ',
    ];

    public function statusToString($status = null)
    {
        if ($status === null) {
            return '';
        }
        return $this->_status[$status];
    }

    /**
     * Hàm tạo slug từ một string
     * @param $str Chuỗi truyền vào
     * @return string Chuỗi slug trả về
     */
    public function toSlug($str)
    {
        $str = trim(mb_strtolower($str));
        $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
        $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
        $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
        $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
        $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
        $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
        $str = preg_replace('/(đ)/', 'd', $str);
        $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
        $str = preg_replace('/([\s]+)/', '-', $str);
        return $str;
    }

    public function getTitle($post_id)
    {
        if ($post_id === null) {
            return '';
        }
        $object = TableRegistry::get('Posts');
        $query = $object->find('list')
            ->select(['Posts.title'])
            ->where(['Posts.id' => $post_id])
            ->limit(1)
            ->toArray();
        return $query[0];
    }

    public function getPostStatus($post_id)
    {
        if ($post_id === null) {
            return '';
        }
        $object = TableRegistry::get('Posts');
        $query = $object->find('list')
            ->select(['Posts.status'])
            ->where(['Posts.id' => $post_id])
            ->limit(1)
            ->toArray();
        return $query[0];
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

    public function getCommentsCount($post_id)
    {
        if ($post_id === null) {
            return '';
        }
        $object = TableRegistry::get('Comments');
        $query = $object->find()
            ->select(['Comments.id'])
            ->where([
                'Comments.post_id' => $post_id,
                'Comments.status' => 3,
            ])
            ->all();
        return $query->count();
    }

    public function getComments($post_id)
    {
        if ($post_id === null) {
            return '';
        }
        $object = TableRegistry::get('Comments');
        $query = $object->find()
            ->select()
            ->where([
                'Comments.post_id' => $post_id,
                'Comments.status' => 3,
            ])
            ->all()
            ->toArray();
        return $query;
    }

    public function getDraftPosts($user_id)
    {
        if ($user_id === null) {
            return 'Người dùng không tồn tại';
        }
        $object = TableRegistry::get('Posts');
        $query = $object->find()
            ->select()
            ->where([
                'Posts.user_id' => $user_id,
                'Posts.status' => 0 //Draft post status
            ])
            ->all()
            ->toArray();
        return $query;
    }

    public function echoShortBody($body, $length = 400) {
        $body = htmlspecialchars_decode($body);
        if (empty($body)) {
            return '';
        } else {
            $body_length = strlen($body);
            if ($body_length <= $length) {
                return $body;
            } else {
                $result = trim(substr($body, 0, $length));
                if (strlen($result) <= $length) {
                    return $result;
                } else {
                    return h($result . '...');
                }
            }
        }

    }


}
