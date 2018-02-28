<?php
require_once "controleur/Routeur.php";
require_once "vue/Vue.php";


session_start();
$routeur=new Routeur();
$routeur->routerRequete();
?>
