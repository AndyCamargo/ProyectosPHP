<?php
/*********************************************************************
    ajax.php

  
**********************************************************************/

function clientLoginPage($msg='Unauthorized') {
    Http::response(403,'Must login: '.Format::htmlchars($msg));
    exit;
}

require('client.inc.php');

if(!defined('INCLUDE_DIR'))	Http::response(500, 'Server configuration error');
require_once INCLUDE_DIR.'/class.dispatcher.php';
require_once INCLUDE_DIR.'/class.ajax.php';

$dispatcher = patterns('',
    url('^/config/', patterns('ajax.config.php:ConfigAjaxAPI',
        url_get('^client$', 'client')
    )),
    url('^/draft/', patterns('ajax.draft.php:DraftAjaxAPI',
        url_post('^(?P<id>\d+)$', 'updateDraftClient'),
        url_post('^(?P<id>\d+)/attach$', 'uploadInlineImageClient'),
        url_get('^(?P<namespace>[\w.]+)$', 'getDraftClient'),
        url_post('^(?P<namespace>[\w.]+)$', 'createDraftClient')
    )),
    url('^/form/', patterns('ajax.forms.php:DynamicFormsAjaxAPI',
        url_get('^help-topic/(?P<id>\d+)$', 'getClientFormsForHelpTopic')
    ))
);
Signal::send('ajax.client', $dispatcher);
print $dispatcher->resolve($ost->get_path_info());
?>
