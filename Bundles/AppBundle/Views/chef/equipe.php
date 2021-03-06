<?= App::render('appBundle:includes:header') ?>

    <div class="content-w">
        <ul class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= BASE_URL ?>">Accueil</a>
            </li>
            <li class="breadcrumb-item">
                <a href="#">Administration - Chef</a>
            </li>
            <li class="breadcrumb-item">
                <span>Equipes</span>
            </li>
        </ul>

        <div class="element-box-tp">
            <div class="content-i" style="padding:20px;">

                <div class="element-wrapper">
                    <div class="element-box">
                        <h5 class="form-header">
                            Gestion des salariés
                        </h5>
                        <div class="form-desc">
                            Voici la liste des salarié associé à votre équipe. Vous pouvez en ajouter, en supprimer, les contacter et voir leurs profils.
                            <br>
                            <br>
                            <a href="<?= App::generateUrl('add_membre') ?>" class="btn btn-primary btn-sm">Créer un nouveau compte pour un salarié</a>
                            <a href="" class="btn btn-info btn-sm">Ajouter une personne existante à mon équipe</a>
                        </div>
                    </div>
                </div>

                <?php foreach($employes as $employe) : ?>
                <div style="float:left; height: 141px;" class="profile-tile col-md-4">
                    <div class="profile-tile-box">
                        <div class="pt-avatar-w">
                            <img alt="" src="<?= App::getRessource('appbundle:images:avatar1.jpg') ?>">
                        </div>
                        <div class="pt-user-name">
                            <?= $employe->getNom() ?>
                        </div>
                    </div>
                    <div class="profile-tile-meta">
                        <ul>
                            <li>Email:<strong><?= $employe->getEmail() ?></strong></li>
                            <li>Crédits:<strong><?= $employe->getCredits() ?></strong></li>
                            <li>Jours restants:<strong><?= $employe->getNbJour() ?></strong></li>
                        </ul>
                        <a class="btn btn-info btn-sm" href="#">Voir</a>
                        <a class="btn btn-success btn-sm" href="#">Contacter</a>
                        <a class="btn btn-danger btn-sm" href="#">Supprimer</a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>

<?= App::render('appBundle:includes:footer') ?>