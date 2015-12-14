<?php
/**
 * List featured content as a sidebar module
 */


$content = elgg_echo('expozeum:intro');
if (elgg_is_logged_in()){
$content .= '</br><p>'.elgg_echo('expozeum:intro:you').'</p>';
$content .= elgg_list_entities_from_metadata(array(
	'type' => 'object',
    'subtype' => 'hjalbumimage',
    'owner_guid' => elgg_get_logged_in_user_guid(),
	'metadata_name_value_pairs' => array(
		'name' => 'expozeum',
		'value' => 'onhold',
	),
	// Order by the time when the content was featured
	'order_by' => 'n_table.time_created DESC',
	'limit' => 5,
));
}
echo elgg_view_module('aside', elgg_echo('expozeum:title'), $content);