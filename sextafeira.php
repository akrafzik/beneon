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
                        <li class="link">
                          <a href="/" class="hidden-xs"> <span class="glyphicon glyphicon-home"></span> <br/>Home</a>
                          <a href="/" class="visible-xs" data-toggle="collapse" data-target=".navbar-collapse"> <span class="glyphicon glyphicon-home"></span> <br/>Home</a>
                        </li>
                        <li class="link">
                          <a class="uk-button hidden-xs action_gif" href="#modal-full" uk-toggle></a>
                          <a class="uk-button visible-xs" data-toggle="collapse" data-target=".navbar-collapse" href="#modal-full" uk-toggle> <span class="glyphicon glyphicon-pencil"></span> <br/> Assine Nosso Blog </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>


    <section class="body_gif">
        <div class="container">

        </div>

        <div id="modal-full" class="uk-modal-full" uk-modal esc-close="false">
                <div class="uk-modal-dialog">
                    <div class="uk-grid-collapse uk-child-width-1-2@s uk-flex-middle" uk-grid>
                        <div class="uk-background-cover" style="width:0px" uk-height-viewport></div>
                        <div class="uk-padding-large" style="text-align:center; margin:0 auto;">
                          <p class="text-title-register">Entre com seu nome e email abaixo para saber como será a sua sexta-feira e compartilhe com seus amigos!.</p>
                          <form class="form-horizontal" id="form2" onsubmit="cadastrarLeadPopup(); return false;">
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
                                      <span id="msg2"></span>
                                  </div>
                              </div>
                          </form>
                        </div>
                    </div>
                </div>
            </div>
    </section>



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
                        $(".action_gif").trigger("click");
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
                                            $("#" + target).append("<div class='col-md-12'><h5>Sem Mais Resultados...</h5></div>");
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
                                        if(data.status){

                                            $('#form1')[0].reset();
                                            swal({
                                            title: "Obrigado!",
                                            text: "Rumo a independencia financeira :)",
                                            imageUrl: "img/Logo.png",
                                            imageSize: '220x90'});
                                        }
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
                                        $("#msg2").html(data.message);
                                        if(data.status){
                                            $('#form2')[0].reset();
                                            swal({
                                            title: "Obrigado!",
                                            text: "Rumo a independencia financeira :)",
                                            imageUrl: "img/Logo.png",
                                            imageSize: '220x90'});
                                        }
                                    }
                                });
                            }, 1000);
                    }

                    function baixarPlanilha(){
                        setTimeout(function () {
                                $.ajax({
                                    type: "POST",
                                    url: "actions.php",
                                    data: $("#form8").serialize(),
                                    dataType: 'json',
                                    processData: true,
                                    success: function (data) {
                                        //console.log(data);
                                        $("#msg3").html(data.message);
                                        if(data.status){
                                            $('#form8')[0].reset();
                                            swal({
                                            title: "Obrigado!",
                                            text: "Rumo a independencia financeira :)",
                                            imageUrl: "img/Logo.png",
                                            imageSize: '220x90'});
                                            download();
                                        }
                                    }
                                });
                            }, 1000);
                    }

                    function download() {
                        var iframe = document.getElementById('invisible');
                        iframe.src = "download/Planilha.xlsx";
                    }

                </script>
</body>
</html>
