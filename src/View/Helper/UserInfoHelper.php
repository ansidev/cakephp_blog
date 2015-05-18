<?php
/**
 * Author: ansidev
 * Date: 28/04/2015
 * Time: 10:21 AM
 */

namespace App\View\Helper;


use Cake\ORM\TableRegistry;
use Cake\View\Helper;

class UserInfoHelper extends Helper
{
    /**
     * Get either a Gravatar URL or complete image tag for a specified email address.
     *
     * @param string $email The email address
     * @param string $s Size in pixels, defaults to 80px [ 1 - 2048 ]
     * @param string $d Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
     * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
     * @param boole $img True to return a complete IMG tag False for just the URL
     * @param array $atts Optional, additional key/value attributes to include in the IMG tag
     * @return String containing either just a URL or a complete image tag
     * @source http://gravatar.com/site/implement/images/php/
     */
    public function get_gravatar($email, $s = 80, $d = 'mm', $r = 'g', $img = false, $attr = array())
    {
        $url = 'http://www.gravatar.com/avatar/';
        $url .= md5(strtolower(trim($email)));
        $url .= "?s=$s&d=$d&r=$r";
        if ($img) {
            $url = '<img class="img-responsive" src="' . $url . '"';
            foreach ($attr as $key => $val)
                $url .= ' ' . $key . '="' . $val . '"';
            $url .= ' />';
        }
        return $url;
    }

    public function getUserInfo($user_id, array $fields = [])
    {
        $object = TableRegistry::get('Users');
        $query = $object->find()
            ->select($fields)
            ->where(['id' => $user_id])
            ->limit(1)
            ->toArray();
        return $query[0];

    }
}
