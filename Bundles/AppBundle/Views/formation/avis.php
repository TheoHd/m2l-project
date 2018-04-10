<?php
    use Core\Session\Session;
    use Core\Utils\Utils;
?>

<?= App::render('appBundle:includes:header') ?>

    <div class="content-w">
        <ul class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= BASE_URL ?>">Accueil</a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= App::generateUrl('list_formations') ?>">Formations</a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= App::generateUrl('show_formation', ['id' => $formation->getId()]) ?>"><?= $formation->getNom() ?></a>
            </li>
            <li class="breadcrumb-item">
                <span>Avis</span>
            </li>
        </ul>

        <div class="content-i" style="padding: 20px;">
            <div class="content-box">
                <div class="element-wrapper">
                    <div class="element-box">
                        <h5 class="form-header">
                            Avis : <code>Formation Google</code>
                        </h5>
                        <?php if($authorizeNewAvis) : ?>
                            <a href="<?= App::generateUrl('add_avis', ['formation' => $formation->getId()]) ?>" class="btn btn-success btn-sm">Ajouter mon avis sur la formation</a>
                        <?php endif; ?>

                        <?= Session::hasFlashes('success') ? "<p class='alert-msg success-msg'>".Session::getFlash('success')."</p>" : '' ; ?>
                    </div>
                </div>
                <div class="element-wrapper">

                    <?php foreach ($avis as $a) : ?>
                    <div class="aec-full-message-w">
                        <div class="aec-full-message">
                            <div class="message-head">
                                <div class="user-w with-status status-green">
                                    <div class="user-avatar-w">
                                        <div class="user-avatar">
                                            <img alt="" src="<?= App::getRessource('appbundle:images:avatar1.jpg') ?>">
                                        </div>
                                    </div>
                                    <div class="user-name">
                                        <h6 class="user-title"><?= $a->getUser()->getNom() ?></h6>
                                        <div class="user-role">Salarié<span>&lt; <?= $a->getUser()->getEmail() ?> &gt;</span></div>
                                    </div>
                                </div>
                                <div class="message-info"><?= Utils::format_date($a->getDate(), 3) ?><br> à <?= Utils::format_date($a->getDate(), 5) ?></div>
                            </div>
                            <div class="message-content">
                               <?= $a->getContent() ?>

                                <div class="message-attachments">
                                    <div class="attachments-heading">Notes</div>
                                    <div class="attachments-docs">
                                        <?php
                                            for($i = 1; $i <= 5; $i++){
                                                $class = ($i <= $a->getNote()) ? 'start-active' : '' ;
                                                echo '<span class="star '.$class.'"><i class="fa fa-star"></i></span>';
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

<?= App::render('appBundle:includes:footer') ?>