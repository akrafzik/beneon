<?php
    include('first/functions.php');
    $post = gettblPostUrl(filter_input(INPUT_GET, 'url'));
?>
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
                        <li class="link"><a id="modalBtn" class="uk-button" href="#modal-full" uk-toggle data-uk-model="{bgclose: false, keyboard:false}"> <span class="glyphicon glyphicon-pencil"></span> <br/> Assine Nosso Blog </a></li>
                  </ul>
              </div>
          </div>
      </nav>
        <section class="intro-header" style="background-image: url('first/upload/img/tblPost/<?=$post['postImagem']?>')">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                            <div class="post-heading">
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </header>

    <section class="main_post_description">
      <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
              <h1><?=$post['postTitulo']?></h1>
              <span class="meta">Postado em <?=$post['postData']?></span>
            </div>
        </div>
      </div>
      <br><br>
      <article>
          <div class="container">
              <div class="row">
                  <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                      <?=nl2br($post['postDescricao'])?>
                  </div>
              </div>
          </div>
      </article>

      <div id="modal-full" class="uk-modal-full" uk-modal esc-close="false">
              <div class="uk-modal-dialog">
                  <button class="uk-modal-close-full" type="button" uk-close></button>
                  <div class="uk-grid-collapse uk-child-width-1-2@s uk-flex-middle" uk-grid>
                      <div class="uk-background-cover" style="background-image: url('img/fundo.jpg');" uk-height-viewport></div>
                      <div class="uk-padding-large">
                        <p class="text-title-register">Entre com seu nome e email abaixo para acessar a pesquisa. Não se preocupe, não enviaremos nenhum SPAM! ;).</p>
                        <form class="form-horizontal" id="form3" onsubmit="cadastrarLeadPopupDetalhe(); return false;">
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

    <script type="text/javascript">
      function cadastrarLeadPopupDetalhe(){
          $(".uk-modal-close-full").fadeIn();
          setTimeout(function () {
                  $.ajax({
                      type: "POST",
                      url: "actions.php",
                      data: $("#form3").serialize(),
                      dataType: 'json',
                      processData: true,
                      success: function (data) {
                          //console.log(data);
                          $("#msg").html(data.message);
                          if(data.status){
                            $('#form3')[0].reset();
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
    </script>

    <?php include('footer.php'); setAccess(filter_input(INPUT_GET, 'url')); ?>

    <?php
      if(filter_input(INPUT_GET, "url") == "1-pergunta-sobre-financas-pessoais"){
        ?>
        <script>
          $("window").ready(function(){
            $("#modalBtn").trigger("click");
            $(".uk-modal-close-full").fadeOut();
          });
        </script>
        <?php
      }
    ?>

</body>
</html>
