<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         3.0.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Model\Behavior;

use Cake\Datasource\EntityInterface;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\ORM\Behavior;
use Cake\ORM\Entity;
use Cake\ORM\Query;
use InvalidArgumentException;
use RuntimeException;

/**
 * Makes the table to which this is attached to behave like a nested set and
 * provides methods for managing and retrieving information out of the derived
 * hierarchical structure.
 *
 * Tables attaching this behavior are required to have a column referencing the
 * parent row, and two other numeric columns (lft and rght) where the implicit
 * order will be cached.
 *
 * For more information on what is a nested set and a how it works refer to
 * http://www.sitepoint.com/hierarchical-data-database-2/
 */
class ModernTreeBehavior extends Behavior
{

    /**
     * Cached copy of the first column in a table's primary key.
     *
     * @var string
     */
    protected $_primaryKey;

    /**
     * Default config
     *
     * These are merged with user-provided configuration when the behavior is used.
     *
     * @var array
     */
    protected $_defaultConfig = [
        'implementedFinders' => [
            'path' => 'findPath',
            'children' => 'findChildren',
            'treeList' => 'findTreeList'
        ],
        'implementedMethods' => [
            'childCount' => 'childCount',
            'moveUp' => 'moveUp',
            'moveDown' => 'moveDown',
            'recover' => 'recover',
            'removeFromTree' => 'removeFromTree',
            'getLevel' => 'getLevel'
        ],
        'id' => 'id',
        'parent' => 'parent_id',
        'path' => 'path',
        'scope' => null,
        'level' => null
    ];

//    /**
//     * Before save listener.
//     * Transparently manages setting the lft and rght fields if the parent field is
//     * included in the parameters to be saved.
//     *
//     * @param \Cake\Event\Event $event The beforeSave event that was fired
//     * @param \Cake\ORM\Entity $entity the entity that is going to be saved
//     * @return void
//     * @throws \RuntimeException if the parent to set for the node is invalid
//     */
//    public function beforeSave(Event $event, Entity $entity)
//    {
//        $isNew = $entity->isNew();
//        $config = $this->config();
//        $parent = $entity->get($config['parent']);
//        $primaryKey = $this->_getPrimaryKey();
//        $dirty = $entity->dirty($config['parent']);
//        $level = $config['level'];
//
//        if ($isNew) {
//            if ($entity->get($primaryKey[0]) == $parent) {
//                throw new RuntimeException("Cannot set a node's parent as itself");
//            }
//
////            $parentNode = $this->_getNode($parent);
////            $path = $parentNode->get($config['path']);
//            $entity->set($config['parent'], 0);
//
//            if ($level) {
//                $entity->set($level, 1);
//            }
//            return;
//        }
//
//        if (!$isNew && $dirty && $parent) {
//            $this->_setParent($entity, $parent);
//
//            if ($level) {
//                $parentNode = $this->_getNode($parent);
//                $entity->set($config[$level], $parentNode[$level] + 1);
//            }
//            return;
//        }
//
//        if (!$isNew && $dirty && !$parent) {
//            $this->_setAsRoot($entity);
//
//            if ($level) {
//                $entity->set($level, 0);
//            }
//        }
//    }

//    /**
//     * After save listener.
//     *
//     * Manages updating level of descendents of currently saved entity.
//     *
//     * @param \Cake\Event\Event $event The beforeSave event that was fired
//     * @param \Cake\ORM\Entity $entity the entity that is going to be saved
//     * @return void
//     */
//    public function afterSave(Event $event, Entity $entity)
//    {
//        if (!$this->_config['level'] || $entity->isNew()) {
//            return;
//        }
//
//        $this->_setChildrenLevel($entity);
//    }

