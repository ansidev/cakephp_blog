<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PostsTag Entity.
 */
class PostsTag extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'created_at' => true,
        'updated_at' => true,
        'post' => true,
        'tag' => true,
    ];
}
