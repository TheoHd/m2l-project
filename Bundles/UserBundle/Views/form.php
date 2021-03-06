<?php
    use Core\Session\Session;
?>
<html lang="fr"><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <?= App::getRessource('appBundle:js:jquery.min.js') ?>

    <title>Portfolio Test</title>

    <!-- Bootstrap core CSS -->
    <link href="<?= BASE_URL ?>/Public/Assets/css/bootstrap.css" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js"></script>
</head>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top" style="    position: relative;">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Portfolio Template</a>
        </div>
    </div>
</nav>

<div class="container" style="padding: 100px;">

    <div class="starter-template">
        <h1>Template test Framework</h1>
        <p class="lead">Use this document as a way to quickly start any new project.<br> All you get is this text and a mostly barebones HTML document.</p>

        <?php
            if( Session::hasFlashes('success') ) {
                echo Session::getFlash('success');
            }
        ?>
        <?= $form->start() ?>
        <?= $form->hasError() ? "<div class='alert alert-danger'><b>Veuillez corriger vos erreurs !</b></div>" : '' ; ?>
        <?= $form->foreach(function($index, $form){ ?>
                <div class="form-group">
                <?php
                    echo $form->get($index);
                    if($form->hasError($index)) :
                        echo "<small class='form-text text-danger'>{$form->getError($index)}</small>";
                    endif;
                ?>
                </div>
        <?php }); ?>
        <?= $form->end() ?>
    </div>

</div>


</body></html>