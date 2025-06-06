<?php


#Disable direct access.
if(!strcasecmp(basename($_SERVER['SCRIPT_NAME']),basename(__FILE__)) || !defined('INCLUDE_DIR'))
    die('kwaheri rafiki!');

#Install flag
define('OSTINSTALLED',TRUE);
if(OSTINSTALLED!=TRUE){
    if(!file_exists(ROOT_DIR.'setup/install.php')) die('Error: Contact system admin.'); //Something is really wrong!
    //Invoke the installer.
    header('Location: '.ROOT_PATH.'setup/install.php');
    exit;
}

# Encrypt/Decrypt secret key - randomly generated during installation.
define('SECRET_SALT','v8QY9MoJb2kK5PtLi9pjmvLf5SJf=mA1');

#Default admin email. Used only on db connection issues and related alerts.
define('ADMIN_EMAIL','webmaster@emcorpinternational.com');

# Database Options
# ---------------------------------------------------
# Mysql Login info
define('DBTYPE','mysql');
define('DBHOST','localhost');
define('DBNAME','clientes_emcorp');
define('DBUSER','root');
define('DBPASS','1234');

# Table prefix
define('TABLE_PREFIX','cli_');

#
# SSL Options
# ---------------------------------------------------
# SSL options for MySQL can be enabled by adding a certificate allowed by
# the database server here. To use SSL, you must have a client certificate
# signed by a CA (certificate authority). You can easily create this
# yourself with the EasyRSA suite. Give the public CA certificate, and both
# the public and private parts of your client certificate below.
#
# Once configured, you can ask MySQL to require the certificate for
# connections:
#
# > create user osticket;
# > grant all on osticket.* to osticket require subject '<subject>';
#
# More information (to-be) available in doc/security/hardening.md

# define('DBSSLCA','/path/to/ca.crt');
# define('DBSSLCERT','/path/to/client.crt');
# define('DBSSLKEY','/path/to/client.key');

#
# Mail Options
# ---------------------------------------------------
# Option: MAIL_EOL (default: \n)
#
# Some mail setups do not handle emails with \r\n (CRLF) line endings for
# headers and base64 and quoted-response encoded bodies. This is an error
# and a violation of the internet mail RFCs. However, because this is also
# outside the control of both osTicket development and many server
# administrators, this option can be adjusted for your setup. Many folks who
# experience blank or garbled email from osTicket can adjust this setting to
# use "\n" (LF) instead of the CRLF default.
#
# References:
# http://www.faqs.org/rfcs/rfc2822.html
# https://github.com/osTicket/osTicket-1.8/issues/202
# https://github.com/osTicket/osTicket-1.8/issues/700
# https://github.com/osTicket/osTicket-1.8/issues/759
# https://github.com/osTicket/osTicket-1.8/issues/1217

# define(MAIL_EOL, "\r\n");

#
# HTTP Server Options
# ---------------------------------------------------
# Option: ROOT_PATH (default: <auto detect>, fallback: /)
#
# If you have a strange HTTP server configuration and osTicket cannot
# discover the URL path of where your osTicket is installed, define
# ROOT_PATH here.
#
# The ROOT_PATH is the part of the URL used to access your osTicket
# helpdesk before the '/scp' part and after the hostname. For instance, for
# http://mycompany.com/support', the ROOT_PATH should be '/support/'
#
# ROOT_PATH *must* end with a forward-slash!

# define('ROOT_PATH', '/support/');
?>
