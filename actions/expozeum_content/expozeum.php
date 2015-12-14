<?php

$user = elgg_get_logged_in_user_entity();

if (!$user->isAdmin() && $user->role !== 'curator') {
	register_error(elgg_echo('actionunauthorized'));
}

$guid = get_input('guid');

$entity = get_entity($guid);
$container = get_entity($entity->container_guid);
if ($container->access_id == ACCESS_PUBLIC) {
    $entity->expozeum = true;
    $owner = get_entity($entity->owner_guid);
    $url = elgg_get_site_url().$container->getURL();
    $subject = elgg_echo('expozeum:notification:subject', array(), $owner->language);
    $summary = elgg_echo('expozeum:notification::summary', array($entity->title), $owner->language);
    $body = elgg_echo('expozeum:notification:body', array($owner->name,$entity->title,$url),$owner->language);
    $params = array(
        'object' => $entity,
        'action' => 'create',
        'summary' => $summary
);

notify_user($owner->guid, $user->guid, $subject, $body, $params);
    system_message(elgg_echo('expozeum_content:expozeum:success'));

} else {
    $entity->expozeum = true;  
    $owner = get_entity($entity->owner_guid);
    $url = elgg_get_site_url().$container->getURL();
    $subject = elgg_echo('expozeum:notification:subject', array(), $owner->language);
    $summary = elgg_echo('expozeum:notification::onhold:summary', array($entity->title), $owner->language);
    $body = elgg_echo('expozeum:notification:onhold:body', array($owner->name,$entity->title,$url),$owner->language);
    $params = array(
        'object' => $entity,
        'action' => 'create',
        'summary' => $summary
);

notify_user($owner->guid, $user->guid, $subject, $body, $params);
    system_message(elgg_echo('expozeum_content:expozeum:onhold'));
}

