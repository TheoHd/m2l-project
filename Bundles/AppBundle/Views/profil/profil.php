<?php use Bundles\AppBundle\Controller\ProfilController;
use Core\Config\Config;
use Core\Utils\Utils; ?>
<?= App::render('appBundle:includes:header') ?>

    <div class="content-w">
        <ul class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= BASE_URL ?>">Accueil</a>
            </li>
            <li class="breadcrumb-item">
                <span>Profil</span>
            </li>
        </ul>
        <div class="content-panel-toggler">
            <i class="os-icon os-icon-grid-squares-22"></i><span>Sidebar</span>
        </div>
        <div class="content-i" style="padding:20px;">
            <div class="content-box">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="user-profile compact">
                            <div class="up-head-w" style="background-image:url(<?= App::getRessource('appBundle:images:profile_bg1.jpg') ?>)">
                                <div class="up-main-info">
                                    <h2 class="up-header"><?= $user->getNom() ?></h2>
                                    <h6 class="up-sub-header"><?= $user->getEmail() ?></h6>
                                </div>
                                <svg class="decor" width="842px" height="219px" viewBox="0 0 842 219" preserveAspectRatio="xMaxYMax meet" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g transform="translate(-381.000000, -362.000000)" fill="#FFFFFF"><path class="decor-path" d="M1223,362 L1223,581 L381,581 C868.912802,575.666667 1149.57947,502.666667 1223,362 Z"></path></g></svg>
                            </div>
                            <div class="up-controls">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="value-pair">
                                            <div class="label">Status:</div>
                                            <div class="value badge badge-pill badge-success"><?= ProfilController::getRole($user) ?></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 text-right">
                                        <a class="btn btn-primary btn-sm" href=""><i class="os-icon os-icon-email-forward"></i><span>Contacter</span></a>
                                    </div>
                                </div>
                            </div>
                            <div class="up-contents">
                                <div class="m-b">
                                    <div class="row m-b">
                                        <div class="col-sm-6 b-r b-b">
                                            <div class="el-tablo centered padded-v">
                                                <div class="value"><?= $user->getNbJour() ?></div>
                                                <div class="label">Jours restants</div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 b-b">
                                            <div class="el-tablo centered padded-v">
                                                <div class="value"><?= $user->getCredits() ?></div>
                                                <div class="label">Crédits restants</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="padded">
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
                            </div>
                        </div>
                        <div class="element-wrapper">
                            <div class="element-box">
                                <h6 class="element-header">
                                    Mes dernières formations
                                </h6>
                                <div class="timed-activities compact">
                                        <?php if(count($lastFormations) > 0) :?>
                                    <div class="timed-activity">
                                        <div class="ta-record-w">
                                            <?php foreach($lastFormations as $l) :?>
                                            <div class="ta-record">
                                                <div class="ta-timestamp">
                                                    <strong><?= Utils::format_date($l->getDate(), 3) ?></strong> Durée : <?= $l->getFormation()->getDuree() ?> jours
                                                </div>
                                                <div class="ta-activity">
                                                    <?= $l->getFormation()->getNom() ?> - <a href="<?= App::generateUrl('show_formation', ['id' => $l->getFormation()->getId()]) ?>">Voir la formation</a>
                                                </div>
                                            </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <?php else : ?>
                                        <div class="alert-msg alert-warning"><small>Vous n'avez postuler à aucune formation</small></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="element-wrapper">
                            <div class="element-box">
                                <form id="formValidate" method="post" action="#">
                                    <div class="element-info">
                                        <div class="element-info-with-icon">
                                            <div class="element-info-icon">
                                                <div class="os-icon os-icon-wallet-loaded"></div>
                                            </div>
                                            <div class="element-info-text">
                                                <h5 class="element-inner-header">
                                                    Réglages de votre profil
                                                </h5>
                                                <div class="element-inner-desc">
                                                    Votre compte à été validé le <b><?= Utils::format_date($user->getValidationDate(), 3) ?></b>.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        <div class="form-group" style="margin-left: 0;">
                                            <label for="">Adresse Email</label>
                                            <br>
                                            <a href="<?= App::generateUrl('changeEmail') ?>" class="form-control btn btn-primary">Cliquez ici pour modifier votre adresse email</a>
                                        </div>
                                    <br>
                                        <div class="form-group" style="margin-left: 0;">
                                            <label for="">Mot de passe</label>
                                            <br>
                                            <a href="<?= App::generateUrl('changePassword') ?>" class="form-control btn btn-primary">Cliquez ici pour modifier votre mot de passe</a>
                                        </div>
                                    <br>
                                    <fieldset class="form-group">
                                        <legend>
                                            <span>Modifier vos informations</span>
                                        </legend>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <?php
                                                    list($nom, $prenom) = explode(' ', $user->getNom());
                                                ?>
                                                <div class="form-group">
                                                    <label for="">Nom</label>
                                                    <input class="form-control" placeholder="ex. Dupont" type="text" name="prenom" value=<?= $prenom ?>>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="">Prenom</label>
                                                    <input class="form-control" placeholder="ex. John" type="text" name="nom" value="<?= $nom ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="">Date de naissance</label>
                                                    <input class="form-control" placeholder="Date de naissance" type="text" name="birthday" value="<?= $user->getBirthday() ?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="">Téléphone</label>
                                                    <input class="form-control" placeholder="Numéro de téléphone..." type="text" name="phone" value="<?= $user->getPhone() ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <div class="form-check">
                                        <label class="form-check-label"><input class="form-check-input" id="acceptConformity" type="checkbox">Je certifie la conformité des informations saisies</label>
                                    </div>
                                    <div class="form-buttons-w">
                                        <button class="btn btn-primary" id="updateProfil" type="submit" >Modifier</button>
                                    </div>
                                </form>
                                <script>
                                    $(document).ready(function(){
                                        $('#updateProfil').click(function(e){
                                            if($('#acceptConformity').prop('checked')){
                                                return true;
                                            }else{
                                                alert('Vous devez certifier que les données saisies sont exactes');
                                                return false;
                                            }
                                        });
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>

<?= App::render('appBundle:includes:footer') ?>