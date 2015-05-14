<?php
/**
 * Author: ansidev
 * Date: 22/04/2015
 * Time: 9:29 PM
 */

namespace App\View\Helper;


use Cake\Core\Configure;
use Cake\View\Helper;

class MediaHelper extends Helper
{
//    public $helpers = ['Number'];

    public function url($relative_path)
    {
        return Configure::read('App.rootUrl') . h($relative_path);
    }
}
