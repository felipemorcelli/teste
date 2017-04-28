<?php
session_start();
$_SESSION['uid']='1';
$id = $_SESSION['uid'];
define("SITE_KEY", "RestAPI_Slim");

function validateParams($validate) {

    $params = array('title', 'publisher', 'price', 'apiKey', 'user_id');

    foreach ($validate as $key => $field) {

        if (!in_array($key, $params))
            return false;
    }

    return true;

}

function apiKey($id)
{
    $key = md5(SITE_KEY . $id);
    // echo hash('sha256', $key . $_SERVER['REMOTE_ADDR']); 
    return hash('sha256', $key . $_SERVER['REMOTE_ADDR']);
}

$apiKey = apiKey($id);