    /**
     * Set level for descendents.
     *
     * @param \Cake\ORM\Entity $entity The entity whose descendents need to be updated.
     * @return void
     */
    protected function _setChildrenLevel(Entity $entity)
    {
        $config = $this->config();

        if ($entity->get($config['left']) + 1 === $entity->get($config['right'])) {
            return;
        }

        $primaryKey = $this->_getPrimaryKey();
        $primaryKeyValue = $entity->get($primaryKey);
        $depths = [$primaryKeyValue => $entity->get($config['level'])];

        $children = $this->_table->find('children', [
            'for' => $primaryKeyValue,
            'fields' => [$this->_getPrimaryKey(), $config['parent'], $config['level']],
            'order' => $config['left']
        ]);

        foreach ($children as $node) {
            $parentIdValue = $node->get($config['parent']);
            $depth = $depths[$parentIdValue] + 1;
            $depths[$node->get($primaryKey)] = $depth;

            $this->_table->updateAll(
                [$config['level'] => $depth],
                [$primaryKey => $node->get($primaryKey)]
            );
        }
    }

//    /**
//     * Also deletes the nodes in the subtree of the entity to be delete
//     *
//     * @param \Cake\Event\Event $event The beforeDelete event that was fired
//     * @param \Cake\ORM\Entity $entity The entity that is going to be saved
//     * @return void
//     */
//    public function beforeDelete(Event $event, Entity $entity)
//    {
//        $config = $this->config();
//        $this->_ensureFields($entity);
//        $left = $entity->get($config['left']);
//        $right = $entity->get($config['right']);
//        $diff = $right - $left + 1;
//
//        if ($diff > 2) {
//            $this->_table->deleteAll([
//                "{$config['left']} >=" => $left + 1,
//                "{$config['left']} <=" => $right - 1
//            ]);
//        }
//
//        $this->_sync($diff, '-', "> {$right}");
//    }

    /**
     * Sets the correct left and right values for the passed entity so it can be
     * updated to a new parent. It also makes the hole in the tree so the node
     * move can be done without corrupting the structure.
     *
     * @param \Cake\ORM\Entity $entity The entity to re-parent
     * @param mixed $parent the id of the parent to set
     * @return void
     * @throws \RuntimeException if the parent to set to the entity is not valid
     */
    protected function _setParent($entity, $parent)
    {
        $config = $this->config();
        $parentNode = $this->_getNode($parent);
        $this->_ensureFields($entity);
        $parentLeft = $parentNode->get($config['left']);
        $parentRight = $parentNode->get($config['right']);
        $right = $entity->get($config['right']);
        $left = $entity->get($config['left']);

        if ($parentLeft > $left && $parentLeft < $right) {
            throw new RuntimeException(sprintf(
                'Cannot use node "%s" as parent for entity "%s"',
                $parent,
                $entity->get($this->_getPrimaryKey())
            ));
        }

        // Values for moving to the left
        $diff = $right - $left + 1;
        $targetLeft = $parentRight;
        $targetRight = $diff + $parentRight - 1;
        $min = $parentRight;
        $max = $left - 1;

        if ($left < $targetLeft) {
            // Moving to the right
            $targetLeft = $parentRight - $diff;
            $targetRight = $parentRight - 1;
            $min = $right + 1;
            $max = $parentRight - 1;
            $diff *= -1;
        }

        if ($right - $left > 1) {
            // Correcting internal subtree
            $internalLeft = $left + 1;
            $internalRight = $right - 1;
            $this->_sync($targetLeft - $left, '+', "BETWEEN {$internalLeft} AND {$internalRight}", true);
        }

        $this->_sync($diff, '+', "BETWEEN {$min} AND {$max}");

        if ($right - $left > 1) {
            $this->_unmarkInternalTree();
        }

        // Allocating new position
        $entity->set($config['left'], $targetLeft);
        $entity->set($config['right'], $targetRight);
    }

    /**
     * Updates the left and right column for the passed entity so it can be set as
     * a new root in the tree. It also modifies the ordering in the rest of the tree
     * so the structure remains valid
     *
     * @param \Cake\ORM\Entity $entity The entity to set as a new root
     * @return void
     */
    protected function _setAsRoot($entity)
    {
        $config = $this->config();
        $edge = $this->_getMax();
        $this->_ensureFields($entity);

        $entity->set($config['parent'], 0);
        $entity->set($config['path'], $entity->get($this->_getPrimaryKey()));
    }

    /**
     * Helper method used to invert the sign of the left and right columns that are
     * less than 0. They were set to negative values before so their absolute value
     * wouldn't change while performing other tree transformations.
     *
     * @return void
     */
    protected function _unmarkInternalTree()
    {
        $config = $this->config();
        $query = $this->_table->query();
        $this->_table->updateAll([
            $query->newExpr()->add("{$config['left']} = {$config['left']} * -1"),
            $query->newExpr()->add("{$config['right']} = {$config['right']} * -1"),
        ], [$config['left'] . ' <' => 0]);
    }

