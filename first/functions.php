<?php session_start();
            header( 'Content-Type: text/html; charset=utf-8' );
                    $db = "beneon";

                    $dsn = "mysql:host=localhost;dbname=" . $db;
                    $usuario = "root";
                    $senha = "be#121#neon!!!";
                    $opcoes = array(
                        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
                    );

                    global $pdo, $img;
                    $img = "upload/img/";

                    try {
                        $pdo = new PDO( $dsn, $usuario, $senha, $opcoes );
                    }
                    catch ( PDOException $e ) {
                        Echo "Ocorreu um erro, veja o log para maiores informações";
                        exit;
                    }

                    /*usado na paginação*/
                    function getQuery( $sql ) {
                        global $pdo, $img;

                        $results = array();
                        foreach ( $pdo->query( $sql ) as $row ) {
                            $results[] = $row;
                        }
                        //die(json_encode($sql));
                        return $results;
                    }

                    function getPaginacao( $sql, $pgSolicitada = 1, $qtd = 20 ) {
                            global $pdo, $img;

                            $qtdPaginas = 9;
                            $itensPagina = $qtd;
                            $itensFim = $itensPagina * $pgSolicitada;
                            $itensInicio = $itensFim - $itensPagina;
                            $totalPaginas;
                            $totalItens;
                            //echo $sql;
                            foreach ( $pdo->query( $sql ) as $row ) {
                                $totalItens = $row[ 0 ];
                            }


                            $totalPaginas = intval( $totalItens / $itensPagina );
                            $decimal = gmp_div_r( $totalItens, $itensPagina );
                            if ( $decimal != 0 ) {
                                $totalPaginas++;
                            }



                            $x = 1;
                            $pgs;
                            if ( $pgSolicitada >= $qtdPaginas ) {
                                $x = $pgSolicitada - 4;
                                $qtdPaginas += $pgSolicitada - 5;

                                if ( $qtdPaginas > $totalPaginas ) {
                                    $x += $totalPaginas - $qtdPaginas;
                                    $qtdPaginas = $totalPaginas;
                                    //$x = $pgSolicitada-5;
                                }

                                if ( $pgSolicitada == $totalPaginas ) {
                                    $x = $pgSolicitada - 9;
                                }
                            }

                            $qtdPaginas = ($qtdPaginas > $totalPaginas ? $totalPaginas : $qtdPaginas);

                            if ( $x <= 0 ) {
                                $x = 1;
                            }

                            while ( $x <= $qtdPaginas ) {
                                $active = ( $x == $pgSolicitada ? "class='active'" : "" );
                                $pgs .= '<li onclick="preparePagination(this)" ' . $active . ' id="goTo-' . $x . '"><a>' . $x . '</a></li>';
                                $x++;
                            }

                            $btnFirst;
                            $btnLast;

                            if ( $pgSolicitada != 1 ) {
                                $btnFirst = '<li onclick="preparePagination(this)" id="goTo-' . ($pgSolicitada - 1) . '"><a aria-label="Previous"><span aria-hidden="true">«</span></a></li>';
                            }
                            if ( $pgSolicitada != $qtdPaginas && $qtdPaginas != 0 ) {
                                $btnLast = '<li onclick="preparePagination(this)" id="goTo-' . ($pgSolicitada + 1) . '"><a aria-label="Next"><span aria-hidden="true">»</span></a></li>';
                            }

                            //var_dump($totalPaginas, $itensPagina, $itensInicio, $itensFim);
                            return '<nav class="text-right" style="margin-right: 15px;"><ul class="pagination">' . $btnFirst . $pgs . $btnLast . '</ul></nav>';
                        }
                        function updateImg( $field, $name, $dir, $fieldPK, $table, $id = 0 ) {
                            global $pdo, $img;
                            try {
                                $sql = "update " . $table . " set
                                                            " . $field . " = '" . $name . "'
                                                            where " . $fieldPK . " = " . $id;
                                $stmt = $pdo->prepare( $sql );
                                $stmt->execute();
                                $erro = $stmt->errorInfo();
                                $valErro = $erro[ 0 ];
                                if ( $valErro !== "00000" ) {
                                    return array( "status" => false, "message" => "Houve um erro em nosso servidor, tente novamente mais tarde, ou entre em contato conosco.", "devMessage" => $erro );
                                }
                            }
                            catch ( PDOException $e ) {
                                return array( "status" => false, "message" => $e->getMessage() );
                            }
                            return array( "status" => true, "message" => "Registro efetuado com sucesso!", "img" => $img.$dir.$name);
                        }
                        function removerRegistro($table, $pk, $pkValue){
                            global $pdo, $img;
                            try {
                                $sql = "Delete from ".$table."
                                        where " . $pk . " = " . $pkValue;
                                $stmt = $pdo->prepare( $sql );
                                $stmt->execute();
                                $erro = $stmt->errorInfo();
                                $valErro = $erro[ 0 ];
                                if ( $valErro !== "00000" ) {
                                    return array( "status" => false, "message" => "Houve um erro em nosso servidor, tente novamente mais tarde, ou entre em contato conosco.", "devMessage" => $erro );
                                }
                            }
                            catch ( PDOException $e ) {
                                return array( "status" => false, "message" => $e->getMessage() );
                            }
                            return array( "status" => true, "message" => "Registro removido com sucesso!");
                        }
                        function getLogin( $email, $senha ) {
                            global $pdo, $img;

                            $results = array();
                            $sql = "SELECT usuario_id,
                                            nome,
                                            login,
                                            senha
                                    FROM ___usuarios where login = :email and senha = :senha";
                            $stmt = $pdo->prepare( $sql );
                            $stmt->execute(
                                    array(
                                        ':email' => $email,
                                        ':senha' => $senha
                                    )
                            );

                            foreach ( $stmt->fetchAll() as $row ) {
                                return $row;
                            }
                        }

                        function getLogs( ) {
                            global $pdo, $img;

                            $results = array();
                            $sql = "SELECT
                                    usuario_id,
                                    log_id,
                                    usuario_id,
                                    (select nome from ___usuarios where usuario_id = l.usuario_id limit 1) as nome,
                                    acao,
                                    mensagem
                                    FROM ___logs l  LIMIT 10";
                            $stmt = $pdo->prepare( $sql );
                            $stmt->execute( );

                            foreach ( $stmt->fetchAll() as $row ) {
                                $results[] = $row;
                            }
                            return $results;
                        }
                        function insertLogs($acao, $mensagem){
                          global $pdo, $img;
                          $pdo->query("insert into ___logs values('', '".$_SESSION[ 'user' ]['usuario_id']."', '".$acao."', '".$mensagem."')");
                        }


            //___usuarios
                function getAll___usuarios(){
                    global $pdo, $img;
                    $sql = "select u.usuario_id,
                    u.nome,
                    u.login,
                    u.senha from ___usuarios u
                    ";

                    $results = array();
                    foreach ( $pdo->query( $sql ) as $row ) {
                        $results[] = $row;
                    }
                    return $results;
                }

                function get___usuarios( $id ) {
                    global $pdo, $img;
                    try {
                        $sql = "select u.usuario_id,
                    u.nome,
                    u.login,
                    u.senha from ___usuarios u
                            where usuario_id = :id";
                        $query = $pdo->prepare( $sql );

                        $query->bindParam( ":id", $id );
                        $query->execute();

                        foreach ( $query->fetchAll() as $row ) {
                            return $row;
                        }
                    }
                    catch ( PDOException $e ) {
                        return false;;
                        exit;
                    }
                }
                function get___usuariosPaginacao( $pg = 1, $filtro = NULL, $qtd = 20 ) {
                    global $img;

                    $finish = ($pg - 1) * $qtd;
                    $start = $finish - $qtd;
                    $where = "";
                    $and;

                    $sql = "select u.usuario_id,
                    u.nome,
                    u.login,
                    u.senha from ___usuarios u
                    
                            " . $where . "
                            LIMIT " . $qtd . " OFFSET " . $finish;
                    //die(json_encode($sql));

                    $pagina = getQuery( $sql );

                    $sql = "select count(*) from ___usuarios u
                    
                            " . $where;

                    $paginacao = getPaginacao( $sql, $pg, $qtd );
                    $arrRetorno = array( "pagina" => $pagina, "paginacao" => $paginacao );
                    return $arrRetorno;
                }

                function insert___usuarios( $fields ) {
                    global $pdo, $img;
                    try {

                        $stmt = $pdo->prepare( "insert into ___usuarios
                    (nome,
                        login,
                        senha)
                    values
                    (:nome,
                        :login,
                        :senha)" );
                        $stmt->execute(
                                array(
                                    ":nome" => $fields["nome"],
                        ":login" => $fields["login"],
                        ":senha" => $fields["senha"]
                                )
                        );
                        $erro = $stmt->errorInfo();
                        $valErro = $erro[ 0 ];
                        if ( $valErro !== "00000" ) {
                            insertLogs("insert", "Houve um erro em nosso servidor, tente novamente mais tarde, ou entre em contato conosco. (___usuarios)");
                            return array( "status" => false, "message" => "Houve um erro em nosso servidor, tente novamente mais tarde, ou entre em contato conosco.", "devMessage" => $erro );
                        }
                    }
                    catch ( PDOException $e ) {
                        insertLogs("insert", $e->getMessage()." (___usuarios) ");
                        return array( "status" => false, "message" => $e->getMessage() );
                    }
                    $id = $pdo->lastInsertId();
                    insertLogs("insert", "Registro efetuado com sucesso! (___usuarios)");
                    return array( "status" => true, "message" => "Registro efetuado com sucesso!", "ID" => $id);
                }

                function update___usuarios( $fields, $pk ) {
                    global $pdo, $img;
                    try {

                        $stmt = $pdo->prepare( "update ___usuarios set
                    nome = :nome,
                        login = :login,
                        senha = :senha
                    Where usuario_id = :usuario_id" );
                        $stmt->execute(
                                array(
                                    ":usuario_id" => $pk,":nome" => $fields["nome"],
                        ":login" => $fields["login"],
                        ":senha" => $fields["senha"]
                                )
                        );
                        $erro = $stmt->errorInfo();
                        $valErro = $erro[ 0 ];
                        if ( $valErro !== "00000" ) {
                            insertLogs("update", "Houve um erro em nosso servidor, tente novamente mais tarde, ou entre em contato conosco. (___usuarios)");
                            return array( "status" => false, "message" => "Houve um erro em nosso servidor, tente novamente mais tarde, ou entre em contato conosco.", "devMessage" => $erro );
                        }
                    }
                    catch ( PDOException $e ) {
                        insertLogs("update", $e->getMessage()." (___usuarios)");
                        return array( "status" => false, "message" => $e->getMessage() );
                    }
                    insertLogs("update", "Registro alterado com sucesso! (___usuarios)");
                    return array( "status" => true, "message" => "Registro alterado com sucesso!", "ID" => $pk);
                }
            //___logs
                function getAll___logs(){
                    global $pdo, $img;
                    $sql = "select l.log_id,
                    u.nome,
                        l.usuario_id,
                    l.acao,
                    l.mensagem from ___logs l
                    inner join ___usuarios u on u.usuario_id = l.usuario_id
                                ";

                    $results = array();
                    foreach ( $pdo->query( $sql ) as $row ) {
                        $results[] = $row;
                    }
                    return $results;
                }

                function get___logs( $id ) {
                    global $pdo, $img;
                    try {
                        $sql = "select l.log_id,
                        l.usuario_id,
                    l.acao,
                    l.mensagem from ___logs l
                            where log_id = :id";
                        $query = $pdo->prepare( $sql );

                        $query->bindParam( ":id", $id );
                        $query->execute();

                        foreach ( $query->fetchAll() as $row ) {
                            return $row;
                        }
                    }
                    catch ( PDOException $e ) {
                        return false;;
                        exit;
                    }
                }
                function get___logsPaginacao( $pg = 1, $filtro = NULL, $qtd = 20 ) {
                    global $img;

                    $finish = ($pg - 1) * $qtd;
                    $start = $finish - $qtd;
                    $where = "";
                    $and;

                    $sql = "select l.log_id,
                    u.nome,
                        l.usuario_id,
                    l.acao,
                    l.mensagem from ___logs l
                    inner join ___usuarios u on u.usuario_id = l.usuario_id
                                
                            " . $where . "
                            LIMIT " . $qtd . " OFFSET " . $finish;
                    //die(json_encode($sql));

                    $pagina = getQuery( $sql );

                    $sql = "select count(*) from ___logs l
                    inner join ___usuarios u on u.usuario_id = l.usuario_id
                                
                            " . $where;

                    $paginacao = getPaginacao( $sql, $pg, $qtd );
                    $arrRetorno = array( "pagina" => $pagina, "paginacao" => $paginacao );
                    return $arrRetorno;
                }

                function insert___logs( $fields ) {
                    global $pdo, $img;
                    try {

                        $stmt = $pdo->prepare( "insert into ___logs
                    (usuario_id,
                        acao,
                        mensagem)
                    values
                    (:usuario_id,
                        :acao,
                        :mensagem)" );
                        $stmt->execute(
                                array(
                                    ":usuario_id" => $fields["usuario_id"],
                        ":acao" => $fields["acao"],
                        ":mensagem" => $fields["mensagem"]
                                )
                        );
                        $erro = $stmt->errorInfo();
                        $valErro = $erro[ 0 ];
                        if ( $valErro !== "00000" ) {
                            insertLogs("insert", "Houve um erro em nosso servidor, tente novamente mais tarde, ou entre em contato conosco. (___logs)");
                            return array( "status" => false, "message" => "Houve um erro em nosso servidor, tente novamente mais tarde, ou entre em contato conosco.", "devMessage" => $erro );
                        }
                    }
                    catch ( PDOException $e ) {
                        insertLogs("insert", $e->getMessage()." (___logs) ");
                        return array( "status" => false, "message" => $e->getMessage() );
                    }
                    $id = $pdo->lastInsertId();
                    insertLogs("insert", "Registro efetuado com sucesso! (___logs)");
                    return array( "status" => true, "message" => "Registro efetuado com sucesso!", "ID" => $id);
                }

                function update___logs( $fields, $pk ) {
                    global $pdo, $img;
                    try {

                        $stmt = $pdo->prepare( "update ___logs set
                    usuario_id = :usuario_id,
                        acao = :acao,
                        mensagem = :mensagem
                    Where log_id = :log_id" );
                        $stmt->execute(
                                array(
                                    ":log_id" => $pk,":usuario_id" => $fields["usuario_id"],
                        ":acao" => $fields["acao"],
                        ":mensagem" => $fields["mensagem"]
                                )
                        );
                        $erro = $stmt->errorInfo();
                        $valErro = $erro[ 0 ];
                        if ( $valErro !== "00000" ) {
                            insertLogs("update", "Houve um erro em nosso servidor, tente novamente mais tarde, ou entre em contato conosco. (___logs)");
                            return array( "status" => false, "message" => "Houve um erro em nosso servidor, tente novamente mais tarde, ou entre em contato conosco.", "devMessage" => $erro );
                        }
                    }
                    catch ( PDOException $e ) {
                        insertLogs("update", $e->getMessage()." (___logs)");
                        return array( "status" => false, "message" => $e->getMessage() );
                    }
                    insertLogs("update", "Registro alterado com sucesso! (___logs)");
                    return array( "status" => true, "message" => "Registro alterado com sucesso!", "ID" => $pk);
                }
            //tblPost
                function getAlltblPost(){
                    global $pdo, $img;
                    $sql = "select P.postID,
                    P.postTitulo,
                    P.postResumo,
                    P.postDescricao,
                    (concat('".$img."tblPost/',P.postImagem)) as foto,
                    P.postImagem from tblPost P
                    ";

                    $results = array();
                    foreach ( $pdo->query( $sql ) as $row ) {
                        $results[] = $row;
                    }
                    return $results;
                }

                function gettblPost( $id ) {
                    global $pdo, $img;
                    try {
                        $sql = "select P.postID,
                    P.postTitulo,
                    P.postResumo,
                    P.postDescricao,
                    (concat('".$img."tblPost/',P.postImagem)) as foto,
                    P.postImagem from tblPost P
                            where postID = :id";
                        $query = $pdo->prepare( $sql );

                        $query->bindParam( ":id", $id );
                        $query->execute();

                        foreach ( $query->fetchAll() as $row ) {
                            return $row;
                        }
                    }
                    catch ( PDOException $e ) {
                        return false;;
                        exit;
                    }
                }

                function gettblPostUrl( $url ) {
                    global $pdo, $img;
                    try {
                        $sql = "select P.postID,
                    P.postTitulo,
                    P.postResumo,
                    P.postDescricao,
                    DATE_FORMAT(P.postData,'%d/%m/%Y') as postData,
                    (concat('".$img."tblPost/',P.postImagem)) as foto,
                    P.postImagem, url(postTitulo) as url
                     from tblPost P
                            where url(postTitulo) = :post";
                        $query = $pdo->prepare( $sql );

                        $query->bindParam( ":post", $url );
                        $query->execute();

                        foreach ( $query->fetchAll() as $row ) {
                            return $row;
                        }
                    }
                    catch ( PDOException $e ) {
                        return false;;
                        exit;
                    }
                }
                function gettblPostPaginacao( $pg = 1, $filtro = NULL, $qtd = 20 ) {
                    global $img;

                    $finish = ($pg - 1) * $qtd;
                    $start = $finish - $qtd;
                    $where = "";
                    $and;

                    $sql = "select P.postID,
                    P.postTitulo,
                    P.postResumo,
                    P.postDescricao,
                    (concat('".$img."tblPost/',P.postImagem)) as foto,
                    P.postImagem from tblPost P
                    
                            " . $where . "
                            LIMIT " . $qtd . " OFFSET " . $finish;
                    //die(json_encode($sql));

                    $pagina = getQuery( $sql );

                    $sql = "select count(*) from tblPost P
                    
                            " . $where;

                    $paginacao = getPaginacao( $sql, $pg, $qtd );
                    $arrRetorno = array( "pagina" => $pagina, "paginacao" => $paginacao );
                    return $arrRetorno;
                }

                function inserttblPost( $fields ) {
                    global $pdo, $img;
                    try {

                        $stmt = $pdo->prepare( "insert into tblPost
                    (postTitulo,
                        postResumo,
                        postDescricao,
                        postImagem,
                        postData)
                    values
                    (:postTitulo,
                        :postResumo,
                        :postDescricao,
                        :postImagem,
                        now())" );
                        $stmt->execute(
                                array(
                                    ":postTitulo" => $fields["postTitulo"],
                        ":postResumo" => $fields["postResumo"],
                        ":postDescricao" => $fields["postDescricao"],
                        ":postImagem" => $fields["postImagem"]
                                )
                        );
                        $erro = $stmt->errorInfo();
                        $valErro = $erro[ 0 ];
                        if ( $valErro !== "00000" ) {
                            insertLogs("insert", "Houve um erro em nosso servidor, tente novamente mais tarde, ou entre em contato conosco. (tblPost)");
                            return array( "status" => false, "message" => "Houve um erro em nosso servidor, tente novamente mais tarde, ou entre em contato conosco.", "devMessage" => $erro );
                        }
                    }
                    catch ( PDOException $e ) {
                        insertLogs("insert", $e->getMessage()." (tblPost) ");
                        return array( "status" => false, "message" => $e->getMessage() );
                    }
                    $id = $pdo->lastInsertId();
                    insertLogs("insert", "Registro efetuado com sucesso! (tblPost)");
                    return array( "status" => true, "message" => "Registro efetuado com sucesso!", "ID" => $id);
                }

                function updatetblPost( $fields, $pk ) {
                    global $pdo, $img;
                    try {

                        $stmt = $pdo->prepare( "update tblPost set
                    postTitulo = :postTitulo,
                        postResumo = :postResumo,
                        postDescricao = :postDescricao
                    Where postID = :postID" );
                        $stmt->execute(
                                array(
                                    ":postID" => $pk,":postTitulo" => $fields["postTitulo"],
                        ":postResumo" => $fields["postResumo"],
                        ":postDescricao" => $fields["postDescricao"]
                                )
                        );
                        $erro = $stmt->errorInfo();
                        $valErro = $erro[ 0 ];
                        if ( $valErro !== "00000" ) {
                            insertLogs("update", "Houve um erro em nosso servidor, tente novamente mais tarde, ou entre em contato conosco. (tblPost)");
                            return array( "status" => false, "message" => "Houve um erro em nosso servidor, tente novamente mais tarde, ou entre em contato conosco.", "devMessage" => $erro );
                        }
                    }
                    catch ( PDOException $e ) {
                        insertLogs("update", $e->getMessage()." (tblPost)");
                        return array( "status" => false, "message" => $e->getMessage() );
                    }
                    insertLogs("update", "Registro alterado com sucesso! (tblPost)");
                    return array( "status" => true, "message" => "Registro alterado com sucesso!", "ID" => $pk);
                }
            //tblLeed
                function getAlltblLeed(){
                    global $pdo, $img;
                    $sql = "select L.leedID,
                    L.leedNome,
                    L.leedEmail,
                    L.leedIP, 
                    DATE_FORMAT(DATE_SUB(leedData, INTERVAL 2 HOUR) , '%d/%m/%Y %H:%i:%s') as leedData from tblLeed L
                    ";

                    $results = array();
                    foreach ( $pdo->query( $sql ) as $row ) {
                        $results[] = $row;
                    }
                    return $results;
                }

                function gettblLeed( $id ) {
                    global $pdo, $img;
                    try {
                        $sql = "select L.leedID,
                    L.leedNome,
                    L.leedEmail,
                    L.leedIP,
                    DATE_FORMAT(DATE_SUB(leedData, INTERVAL 2 HOUR) , '%d/%m/%Y %H:%i:%s') as leedData from tblLeed L
                            where leedID = :id";
                        $query = $pdo->prepare( $sql );

                        $query->bindParam( ":id", $id );
                        $query->execute();

                        foreach ( $query->fetchAll() as $row ) {
                            return $row;
                        }
                    }
                    catch ( PDOException $e ) {
                        return false;;
                        exit;
                    }
                }
                function gettblLeedPaginacao( $pg = 1, $filtro = NULL, $qtd = 20 ) {
                    global $img;

                    $finish = ($pg - 1) * $qtd;
                    $start = $finish - $qtd;
                    $where = "";
                    $and;

                    $sql = "select L.leedID,
                    L.leedNome,
                    L.leedEmail,
                    L.leedIP,
                    DATE_FORMAT(DATE_SUB(leedData, INTERVAL 2 HOUR) , '%d/%m/%Y %H:%i:%s') as leedData from tblLeed L
                    
                            " . $where . "
                            LIMIT " . $qtd . " OFFSET " . $finish;
                    //die(json_encode($sql));

                    $pagina = getQuery( $sql );

                    $sql = "select count(*) from tblLeed L
                    
                            " . $where;

                    $paginacao = getPaginacao( $sql, $pg, $qtd );
                    $arrRetorno = array( "pagina" => $pagina, "paginacao" => $paginacao );
                    return $arrRetorno;
                }

                function inserttblLeed( $fields ) {
                    global $pdo, $img;
                    try {

                        $stmt = $pdo->prepare( "insert into tblLeed
                    (leedNome,
                        leedEmail,
                        leedIP,
                        leedData)
                    values
                    (:leedNome,
                        :leedEmail,
                        :leedIP,
                        now())" );
                        $stmt->execute(
                                array(
                                    ":leedNome" => $fields["leedNome"],
                        ":leedEmail" => $fields["leedEmail"],
                        ":leedIP" => $_SERVER['REMOTE_ADDR']
                                )
                        );
                        $erro = $stmt->errorInfo();
                        $valErro = $erro[ 0 ];
                        if ( $valErro !== "00000" ) {
                            insertLogs("insert", "Houve um erro em nosso servidor, tente novamente mais tarde, ou entre em contato conosco. (tblLeed)");
                            return array( "status" => false, "message" => "Houve um erro em nosso servidor, tente novamente mais tarde, ou entre em contato conosco.", "devMessage" => $erro );
                        }
                    }
                    catch ( PDOException $e ) {
                        insertLogs("insert", $e->getMessage()." (tblLeed) ");
                        return array( "status" => false, "message" => $e->getMessage() );
                    }
                    $id = $pdo->lastInsertId();
                    insertLogs("insert", "Registro efetuado com sucesso! (tblLeed)");
                    return array( "status" => true, "message" => "Registro efetuado com sucesso!", "ID" => $id);
                }

                function updatetblLeed( $fields, $pk ) {
                    global $pdo, $img;
                    try {

                        $stmt = $pdo->prepare( "update tblLeed set
                    leedNome = :leedNome,
                        leedEmail = :leedEmail,
                        leedIP = :leedIP,
                        leedData = :leedData
                    Where leedID = :leedID" );
                        $stmt->execute(
                                array(
                                    ":leedID" => $pk,":leedNome" => $fields["leedNome"],
                        ":leedEmail" => $fields["leedEmail"],
                        ":leedIP" => $fields["leedIP"],
                        ":leedData" => $fields["leedData"]
                                )
                        );
                        $erro = $stmt->errorInfo();
                        $valErro = $erro[ 0 ];
                        if ( $valErro !== "00000" ) {
                            insertLogs("update", "Houve um erro em nosso servidor, tente novamente mais tarde, ou entre em contato conosco. (tblLeed)");
                            return array( "status" => false, "message" => "Houve um erro em nosso servidor, tente novamente mais tarde, ou entre em contato conosco.", "devMessage" => $erro );
                        }
                    }
                    catch ( PDOException $e ) {
                        insertLogs("update", $e->getMessage()." (tblLeed)");
                        return array( "status" => false, "message" => $e->getMessage() );
                    }
                    insertLogs("update", "Registro alterado com sucesso! (tblLeed)");
                    return array( "status" => true, "message" => "Registro alterado com sucesso!", "ID" => $pk);
                }
            //tblBannerHome
                function getAlltblBannerHome(){
                    global $pdo, $img;
                    $sql = "select B.bannerID,
                    B.bannerTitulo,
                    B.bannerDescricao,
                    B.bannerLink,
                    (concat('".$img."tblBannerHome/',B.bannerImagem)) as foto,
                    B.bannerImagem from tblBannerHome B
                    ";

                    $results = array();
                    foreach ( $pdo->query( $sql ) as $row ) {
                        $results[] = $row;
                    }
                    return $results;
                }

                function gettblBannerHome( $id ) {
                    global $pdo, $img;
                    try {
                        $sql = "select B.bannerID,
                    B.bannerTitulo,
                    B.bannerDescricao,
                    B.bannerLink,
                    (concat('".$img."tblBannerHome/',B.bannerImagem)) as foto,
                    B.bannerImagem from tblBannerHome B
                            where bannerID = :id";
                        $query = $pdo->prepare( $sql );

                        $query->bindParam( ":id", $id );
                        $query->execute();

                        foreach ( $query->fetchAll() as $row ) {
                            return $row;
                        }
                    }
                    catch ( PDOException $e ) {
                        return false;;
                        exit;
                    }
                }
                function gettblBannerHomePaginacao( $pg = 1, $filtro = NULL, $qtd = 20 ) {
                    global $img;

                    $finish = ($pg - 1) * $qtd;
                    $start = $finish - $qtd;
                    $where = "";
                    $and;

                    $sql = "select B.bannerID,
                    B.bannerTitulo,
                    B.bannerDescricao,
                    B.bannerLink,
                    (concat('".$img."tblBannerHome/',B.bannerImagem)) as foto,
                    B.bannerImagem from tblBannerHome B
                    
                            " . $where . "
                            LIMIT " . $qtd . " OFFSET " . $finish;
                    //die(json_encode($sql));

                    $pagina = getQuery( $sql );

                    $sql = "select count(*) from tblBannerHome B
                    
                            " . $where;

                    $paginacao = getPaginacao( $sql, $pg, $qtd );
                    $arrRetorno = array( "pagina" => $pagina, "paginacao" => $paginacao );
                    return $arrRetorno;
                }

                function inserttblBannerHome( $fields ) {
                    global $pdo, $img;
                    try {

                        $stmt = $pdo->prepare( "insert into tblBannerHome
                    (bannerTitulo,
                        bannerDescricao,
                        bannerLink,
                        bannerImagem)
                    values
                    (:bannerTitulo,
                        :bannerDescricao,
                        :bannerLink,
                        :bannerImagem)" );
                        $stmt->execute(
                                array(
                                    ":bannerTitulo" => $fields["bannerTitulo"],
                        ":bannerDescricao" => $fields["bannerDescricao"],
                        ":bannerLink" => $fields["bannerLink"],
                        ":bannerImagem" => $fields["bannerImagem"]
                                )
                        );
                        $erro = $stmt->errorInfo();
                        $valErro = $erro[ 0 ];
                        if ( $valErro !== "00000" ) {
                            insertLogs("insert", "Houve um erro em nosso servidor, tente novamente mais tarde, ou entre em contato conosco. (tblBannerHome)");
                            return array( "status" => false, "message" => "Houve um erro em nosso servidor, tente novamente mais tarde, ou entre em contato conosco.", "devMessage" => $erro );
                        }
                    }
                    catch ( PDOException $e ) {
                        insertLogs("insert", $e->getMessage()." (tblBannerHome) ");
                        return array( "status" => false, "message" => $e->getMessage() );
                    }
                    $id = $pdo->lastInsertId();
                    insertLogs("insert", "Registro efetuado com sucesso! (tblBannerHome)");
                    return array( "status" => true, "message" => "Registro efetuado com sucesso!", "ID" => $id);
                }

                function updatetblBannerHome( $fields, $pk ) {
                    global $pdo, $img;
                    try {

                        $stmt = $pdo->prepare( "update tblBannerHome set
                    bannerTitulo = :bannerTitulo,
                        bannerDescricao = :bannerDescricao,
                        bannerLink = :bannerLink
                    Where bannerID = :bannerID" );
                        $stmt->execute(
                                array(
                                    ":bannerID" => $pk,":bannerTitulo" => $fields["bannerTitulo"],
                        ":bannerDescricao" => $fields["bannerDescricao"],
                        ":bannerLink" => $fields["bannerLink"]
                                )
                        );
                        $erro = $stmt->errorInfo();
                        $valErro = $erro[ 0 ];
                        if ( $valErro !== "00000" ) {
                            insertLogs("update", "Houve um erro em nosso servidor, tente novamente mais tarde, ou entre em contato conosco. (tblBannerHome)");
                            return array( "status" => false, "message" => "Houve um erro em nosso servidor, tente novamente mais tarde, ou entre em contato conosco.", "devMessage" => $erro );
                        }
                    }
                    catch ( PDOException $e ) {
                        insertLogs("update", $e->getMessage()." (tblBannerHome)");
                        return array( "status" => false, "message" => $e->getMessage() );
                    }
                    insertLogs("update", "Registro alterado com sucesso! (tblBannerHome)");
                    return array( "status" => true, "message" => "Registro alterado com sucesso!", "ID" => $pk);
                } 


/*************************/
                function getRegistrosPost( $pg = 1, $filter = null, $order = null, $itens = 2 ) {
                        global $pdo;
                        $pg -=1;
                        $where = "";
                        $ordering = "";
                        if($filter != null){
                            $where = "";
                        }
                        if($order != ""){
                            $ordering = " order by ". $order["field"]. " ".$order["direction"];
                        }
                        $sql = "SELECT 
                                    postID, postTitulo, postResumo, postDescricao, postImagem, postData, url(postTitulo) as url
                                FROM tblPost
                                ".$where." ".$ordering."
                                limit " . $itens . " offset " . $pg * $itens;
                        $results = array();
                        foreach ( $pdo->query( $sql ) as $row ) {
                            $results[] = $row;
                        }
                        return $results;
                    }

                    function setAccess($url){
                        global $pdo, $img;
                        try {

                        $stmt = $pdo->prepare( "update tblPost set postAcessos = postAcessos+1 where url(postTitulo) = :url" );
                        $stmt->execute(
                                array(
                                    ":url" => $url
                                )
                        );
                        $erro = $stmt->errorInfo();
                        $valErro = $erro[ 0 ];
                        if ( $valErro !== "00000" ) {
                            insertLogs("insert", "Houve um erro em nosso servidor, tente novamente mais tarde, ou entre em contato conosco. (tblPost)");
                            return array( "status" => false, "message" => "Houve um erro em nosso servidor, tente novamente mais tarde, ou entre em contato conosco.", "devMessage" => $erro );
                        }
                    }
                    catch ( PDOException $e ) {
                        insertLogs("insert", $e->getMessage()." (tblPost) ");
                        return array( "status" => false, "message" => $e->getMessage() );
                    }
                        $id = $pdo->lastInsertId();
                        insertLogs("insert", "Registro efetuado com sucesso! (tblPost)");
                        return array( "status" => true, "message" => "Registro efetuado com sucesso!", "ID" => $id);
                    }


                ?>