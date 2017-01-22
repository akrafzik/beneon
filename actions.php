<?php 
	include('functions.php'); 
	$exec = filter_input( INPUT_POST, "exec" );
	if ( $exec == "" ) {
		die(var_dump("Foo"));
	}
?>