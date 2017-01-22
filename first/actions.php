<?php include('functions.php');
                $exec = filter_input( INPUT_POST, "exec" );
                if ( $exec == "gerencia___usuarios" ) {

                    //die(json_encode(array("status" => bool, "msg" => "mensagem em texto para o usuário", "devMsg" => "Mensagem para o desenvolvedor" )))

                    $id = filter_input(INPUT_POST, "usuario_id");
                    if($id == ""){
                        die(json_encode(insert___usuarios( $_POST )));
                    }
                    else{
                        die(json_encode(update___usuarios( $_POST, filter_input(INPUT_POST, "usuario_id") )));
                    }
                }
                
                else if ( $exec == "paginationBottom___usuarios" ) {
                    $pg = str_replace( "goTo-", "", filter_input( INPUT_POST, "pg" ) );
                    $paginas = get___usuariosPaginacao( $pg, $filtro );
                    $paginaHTML;
                    $x = 0;
                    foreach ( $paginas[ 'pagina' ] as $pagina ) {
                        $paginaHTML .= "
                        <tr>
                            <td>".$pagina["nome"]."</td><td>".$pagina["login"]."</td>
                            <td>
                                <a href=\"alterar-usuarios/".$pagina["usuario_id"]."/\">Alterar</a> || <a href=\"javascript:void(0);\" onclick=\"removerRegistro('".$pagina["usuario_id"]."')\" >Excluir</a><br>
                            </td>
                        </tr>";
                        $x++;
                        /* if ( $x == 3 ) {
                        $x = 0;
                        $paginaHTML .= '<div class="clearfix"></div>';
                        } */
                    }
                    die( json_encode( array( "pagina" => $paginaHTML, "paginacao" => $paginas[ 'paginacao' ] ) ) );
                }
                else if ( $exec == "removerRegistro" ) {
                    $table = filter_input(INPUT_POST, "table");
                    $pk = filter_input(INPUT_POST, "pk");
                    $pkValue = filter_input(INPUT_POST, "pkValue");

                    die(json_encode(removerRegistro($table, $pk, $pkValue)));
                }
                if ( $exec == 'doLogin' ) {
                    if ( !filter_input( INPUT_POST, "email", FILTER_VALIDATE_EMAIL ) ) {
                        die( json_encode( array( 'status' => false, 'message' => 'Informe um e-mail valido...' ) ) );
                    }
                    $email = filter_input( INPUT_POST, "email" );
                    $senha = filter_input( INPUT_POST, "senha" );

                    $login = getLogin( $email, $senha );
                    if ( count( $login ) > 0 ) {
                        $_SESSION[ 'user' ] = $login;
                        die( json_encode( array( 'status' => true, 'message' => 'Acesso permitido, Aguarde o redirecionamento...' ) ) );
                    }
                    else {
                        unset( $_SESSION[ 'user' ] );
                        die( json_encode( array( 'status' => false, 'message' => 'Login Incorreto.' ) ) );
                    }
                }
                if ( $exec == "gerencia___logs" ) {

                    //die(json_encode(array("status" => bool, "msg" => "mensagem em texto para o usuário", "devMsg" => "Mensagem para o desenvolvedor" )))

                    $id = filter_input(INPUT_POST, "log_id");
                    if($id == ""){
                        die(json_encode(insert___logs( $_POST )));
                    }
                    else{
                        die(json_encode(update___logs( $_POST, filter_input(INPUT_POST, "log_id") )));
                    }
                }
                
                else if ( $exec == "paginationBottom___logs" ) {
                    $pg = str_replace( "goTo-", "", filter_input( INPUT_POST, "pg" ) );
                    $paginas = get___logsPaginacao( $pg, $filtro );
                    $paginaHTML;
                    $x = 0;
                    foreach ( $paginas[ 'pagina' ] as $pagina ) {
                        $paginaHTML .= "
                        <tr>
                            <td>".$pagina["nome"]."</td><td>".$pagina["acao"]."</td><td>".$pagina["mensagem"]."</td>
                            <td>
                                <a href=\"alterar-/".$pagina["log_id"]."/\">Alterar</a> || <a href=\"javascript:void(0);\" onclick=\"removerRegistro('".$pagina["log_id"]."')\" >Excluir</a><br>
                            </td>
                        </tr>";
                        $x++;
                        /* if ( $x == 3 ) {
                        $x = 0;
                        $paginaHTML .= '<div class="clearfix"></div>';
                        } */
                    }
                    die( json_encode( array( "pagina" => $paginaHTML, "paginacao" => $paginas[ 'paginacao' ] ) ) );
                }
                else if ( $exec == "removerRegistro" ) {
                    $table = filter_input(INPUT_POST, "table");
                    $pk = filter_input(INPUT_POST, "pk");
                    $pkValue = filter_input(INPUT_POST, "pkValue");

                    die(json_encode(removerRegistro($table, $pk, $pkValue)));
                }
                if ( $exec == 'doLogin' ) {
                    if ( !filter_input( INPUT_POST, "email", FILTER_VALIDATE_EMAIL ) ) {
                        die( json_encode( array( 'status' => false, 'message' => 'Informe um e-mail valido...' ) ) );
                    }
                    $email = filter_input( INPUT_POST, "email" );
                    $senha = filter_input( INPUT_POST, "senha" );

                    $login = getLogin( $email, $senha );
                    if ( count( $login ) > 0 ) {
                        $_SESSION[ 'user' ] = $login;
                        die( json_encode( array( 'status' => true, 'message' => 'Acesso permitido, Aguarde o redirecionamento...' ) ) );
                    }
                    else {
                        unset( $_SESSION[ 'user' ] );
                        die( json_encode( array( 'status' => false, 'message' => 'Login Incorreto.' ) ) );
                    }
                }
                if ( $exec == "gerenciatblPost" ) {

                    //die(json_encode(array("status" => bool, "msg" => "mensagem em texto para o usuário", "devMsg" => "Mensagem para o desenvolvedor" )))

                    $id = filter_input(INPUT_POST, "postID");
                    if($id == ""){
                        die(json_encode(inserttblPost( $_POST )));
                    }
                    else{
                        die(json_encode(updatetblPost( $_POST, filter_input(INPUT_POST, "postID") )));
                    }
                }
                else if ( $exec == "uploadtblPost" ) {
                                if(isset($_FILES["postImagem"]["name"])){
                        $types = array(
                            "png" => "image/png",
                            "jpg" => "image/jpeg"
                        );
                        if ( !in_array( mime_content_type( $_FILES["postImagem"][ "tmp_name" ] ), $types ) ) {
                            die( json_encode( array( "status" => false, "msg" => "Tipos de arquivo permitidos: 'Jpg | Png'" ) ) );
                        }
			$data = date("dmYHis");

                        $oldmask = umask(0);
                        mkdir($img."tblPost", 0777, true);
                        umask($oldmask);
			move_uploaded_file($_FILES["postImagem"]["tmp_name"], $img."tblPost/".$data.".jpg");
			die(json_encode(updateImg("postImagem", $data.".jpg", "tblPost/", "postID",  "tblPost", filter_input(INPUT_POST, "ID"))));
                            //$field, $name, $fieldPK, $table, $id = 0
                        //die(json_encode(array("status" => true, "img" => $img."tblPost/".$data.".jpg")));
		}
                                die(json_encode(array("status" => true, "msg" => "No Upload", "devMsg" => "")));
                            }
                else if ( $exec == "paginationBottomtblPost" ) {
                    $pg = str_replace( "goTo-", "", filter_input( INPUT_POST, "pg" ) );
                    $paginas = gettblPostPaginacao( $pg, $filtro );
                    $paginaHTML;
                    $x = 0;
                    foreach ( $paginas[ 'pagina' ] as $pagina ) {
                        $paginaHTML .= "
                        <tr>
                            <td>".$pagina["postTitulo"]."</td><td>".$pagina["postResumo"]."</td><td><img src=\"".$pagina["foto"]."\" style=\"width:100px;\"></td>
                            <td>
                                <a href=\"alterar-posts/".$pagina["postID"]."/\">Alterar</a> || <a href=\"javascript:void(0);\" onclick=\"removerRegistro('".$pagina["postID"]."')\" >Excluir</a><br>
                            </td>
                        </tr>";
                        $x++;
                        /* if ( $x == 3 ) {
                        $x = 0;
                        $paginaHTML .= '<div class="clearfix"></div>';
                        } */
                    }
                    die( json_encode( array( "pagina" => $paginaHTML, "paginacao" => $paginas[ 'paginacao' ] ) ) );
                }
                else if ( $exec == "removerRegistro" ) {
                    $table = filter_input(INPUT_POST, "table");
                    $pk = filter_input(INPUT_POST, "pk");
                    $pkValue = filter_input(INPUT_POST, "pkValue");

                    die(json_encode(removerRegistro($table, $pk, $pkValue)));
                }
                if ( $exec == 'doLogin' ) {
                    if ( !filter_input( INPUT_POST, "email", FILTER_VALIDATE_EMAIL ) ) {
                        die( json_encode( array( 'status' => false, 'message' => 'Informe um e-mail valido...' ) ) );
                    }
                    $email = filter_input( INPUT_POST, "email" );
                    $senha = filter_input( INPUT_POST, "senha" );

                    $login = getLogin( $email, $senha );
                    if ( count( $login ) > 0 ) {
                        $_SESSION[ 'user' ] = $login;
                        die( json_encode( array( 'status' => true, 'message' => 'Acesso permitido, Aguarde o redirecionamento...' ) ) );
                    }
                    else {
                        unset( $_SESSION[ 'user' ] );
                        die( json_encode( array( 'status' => false, 'message' => 'Login Incorreto.' ) ) );
                    }
                }
                if ( $exec == "gerenciatblLeed" ) {

                    //die(json_encode(array("status" => bool, "msg" => "mensagem em texto para o usuário", "devMsg" => "Mensagem para o desenvolvedor" )))

                    $id = filter_input(INPUT_POST, "leedID");
                    if($id == ""){
                        die(json_encode(inserttblLeed( $_POST )));
                    }
                    else{
                        die(json_encode(updatetblLeed( $_POST, filter_input(INPUT_POST, "leedID") )));
                    }
                }
                
                else if ( $exec == "paginationBottomtblLeed" ) {
                    $pg = str_replace( "goTo-", "", filter_input( INPUT_POST, "pg" ) );
                    $paginas = gettblLeedPaginacao( $pg, $filtro );
                    $paginaHTML;
                    $x = 0;
                    foreach ( $paginas[ 'pagina' ] as $pagina ) {
                        $paginaHTML .= "
                        <tr>
                            <td>".$pagina["leedNome"]."</td><td>".$pagina["leedEmail"]."</td><td>".$pagina["leedIP"]."</td><td>".$pagina["leedData"]."</td>
                            <td>
                                <a href=\"alterar-leed/".$pagina["leedID"]."/\">Alterar</a> || <a href=\"javascript:void(0);\" onclick=\"removerRegistro('".$pagina["leedID"]."')\" >Excluir</a><br>
                            </td>
                        </tr>";
                        $x++;
                        /* if ( $x == 3 ) {
                        $x = 0;
                        $paginaHTML .= '<div class="clearfix"></div>';
                        } */
                    }
                    die( json_encode( array( "pagina" => $paginaHTML, "paginacao" => $paginas[ 'paginacao' ] ) ) );
                }
                else if ( $exec == "removerRegistro" ) {
                    $table = filter_input(INPUT_POST, "table");
                    $pk = filter_input(INPUT_POST, "pk");
                    $pkValue = filter_input(INPUT_POST, "pkValue");

                    die(json_encode(removerRegistro($table, $pk, $pkValue)));
                }
                if ( $exec == 'doLogin' ) {
                    if ( !filter_input( INPUT_POST, "email", FILTER_VALIDATE_EMAIL ) ) {
                        die( json_encode( array( 'status' => false, 'message' => 'Informe um e-mail valido...' ) ) );
                    }
                    $email = filter_input( INPUT_POST, "email" );
                    $senha = filter_input( INPUT_POST, "senha" );

                    $login = getLogin( $email, $senha );
                    if ( count( $login ) > 0 ) {
                        $_SESSION[ 'user' ] = $login;
                        die( json_encode( array( 'status' => true, 'message' => 'Acesso permitido, Aguarde o redirecionamento...' ) ) );
                    }
                    else {
                        unset( $_SESSION[ 'user' ] );
                        die( json_encode( array( 'status' => false, 'message' => 'Login Incorreto.' ) ) );
                    }
                }
                if ( $exec == "gerenciatblBannerHome" ) {

                    //die(json_encode(array("status" => bool, "msg" => "mensagem em texto para o usuário", "devMsg" => "Mensagem para o desenvolvedor" )))

                    $id = filter_input(INPUT_POST, "bannerID");
                    if($id == ""){
                        die(json_encode(inserttblBannerHome( $_POST )));
                    }
                    else{
                        die(json_encode(updatetblBannerHome( $_POST, filter_input(INPUT_POST, "bannerID") )));
                    }
                }
                else if ( $exec == "uploadtblBannerHome" ) {
                                if(isset($_FILES["bannerImagem"]["name"])){
                        $types = array(
                            "png" => "image/png",
                            "jpg" => "image/jpeg"
                        );
                        if ( !in_array( mime_content_type( $_FILES["bannerImagem"][ "tmp_name" ] ), $types ) ) {
                            die( json_encode( array( "status" => false, "msg" => "Tipos de arquivo permitidos: 'Jpg | Png'" ) ) );
                        }
			$data = date("dmYHis");

                        $oldmask = umask(0);
                        mkdir($img."tblBannerHome", 0777, true);
                        umask($oldmask);
			move_uploaded_file($_FILES["bannerImagem"]["tmp_name"], $img."tblBannerHome/".$data.".jpg");
			die(json_encode(updateImg("bannerImagem", $data.".jpg", "tblBannerHome/", "bannerID",  "tblBannerHome", filter_input(INPUT_POST, "ID"))));
                            //$field, $name, $fieldPK, $table, $id = 0
                        //die(json_encode(array("status" => true, "img" => $img."tblBannerHome/".$data.".jpg")));
		}
                                die(json_encode(array("status" => true, "msg" => "No Upload", "devMsg" => "")));
                            }
                else if ( $exec == "paginationBottomtblBannerHome" ) {
                    $pg = str_replace( "goTo-", "", filter_input( INPUT_POST, "pg" ) );
                    $paginas = gettblBannerHomePaginacao( $pg, $filtro );
                    $paginaHTML;
                    $x = 0;
                    foreach ( $paginas[ 'pagina' ] as $pagina ) {
                        $paginaHTML .= "
                        <tr>
                            <td>".$pagina["bannerTitulo"]."</td><td>".$pagina["bannerLink"]."</td><td><img src=\"".$pagina["foto"]."\" style=\"width:100px;\"></td>
                            <td>
                                <a href=\"alterar-banner/".$pagina["bannerID"]."/\">Alterar</a> || <a href=\"javascript:void(0);\" onclick=\"removerRegistro('".$pagina["bannerID"]."')\" >Excluir</a><br>
                            </td>
                        </tr>";
                        $x++;
                        /* if ( $x == 3 ) {
                        $x = 0;
                        $paginaHTML .= '<div class="clearfix"></div>';
                        } */
                    }
                    die( json_encode( array( "pagina" => $paginaHTML, "paginacao" => $paginas[ 'paginacao' ] ) ) );
                }
                else if ( $exec == "removerRegistro" ) {
                    $table = filter_input(INPUT_POST, "table");
                    $pk = filter_input(INPUT_POST, "pk");
                    $pkValue = filter_input(INPUT_POST, "pkValue");

                    die(json_encode(removerRegistro($table, $pk, $pkValue)));
                }
                if ( $exec == 'doLogin' ) {
                    if ( !filter_input( INPUT_POST, "email", FILTER_VALIDATE_EMAIL ) ) {
                        die( json_encode( array( 'status' => false, 'message' => 'Informe um e-mail valido...' ) ) );
                    }
                    $email = filter_input( INPUT_POST, "email" );
                    $senha = filter_input( INPUT_POST, "senha" );

                    $login = getLogin( $email, $senha );
                    if ( count( $login ) > 0 ) {
                        $_SESSION[ 'user' ] = $login;
                        die( json_encode( array( 'status' => true, 'message' => 'Acesso permitido, Aguarde o redirecionamento...' ) ) );
                    }
                    else {
                        unset( $_SESSION[ 'user' ] );
                        die( json_encode( array( 'status' => false, 'message' => 'Login Incorreto.' ) ) );
                    }
                } ?>