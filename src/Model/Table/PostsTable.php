<?php
namespace App\Model\Table;

use App\Model\Entity\Post;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Posts Model
 */
class PostsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('posts');
        $this->displayField('title');
        $this->primaryKey('id');
        $this->belongsTo('ParentPosts', [
            'className' => 'Posts',
            'foreignKey' => 'parent_id'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Comments', [
            'foreignKey' => 'post_id'
        ]);
        $this->hasMany('ChildPosts', [
            'className' => 'Posts',
            'foreignKey' => 'parent_id'
        ]);
        $this->belongsToMany('Categories', [
            'foreignKey' => 'post_id',
            'targetForeignKey' => 'category_id',
            'joinTable' => 'posts_categories'
        ]);
        $this->belongsToMany('Tags', [
            'foreignKey' => 'post_id',
            'targetForeignKey' => 'tag_id',
            'joinTable' => 'posts_tags'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create')
            ->allowEmpty('title')
            ->allowEmpty('slug')
            ->allowEmpty('body')
            ->allowEmpty('thumbnail_url')
            ->add('status', 'valid', ['rule' => 'numeric'])
            ->requirePresence('status', 'create')
            ->notEmpty('status')
            ->add('clicked', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('clicked')
            ->add('pinned', 'valid', ['rule' => 'boolean'])
            ->allowEmpty('pinned')
            ->add('created_at', 'valid', ['rule' => 'datetime'])
            ->allowEmpty('created_at')
            ->add('updated_at', 'valid', ['rule' => 'datetime'])
            ->allowEmpty('updated_at');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['parent_id'], 'ParentPosts'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        return $rules;
    }
}
