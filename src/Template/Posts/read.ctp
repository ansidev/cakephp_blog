<?php
echo $this->start('breadcrumb');
$this->Html->addCrumb('Post', '/');
$this->Html->addCrumb($post->title, $this->Url->build(['_name' => 'post-read', 'slug' => $post->slug, 'id' => $post->id]), ['escape' => false, 'title' => $post->title]);
echo $this->end();

echo $this->start('posts');
echo $this->element('Posts/post', ['no_display' => true]);
echo $this->end();

echo $this->start('comments');
echo $this->element('Posts/comments');
echo $this->end();
