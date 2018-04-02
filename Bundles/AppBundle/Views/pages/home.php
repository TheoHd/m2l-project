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
                                                <h5 class="element-inner-header">Bonjour <code>Baptiste</code>, comment allez-vous ?</h5>
                                                <div class="element-inner-desc">Bienvenue sur l'espace de la maison des ligues de lorraine.</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="element-search">
                                            <input placeholder="Rechercher une formation..." type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-xl-4">
                                    <div class="row">
                                        <div class="col-sm-6 b-r b-b">
                                            <div class="el-tablo centered padded">
                                                <div class="value">24</div>
                                                <div class="label">Formations</div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 b-b">
                                            <div class="el-tablo centered padded">
                                                <div class="value">2300</div>
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
                                                <div class="value">12</div>
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
                                                    <span>Notes global</span><span class="positive"><i class="fa fa-thumbs-up"></i></span>
                                                </div>
                                                <div class="bar-label-right">
                                                    <span class="info">4.5/5</span>
                                                </div>
                                            </div>
                                            <div class="bar-level-1" style="width: 100%">
                                                <div class="bar-level-3" style="width: 90%"></div>
                                            </div>
                                        </div>
                                        <div class="os-progress-bar blue">
                                            <div class="bar-labels">
                                                <div class="bar-label-left">
                                                    <span>Dernière note</span><span class="negative"><i class="fa fa-thumbs-down"></i></span>
                                                </div>
                                                <div class="bar-label-right">
                                                    <span class="info">1.5/5</span>
                                                </div>
                                            </div>
                                            <div class="bar-level-1" style="width: 100%">
                                                <div class="bar-level-3" style="width: 30%"></div>
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
                                                        John Mayers
                                                    </div>
                                                    <strong class="activity-title">Posted Comment</strong>
                                                </div>
                                                <a href="" class="btn btn-sm btn-primary">Contacter</a>
                                            </div>

                                            <div class="activity-box">
                                                <div class="activity-avatar">
                                                    <img alt="" src="<?= App::getRessource('appbundle:images:avatar3.jpg') ?>">
                                                </div>
                                                <div class="activity-info">
                                                    <div class="activity-role">
                                                        Kate Wallet
                                                    </div>
                                                    <strong class="activity-title">Opened New Account</strong>
                                                </div>
                                                <a href="" class="btn btn-sm btn-primary">Contacter</a>
                                            </div>



                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="element-wrapper">
                        <div class="element-box d-flex flex-wrap justify-content-around">
                            <!-- Salarié -->
                            <a href="" class="btn btn-success">Postuler à une formation</a>
                            <a href="" class="btn btn-warning">Modifier mon profil</a>
                            <a href="" class="btn btn-info">Voir mon historique</a>
                            <a href="" class="btn btn-primary">Contacter mon supérieur</a>
                            <a href="" class="btn btn-danger">Signaler un problème</a>
                            <!-- Chef -->
<!--                            <a href="" class="btn btn-primary">Valider des demandes de formations</a>-->
<!--                            <a href="" class="btn btn-success">Ajouter un membre</a>-->
<!--                            <a href="" class="btn btn-info">Gérer son équipe</a>-->
<!--                            <a href="" class="btn btn-warning">Modifier mon profil</a>-->
<!--                            <a href="" class="btn btn-danger">Signaler un problème</a>-->
                            <!-- Admin -->
