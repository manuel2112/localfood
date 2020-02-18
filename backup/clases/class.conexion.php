<?php

if( isset($_SERVER['REMOTE_ADDR']) && in_array( $_SERVER['REMOTE_ADDR'], array( '127.0.0.1', '::1' ) ) )
{
define ( 'DB_HOST', 'localhost' );
define ( 'DB_USER', 'root' );
define ( 'DB_PASSWORD', '' );
define ( 'DB_NAME', 'chanlivery' );
}else{
define ( 'DB_HOST', 'localhost' );
define ( 'DB_USER', 'localfoo' );
define ( 'DB_PASSWORD', '01e3RuK9vi' );
define ( 'DB_NAME', 'localfoo_localfood' );
}

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if ($mysqli->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}