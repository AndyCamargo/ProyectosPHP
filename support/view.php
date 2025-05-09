<?php
/*********************************************************************
    view.php

  
**********************************************************************/
require_once('client.inc.php');

// Try autologin the user
// Authenticated user can be of type ticket owner or collaborator
$errors = array();
if (isset($_GET['auth']) || isset($_GET['t']))
    $user =  UserAuthenticationBackend::processSignOn($errors);

if ($user && $user->getTicketId())
    Http::redirect('tickets.php?id='.$user->getTicketId());

//Simply redirecting to tickets.php until multiview is implemented.
require('tickets.php');
?>