    /**
     * Custom finder method which can be used to return the list of nodes from the root
     * to a specific node in the tree. This custom finder requires that the key 'for'
     * is passed in the options containing the id of the node to get its path for.
     *
     * @param \Cake\ORM\Query $query The constructed query to modify
     * @param array $options the list of options for the query
     * @return \Cake\ORM\Query
     * @throws \InvalidArgumentException If the 'for' key is missing in options
     */
    public function findPath(Query $query, array $options)
    {
        if (empty($options['for'])) {
            throw new InvalidArgumentException("The 'for' key is required for find('path')");
        }

        $config = $this->config();
        list($left, $right) = array_map(
            function ($field) {
                return $this->_table->aliasField($field);
            },
            [$config['left'], $config['right']]
        );

        $node = $this->_table->get($options['for'], ['fields' => [$left, $right]]);

        return $this->_scope($query)
            ->where([
                "$left <=" => $node->get($config['left']),
                "$right >=" => $node->get($config['right'])
            ]);
    }

    /**
     * Get the number of children nodes.
     *
     * @param \Cake\ORM\Entity $node The entity to count children for
     * @param bool $direct whether to count all nodes in the subtree or just
     * direct children
     * @return int Number of children nodes.
     */
    public function childCount(Entity $node, $direct = false)
    {
        $config = $this->config();
        $parent = $this->_table->aliasField($config['parent']);
        $path = $this->_table->aliasField($config['path']);

        if ($direct) {
            return $this->_scope($this->_table->find())
                ->where([$parent => $node->get($this->_getPrimaryKey())])
                ->count();
        }

        return $this->_scope($this->_table->find())
            ->where(["{$path} LIKE" => $node->get($config['path']) . '-%'])
            ->count();
    }

    /**
     * Get the children nodes of the current model
     *
     * Available options are:
     *
     * - for: The id of the record to read.
     * - direct: Boolean, whether to return only the direct (true), or all (false) children,
     *   defaults to false (all children).
     *
     * If the direct option is set to true, only the direct children are returned (based upon the parent_id field)
     *
     * @param \Cake\ORM\Query $query Query.
     * @param array $options Array of options as described above
     * @return \Cake\ORM\Query
     * @throws \InvalidArgumentException When the 'for' key is not passed in $options
     */
    public function findChildren(Query $query, array $options)
    {
        $config = $this->config();
        $options += ['for' => null, 'direct' => false];
        list($parent, $path) = array_map(
            function ($field) {
                return $this->_table->aliasField($field);
            },
            [$config['parent'], $config['path']]
        );

        list($for, $direct) = [$options['for'], $options['direct']];

        if (empty($for)) {
            throw new InvalidArgumentException("The 'for' key is required for find('children')");
        }

        if ($query->clause('order') === null) {
            $query->order([$path => 'ASC']);
        }

        if ($direct) {
            return $this->_scope($query)->where([$parent => $for]);
        }

        $node = $this->_getNode($for);
        return $this->_scope($query)
            ->where([
                "{$path} LIKE" => $node->get($config['path']) . '-%',
            ]);
    }

    /**
     * Gets a representation of the elements in the tree as a flat list where the keys are
     * the primary key for the table and the values are the display field for the table.
     * Values are prefixed to visually indicate relative depth in the tree.
     *
     * Available options are:
     *
     * - keyPath: A dot separated path to fetch the field to use for the array key, or a closure to
     *  return the key out of the provided row.
     * - valuePath: A dot separated path to fetch the field to use for the array value, or a closure to
     *  return the value out of the provided row.
     * - spacer: A string to be used as prefix for denoting the depth in the tree for each item
     *
     * @param \Cake\ORM\Query $query Query.
     * @param array $options Array of options as described above
     * @return \Cake\ORM\Query
     */
    public function findTreeList(Query $query, array $options)
    {
        $config = $this->config();
        $options += ['for' => null, 'direct' => false];
        list($parent, $path) = array_map(
            function ($field) {
                return $this->_table->aliasField($field);
            },
            [$config['parent'], $config['path']]
        );

        list($for, $direct) = [$options['for'], $options['direct']];

        if (empty($for)) {
            throw new InvalidArgumentException("The 'for' key is required for find('children')");
        }

        if ($query->clause('order') === null) {
            $query->order([$path => 'ASC']);
        }

        if ($direct) {
            return $this->_scope($query)->where([$parent => $for]);
        }

        $node = $this->_getNode($for);
        return $this->_scope($query)
            ->where([
                "{$path} LIKE" => $node->get($config['path']) . '%',
            ]);
    }

