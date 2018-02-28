<?php
/*    Using "mysqli" instead of "mysql" that is obsolete.
*
* Change the value of parameter 3 if you have set a password on the root userid
*
*/
$mysqli = new mysqli('127.0.0.1', 'root', '');

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
}
echo 'Connection OK';
$mysqli->close();
?>
