<?php

function myhash($secret) {
    return hash('sha256', $secret . SECRET);
}

function set_page_title($page) {
	return ucfirst(basename($page, '.php'));
}

function redirect_user_to($location) {
    header('Location: ' . $location);
    if (isset($_SESSION['returnUrl']))
    	unset($_SESSION['returnUrl']);
    exit();
}

?>