<?php include('head.php'); ?>
<?php
    include('first/functions.php'); 
    $post = gettblPostUrl(filter_input(INPUT_GET, 'url'));
?>

<body>
    <header>
        <nav class="navbar navbar-default">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
                <a class="navbar-brand" href="#"><img src="Logo.png" width="280px" alt=""></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a class="link" href="/">Home </br><span class="glyphicon glyphicon-home"></span></a></li>
                    <li><a class="link " href="#">Assine Nosso Blog <br> <span class="glyphicon glyphicon-pencil"></span></a></li>
                </ul>
            </div>
        </nav>
        <section class="intro-header" style="background-image: url('first/upload/img/tblPost/<?=$post['postImagem']?>')">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                            <div class="post-heading">
                                <h1><?=$post['postTitulo']?></h1>
                                <!--<h2 class="subheading">Subtitle</h2>-->
                                <span class="meta">Posted on <?=$post['postData']?></span>
                            </div>
                        </div>
                    </div>
                </div>
        </section>

    </header>

    <section class="main_post_description">

      <article>
          <div class="container">
              <div class="row">
                  <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                      <?=nl2br($post['postDescricao'])?>
                  </div>
              </div>
          </div>
      </article>
    </section>

    
    <?php include('footer.php'); ?>


</body>

</html>
