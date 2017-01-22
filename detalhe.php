<!DOCTYPE html>
<html lang="en">
<?php
    include('first/functions.php'); 
    $post = gettblPostUrl(filter_input(INPUT_GET, 'url'));
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/uikit.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
    <title>PLANEJECONQUISTE</title>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-90726734-1', 'auto');
  ga('send', 'pageview');

</script>
</head>

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
                    <li><a class="link" href="#">Home </br><span class="glyphicon glyphicon-home"></span></a></li>
                    <li><a class="link" href="#">Blog <br> <span class="glyphicon glyphicon-book"></span></a></li>
                    <li><a class="link " href="#">Assine Nosso Blog <br> <span class="glyphicon glyphicon-pencil"></span></a></li>
                </ul>
            </div>
        </nav>
        <section class="intro-header" style="background-image: url('first/<?=$post['postImagem']?>)">
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

    <footer>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-4">
                    <a href="#"><img src="Logo.png" width="280px" alt=""></a>
                </div>
                <div class="col-md-8 links_footer">
                    <div class="col-md-4"><a href="">SOBRE O BLOG</a></div>
                    <div class="col-md-4"><a href="">FINANÇAS PESSOAIS</a></div>
                    <div class="col-md-4"><a href="">MATERIAIS GRATUITOS</a></div>
                </div>
            </div>
        </div>
    </footer>

    <p class="text-center">@2017Planejeconquiste. Todos os direitos reservados.</p>

    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <script type="text/javascript" src="js/uikit.min.js"></script>

</body>

</html>
