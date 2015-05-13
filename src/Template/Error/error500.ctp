<?php
use Cake\Core\Configure;
use Cake\Error\Debugger;

$this->layout = 'front_page';

if (Configure::read('debug')):
    $this->layout = 'dev_error';

    $this->assign('title', $message);
    $this->assign('templateName', 'error500.ctp');

    $this->start('file');
?>
<?php if (!empty($error->queryString)) : ?>
    <p class="notice">
        <strong>SQL Query: </strong>
        <?= h($error->queryString) ?>
    </p>
<?php endif; ?>
<?php if (!empty($error->params)) : ?>
        <strong>SQL Query Params: </strong>
        <?= Debugger::dump($error->params) ?>
<?php endif; ?>
<?php
    echo $this->element('auto_table_warning');

    if (extension_loaded('xdebug')):
        xdebug_print_function_stack();
    endif;

    $this->end();
endif;
?>
<h2><?= __d('cake', 'Đã xảy ra lỗi nội bộ') ?></h2>
<p class="error">
    <strong><?= __d('cake', 'Lỗi') ?>: </strong>
    <?= h($message) ?>
</p>
