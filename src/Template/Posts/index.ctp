<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Post'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Comments'), ['controller' => 'Comments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Comment'), ['controller' => 'Comments', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Categories'), ['controller' => 'Categories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Category'), ['controller' => 'Categories', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Tags'), ['controller' => 'Tags', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tag'), ['controller' => 'Tags', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="posts index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('parent_id') ?></th>
            <th><?= $this->Paginator->sort('user_id') ?></th>
            <th><?= $this->Paginator->sort('title') ?></th>
            <th><?= $this->Paginator->sort('body') ?></th>
            <th><?= $this->Paginator->sort('slug') ?></th>
            <th><?= $this->Paginator->sort('status') ?></th>
            <th><?= $this->Paginator->sort('created_at') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($posts as $post): ?>
        <tr>
            <td><?= $this->Number->format($post->id) ?></td>
            <td><?= $this->Number->format($post->parent_id) ?></td>
            <td>
                <?= $post->has('user') ? $this->Html->link($post->user->id, ['controller' => 'Users', 'action' => 'view', $post->user->id]) : '' ?>
            </td>
            <td><?= h($post->title) ?></td>
            <td><?= h($post->body) ?></td>
            <td><?= h($post->slug) ?></td>
            <td><?= $this->Number->format($post->status) ?></td>
            <td><?= h($post->created_at) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $post->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $post->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $post->id], ['confirm' => __('Are you sure you want to delete # {0}?', $post->id)]) ?>
            </td>
        </tr>

    <?php endforeach; ?>
    </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
