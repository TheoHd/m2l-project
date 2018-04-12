<?php if(count($formations) > 0) : ?>
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
<?php else: ?>
    <div class="alert-msg alert-warning">Aucune formation ne correspond à votre recherche</div>
<?php endif; ?>
