<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Media Entity.
 */
class Media extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'user_id' => true,
        'title' => true,
        'slug' => true,
        'description' => true,
        'file_name' => true,
        'relative_path' => true,
        'media_type' => true,
        'mime_type' => true,
        'status' => true,
        'created_at' => true,
        'updated_at' => true,
        'user' => true,
    ];
}
