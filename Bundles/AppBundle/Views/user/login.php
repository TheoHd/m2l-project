<?php
    use Core\Session\Session;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Connexion - M2L</title>
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
                M2L - Connection
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
                    <label for="">Adresse Email</label>
                    <input class="form-control" placeholder="Entrer votre adresse email" type="text" name="email">
                    <div class="pre-icon os-icon os-icon-user-male-circle"></div>
                </div>
                <div class="form-group">
                    <label for="">Mot de passe</label>
                    <input class="form-control" placeholder="Entrer votre mot de passe" type="password" name="password">
                    <div class="pre-icon os-icon os-icon-fingerprint"></div>
                </div>
                <div class="buttons-w">
                    <button class="btn btn-primary">Se connecter</button>
                    <div class="form-check-inline">
                        <small>
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" name="remember">Se souvenir de moi
                            </label>
                        </small>
                    </div>
                </div>
                <div style="text-align:center;margin-top: 50px;"><small><a href="<?= App::generateUrl('forgotPassword') ?>">Mot de passe oublié ?</a></small></div>
            </form>
        </div>
    </div>
</body>
</html>
