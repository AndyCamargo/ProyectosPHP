<?php
/*********************************************************************
    index.php

    Helpdesk landing page. Please customize it to fit your needs.

    Peter Rotich <peter@osticket.com>
    Copyright (c)  2006-2013 osTicket
    http://www.osticket.com

    Released under the GNU General Public License WITHOUT ANY WARRANTY.
    See LICENSE.TXT for details.

    vim: expandtab sw=4 ts=4 sts=4:
**********************************************************************/
require('client.inc.php');
$section = 'home';
require(CLIENTINC_DIR.'header.inc.php');
?>
<div id="landing_page">
    <?php
    if($cfg && ($page = $cfg->getLandingPage()))
        echo $page->getBodyWithImages();
    else
        echo  '<h1>Welcome to the Support Center</h1>';
    ?>
    <div id="new_ticket">
        <h3>Abrir nuevo Ticket</h3>
        <br>
        <div>Por favor,proporcione tantos detalles como sea posible,asi podemos ayudarle mejor.Para ver estado del ticket,por favor inicie sesion.</div>
        <p>
            <a href="open.php" class="green button">Abrir nuevo Ticket</a>
        </p>
    </div>

    <div id="check_status">
        <h3>Compruebe Estado del Ticket </h3>
        <br>
        <div>Recuerda que el historial queda almacenado en nuestra BD para revisar tu solicitud da click aqui</div>
        <p>
            <a href="view.php" class="blue button">Compruebe Estado Ticket</a>
        </p>
    </div>
</div>
<div class="clear"></div>
<?php
if($cfg && $cfg->isKnowledgebaseEnabled()){
    //FIXME: provide ability to feature or select random FAQs ??
?>
<p>Be sure to browse our <a href="kb/index.php">Frequently Asked Questions (FAQs)</a>, before opening a ticket.</p>
</div>
<?php
} ?>
<?php require(CLIENTINC_DIR.'footer.inc.php'); ?>
