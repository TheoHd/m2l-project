<?php
    use Core\Session\Session;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Mot de passe oublié - M2L</title>
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
                M2L - Mot de passe oublié
            </h4>

            <?= $form->hasError() ? "<p class='alert-msg error-msg'>".$form->getErrors()."</p>" : '' ; ?>
            <?= $form->hasSuccess() ? "<p class='alert-msg success-msg'>".$form->getSuccess()."</p>" : '' ; ?>

            <?= $form->start() ?>
                <div class="form-group">
                    <?= $form->get('email') ?>
                    <div class="pre-icon os-icon os-icon-user-male-circle"></div>
                </div>
                <div class="buttons-w">
                    <?= $form->get('submit') ?>
                </div>
            <?= $form->end() ?>
            <div style="text-align:center;padding: 50px 0;"><small><a href="<?= App::generateUrl('login') ?>"><i class="fa fa-arrow-left"></i> Retour</a></small></div>
        </div>
    </div>
</body>
</html>
