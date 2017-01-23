<?php include('head.php'); ?>

<body>
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
                    <a class="navbar-brand" href="#"><img id="logo-img" src="img/Logo.png" alt=""></a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="link"><a href="/"> <span class="glyphicon glyphicon-home"></span> <br/>Home</a></li>
                        <li class="link"><a href="#posts" uk-scroll> <span class="glyphicon glyphicon-book"></span><br/>Finanças Pessoais</a></li>
                        <li class="link"><a class="uk-button" href="#modal-full" uk-toggle> <span class="glyphicon glyphicon-pencil"></span> <br/> Assine Nosso Blog </a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <section id="message_top" class='img_cover'>
            <div class="backgroud-cover">

              <h1>QUAL É O SEU PRÓXIMO SONHO? <br/> <a href="#posts" uk-scroll><span class="glyphicon glyphicon-chevron-down"></span></a></h1>

            </div>

            </div>
        </section>
    </header>

    <section class="main_content" id="form_cad">
        <div class="row">
            <div class="container-fluid">
                <div class="col-md-4">
                    <div class="description_text">
                        <p> Planeje e conquiste a sua independência financeira.</p>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form_register">
                        <p>Insira o seu endereço de email abaixo para receber gratuitamente as atualizações do blog.</p>
                        <form class="form-horizontal" id="form1" onsubmit="cadastrarLead(); return false;">
                            <input type="hidden" value="cadastrarLead" name="exec">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Nome</label>
                                <div class="col-sm-10">
                                    <input type="text" name="nomeLead" class="form-control" placeholder="Digite o seu nome" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" name="emailLead" class="form-control" placeholder="Digite o seu email" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary btn-block">Cadastrar</button>
                                    <span id="msg"></span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
          </div>
    </section>

    <section id="posts" class="posts">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-8 post-space">
                    <div class="uk-child-width-1-2@m" id="res" uk-grid>
                        <!-- =] -->
                    </div>
                    <!--<p class="text-center load btn-block">
                        <a href=""><span class="glyphicon glyphicon-refresh"></span></br>
                            Carregar Mais</a>
                    </p>-->
                </div>
                <div class="col-md-4 wow slideInRight" data-wow-duration="1s">
                    <div class="col-md-12">
                        <div class="post_read" id="post_read">
                            <p class="title_reads"> Posts Mais Lidos </p>
                            <!-- =] -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="modal-full" class="uk-modal-full" uk-modal>
                <div class="uk-modal-dialog">
                    <button class="uk-modal-close-full" type="button" uk-close></button>
                    <div class="uk-grid-collapse uk-child-width-1-2@s uk-flex-middle" uk-grid>
                        <div class="uk-background-cover" style="background-image: url('img/fundo.jpg');" uk-height-viewport></div>
                        <div class="uk-padding-large">

                          <p>Insira o seu endereço de email abaixo, para receber gratuitamente as atualizações do blog.</p>

                          <form class="form-horizontal" id="form2" onsubmit="cadastrarLeadPopup(); return false;">
                              <input type="hidden" value="cadastrarLead" name="exec">
                              <div class="form-group">
                                  <label for="inputEmail3" class="col-sm-2 control-label">Nome</label>
                                  <div class="col-sm-10">
                                      <input type="text" name="nomeLead" class="form-control" placeholder="Digite o seu nome" required>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="inputPassword3" class="col-sm-2 control-label">Email</label>
                                  <div class="col-sm-10">
                                      <input type="email" name="emailLead" class="form-control" placeholder="Digite o seu email" required>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <div class="col-sm-offset-2 col-sm-10">
                                      <button type="submit" class="btn btn-primary btn-block">Cadastrar</button>
                                      <span id="msg"></span>
                                  </div>
                              </div>
                          </form>
                        </div>
                    </div>
                </div>
            </div>

            <?php include('footer.php'); ?>

        <span id="page" style="display:none">1</span>
                <span id="trigger" style="display:none">true</span>

                <script>
                    $(document).ready(function () {
                        $(window).scroll(function (event) {
                            if ($('body').height() <= ($(window).height() + 400 + $(window).scrollTop())) {
                                getPagination($("#page").html(), 'scroll', 'res');
                            }
                        });
                    });
                    function getPagination(pg, request, target) {
                        if ($("#trigger").html() === "true") {
                            $("#trigger").html("false");
                            $("#" + target).fadeTo("slow", 0.3);
                            setTimeout(function () {
                                $.ajax({
                                    type: "POST",
                                    url: "actions.php",
                                    data: {
                                        exec: request,
                                        pg: pg
                                    },
                                    dataType: 'json',
                                    processData: true,
                                    success: function (data) {
                                        if (data.results !== "") {
                                            $("#" + target).append(data.results);
                                            setTimeout(function () {
                                                if (data.totalItens < 1) {
                                                    $("#trigger").html("false");
                                                }
                                                else {
                                                    $("#trigger").html("true");
                                                }
                                                $("#page").html(data.pg);
                                            }, 500);
                                        }
                                        else {
                                            $("#" + target).append('<div class="col-md-12"><h3>Sem Mais Resultados...</h3></div>');
                                        }
                                        $("#" + target).fadeTo("slow", 1);
                                    }
                                });
                            }, 1000);
                        }
                    }

                    getPagination(1, 'scroll', 'res');
                    $("#trigger").html("true");
                    getPagination(1, 'maisLidos', 'post_read');

                    function cadastrarLead(){
                        setTimeout(function () {
                                $.ajax({
                                    type: "POST",
                                    url: "actions.php",
                                    data: $("#form1").serialize(),
                                    dataType: 'json',
                                    processData: true,
                                    success: function (data) {
                                        //console.log(data);
                                        $("#msg").html(data.message);
                                        $('#form1')[0].reset();
                                        swal({
                                        title: "Obrigado!",
                                        text: "Rumo a independencia financeira :)",
                                        imageUrl: "img/Logo.png",
                                        imageSize: '220x90'});
                                    }
                                });
                            }, 1000);
                    }

                    function cadastrarLeadPopup(){
                        setTimeout(function () {
                                $.ajax({
                                    type: "POST",
                                    url: "actions.php",
                                    data: $("#form2").serialize(),
                                    dataType: 'json',
                                    processData: true,
                                    success: function (data) {
                                        //console.log(data);
                                        $("#msg").html(data.message);
                                        $('#form2')[0].reset();
                                        swal({
                                        title: "Obrigado!",
                                        text: "Rumo a independencia financeira :)",
                                        imageUrl: "img/Logo.png",
                                        imageSize: '220x90'});
                                    }
                                });
                            }, 1000);
                    }

                </script>


</body>

</html>
