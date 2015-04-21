<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Comment Entity.
 */
class Comment extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'body' => true,
        'user_id' => true,
        'post_id' => true,
        'status' => true,
        'created_at' => true,
        'updated_at' => true,
        'user' => true,
        'post' => true,
    ];
}
