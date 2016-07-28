<?php

	// include('session.php');
	function is_session_started()
{
    if ( php_sapi_name() !== 'cli' ) {
        if ( version_compare(phpversion(), '5.4.0', '>=') ) {
            return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
        } else {
            return session_id() === '' ? FALSE : TRUE;
        }
    } 
    return FALSE;
}

      if ( is_session_started() === FALSE ) {
         header('Location: http://localhost/pms/welcome.php');
}     if ( is_session_started() === TRUE ) {
         header('Location: http://localhost/pms/index.php');
}
	
?>
