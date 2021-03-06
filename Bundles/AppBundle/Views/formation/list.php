<?php use Core\Config\Config; ?>

<?= App::render('appBundle:includes:header') ?>

    <div class="content-w">
        <div class="top-menu-secondary">
            <ul>
                <li class="active"><a href="#">Toutes</a></li>
                <li><a href="#">En cours</a></li>
                <li><a href="#">Terminées</a></li>
                <li><a href="#">Annulées</a></li>
                <li><a href="#">Reportées</a></li>
            </ul>
        </div>
        <div class="content-i">
            <div class="content-box">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="padded-lg">
                            <div class="projects-list" id="projects-list">

                                <?php foreach ($formations as $formation) : ?>
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
                    <div class="col-lg-5 b-l-lg">
                        <div class="padded-lg">
                            <div class="element-wrapper">
                                <h6 class="element-header">
                                    Rechercher une formation
                                </h6>
                                <div class="element-box">
                                    <div class="col-sm-12">
                                        <div class="element-search">
                                            <input placeholder="Rechercher une formation..." type="text" id="seachFormation">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="element-wrapper">
                                <h6 class="element-header">
                                    Informations
                                </h6>
                                <div class="element-box">
                                    <div class="padded m-b">
                                        <div class="centered-header">
                                            <h6>
                                                Statistiques
                                            </h6>
                                        </div>
                                        <div class="row">
                                            <div class="col-6 b-r b-b">
                                                <div class="el-tablo centered padded-v-big highlight bigger">
                                                    <div class="label">
                                                        <small>Mes formations</small>
                                                    </div>
                                                    <div class="value"><?= $nbFormation ?></div>
                                                </div>
                                            </div>
                                            <div class="col-6 b-b">
                                                <div class="el-tablo centered padded-v-big highlight bigger">
                                                    <div class="label">
                                                        <small>Total Jours</small>
                                                    </div>
                                                    <div class="value"><?= $totalDays ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="padded m-b">
                                        <div class="centered-header">
                                            <h6>
                                                Avancement
                                            </h6>
                                        </div>
                                        <div class="os-progress-bar blue">
                                            <div class="bar-labels">
                                                <div class="bar-label-left">
                                                    <span>Avancement de votre Profil</span><span class="positive">+40</span>
                                                </div>
                                                <div class="bar-label-right">
                                                    <span class="info">72/100</span>
                                                </div>
                                            </div>
                                            <div class="bar-level-1" style="width: 100%">
                                                <div class="bar-level-2" style="width: 80%">
                                                    <div class="bar-level-3" style="width: 30%"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="os-progress-bar blue">
                                            <div class="bar-labels">
                                                <div class="bar-label-left">
                                                    <span>Crédits restants</span><span class="negative">-500</span>
                                                </div>
                                                <div class="bar-label-right">
                                                    <span class="info"><?= $user->getCredits() ?>/<?= Config::get('app:site_maxCredits') ?></span>
                                                </div>
                                            </div>
                                            <div class="bar-level-1" style="width: 100%">
                                                <div class="bar-level-3" style="width: <?= $user->getCredits() * 100 / Config::get('app:site_maxCredits') ?>%">
                                                    <!--                                                    <div class="bar-level-3" style="width: 10%"></div>-->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="os-progress-bar blue">
                                            <div class="bar-labels">
                                                <div class="bar-label-left">
                                                    <span>Jours restants</span><span class="negative">-2</span>
                                                </div>
                                                <div class="bar-label-right">
                                                    <span class="info"><?= $user->getNbJour() ?>/<?= Config::get('app:site_maxJours') ?></span>
                                                </div>
                                            </div>
                                            <div class="bar-level-1" style="width: 100%">
                                                <div class="bar-level-3" style="width: <?= $user->getNbJour() * 100 / Config::get('app:site_maxJours') ?>%">
                                                    <!--                                                    <div class="bar-level-3" style="width: 90%"></div>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="element-box">
                                    <div class="padded m-b">
                                        <div class="centered-header">
                                            <h6>Un problème ?</h6>
                                        </div>
                                        <br>
                                        <a href="<?= App::generateUrl('contact') ?>" class="btn btn-primary" style="display: block;">Contactez-nous</a>
                                    </div>
                                </div>
                            </div>
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
                $.post("<?= App::generateUrl('search_formations_salarie') ?>", {search: val}, function(donnees){
                    $('#projects-list').html(donnees);
                });
            }
        })
    </script>

<?= App::render('appBundle:includes:footer') ?>