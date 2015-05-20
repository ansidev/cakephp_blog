<?php
/**
 * Author: ansidev
 * Date: 22/04/2015
 * Time: 9:29 PM
 */

namespace App\View\Helper;


use Cake\View\Helper;

class CommentHelper extends Helper
{
    protected $_status = [
        1 => 'Chờ duyệt',
        2 => 'Đã duyệt',
        3 => 'Đã đăng',
        4 => 'Spam',
        5 => 'Trong thùng rác',
        6 => 'Lưu trữ'
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
}
