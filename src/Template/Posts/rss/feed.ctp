<?php
$this->set('channelData', [
    'title' => __("Most Recent Posts"),
    'link' => $this->Url->build('/', true),
    'description' => __("Most recent posts."),
    'language' => 'en-us'
]);

if (!isset($channel)):
    $channel = array();
endif;
if (!isset($channel['title'])):
    $channel['title'] = $this->fetch('title');
endif;

echo $this->Rss->document(
    $this->Rss->channel(
        array(), $channel, $this->fetch('content')
    )
);

foreach ($posts as $post) {
    $created_at = strtotime($post->created_at);

    $link = ['_name' => 'post-read', 'slug' => $post->slug, 'id' => $post->id];

    // Remove & escape any HTML to make sure the feed content will validate.
//    debug($post->body);
    $body = (html_entity_decode($post->body));
    debug($body);
    $body = $this->Text->truncate($body, 400, [
        'ending' => '...',
        'exact' => true,
        'html' => true,
    ]);
    echo $this->Rss->item([], [
            'title' => $post->title,
            'author' => $this->UserInfo->getUserInfo($post->user_id, ['username'])->username,
            'link' => $link,
            'guid' => ['url' => $link, 'isPermaLink' => 'true'],
            'description' => $body,
            'pubDate' => $post->created_at
        ]);
}
