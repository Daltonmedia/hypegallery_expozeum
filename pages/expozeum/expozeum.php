<?php



$options = array(
    'type' => 'object',
	'subtype' => 'hjalbumimage',
	'metadata_name_value_pairs' => array(
		'name' => 'expozeum',
		'value' => true,
	   ),
    'wheres' => array('e.access_id = ' . ACCESS_PUBLIC),
    'full_view' => false,
    'limit' => '30',
    'pagination' =>false,
    'list_type' => 'gallery',
    'gallery_class' => 'gallery-photostream',
    'item_class' => 'expozeum-item',
    'no_results' => elgg_echo('expozeum:no_results'),
);




$content = '<p>'.elgg_echo('expozeum:intro').'</p>';
$content .= elgg_list_entities_from_metadata($options);


$title = elgg_echo('expozeum:title');

$options = array(
	'content' => $content,
	'title' => $title,
);

	

$body = elgg_view_layout('one_column', $options);

echo elgg_view_page($title, $body);





