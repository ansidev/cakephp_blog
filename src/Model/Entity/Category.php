<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Category Entity.
 */
class Category extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'slug' => true,
        'parent_id' => true,
        'path' => true,
        'created_at' => true,
        'updated_at' => true,
        'parent_category' => true,
        'child_categories' => true,
        'posts' => true,
    ];
}
