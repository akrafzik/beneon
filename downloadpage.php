<?php include('head.php'); ?>
<script>fbq('track', '<EVENT_NAME>');</script>

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
                        <li class="link"><a class="uk-button" href="#modal-full" uk-toggle> <span class="glyphicon glyphicon-pencil"></span> <br/> Assine Nosso Blog </a></li>
                    </ul>
                </div>
            </div>
        </nav>

    </header>


    <section class="intro-header" style="background-image: url('img/cover.jpg')">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                                <div class="post-heading">
                                </div>
                            </div>
                        </div>
                    </div>
    </section>

    <section  id="form_cad">
        <div class="row">
            <div class="container-fluid">
              <div class="col-md-2 "></div>
                <div class="col-md-8 ">
                    <div class="form_register">
                        <p>Cadastre se na nossa plataforma para receber nossa planilha de controle de custo inteiramente gratis!</p>
                        <form class="form-horizontal" id="form6" onsubmit="cadastrarLeadDownloadPage(); return false;">
                            <input type="hidden" value="cadastrarLead" name="exec">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Nome</label>
                                <div class="col-sm-10">
                                    <input type="text" name="nomeLead" class="form-control" placeholder="Digite o seu nome e Sobrenome" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" name="emailLead" class="form-control" placeholder="Digite o seu email" required>
                                </div>
                            </div>
                            <div class="form-group">
                            <iframe id="invisible" style="display:none;"></iframe>
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary btn-block">Cadastrar e Baixar</button>
                                    <span id="msg"></span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-2 "></div>
            </div>

            <div id="modal-full" class="uk-modal-full" uk-modal>
                    <div class="uk-modal-dialog">
                        <button class="uk-modal-close-full" type="button" uk-close></button>
                        <div class="uk-grid-collapse uk-child-width-1-2@s uk-flex-middle" uk-grid>
                            <div class="uk-background-cover" style="background-image: url('img/fundo.jpg');" uk-height-viewport></div>
                            <div class="uk-padding-large">
                              <p class="text-title-register">Entre com seu nome e email abaixo para acessar a pesquisa. Não se preocupe, não enviaremos nenhum SPAM! ;).</p>
                              <form class="form-horizontal" id="form5" onsubmit="cadastrarLeadPlanilha(); return false;">
                                  <input type="hidden" value="cadastrarLead" name="exec">
                                  <div class="form-group">
                                      <label for="inputEmail3" class="col-sm-2 control-label">Nome</label>
                                      <div class="col-sm-10">
                                          <input type="text" name="nomeLead" class="form-control" placeholder="Digite o seu nome e Sobrenome" required>
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

                <iframe id="invisible" style="display:none;"></iframe>

    </section>

    <section id="posts" class="posts">

        <?php include('footer.php'); ?>

        <span id="page" style="display:none">1</span>
                <span id="trigger" style="display:none">true</span>

                <script src=js/jquery.min.js></script>

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

                    function download() {
                        var iframe = document.getElementById('invisible');
                        iframe.src = "download/Planilha.xlsx";
                    }

                    function cadastrarLeadDownloadPage(){
                        setTimeout(function () {
                                $.ajax({
                                    type: "POST",
                                    url: "actions.php",
                                    data: $("#form6").serialize(),
                                    dataType: 'json',
                                    processData: true,
                                    success: function (data) {
                                        //console.log(data);
                                        $("#msg").html(data.message);
                                        $('#form6')[0].reset();
                                        swal({
                                        title: "Obrigado!",
                                        text: "Rumo a independencia financeira :)",
                                        imageUrl: "img/Logo.png",
                                        imageSize: '220x90'});
                                        download();
                                    }
                                });
                            }, 1000);
                    }

                    function cadastrarLeadPlanilha(){
                        setTimeout(function () {
                                $.ajax({
                                    type: "POST",
                                    url: "actions.php",
                                    data: $("#form5").serialize(),
                                    dataType: 'json',
                                    processData: true,
                                    success: function (data) {
                                        //console.log(data);
                                        $("#msg").html(data.message);
                                        $('#form5')[0].reset();
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
                <script>
                fbq('track', 'Lead');
                </script>
</body>

</html>
