<?php
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\Routing\Router;

class RouterHelper extends Helper
{
    public function url($option) {
        return Router::url(['controller' => $option['controller'], 'action' => $option['action']]);
    }
}
