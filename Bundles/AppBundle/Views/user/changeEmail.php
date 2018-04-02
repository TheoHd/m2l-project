<?php
    use Core\Session\Session;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Changement du mot de passe - M2L</title>
    <meta charset="utf-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <meta content="Admin dashboard html template" name="description">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <?= App::getRessource('appBundle:css:main.css') ?>
</head>
<body class="auth-wrapper">
    <div class="all-wrapper menu-side with-pattern">
        <div class="auth-box-w">
            <div class="logo-w">
                <a href="<?= BASE_URL ?>"><img alt="" src="<?= App::getRessource('appBundle:images:logo-big.png') ?>"></a>
            </div>
            <h4 class="auth-header">
                M2L - Adresse email
            </h4>
            <?php
                if( Session::hasFlashes('error') ) {
                    echo  "<p class='alert-msg error-msg'>".Session::getFlash('error')."</p>";
                }
                if( Session::hasFlashes('success') ) {
                    echo  "<p class='alert-msg success-msg'>".Session::getFlash('success')."</p>";
                }
            ?>
            <form action="" method="post">
                <div class="form-group">
                    <label for="">Ancienne adresse email</label><input class="form-control" placeholder="Entrer votre ancienne adresse email" type="email" disabled="disabled" value="<?= App::getUser()->getEmail() ?>">
                    <div class="pre-icon os-icon os-icon-user-male-circle"></div>
                </div>
                <div class="form-group">
                    <label for="">Nouvelle adresse email</label><input class="form-control" placeholder="Entrer votre nouvelle adresse email" type="email" name="newEmail">
                    <div class="pre-icon os-icon os-icon-user-male-circle"></div>
                </div>
                <div class="buttons-w">
                    <button class="btn btn-primary">Modifier mon adresse email</button>
                </div>
            </form>
            <div style="text-align:center;padding: 50px 0;"><small><a href="<?= App::generateUrl('showProfil') ?>"><i class="fa fa-arrow-left"></i> Retour</a></small></div>
        </div>
    </div>
</body>
</html>
