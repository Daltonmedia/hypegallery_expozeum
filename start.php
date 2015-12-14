<?php
/**
 * Plugin for managing and displaying featured content
 */

elgg_register_event_handler('init', 'system', 'expozeum_content_init');

/**
 * Initialize the plugin.
 */
function expozeum_content_init() {
	elgg_register_plugin_hook_handler('register', 'menu:entity', array('\ExpozeumContent\EntityMenu', 'setUp'));
	elgg_register_plugin_hook_handler('register', 'menu:user_hover', array('\ExpozeumContent\UserHoverMenu', 'setUp'));
    
	elgg_register_page_handler('expozeum', 'expozeum_page_handler');
    
	elgg_extend_view('elgg.css', 'expozeum_content/style.css');


	elgg_register_action('expozeum_content/expozeum', __DIR__ . '/actions/expozeum_content/expozeum.php');
	elgg_register_action('expozeum_content/unexpozeum', __DIR__ . '/actions/expozeum_content/unexpozeum.php');

	elgg_register_action('expozeum_content/make_curator', __DIR__ . '/actions/expozeum_content/make_curator.php');
	elgg_register_action('expozeum_content/unmake_curator', __DIR__ . '/actions/expozeum_content/unmake_curator.php');
    
    // Register usersettingshook (to remove unwanted museum items)
    elgg_register_plugin_hook_handler('usersetting', 'plugin', 'expozeum_usersettings_hook');
    
    // Register cron hook
	//elgg_register_plugin_hook_handler('cron', 'daily', 'expozeum_cron');

    
    // Site navigation
    $item = new ElggMenuItem('expozeum', elgg_echo('expozeum:title'), 'expozeum/');
    elgg_register_menu_item('site', $item); 
}

function expozeum_page_handler($handler){
	
	$base_dir = elgg_get_plugins_path() . 'expozeum/pages/expozeum';
    require_once("$base_dir/expozeum.php");
	return true;
}

function expozeum_usersettings_hook($hook_name, $entity_type, $return_value, $parameters) {
	if (($parameters['plugin_id']=='expozeum')&&($parameters['value']==1)) {
        if (get_input('illegals_exposed')) {
            //doen wat moet
            $owner = get_input('user_guid');
            $options = array(
                'type' => 'object',
                'subtype' => 'hjalbumimage',
                'owner_guid' => $owner,
                'metadata_name_value_pairs' => array(
                    'name' => 'expozeum',
                    'value' => true,
                   ),
                'limit' => 0,
            );
            $illegals = elgg_get_entities_from_metadata($options);
            foreach ($illegals as $illegal) {
               unset($illegal->expozeum);
            }
            
        }
    }

}
//TODO get ONLY the entities where the metadatstring 'expozeum's time_created < $time
function expozeum_cron($hook, $entity_type, $returnvalue, $params) {
	echo elgg_echo('expozeum:clean:done');
    $time = time() - (7 * 24 * 60 * 60);
    $db_prefix = elgg_get_config('dbprefix');
    echo $time;
    $options = array(
        'type' => 'object',
        'subtype' => 'hjalbumimage',
        'metadata_name_value_pairs' => array(
            'name' => 'expozeum',
            'value' => true,
           ),

        'limit' => 0,
        'wheres' => array('e.access_id != ' . ACCESS_PUBLIC),
        );
    $illegals = elgg_get_entities_from_metadata($options);
    foreach ($illegals as $illegal) {
        unset($illegal->expozeum);
    }
}

