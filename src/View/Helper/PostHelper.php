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
    public $helpers = ['Text', 'Html', 'Url', 'Content'];
    protected $_status = [
        0 => 'Bản nháp',
        1 => 'Chờ duyệt',
        2 => 'Đã duyệt',
        3 => 'Đã xuất bản',
        4 => 'Trong thùng rác',
        5 => 'Lưu trữ',
    ];

    public function getStatuses()
    {
        return $this->_status;
    }

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

    public function get($post_id)
    {
        if ($post_id === null) {
            return '';
        }
        $object = TableRegistry::get('Posts');
        $query = $object->find('all')
            ->select()
            ->where(['Posts.id' => $post_id])
            ->limit(1)
            ->toArray();
        return $query[0];
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
            ->select(['Categories.name', 'Categories.id', 'Categories.slug'])
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
            $result[] = $this->Html->link(__($row->Categories['name']), $this->Url->build(['_name' => 'cat-display', 'slug' => $row->Categories['slug'], 'id' => $row->Categories['id']]), ['class' => 'btn btn-xs btn-primary']);
        };
        return implode(' ', $result);
    }

    public function getTags($id)
    {
        if ($id === null) {
            return '';
        }
        $object = TableRegistry::get('PostsTags');
        $query = $object->find()
            ->select(['Tags.name', 'Tags.id', 'Tags.slug'])
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
            $result[] = $this->Html->link(__($row->Tags['name']), $this->Url->build(['_name' => 'tag-display', 'slug' => $row->Tags['slug'], 'id' => $row->Tags['id']]), ['class' => 'btn btn-xs btn-danger']);

        };
        return implode(' ', $result);
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

    public function getThumbnailImage($id, $url = null)
    {
        $link = empty($url) ? h('/img/default.gif') : h($url);
        $html = '<img src="' . $link . '" class="img-responsive" alt="thumbnail-img-' . $id . '"/>';
        return $html;
    }

    public function getThumbnailImageUrl($url = null)
    {
        $link = empty($url) ? h('/img/default.gif') : h($url);
        return $link;
    }

    public function getCarouselItem($post, $active = false)
    {
        $options = [
            'thumbnail_url' => $this->getThumbnailImageUrl($post['thumbnail_url']),
            'title' => $post['title'],
            'body' => $this->Content->echoShortText($post['body'], 200),
            'post_url' => $this->Url->build(['_name' => 'post-read', 'slug' => $post['slug'], 'id' => $post['id']]),
            'active' => $active
        ];
//        $html = '';
//        $html .= '<div class="item active">';
//        $html .= '<img src="' . $options['thumbnail_url'] . '" style="width:100%" class="img-responsive"/>';
//        $html .= '<div class="container">';
//        $html .= '<div class="carousel-caption">';
//        $html .= '<h1>' . $options['title'] . '</h1>';
//        $html .= '<p>' . $options['body'] . '</p>';
//        $html .= '<p><a class="btn btn-lg btn-primary" href="' . $options['post_url'] . '">Xem thêm</a ></p >';
//        $html .= '</div></div></div>';
        return $options;
    }
}
