<?php
  if(filter_input(INPUT_GET, 'generate') == ''){
    echo "<script>window.location = '?generate=".date("dmYHis")."';</script>";

  }
?>
<!DOCTYPE html>
<html lang="pt">
<head>
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
        <base href="/">
    <?php
      $title = (trim($post['postTitulo']) != '' ? $post['postTitulo'] : "Planejamento Financeiro.");
      $desc = (trim($post['postResumo']) != '' ? nl2br($post['postResumo']) : "A melhor forma de administrar o seu dinheiro :)");
      $img = (trim($post['postImagem']) != '' ? 'http://planejeconquiste.com.br/first/upload/img/tblPost/'.$post['postImagem'] : "http://planejeconquiste.com.br/img/cover.jpg");
      $page = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

      $arrayName = array( 1 => "img/gif_1",
                          2 => "img/gif_2",
                          3 => "img/gif_3",
                          4 => "img/gif_4",
                          5 => "img/gif_5",
                          6 => "img/gif_6",
                          7 => "img/gif_7",
                          8 => "img/gif_8",
                          9 => "img/gif_9");

                          $min=1;
                          $max=9;
                          $number =  rand($min,$max);

    ?>

    <meta property="og:locale" content="pt_BR">
    <meta property="og:url" content="http://planejeconquiste.com.br/sextafeira.php"/>
    <meta property="og:title" content="Hoje é sexta !!!!!">
    <meta property="og:site_name" content="PlanejeConquiste">
    <meta property="og:description" content="Hoje minha sexta vai ser assim e a sua ?">
    <meta property="og:image" content="http://planejeconquiste.com.br/<?= $arrayName[$number] . '.jpeg' ?>"/>
    <meta property="og:image:type" content="jpeg">
    <meta property="og:image:width" content="800">
    <meta property="og:image:height" content="600">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no">


    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/uikit.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/sweetalert.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">

    <title><?=$title?></title>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-90726734-1', 'auto');
  ga('send', 'pageview');

</script>

<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '682993335209248'); // Insert your pixel ID here.
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=682993335209248&ev=PageView&noscript=1"
/></noscript>
<!-- DO NOT MODIFY -->
<!-- End Facebook Pixel Code -->

</head>

<link href="https://fonts.googleapis.com/css?family=Krona+One" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">


<body style="background-color:#ccc;">
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
            <div class="git_img">
              <p> SUA SEXTA-FEIRA VAI SER ASSIM: </p>
              <img src="<?= $arrayName[$number] . '.gif'?>">
              <p> CURTIU? COMPARTILHE E MARQUE SEUS AMIGOS! </p>
              <div class="addthis_inline_share_toolbox">
                <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-58878f36e953258c"></script>
              </div>
            </div>
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
                        /* $(".action_gif").trigger("click"); */
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
