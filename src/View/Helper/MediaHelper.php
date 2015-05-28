<?php
/**
 * Author: ansidev
 * Date: 22/04/2015
 * Time: 9:29 PM
 */

namespace App\View\Helper;


use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\View\Helper;

class MediaHelper extends Helper
{
//    public $helpers = ['Number'];

    public function url($relative_path)
    {
        return Configure::read('App.rootUrl') . h($relative_path);
    }
    public function getDescription($media_id) {
        if ($media_id === null) {
            return '';
        }
        $object = TableRegistry::get('Media');
        $query = $object->find('all')
            ->select(['description'])
            ->where(['Media.id' => $media_id])
            ->limit(1)
            ->toArray();
        return json_decode($query[0]['description'], true)['description'];

    }
}