    /**
     * Removes the current node from the tree, by positioning it as a new root
     * and re-parents all children up one level.
     *
     * Note that the node will not be deleted just moved away from its current position
     * without moving its children with it.
     *
     * @param \Cake\ORM\Entity $node The node to remove from the tree
     * @return \Cake\ORM\Entity|false the node after being removed from the tree or
     * false on error
     */
    public function removeFromTree(Entity $node)
    {
        return $this->_table->connection()->transactional(function () use ($node) {
            $this->_ensureFields($node);
            return $this->_removeFromTree($node);
        });
    }

    /**
     * Helper function containing the actual code for removeFromTree
     *
     * @param \Cake\ORM\Entity $node The node to remove from the tree
     * @return \Cake\ORM\Entity|false the node after being removed from the tree or
     * false on error
     */
    protected function _removeFromTree($node)
    {
        $config = $this->config();
        $left = $node->get($config['left']);
        $right = $node->get($config['right']);
        $parent = $node->get($config['parent']);

        $node->set($config['parent'], null);

        if ($right - $left == 1) {
            return $this->_table->save($node);
        }

        $primary = $this->_getPrimaryKey();
        $this->_table->updateAll(
            [$config['parent'] => $parent],
            [$config['parent'] => $node->get($primary)]
        );
        $this->_sync(1, '-', 'BETWEEN ' . ($left + 1) . ' AND ' . ($right - 1));
        $this->_sync(2, '-', "> {$right}");
        $edge = $this->_getMax();
        $node->set($config['left'], $edge + 1);
        $node->set($config['right'], $edge + 2);
        $fields = [$config['parent'], $config['left'], $config['right']];

        $this->_table->updateAll($node->extract($fields), [$primary => $node->get($primary)]);

        foreach ($fields as $field) {
            $node->dirty($field, false);
        }
        return $node;
    }

    /**
     * Reorders the node without changing its parent.
     *
     * If the node is the first child, or is a top level node with no previous node
     * this method will return false
     *
     * @param \Cake\ORM\Entity $node The node to move
     * @param int|bool $number How many places to move the node, or true to move to first position
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When node was not found
     * @return \Cake\ORM\Entity|bool $node The node after being moved or false on failure
     */
    public function moveUp(Entity $node, $number = 1)
    {
        if ($number < 1) {
            return false;
        }

        return $this->_table->connection()->transactional(function () use ($node, $number) {
            $this->_ensureFields($node);
            return $this->_moveUp($node, $number);
        });
    }

    /**
     * Helper function used with the actual code for moveUp
     *
     * @param \Cake\ORM\Entity $node The node to move
     * @param int|bool $number How many places to move the node, or true to move to first position
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When node was not found
     * @return \Cake\ORM\Entity|bool $node The node after being moved or false on failure
     */
    protected function _moveUp($node, $number)
    {
        $config = $this->config();
        list($parent, $left, $right) = [$config['parent'], $config['left'], $config['right']];
        list($nodeParent, $nodeLeft, $nodeRight) = array_values($node->extract([$parent, $left, $right]));

        $targetNode = null;
        if ($number !== true) {
            $targetNode = $this->_scope($this->_table->find())
                ->select([$left, $right])
                ->where(["$parent IS" => $nodeParent, "$right <" => $nodeLeft])
                ->order([$left => 'DESC'])
                ->offset($number - 1)
                ->limit(1)
                ->first();
        }
        if (!$targetNode) {
            $targetNode = $this->_scope($this->_table->find())
                ->select([$left, $right])
                ->where(["$parent IS" => $nodeParent, "$right <" => $nodeLeft])
                ->order([$left => 'ASC'])
                ->limit(1)
                ->first();

            if (!$targetNode) {
                return $node;
            }
        }

        list($targetLeft, $targetRight) = array_values($targetNode->extract([$left, $right]));
        $edge = $this->_getMax();
        $leftBoundary = $targetLeft;
        $rightBoundary = $nodeLeft - 1;

        $nodeToEdge = $edge - $nodeLeft + 1;
        $shift = $nodeRight - $nodeLeft + 1;
        $nodeToHole = $edge - $leftBoundary + 1;
        $this->_sync($nodeToEdge, '+', "BETWEEN {$nodeLeft} AND {$nodeRight}");
        $this->_sync($shift, '+', "BETWEEN {$leftBoundary} AND {$rightBoundary}");
        $this->_sync($nodeToHole, '-', "> {$edge}");

        $node->set($left, $targetLeft);
        $node->set($right, $targetLeft + ($nodeRight - $nodeLeft));

        $node->dirty($left, false);
        $node->dirty($right, false);

        return $node;
    }

