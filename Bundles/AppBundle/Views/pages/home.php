<?= App::render('appBundle:includes:header') ?>

    <div class="content-w">

        <div class="content-i" style="padding: 20px;">
            <div class="row">
                <div class="col-sm-12">
                    <div class="element-wrapper">
                        <h6 class="element-header">
                            Accueil - Dashboard
                        </h6>
                        <div class="element-box">
                            <div class="element-info">
                                <div class="row align-items-center">
                                    <div class="col-sm-8">
                                        <div class="element-info-with-icon">
                                            <div class="element-info-icon">
                                                <div class="os-icon os-icon-wallet-loaded"></div>
                                            </div>
                                            <div class="element-info-text">
                                                <h5 class="element-inner-header">Bonjour <code><?= explode(' ', $user->getNom())[0] ?></code>, comment allez-vous ?</h5>
                                                <div class="element-inner-desc">Bienvenue sur l'espace de la maison des ligues de lorraine.</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="element-search">
                                            <input placeholder="Rechercher une formation..." type="text" id="seachFormation">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row remove-ajax-search">
                                <div class="col-md-6 col-xl-4">
                                    <div class="row">
                                        <div class="col-sm-6 b-r b-b">
                                            <div class="el-tablo centered padded">
                                                <div class="value"><?= $nbFormations ?></div>
                                                <div class="label">Formations</div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 b-b">
                                            <div class="el-tablo centered padded">
                                                <div class="value"><?= $user->getCredits() ?></div>
                                                <div class="label">Crédits restants</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 b-r">
                                            <div class="el-tablo centered padded">
                                                <div class="value">4</div>
                                                <div class="label">Nouveaux messages</div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="el-tablo centered padded">
                                                <div class="value"><?= $user->getNbJour() ?></div>
                                                <div class="label">Jours restants</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-4">
                                    <div class="padded b-l b-r">
                                        <div class="element-info-with-icon smaller">
                                            <div class="element-info-icon">
                                                <div class="os-icon os-icon-bar-chart-stats-up"></div>
                                            </div>
                                            <div class="element-info-text">
                                                <h5 class="element-inner-header">Statistiques</h5>
                                                <div class="element-inner-desc">associé à votre compte</div>
                                            </div>
                                        </div>
                                        <div class="os-progress-bar blue">
                                            <div class="bar-labels">
                                                <div class="bar-label-left">
                                                    <span>Notes global</span>
                                                    <?php if($moyenne > 2.5) : ?>
                                                        <span class="positive"><i class="fa fa-thumbs-up"></i></span>
                                                    <?php else: ?>
                                                        <span class="negative"><i class="fa fa-thumbs-down"></i></span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="bar-label-right">
                                                    <span class="info"><?= $moyenne ?>/5</span>
                                                </div>
                                            </div>
                                            <div class="bar-level-1" style="width: 100%">
                                                <div class="bar-level-3" style="width: <?= $moyenne * 100 / 5 ?>%"></div>
                                            </div>
                                        </div>
                                        <div class="os-progress-bar blue">
                                            <div class="bar-labels">
                                                <div class="bar-label-left">
                                                    <span>Dernière note</span>
                                                    <?php if($lastNote > 2.5) : ?>
                                                        <span class="positive"><i class="fa fa-thumbs-up"></i></span>
                                                    <?php else: ?>
                                                        <span class="negative"><i class="fa fa-thumbs-down"></i></span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="bar-label-right">
                                                    <span class="info"><?= $lastNote ?>/5</span>
                                                </div>
                                            </div>
                                            <div class="bar-level-1" style="width: 100%">
                                                <div class="bar-level-3" style="width: <?= $lastNote * 100 / 5 ?>%"></div>
                                            </div>
                                        </div>
                                        <div class="os-progress-bar blue">
                                            <div class="bar-labels">
                                                <div class="bar-label-left">
                                                    <span>Avancement de votre profil</span>
                                                </div>
                                                <div class="bar-label-right">
                                                    <span class="info">70%</span>
                                                </div>
                                            </div>
                                            <div class="bar-level-1" style="width: 100%">
                                                <div class="bar-level-3" style="width: 70%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-4 activity-boxes-w">

                                            <div class="activity-box">
                                                <div class="activity-avatar">
                                                    <img alt="" src="<?= App::getRessource('appbundle:images:avatar2.jpg') ?>">
                                                </div>
                                                <div class="activity-info">
                                                    <div class="activity-role">
                                                        <?= $administrateur->getNom() ?>
                                                    </div>
                                                    <strong class="activity-title">Administrateur</strong>
                                                </div>
                                                <a href="" class="btn btn-sm btn-primary">Contacter</a>
                                            </div>

                                            <div class="activity-box">
                                                <div class="activity-avatar">
                                                    <img alt="" src="<?= App::getRessource('appbundle:images:avatar3.jpg') ?>">
                                                </div>
                                                <div class="activity-info">
                                                    <div class="activity-role">
                                                        <?= $chef->getNom() ?>
                                                    </div>
                                                    <strong class="activity-title">Chef</strong>
                                                </div>
                                                <a href="" class="btn btn-sm btn-primary">Contacter</a>
                                            </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="div-ajax-content-formations-load"></div>
                    <div class="element-wrapper remove-ajax-search">
                        <div class="element-box d-flex flex-wrap justify-content-around">

    <?php if(App::getUser()->hasRole('ROLE_ADMIN')) : ?>
        <!-- Salarié -->
        <a href="<?= App::generateUrl('add_membre') ?>" class="btn btn-success">Ajouter un membre</a>
        <a href="<?= App::generateUrl('add_formation') ?>" class="btn btn-success">Ajouter une formation</a>
        <a href="<?= App::generateUrl('add_prestataire') ?>" class="btn btn-success">Ajouter un prestataire</a>
        <a href="<?= App::generateUrl('showProfil') ?>" class="btn btn-warning">Modifier mon profil</a>
        <a href="http://baptiste-vasseur.fr" class="btn btn-danger">Retour Portfolio</a>

