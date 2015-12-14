<?php
/**
 * Grant publisher role to a user
 */

$user = elgg_get_logged_in_user_entity();

if (!$user->isAdmin() && $user->role !== 'curator') {
	register_error(elgg_echo('actionunauthorized'));
}

$guid = get_input('guid');

$user = get_user($guid);

$user->role = 'curator';

system_message(elgg_echo('expozeum_content:make_curator:success', array($user->name)));
