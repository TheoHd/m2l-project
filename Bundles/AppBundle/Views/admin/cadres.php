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
                <span>Cadres</span>
            </li>
        </ul>

        <div class="element-box-tp">
            <div class="content-i" style="padding:20px;">

                <div class="element-wrapper">
                    <div class="element-box">
                        <h5 class="form-header">
                            Gestion des chefs / cadres
                        </h5>
                        <div class="form-desc">
                            Lors de la déchéance d'un chef, les demandes faites pas les membres de son équipe ne pourront être validé que par un administrateur.
                            <br><br>
                            <code>Chaques équipes doit bénéficier d'un chef afin que celui-ci puisse valider les demandes.</code>
                            <br><br>
                            <a href="<?= App::generateUrl('list_membres') ?>" class="btn btn-primary btn-sm">Ajouter un cadre</a>
                        </div>
                        <form action="">
                            <input type="text" placeholder="Rechercher un chef/cadre..." class="form-control">
                        </form>
                    </div>
                </div>

                <?php foreach($cadres as $cadre) : ?>
                <div class="element-wrapper col-md-3" style="float: left;">
                    <div class="element-box full-chat-w">
                        <div class="user-intro">
                            <div class="avatar">
                                <img alt="" src="<?= App::getRessource('appbundle:images:avatar1.jpg') ?>">
                            </div>
                            <div class="user-intro-info">
                                <a href=""><h5 class="user-name"><?= $cadre->getNom() ?></h5></a>
                                <div class="user-sub"><?= $cadre->getEmail() ?></div>
                                <div class="user-social">
                                    <a href="<?= App::generateUrl('list_equipe', ['id' => $cadre->getId()]) ?>" class="btn btn-primary btn-sm">Voir l'équipe</a>
                                    <a href="<?= App::generateUrl('demote_user', ['id' => $cadre->getId()]) ?>" class="btn btn-danger btn-sm btn-demote">Rétrograder</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>


            </div>
        </div>

    </div>

    <script>
        $('.btn-demote').click(function(e){
           return confirm('En rétrogradant cet utilisateur, les membres associés à son équipe se retrouveront sans équipe, voulez-vous continuer ?');
        });
    </script>
<?= App::render('appBundle:includes:footer') ?>