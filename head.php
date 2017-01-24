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
    ?>

    <meta property="og:locale" content="pt_BR">
    <meta property="og:url" content="<?=$page?>"/>
    <meta property="og:title" content="<?=$title?>">
    <meta property="og:site_name" content="PlanejeConquiste">
    <meta property="og:description" content="<?=$desc?>">
    <meta property="og:image" content="<?=$img?>"/>
    <meta property="og:image:type" content="png">
    <meta property="og:image:width" content="800">
    <meta property="og:image:height" content="600">

    <!--

    <meta name="description" content="<?=$desc?>">
    <meta property="og:type" content="article">
    <meta property="og:title" content="<?=$title?>">
    <meta property="og:image" content="<?=$img?>"/>
    <meta property="og:description" content="<?=$desc?>"/>
    <meta property="og:url" content="<?=$page?>"/>

    -->

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
</head>

<link href="https://fonts.googleapis.com/css?family=Krona+One" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
