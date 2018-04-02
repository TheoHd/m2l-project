<?php
    use Core\Session\Session;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Inscription - M2L</title>
    <meta charset="utf-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <meta content="Admin dashboard html template" name="description">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <?= App::getRessource('appBundle:css:main.css') ?>
</head>
<body class="auth-wrapper">
<div class="all-wrapper menu-side with-pattern">
    <div class="auth-box-w">
        <div class="logo-w">
            <a href="<?= BASE_URL ?>"><img alt="" src="<?= App::getRessource('appBundle:images:logo-big.png') ?>"></a>
        </div>
        <h4 class="auth-header">
            M2L - Inscription
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
                <label for="">Nom Complet</label>
                <input class="form-control" placeholder="Entrer votre nom complet" type="text" name="nom">
                <div class="pre-icon os-icon os-icon-email-2-at2"></div>
            </div>
            <div class="form-group">
                <label for="">Adresse Email</label>
                <input class="form-control" placeholder="Entrer votre adresse email" type="email" name="email">
                <div class="pre-icon os-icon os-icon-email-2-at2"></div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="">Mot de passe</label>
                        <input class="form-control" placeholder="Mot de passe" type="password" name="password">
                        <div class="pre-icon os-icon os-icon-fingerprint"></div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="">Vérification</label>
                        <input class="form-control" placeholder="Mot de passe" type="password" name="repeatPassword">
                    </div>
                </div>
            </div>

            <div class="buttons-w">
                <button class="btn btn-primary">S'inscrire</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
