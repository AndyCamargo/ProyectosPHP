<?php
if(!defined('OSTCLIENTINC')) die('Access Denied!');
$info=array();
if($thisclient && $thisclient->isValid()) {
    $info=array('name'=>$thisclient->getName(),
                'email'=>$thisclient->getEmail(),
                'phone'=>$thisclient->getPhoneNumber());
}

$info=($_POST && $errors)?Format::htmlchars($_POST):$info;
?>
<h1>Abrir nuevo Ticket</h1>
<p>Por favor llene el siguiente formulario para abrir un nuevo ticket.</p>
<form id="ticketForm" method="post" action="open.php" enctype="multipart/form-data">
  <?php csrf_token(); ?>
  <input type="hidden" name="a" value="open">
  <table width="800" cellpadding="1" cellspacing="0" border="0">
    <tbody>
    <tr>
        <td class="required">Tema De Ayuda:</td>
        <td>
            <select id="topicId" name="topicId" onchange="javascript:
                    $('#dynamic-form').load(
                        'ajax.php/form/help-topic/' + this.value);
                    ">
                <option value="" selected="selected">&mdash; Selecione Tema De Ayuda &mdash;</option>
                <?php
                if($topics=Topic::getPublicHelpTopics()) {
                    foreach($topics as $id =>$name) {
                        echo sprintf('<option value="%d" %s>%s</option>',
                                $id, ($info['topicId']==$id)?'selected="selected"':'', $name);
                    }
                } else { ?>
                    <option value="0" >General Inquiry</option>
                <?php
                } ?>
            </select>
            <font class="error">*&nbsp;<?php echo $errors['topicId']; ?></font>
        </td>
    </tr>
<?php
        if (!$thisclient) {
            $uform = UserForm::getUserForm()->getForm($_POST);
            if ($_POST) $uform->isValid();
            $uform->render(false, 'Tu Informacion');
        }
        else { ?>
            <tr><td colspan="2"><hr /></td></tr>
        <tr><td>Email:</td><td><?php echo $thisclient->getEmail(); ?></td></tr>
        <tr><td>Client:</td><td><?php echo $thisclient->getName(); ?></td></tr>
        <?php } ?>
    </tbody>
    <tbody id="dynamic-form">
        <?php if ($form) {
            include(CLIENTINC_DIR . 'templates/dynamic-form.tmpl.php');
        } ?>
    </tbody>
    <tbody><?php
        $tform = TicketForm::getInstance()->getForm($_POST);
        if ($_POST) $tform->isValid();
        $tform->render(false); ?>
    </tbody>
    <tbody>
    <?php
    if($cfg && $cfg->isCaptchaEnabled() && (!$thisclient || !$thisclient->isValid())) {
        if($_POST && $errors && !$errors['captcha'])
            $errors['captcha']='Please re-enter the text again';
        ?>
    <tr class="captchaRow">
        <td class="required">CAPTCHA Text:</td>
        <td>
            <span class="captcha"><img src="captcha.php" border="0" align="left"></span>
            &nbsp;&nbsp;
            <input id="captcha" type="text" name="captcha" size="6" autocomplete="off">
            <em>Introduzca el texto mostrado en la imagen</em>
            <font class="error">*&nbsp;<?php echo $errors['captcha']; ?></font>
        </td>
    </tr>
    <?php
    } ?>
    <tr><td colspan=2>&nbsp;</td></tr>
    </tbody>
  </table>
<hr/>
  <p style="text-align:center;">
        <input type="submit" value="Crear Ticket">
        <input type="reset" value="Reiniciar">
        <input type="button" value="Cancelar" onClick='window.location.href="index.php"'>
  </p>
</form>
