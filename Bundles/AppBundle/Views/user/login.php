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
    <style>
        label[for='loginform_remember']{
            margin-bottom:0;
        }
        #loginform_submit{
            display: inline-block;
        }
    </style>
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

            <div class="container">
                <?= Session::hasFlashes('error') ? "<p class='alert-msg error-msg'>".Session::getFlash('error')."</p>" : '' ; ?>
                <?= Session::hasFlashes('success') ? "<p class='alert-msg success-msg'>".Session::getFlash('success')."</p>" : '' ; ?>

                <?= $form->hasError() ? "<p class='alert-msg error-msg'>".$form->getErrors()."</p>" : '' ; ?>
                <?= $form->hasSuccess() ? "<p class='alert-msg success-msg'>".$form->getSuccess()."</p>" : '' ; ?>
            </div>

            <?php

            $form->beforeSurround = "";
            $form->afterSurround = "";

            ?>

            <?= $form->start() ?>
                <div class="form-group">
                    <?= $form->get('email') ?>
                    <div class="pre-icon os-icon os-icon-user-male-circle"></div>
                </div>
                <div class="form-group">
                    <?= $form->get('password') ?>
                    <div class="pre-icon os-icon os-icon-fingerprint"></div>
                </div>
                <div class="buttons-w">
                    <?= $form->get('submit') ?>
                    <div class="form-check-inline">
                        <small>
                            <label class="form-check-label" style="padding-left:0;">
                                <?= $form->get('remember') ?>
                            </label>
                        </small>
                    </div>
                </div>
                <div style="text-align:center;margin-top: 50px;"><small><a href="<?= App::generateUrl('forgotPassword') ?>">Mot de passe oublié ?</a></small></div>
            <?= $form->end() ?>
        </div>
    </div>
</body>
</html>
