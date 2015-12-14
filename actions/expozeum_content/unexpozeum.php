<?php

$user = elgg_get_logged_in_user_entity();

if (!$user->isAdmin() && $user->role !== 'curator') {
	register_error(elgg_echo('actionunauthorized'));
}

$guid = get_input('guid');

$entity = get_entity($guid);

unset($entity->expozeum);

system_message(elgg_echo('expozeum_content:unexpozeum:success'));
