<?php

namespace ExpozeumContent;

use ElggMenuItem, ElggUser;

class UserHoverMenu {
	/**
	 * Set up items for user_hover menu
	 */
	 public function setUp ($hook, $type, $menu, $params) {
	 	if (!elgg_is_logged_in()) {
	 		return $menu;
	 	}

	 	$current_user = elgg_get_logged_in_user_entity();

		// Allow only admins and publishers to grant/remove publisher roles
		if (!$current_user->isAdmin() && $current_user->role !== 'curator') {
	 		return $menu;
		}

		$user = $params['entity'];

		// User cannot make/unmake himseld a publisher
		if ($user->guid === $current_user->guid) {
			return $menu;
		}

		if (!$user instanceof ElggUser) {
			return $menu;
		}

		if ($user->role === 'curator') {
			$action = 'unmake_curator';
			$text = elgg_echo('expozeum_content:unmake_curator');
		} else {
			$action = 'make_curator';
			$text = elgg_echo('expozeum_content:make_curator');
		}

		$menu[] = ElggMenuItem::factory(array(
			'name' => 'curator',
			'text' => $text,
			'href' => "action/expozeum_content/$action?guid={$user->guid}",
			'is_action' => true,
		));

		return $menu;
	 }
}
