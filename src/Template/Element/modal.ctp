<?= $this->Html->script('blog/write') ?>
<div class="modal fade" id="<?= $id ?>" tabindex="-1">
    <div class="modal-dialog modal-lg" style="width: 100%">
        <div class="modal-content">
            <div class="modal-body" style="width: 100%">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <?= $modal_body ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" id="modal-close">Close</button>
                <button type="button" class="btn btn-primary" id="modal-ok">OK</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->
