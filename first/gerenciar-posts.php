<?php include("header.php");
        ?><!-- BODY START -->
        <div id="page-wrapper">
            <?php
            $id = filter_input( INPUT_GET, "id" );
            $dados = array();
            if ( $id != "" ) {
                $dados = gettblPost( $id );
            }
            /* var_dump($dados, "P.postID,
                    P.postTitulo,
                    P.postResumo,
                    P.postDescricao,
                    (concat('".$img."tblPost/',P.postImagem)) as foto,
                    P.postImagem"); */
            ?>
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <?= $id == "" ? "Cadastrar " : "Alterar " ?>Posts
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Painel de controle
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <form id="theform" onsubmit="sendForm(); return false;">
                            <div class="form-group col-lg-12"><img id="resImg" src="<?=$dados['foto']?>" style="width:150px;"></div><div class="form-group ">
                                <label class="sr-only" for="exampleInputEmail3">&nbsp;</label>
                                <input  type="hidden" class="form-control" name="postID" id="postID" placeholder="" value="<?=$dados['postID']?>">
                              </div><div class="form-group col-lg-6">
                                <label class="sr-only" for="exampleInputEmail3">&nbsp;</label>
                                <input required type="text" class="form-control" name="postTitulo" id="postTitulo" placeholder="Título" value="<?=$dados['postTitulo']?>">
                              </div><div class="form-group col-lg-12">
                                <label class="sr-only" for="exampleInputEmail3">&nbsp;</label>
                                <textarea  class="form-control" name="postResumo" id="postResumo" placeholder="Resumo"><?=$dados['postResumo']?></textarea>
                              </div><div class="form-group col-lg-12">
                                <label class="sr-only" for="exampleInputEmail3">&nbsp;</label>
                                <textarea  class="form-control" name="postDescricao" id="postDescricao" placeholder="Descrição"><?=$dados['postDescricao']?></textarea>
                              </div><div class="form-group col-lg-6">
                                <label class="sr-only" for="exampleInputEmail3">&nbsp;</label>
                                <input data-filename-placement="inside" title="Imagem" type="file" class="form-control" name="postImagem" id="postImagem" placeholder="Imagem" value="<?=$dados['postImagem']?>">
                              </div>
                            <div class="clearfix"></div>
                            <br><br>
                            <div id="message" style="margin-bottom:10px; padding:30px;"></div>
                            <div class="pull-right">
                                <input type="hidden" name="exec" value="gerenciatblPost">
                                <button type="submit" onclick="" class="btn btn-primary "><?= $id == "" ? "Cadastrar " : "Alterar" ?></button>
                                <button type="button" class="btn btn-primary " onclick="history.back(-1);">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
                <script>
                    function sendForm(){
                    $.ajax({
                    type: "POST",
                            url: "actions.php",
                            data: $("#theform").serialize(),
                            dataType: 'json',
                            processData: true,
                            success: function (data) {
                            console.log(data);
                            $("#message").removeClass("alert-danger");
                            $("#message").removeClass("alert-info");
                            $("#message").removeClass("alert-success");
                            $("#message").html("Verificando...");
                            $("#message").addClass("alert-info");
                            $("#message").fadeIn("slow");
                            /*alert-danger alert-success*/
                            setTimeout(function () {
                            if (!data.status){
                            $("#message").removeClass("alert-danger");
                            $("#message").removeClass("alert-info");
                            $("#message").removeClass("alert-success");
                            $("#message").html(data.message);
                            $("#message").addClass("alert-danger");
                            $("#message").fadeIn("slow");
                            }
                            else{
                            $("#message").removeClass("alert-danger");
                            $("#message").removeClass("alert-info");
                            $("#message").removeClass("alert-success");
                            $("#message").html(data.message);
                            $("#message").addClass("alert-success");
                            $("#message").fadeIn("slow");
                            var form_data = new FormData();
                                        var file_postImagem = $('#postImagem').prop('files')[0];
                                        form_data.append('postImagem', file_postImagem );
                                        $("#message").html($("#message").html() + "<br> Verificando upload de arquivo..." );


                                        form_data.append('exec', "uploadtblPost");
                                        form_data.append('ID', <?=$id != "" ? "'".$id."'" : "data.ID"?>);


                                        $.ajax({
                                            url: 'actions.php', // point to server-side PHP script
                                            dataType: 'json',  // what to expect back from the PHP script, if anything
                                            cache: false,
                                            contentType: false,
                                            processData: false,
                                            data: form_data,
                                            type: 'post',
                                            success: function(response){
                                                //history.back(-1);
                                              if(response.msg == "No Upload"){
                                                history.back(-1);
                                              }
                                              else{
                                                $("#resImg").attr("src", response.img);
                                                $("#message").html(response.message );
                                                history.back(-1);
                                              }
                                                console.log(response);
                                            }
                                        });
                            }
                            }, 1000);
                            }
                    });
                    }

                </script>
                <!-- /.row -->
                <?php include("foot.php"); ?>