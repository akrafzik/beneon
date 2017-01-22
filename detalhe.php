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
    <base href="/">
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
        <section class="intro-header" style="background-image: url('img/cover.jpg')">
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
                      <p>Never in all their history have men been able truly to conceive of the world as one: a single sphere, a globe, having the qualities of a globe, a round earth in which all the directions eventually meet, in which there is no center because every point, or none, is center — an equal earth which all men occupy as equals. The airman's earth, if free men make it, will be truly round: a globe in practice, not in theory.</p>

                      <p>Science cuts two ways, of course; its products can be used for both good and evil. But there's no turning back from science. The early warnings about technological dangers also come from science.</p>

                      <p>What was most significant about the lunar voyage was not that man set foot on the Moon but that they set eye on the earth.</p>

                      <p>A Chinese tale tells of some men sent to harm a young girl who, upon seeing her beauty, become her protectors rather than her violators. That's how I felt seeing the Earth for the first time. I could not help but love and cherish her.</p>

                      <p>For those who have seen the Earth from space, and for the hundreds and perhaps thousands more who will, the experience most certainly changes your perspective. The things that we share in our world are far more valuable than those which divide us.</p>

                      <h2 class="section-heading">The Final Frontier</h2>

                      <p>There can be no thought of finishing for ‘aiming for the stars.’ Both figuratively and literally, it is a task to occupy the generations. And no matter how much progress one makes, there is always the thrill of just beginning.</p>

                      <p>There can be no thought of finishing for ‘aiming for the stars.’ Both figuratively and literally, it is a task to occupy the generations. And no matter how much progress one makes, there is always the thrill of just beginning.</p>

                      <blockquote>The dreams of yesterday are the hopes of today and the reality of tomorrow. Science has not yet mastered prophecy. We predict too much for the next year and yet far too little for the next ten.</blockquote>

                      <p>Spaceflights cannot be stopped. This is not the work of any one man or even a group of men. It is a historical process which mankind is carrying out in accordance with the natural laws of human development.</p>

                      <h2 class="section-heading">Reaching for the Stars</h2>

                      <p>As we got further and further away, it [the Earth] diminished in size. Finally it shrank to the size of a marble, the most beautiful you can imagine. That beautiful, warm, living object looked so fragile, so delicate, that if you touched it with a finger it would crumble and fall apart. Seeing this has to change a man.</p>

                      <a href="#">
                          <img class="img-responsive" src="img/midle.jpg" alt="">
                      </a>
                      <span class="caption text-muted">To go places and do things that have never been done before – that’s what living is all about.</span>

                      <p>Space, the final frontier. These are the voyages of the Starship Enterprise. Its five-year mission: to explore strange new worlds, to seek out new life and new civilizations, to boldly go where no man has gone before.</p>

                      <p>As I stand out here in the wonders of the unknown at Hadley, I sort of realize there’s a fundamental truth to our nature, Man must explore, and this is exploration at its greatest.</p>

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
