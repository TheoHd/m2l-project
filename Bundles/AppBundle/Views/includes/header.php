<!DOCTYPE html>
<html lang="fr">
  <head>
    <title><?= App::getConfig()::get('app:siteName') ?></title>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link href="favicon.png" rel="shortcut icon">
    <link href="apple-touch-icon.png" rel="apple-touch-icon">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <?= App::getRessource('appBundle:css:main.css') ?>
      <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  </head>
  <body>
    <div class="all-wrapper menu-side with-side-panel">
      <div class="layout-w">
        <?= App::render('appBundle:includes:sidebar') ?>
      