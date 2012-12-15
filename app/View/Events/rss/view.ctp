<?php
$this->set('channelData', array(
    'title' => __("Most Recent Posts"),
    'link' => $this->Html->url('/', true),
    'description' => __("Most recent posts."),
    'language' => 'en-us'
));


App::uses('Sanitize', 'Utility');

$postTime = strtotime($event['Event']['created']);

$postLink = array(
    'controller' => 'posts',
    'action' => 'view',
    $event['Event']['id']
);

// This is the part where we clean the body text for output as the description
// of the rss item, this needs to have only text to make sure the feed validates
$bodyText = preg_replace('=\(.*?\)=is', '', $event['Event']['shortdescription']);
$bodyText = $this->Text->stripLinks($bodyText);
$bodyText = Sanitize::stripAll($bodyText);
$bodyText = $this->Text->truncate($bodyText, 400, array(
    'ending' => '...',
    'exact'  => true,
    'html'   => true,
));

$item = array(
    'title' => $event['Event']['name'],
    'link' => $postLink,
    'guid' => array('url' => $postLink, 'isPermaLink' => 'true'),
    'description' => $bodyText,
    'pubDate' => $event['Event']['created']
);
$item['description'] .= '<br><img src="'. FULL_BASE_URL . $event['Event']['img_thumb'] . '" />';

if(!empty($event['Event']['img_thumb'])){
    $item['eventThumbnail'] = FULL_BASE_URL . $event['Event']['img_thumb'];
}
for($i=1;$i<=5;$i++){
    $item["OverlayImage$i"] = FULL_BASE_URL . $event['Event']["img_overlay_$i"];
}
echo  $this->Rss->item(array(), $item );

