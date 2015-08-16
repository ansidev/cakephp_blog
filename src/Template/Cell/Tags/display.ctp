<div class="well" style="border-radius: 0">
<!--    <h4>Tag</h4>-->

    <div class="row">
        <div class="col-lg-12">
            <ul class="list-unstyled">
                <?php foreach ($tags as $tag): ?>
                    <?= $this->Html->link(__($tag->name), $this->Url->build(['_name' => 'tag-display', 'slug' => $tag->slug, 'id' => $tag->id]), ['class' => 'btn btn-xs btn-danger', 'style' => 'margin-bottom: 5px']) ?>
                <?php endforeach; ?>
            </ul>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>
