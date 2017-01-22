<?php 
header('Access-Control-Allow-Origin: *');  
	include('first/functions.php'); 
	$exec = filter_input( INPUT_POST, "exec" );
	if ( $exec == "cadastrarLead" ) {
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
	else if ( $exec == "scroll" ) {
        $pg = filter_input( INPUT_POST, 'pg' );
        $registros = getRegistros( $pg );
        $pg += 1;
        $html = '';
        $slideIn = "slideInLeft";
        foreach ( $registros as $registro ) {
            $html .= '<div class="uk-grid-margin uk-first-column">
                            <div class="uk-card uk-card-default wow '.$slideIn.'" data-wow-duration="1s" style="visibility: visible; animation-duration: 1s; animation-name: '.$slideIn.';">
                                <div class="uk-inline-clip">
                                    <div class="uk-inline-clip uk-transition-toggle uk-light uk-transition-toggle">
                                        <img src="img/cover.jpg" alt="">
                                        <div class="uk-position-center">
                                            <div class="uk-transition-slide-top-small">
                                                <h4 class="uk-margin-remove">Planeje</h4></div>
                                            <div class="uk-transition-slide-bottom-small">
                                                <h4 class="uk-margin-remove">Conquiste</h4></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="uk-card-body">
                                    <h3 class="uk-card-title">'.$registro['postTitulo'].'</h3>
                                    <p>
                                    	'.nl2br($registro['postResumo']).'
                                    </p>
                                </div>
                                <div class="uk-card-footer text-right">
                                    <a href="'.$registro['url'].'" class="reading"><span> Continue Lendo</span></a>
                                </div>
                            </div>
                        </div>';
            if($slideIn == "slideInLeft"){
            	$slideIn = "slideInRight";
            }
            else{
				$slideIn = "slideInLeft";
            }
        }
        die( json_encode( array( "results" => $html, "pg" => $pg, "totalItens" => count( $registros ) ) ) );
    }
?>