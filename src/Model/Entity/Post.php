<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Post Entity.
 */
class Post extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'parent_id' => true,
        'user_id' => true,
        'title' => true,
        'slug' => true,
        'body' => true,
        'status' => true,
        'created_at' => true,
        'updated_at' => true,
        'parent_post' => true,
        'user' => true,
        'comments' => true,
        'child_posts' => true,
        'categories' => true,
        'tags' => true,
    ];
}