<?php elseif(App::getUser()->hasRole('ROLE_CHEF')) : ?>
        <!-- Chef -->
        <a href="<?= App::generateUrl('gestion_demand') ?>" class="btn btn-primary">Valider des demandes de formations</a>
        <a href="<?= App::generateUrl('add_membre') ?>" class="btn btn-success">Ajouter un membre</a>
        <a href="<?= App::generateUrl('gestion_equipe') ?>" class="btn btn-info">Gérer son équipe</a>
        <a href="<?= App::generateUrl('showProfil') ?>" class="btn btn-warning">Modifier mon profil</a>
        <a href="<?= App::generateUrl('contact') ?>" class="btn btn-danger">Signaler un problème</a>

<?php elseif(App::getUser()->hasRole('ROLE_SALARIE')) : ?>
         <!-- Admin -->
        <a href="<?= App::generateUrl('list_formations') ?>" class="btn btn-success">Postuler à une formation</a>
        <a href="<?= App::generateUrl('showProfil') ?>" class="btn btn-warning">Modifier mon profil</a>
        <a href="<?= App::generateUrl('history') ?>" class="btn btn-info">Voir mon historique</a>
        <a href="<?= App::generateUrl('messagerie') ?>" class="btn btn-primary">Contacter mon supérieur</a>
        <a href="<?= App::generateUrl('contact') ?>" class="btn btn-danger">Signaler un problème</a>
    <?php endif; ?>
                        </div>
                    </div>
                    <div class="element-wrapper remove-ajax-search">
                        <h6 class="element-header">
                            Les 3 dernières formations
                        </h6>
                        <div class="element-desc"></div>
                        <div class="projects-list">
                            <?php foreach ($last3formations as $formation) : ?>
                                <a href="<?= App::generateUrl('show_formation', ['id' => $formation->getId()]) ?>" class="project-box">
                                    <div class="project-head">
                                        <div class="project-title">
                                            <h5><?= $formation->getNom() ?></h5>
                                        </div>
                                        <!--                                        <div class="project-users">-->
                                        <!--                                            <div class="avatar">-->
                                        <!--                                                <img alt="" src="--><?//= App::getRessource('appBundle:images:avatar3.jpg') ?><!--">-->
                                        <!--                                            </div>-->
                                        <!--                                            <div class="avatar">-->
                                        <!--                                                <img alt="" src="--><?//= App::getRessource('appBundle:images:avatar1.jpg') ?><!--">-->
                                        <!--                                            </div>-->
                                        <!--                                            <div class="avatar">-->
                                        <!--                                                <img alt="" src="--><?//= App::getRessource('appBundle:images:avatar5.jpg') ?><!--">-->
                                        <!--                                            </div>-->
                                        <!--                                            <div class="avatar">-->
                                        <!--                                                <img alt="" src="--><?//= App::getRessource('appBundle:images:avatar2.jpg') ?><!--">-->
                                        <!--                                            </div>-->
                                        <!--                                            <div class="more">-->
                                        <!--                                                + 5 Participants-->
                                        <!--                                            </div>-->
                                        <!--                                        </div>-->
                                    </div>
                                    <div class="project-info">
                                        <div class="row align-items-center">
                                            <div class="col-sm-5">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="el-tablo highlight">
                                                            <div class="label">Crédits</div>
                                                            <div class="value"><?= $formation->getPrerequis() ?></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="el-tablo highlight">
                                                            <div class="label">Durée</div>
                                                            <div class="value"><?= $formation->getDuree() ?>J</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-5 offset-sm-2">
                                                <div class="os-progress-bar blue">
                                                    <div class="bar-labels">
                                                        <div class="bar-label-left">
                                                            <span>Difficulté</span>
                                                        </div>
                                                        <div class="bar-label-right">
                                                            <span class="info"><?= $formation->noteTitle ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="bar-level-1" style="width: 100%">
                                                        <div class="bar-level-3" style="width: <?= $formation->notePercent ?>%"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            <?php endforeach; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        $('#seachFormation').keyup(function(e){
            val = $(this).val();
            if(val.length > 2){
                $('.remove-ajax-search').remove();
                $('#element-info').remove();
                $.post("<?= App::generateUrl('search_formations') ?>", {search: val}, function(donnees){
                    $('#div-ajax-content-formations-load').html(donnees);
                });
            }
        })
    </script>

<?= App::render('appBundle:includes:footer') ?>