    /**
     * Reorders the node without changing the parent.
     *
     * If the node is the last child, or is a top level node with no subsequent node
     * this method will return false
     *
     * @param \Cake\ORM\Entity $node The node to move
     * @param int|bool $number How many places to move the node or true to move to last position
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When node was not found
     * @return \Cake\ORM\Entity|bool the entity after being moved or false on failure
     */
    public function moveDown(Entity $node, $number = 1)
    {
        if ($number < 1) {
            return false;
        }

        return $this->_table->connection()->transactional(function () use ($node, $number) {
            $this->_ensureFields($node);
            return $this->_moveDown($node, $number);
        });
    }

    /**
     * Helper function used with the actual code for moveDown
     *
     * @param \Cake\ORM\Entity $node The node to move
     * @param int|bool $number How many places to move the node, or true to move to last position
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When node was not found
     * @return \Cake\ORM\Entity|bool $node The node after being moved or false on failure
     */
    protected function _moveDown($node, $number)
    {
        $config = $this->config();
        list($parent, $left, $right) = [$config['parent'], $config['left'], $config['right']];

        list($nodeParent, $nodeLeft, $nodeRight) = array_values($node->extract([$parent, $left, $right]));

        $targetNode = null;
        if ($number !== true) {
            $targetNode = $this->_scope($this->_table->find())
                ->select([$left, $right])
                ->where(["$parent IS" => $nodeParent, "$left >" => $nodeRight])
                ->order([$left => 'ASC'])
                ->offset($number - 1)
                ->limit(1)
                ->first();
        }
        if (!$targetNode) {
            $targetNode = $this->_scope($this->_table->find())
                ->select([$left, $right])
                ->where(["$parent IS" => $nodeParent, "$left >" => $nodeRight])
                ->order([$left => 'DESC'])
                ->limit(1)
                ->first();

            if (!$targetNode) {
                return $node;
            }
        }

        list($targetLeft, $targetRight) = array_values($targetNode->extract([$left, $right]));
        $edge = $this->_getMax();
        $leftBoundary = $nodeRight + 1;
        $rightBoundary = $targetRight;

        $nodeToEdge = $edge - $nodeLeft + 1;
        $shift = $nodeRight - $nodeLeft + 1;
        $nodeToHole = $edge - $rightBoundary + $shift;
        $this->_sync($nodeToEdge, '+', "BETWEEN {$nodeLeft} AND {$nodeRight}");
        $this->_sync($shift, '-', "BETWEEN {$leftBoundary} AND {$rightBoundary}");
        $this->_sync($nodeToHole, '-', "> {$edge}");

        $node->set($left, $targetRight - ($nodeRight - $nodeLeft));
        $node->set($right, $targetRight);

        $node->dirty($left, false);
        $node->dirty($right, false);

        return $node;
    }

    /**
     * Returns a single node from the tree from its primary key
     *
     * @param mixed $id Record id.
     * @return \Cake\ORM\Entity
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When node was not found
     */
    protected function _getNode($id)
    {
        $config = $this->config();
        list($parent, $path) = [$config['parent'], $config['path']];
        $primaryKey = $this->_getPrimaryKey();
        $fields = [$parent, $path];
        if ($config['level']) {
            $fields[] = $config['level'];
        }

        $node = $this->_scope($this->_table->find())
            ->select($fields)
            ->where([$this->_table->alias() . '.' . $primaryKey => $id])
            ->first();

        if (!$node) {
            throw new RecordNotFoundException("Node \"{$id}\" was not found in the tree.");
        }

        return $node;
    }

    /**
     * Recovers the lft and right column values out of the hierarchy defined by the
     * parent column.
     *
     * @return void
     */
    public function recover()
    {
        $this->_table->connection()->transactional(function () {
            $this->_recoverTree();
        });
    }

