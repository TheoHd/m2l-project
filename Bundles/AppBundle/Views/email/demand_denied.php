<?php
    use Core\Config\Config;
?>
<div>
    Bonjour <?= $user->getNom() ?>
    <br>
    <br>Votre candidature pour la formation <b><?= $formation->getNom() ?></b> à été refusé.
    <br>Si vous pensez qu'il s'agit d'une erreur, n'hésiter pas à nous recontacter.
    <br>
    <br>Bien Cordialement,
    <br><?= Config::get('app:Email_Signature') ?>
</div>
