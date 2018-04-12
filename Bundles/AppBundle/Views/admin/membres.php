<?= App::render('appBundle:includes:header') ?>

    <div class="content-w">
        <ul class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= BASE_URL ?>">Accueil</a>
            </li>
            <li class="breadcrumb-item">
                <a href="#">Administration - Admin</a>
            </li>
            <li class="breadcrumb-item">
                <span>Membres</span>
            </li>
        </ul>

        <div class="element-box-tp">
            <div class="content-i" style="padding:20px;">

                <div class="element-wrapper">
                    <div class="element-box">
                        <h5 class="form-header">
                            Gestion des membres
                        </h5>
                        <div class="form-desc">
                            Listing de tout les membres (chef, salarié et administrateur inclus).
                            <br><br>
                            <code>Pour voir toutes les formations d'un membre, rendez-vous sur son profil.</code>
                        </div>
                        <form action="">
                            <input type="text" placeholder="Rechercher un membre (nom, prenom, email ...)" class="form-control">
                        </form>
                        <a href="<?= App::generateUrl('add_membre') ?>" class="btn btn-primary btn-sm">Créer un nouveau compte pour un salarié</a>
                    </div>
                </div>

                <?php if(count($membres) > 0) : ?>
                    <?php foreach($membres as $membre) : ?>
                    <div class="element-wrapper col-md-3" style="float: left;">
                        <div class="element-box full-chat-w">
                            <div class="user-intro">
                                <div class="avatar">
                                    <img alt="" src="<?= App::getRessource('appbundle:images:avatar1.jpg') ?>">
                                </div>
                                <div class="user-intro-info">
                                    <a href=""><h5 class="user-name"><?= $membre->getNom() ?></h5></a>
                                    <div class="user-sub"><?= $membre->getEmail() ?></div>
                                    <div class="user-social">
                                        <a href="<?= App::generateUrl('showUserProfil', ['id' => $membre->getId()]) ?>" class="btn btn-primary btn-sm">Voir le profil</a>
                                        <a href="<?= App::generateUrl('promote_user', ['id' => $membre->getId()]) ?>" class="btn btn-success btn-sm">Promouvoir</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="alert-msg info-msg">Aucun membre</div>
                <?php endif; ?>

            </div>
        </div>

    </div>

<?= App::render('appBundle:includes:footer') ?>