<!--                            <a href="" class="btn btn-success">Ajouter un membre</a>-->
<!--                            <a href="" class="btn btn-success">Ajouter une formation</a>-->
<!--                            <a href="" class="btn btn-success">Ajouter un prestataire</a>-->
<!--                            <a href="" class="btn btn-warning">Modifier mon profil</a>-->
<!--                            <a href="" class="btn btn-danger">Retour Portfolio</a>-->
                        </div>
                    </div>
                    <div class="element-wrapper">
                        <h6 class="element-header">
                            Les 3 dernières formations
                        </h6>
                        <div class="element-desc"></div>
                        <div class="projects-list">
                            <div class="project-box">
                                <div class="project-head">
                                    <div class="project-title">
                                        <h5>Formation Google - <small><a href="" style="letter-spacing:0;text-transform:none;">Ajouter un avis</a></small></h5>
                                    </div>
                                    <div class="project-users">
                                        <div class="avatar">
                                            <img alt="" src="http://localhost/m2l-project/Bundles/AppBundle/Assets/images/avatar3.jpg">
                                        </div>
                                        <div class="avatar">
                                            <img alt="" src="http://localhost/m2l-project/Bundles/AppBundle/Assets/images/avatar1.jpg">
                                        </div>
                                        <div class="avatar">
                                            <img alt="" src="http://localhost/m2l-project/Bundles/AppBundle/Assets/images/avatar5.jpg">
                                        </div>
                                        <div class="avatar">
                                            <img alt="" src="http://localhost/m2l-project/Bundles/AppBundle/Assets/images/avatar2.jpg">
                                        </div>
                                        <div class="more">
                                            + 5 Participants
                                        </div>
                                    </div>
                                </div>
                                <div class="project-info">
                                    <div class="row align-items-center">
                                        <div class="col-sm-5">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="el-tablo highlight">
                                                        <div class="label">Crédits</div>
                                                        <div class="value">700</div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="el-tablo highlight">
                                                        <div class="label">Durée</div>
                                                        <div class="value">2J</div>
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
                                                        <span class="info">Intermédiaire</span>
                                                    </div>
                                                </div>
                                                <div class="bar-level-1" style="width: 100%">
                                                    <div class="bar-level-3" style="width: 75%"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="project-box">
                                <div class="project-head">
                                    <div class="project-title">
                                        <h5>Formation Google - <small><a href="" style="letter-spacing:0;text-transform:none;">Ajouter un avis</a></small></h5>
                                    </div>
                                    <div class="project-users">
                                        <div class="avatar">
                                            <img alt="" src="http://localhost/m2l-project/Bundles/AppBundle/Assets/images/avatar3.jpg">
                                        </div>
                                        <div class="avatar">
                                            <img alt="" src="http://localhost/m2l-project/Bundles/AppBundle/Assets/images/avatar1.jpg">
                                        </div>
                                        <div class="avatar">
                                            <img alt="" src="http://localhost/m2l-project/Bundles/AppBundle/Assets/images/avatar5.jpg">
                                        </div>
                                        <div class="avatar">
                                            <img alt="" src="http://localhost/m2l-project/Bundles/AppBundle/Assets/images/avatar2.jpg">
                                        </div>
                                        <div class="more">
                                            + 5 Participants
                                        </div>
                                    </div>
                                </div>
                                <div class="project-info">
                                    <div class="row align-items-center">
                                        <div class="col-sm-5">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="el-tablo highlight">
                                                        <div class="label">Crédits</div>
                                                        <div class="value">700</div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="el-tablo highlight">
                                                        <div class="label">Durée</div>
                                                        <div class="value">2J</div>
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
                                                        <span class="info">Intermédiaire</span>
                                                    </div>
                                                </div>
                                                <div class="bar-level-1" style="width: 100%">
                                                    <div class="bar-level-3" style="width: 75%"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="project-box">
                                <div class="project-head">
                                    <div class="project-title">
                                        <h5>Formation Google - <small><a href="" style="letter-spacing:0;text-transform:none;">Ajouter un avis</a></small></h5>
                                    </div>
                                    <div class="project-users">
                                        <div class="avatar">
                                            <img alt="" src="http://localhost/m2l-project/Bundles/AppBundle/Assets/images/avatar3.jpg">
                                        </div>
                                        <div class="avatar">
                                            <img alt="" src="http://localhost/m2l-project/Bundles/AppBundle/Assets/images/avatar1.jpg">
                                        </div>
                                        <div class="avatar">
                                            <img alt="" src="http://localhost/m2l-project/Bundles/AppBundle/Assets/images/avatar5.jpg">
                                        </div>
                                        <div class="avatar">
                                            <img alt="" src="http://localhost/m2l-project/Bundles/AppBundle/Assets/images/avatar2.jpg">
                                        </div>
                                        <div class="more">
                                            + 5 Participants
                                        </div>
                                    </div>
                                </div>
                                <div class="project-info">
                                    <div class="row align-items-center">
                                        <div class="col-sm-5">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="el-tablo highlight">
                                                        <div class="label">Crédits</div>
                                                        <div class="value">700</div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="el-tablo highlight">
                                                        <div class="label">Durée</div>
                                                        <div class="value">2J</div>
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
                                                        <span class="info">Intermédiaire</span>
                                                    </div>
                                                </div>
                                                <div class="bar-level-1" style="width: 100%">
                                                    <div class="bar-level-3" style="width: 75%"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

<?= App::render('appBundle:includes:footer') ?>