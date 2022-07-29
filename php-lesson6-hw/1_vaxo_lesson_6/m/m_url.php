<?php

function get_data ($method, $var_name) {
	switch($method) {
		case 'get':
			return isset($_GET[$var_name]) ? htmlspecialchars(trim($_GET[$var_name])) : null;
			break;
		case 'post';
			return isset($_POST[$var_name]) ? htmlspecialchars(trim($_POST[$var_name])) : null;
	}
}

?>