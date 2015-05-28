<div class="well">
<!--    <h4>Chủ đề</h4>-->

    <div class="row">
        <div class="col-lg-12">
            <?php
            $list = $this->Menu->createMultiLevelList($categories);
            echo $this->Html->nestedList($list, ['style' => 'padding-left: 15px']);
            ?>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>
