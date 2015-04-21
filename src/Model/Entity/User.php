<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity.
 */
class User extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'username' => true,
        'email' => true,
        'full_name' => true,
        'password' => true,
        'roles_id' => true,
        'created_at' => true,
        'updated_at' => true,
        'role' => true,
        'comments' => true,
        'posts' => true,
    ];
}
