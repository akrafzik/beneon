<?php 
	include('first/functions.php'); 
	$exec = filter_input( INPUT_POST, "exec" );
	if ( $exec == "" ) {
		$nomeLead = filter_input( INPUT_POST, "nomeLead" );
		$emailLead = filter_input( INPUT_POST, "emailLead", FILTER_SANITIZE_EMAIL );
		$arrNome = explode(" ", trim($nomeLead));
		

		if ($nomeLead == "") {
		    die(json_encode(array("status" => false, "message" => "Seu nome é obrigatório")));
		}

		if(count($arrNome) <= 1){
			die(json_encode(array("status" => false, "message" => "Precisamos do seu nome e sobrenome!")));	
		}

		if (!filter_var($emailLead, FILTER_VALIDATE_EMAIL) === true) {
		    die(json_encode(array("status" => false, "message" => "E-mail Inválido")));
		}
		
		die(json_encode(inserttblLeed( array("leedNome" => $nomeLead, "leedEmail" => $emailLead) )));

	}
?>