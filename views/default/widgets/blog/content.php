<?php

$widget = $vars['entity'];

// add in a create content link in certain contexts
$owner = elgg_get_page_owner_entity();
if(elgg_get_logged_in_user_guid() == $owner->guid || (elgg_instanceof($owner, 'group') && $owner->isMember())){
	
	$url = 'blog/add/' . $owner->guid;

	echo '<div class="au_widgets_add_content">';
	echo elgg_view('output/url', array(
		'href' => $url,
		'text' => elgg_echo('blog:add'),
		'is_trusted' => TRUE,
	));
	echo '</div>';
}

// now we can get our content
$options = eligo_get_display_entities_options($widget);
$content = elgg_list_entities($options);


echo $content;

if ($content) {
  $blog_url = "blog/owner/" . elgg_get_page_owner_entity()->username;
  if (elgg_instanceof(elgg_get_page_owner_entity(), 'group')) {
    $blog_url = "blog/group/" . elgg_get_page_owner_entity()->guid . "/all";
  }
	
	$more_link = elgg_view('output/url', array(
		'href' => $blog_url,
		'text' => elgg_echo('blog:moreblogs'),
		'is_trusted' => true,
	));
	echo "<span class=\"elgg-widget-more\">$more_link</span>";
} else {
	echo elgg_echo('blog:noblogs');
}
