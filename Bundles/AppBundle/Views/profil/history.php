<?= App::render('appBundle:includes:header') ?>

    <div class="content-w">
        <div class="top-menu-secondary">
            <ul>
                <li class="active">
                    <a href="#">Toutes</a>
                </li>
                <li>
                    <a href="#">Terminées</a>
                </li>
                <li>
                    <a href="#">Annulées</a>
                </li>
                <li>
                    <a href="#">Reportées</a>
                </li>
            </ul>
        </div>
        <div class="content-i">
            <div class="content-box">
                <div class="row">
                    <div class="col-12">
                        <div class="padded-lg">
                            <div class="projects-list">
                                <?php if(count($demands) <= 0){ echo "<div class='alert-msg alert-warning'>Aucune demandes</div>"; } ?>
                                <?php foreach ($demands as $demand) : ?>
                                    <?php $formation = $demand->getFormation() ?>
                                    <a href="<?= App::generateUrl('show_formation', ['id' => $formation->getId()]) ?>" class="project-box">
                                        <div class="project-head">
                                            <div class="project-title">
                                                <h5><?= $formation->getNom() ?></h5>
                                            </div>
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
    </div>

<?= App::render('appBundle:includes:footer') ?>