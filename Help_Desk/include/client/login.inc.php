<?php
if(!defined('OSTCLIENTINC')) die('Access Denied');

$email=Format::input($_POST['lemail']?$_POST['lemail']:$_GET['e']);
$ticketid=Format::input($_POST['lticket']?$_POST['lticket']:$_GET['t']);
?>
<h1>Comprobar estado del ticket</h1>
<p>
Sírvase proporcionarnos su dirección de correo electrónico y un número de ticket, y se le enviará por correo electrónico un enlace de acceso.</p>
<form action="login.php" method="post" id="clientLogin">
    <?php csrf_token(); ?>
    <strong><?php echo Format::htmlchars($errors['login']); ?></strong>
    <br>
    <div>
        <label for="email">E-Mail:</label>
        <input id="email" type="text" name="lemail" size="30" value="<?php echo $email; ?>">
    </div>
    <div>
        <label for="ticketno">Numero De Ticket:</label>
        <input id="ticketno" type="text" name="lticket" size="16" value="<?php echo $ticketid; ?>"></td>
    </div>
    <p>
        <input class="btn" type="submit" value="Email Accesso Link">
    </p>
</form>
<br>
<p>
Si es la primera vez que nos contacta o si ha perdido el número del ticket, por favor <a href="open.php"> Abre un nuevo ticket</a>.
</p>