    /**
     * Recursive method used to recover a single level of the tree
     *
     * @param int $counter The Last left column value that was assigned
     * @param mixed $parentId the parent id of the level to be recovered
     * @return int The next value to use for the left column
     */
    protected function _recoverTree($counter = 0, $parentId = null)
    {
        $config = $this->config();
        list($parent, $left, $right) = [$config['parent'], $config['left'], $config['right']];
        $pk = (array)$this->_table->primaryKey();

        $query = $this->_scope($this->_table->query())
            ->select($pk)
            ->where([$parent . ' IS' => $parentId])
            ->order($pk)
            ->hydrate(false);

        $leftCounter = $counter;
        foreach ($query as $row) {
            $counter++;
            $counter = $this->_recoverTree($counter, $row[$pk[0]]);
        }

        if ($parentId === null) {
            return $counter;
        }

        $this->_table->updateAll(
            [$left => $leftCounter, $right => $counter + 1],
            [$pk[0] => $parentId]
        );

        return $counter + 1;
    }

    /**
     * Returns the maximum index value in the table.
     *
     * @return int
     */
    protected function _getMax()
    {
        $config = $this->config();
        $field = $config['path'];

        $edge = $this->_scope($this->_table->find())
            ->select([$field])
            ->order([$field => 'DESC'])
            ->first();

        if (empty($edge->{$field})) {
            return 0;
        }

        return $edge->{$field};
    }

    /**
     * Auxiliary function used to automatically alter the value of both the left and
     * right columns by a certain amount that match the passed conditions
     *
     * @param int $shift the value to use for operating the left and right columns
     * @param string $dir The operator to use for shifting the value (+/-)
     * @param string $conditions a SQL snipped to be used for comparing left or right
     * against it.
     * @param bool $mark whether to mark the updated values so that they can not be
     * modified by future calls to this function.
     * @return void
     */
    protected function _sync($shift, $dir, $conditions, $mark = false)
    {
        $config = $this->config();

        foreach ([$config['left'], $config['right']] as $field) {
            $query = $this->_scope($this->_table->query());

            $mark = $mark ? '*-1' : '';
            $template = sprintf('%s = (%s %s %s)%s', $field, $field, $dir, $shift, $mark);
            $query->update()->set($query->newExpr()->add($template));
            $query->where("{$field} {$conditions}");

            $query->execute();
        }
    }

    /**
     * Alters the passed query so that it only returns scoped records as defined
     * in the tree configuration.
     *
     * @param \Cake\ORM\Query $query the Query to modify
     * @return \Cake\ORM\Query
     */
    protected function _scope($query)
    {
        $config = $this->config();

        if (is_array($config['scope'])) {
            return $query->where($config['scope']);
        } elseif (is_callable($config['scope'])) {
            return $config['scope']($query);
        }

        return $query;
    }

    /**
     * Ensures that the provided entity contains non-empty values for the left and
     * right fields
     *
     * @param \Cake\ORM\Entity $entity The entity to ensure fields for
     * @return void
     */
    protected function _ensureFields($entity)
    {
        $config = $this->config();
        $fields = [$config['left'], $config['right']];
        $values = array_filter($entity->extract($fields));
        if (count($values) === count($fields)) {
            return;
        }

        $fresh = $this->_table->get($entity->get($this->_getPrimaryKey()), $fields);
        $entity->set($fresh->extract($fields), ['guard' => false]);

        foreach ($fields as $field) {
            $entity->dirty($field, false);
        }
    }

    /**
     * Returns a single string value representing the primary key of the attached table
     *
     * @return string
     */
    protected function _getPrimaryKey()
    {
        if (!$this->_primaryKey) {
            $this->_primaryKey = (array)$this->_table->primaryKey();
            $this->_primaryKey = $this->_primaryKey[0];
        }
        return $this->_primaryKey;
    }

    /**
     * Returns the depth level of a node in the tree.
     *
     * @param int|string|\Cake\Datasource\EntityInterface $entity The entity or primary key get the level of.
     * @return int|bool Integer of the level or false if the node does not exist.
     */
    public function getLevel($entity)
    {
        $primaryKey = $this->_getPrimaryKey();
        $id = $entity;
        if ($entity instanceof EntityInterface) {
            $id = $entity->get($primaryKey);
        }
        $config = $this->config();
        $entity = $this->_table->find('all')
            ->select([$config['path']])
            ->where([$primaryKey => $id])
            ->first();

        if ($entity === null) {
            return false;
        }

        return substr_count($entity[$config['path']], '-') + 1;
    }
}
