<?php

$entity = elgg_extract('entity', $vars);
$user = elgg_get_page_owner_entity();

$options = array(
    'type' => 'object',
	'subtype' => 'hjalbumimage',
    'owner_guid' =>$user->guid,
	'metadata_name_value_pairs' => array(
		'name' => 'expozeum',
		'value' => true,
	   ),
    'limit' => 0,
    'count' =>true,
);
$warned = elgg_get_entities_from_metadata($options);
	echo '<div><p>';
    echo elgg_echo('expozeum:usersettings:intro');
    if ($warned) {
        echo elgg_view('input/hidden', array(
	'name' => 'illegals_exposed',
    'value' => 1,
));
        echo '<b>'.elgg_echo('expozeum:usersettings:warning').'</b>';
    }
	echo '</p><label>' . elgg_echo('expozeum:usersettings:exposable') . '</label>';
	echo elgg_view('input/dropdown', array(
		'name' => 'params[not_exposable]',
		'value' => elgg_get_plugin_user_setting('not_exposable', $user->guid, 'expozeum'),
		'options_values' => array(
			0 => elgg_echo('option:yes'),
			1 => elgg_echo('option:no'),
		)
	));
	echo '</div>';
