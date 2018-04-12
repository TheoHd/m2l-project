<?php
use Core\Config\Config;
?>
<div>
    Bonjour <?= $user->getNom() ?>
    <br>
    <br>Votre candidature pour la formation <b><?= $formation->getNom() ?></b> à été accepté.
    <br>Vous recevrez d'ici quelques jours un email contenant plus d'informations.
    <br>
    <br>Bien Cordialement,
    <br><?= Config::get('app:Email_Signature') ?>
</div>
