<?php

function get_view($views, $view) {
	if (in_array($view, $views))
	  return 'v/v_'. $view . '.php';
	else
	  return 'v/v_compact.php';
}

?>