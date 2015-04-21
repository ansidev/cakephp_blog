<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Permission Entity.
 */
class Permission extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'controller' => true,
        'action' => true,
        'type' => true,
        'created_at' => true,
        'updated_at' => true,
        'roles' => true,
    ];
}
