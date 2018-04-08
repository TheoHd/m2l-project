<?php
    use Core\Config\Config;
?>
<div>
    Bonjour <b><?= $nom ?></b>
    <br>
    <br>Votre adresse email vient d'être modifié (adresse ip : <b><?= $ip ?></b>).
    <br>
    <br><b><?= $oldEmail ?></b> à bien été supprimer de notre base donnée.
    <br>Votre nouvelle adresse email est <b> <?= $newEmail ?></b>
    <br>
    <br><small>Si vous n'êtes pas à l'origine de ce changement, nous vous invitons à immédiatement changer votre mot de passe.</small>
    <br><small>N'hésitez pas à nous contacter en cas de problèmes.</small>
    <br>
    <br>Cordialement,
    <br><?= Config::get('app:Email_Signature') ?>
</div>