<?php

namespace ExpozeumContent;

use ElggMenuItem, ElggObject;

class EntityMenu {
	/**
	 *
	 */
	 public function setUp ($hook, $type, $menu, $params) {
	 	if (!elgg_is_logged_in()) {
	 		return $menu;
	 	}

	 	$user = elgg_get_logged_in_user_entity();

		if (!$user->isAdmin() && $user->role !== 'curator') {
	 		return $menu;
		}

		$entity = $params['entity'];
        if (elgg_get_plugin_user_setting('not_exposable', $entity->owner_guid, 'expozeum') == false) {
    
		// We don't want to feature users, sites nor groups
		if (!elgg_instanceof($entity, 'object', 'hjalbumimage')) {
            
			return $menu;
		}

		if ($entity->expozeum) {
			$action = 'unexpozeum';
			$icon = 'eye-alt';
            //$text = 'unexpozeum';
		} else {
			$action = 'expozeum';
			$icon = 'eye';
            //$text = 'expozeum';
		}

		$menu[] = ElggMenuItem::factory(array(
			'name' => 'expozeum',
			'text' => elgg_view_icon($icon),
			//'text' => elgg_echo($text),
			'href' => "action/expozeum_content/$action?guid={$entity->guid}",
			'is_action' => true,
		));

		return $menu;
	 }
        return $menu;
     }
}
