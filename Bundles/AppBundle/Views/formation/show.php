<?php use Bundles\AppBundle\Controller\ProfilController;
use Core\Utils\Utils; ?>
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
                <span><?= $formation->getNom() ?></span>
            </li>
        </ul>
        <div class="content-panel-toggler">
            <i class="os-icon os-icon-grid-squares-22"></i>
            <span>Sidebar</span>
        </div>
        <div class="content-i" style="padding: 20px;">
            <div class="content-box">
                <div class="element-wrapper">
                    <div class="element-box">
                        <h5 class="form-header">
                            Plus d'infos : <code><?= $formation->getNom() ?></code>
                        </h5>
                        <div class="form-desc">
                            Le contenu / descriptif de la formation est donné à titre indicatif, il est susceptible d'être modifié. <a href="" target="_blank">Voir nos conditions générales d'utilisations</a> pour plus d'infos.
                        </div>
                        <div class="form-content">
                            <?= $formation->getContenu() ?>
                        </div>
                        <br>
                        <div class="form-desc"></div>
                        <div class="">
                            <small>Cette formation vous est proposé par <a href="<?= App::generateUrl('show_prestataire', ['id' => $formation->getPrestataire()->getId()]) ?>"><code><?= $formation->getPrestataire()->getEntrepriseName() ?></code></a>. Elle se déroulera sur <code><?= $formation->getDuree() ?> Jours</code>. Vous devez disposez de <code><?= $formation->getPrerequis() ?> crédits</code> pour pouvoir y participer.</small>
                        </div>
                    </div>
                </div>
                <div class="element-wrapper">
                    <div class="element-box">
                        <div class="form-content" style="text-align: center;">
                            <?php if( !$alreadyHasDemand ) : ?>
                                <?php if(App::getUser()->getCredits() > $formation->getPrerequis() ) : ?>
                                    <?php if(App::getUser()->getNbJour() > $formation->getDuree() ) : ?>
                                        <a href="<?= App::generateUrl('new_demand', ['id' => $formation->getId()]) ?>" class="btn btn-success">Postuler à cette formation</a>
                                    <?php else: ?>
                                        <div class="alert-msg alert-warning">Vous n'avez pas assez de jour disponible postuler à cette formation</div>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <div class="alert-msg alert-warning">Vous n'avez pas assez de crédits pour postuler à cette formation</div>
                                <?php endif; ?>
                            <?php else: ?>
                                <a href="<?= App::generateUrl('cancel_demand', ['id' => $formation->getId()]) ?>" class="btn btn-danger">Annuler ma demande de formation</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="element-wrapper">
                    <div class="element-box">
                        <div class="form-header">
                            Lieu de la formation
                        </div>
                        <div class="form-content">
                            <iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyD8LF6AzTexqR9nrPj8LgFS1si1NZ0zReI&q=<?= str_ireplace(' ', '+', $formation->getPrestataire()->getAdress()) ?>" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
                <div class="element-wrapper">
                    <div class="element-box">
                        <h5 class="form-header">
                            Avis sur la formation
                        </h5>
                        <div class="form-desc">Cette formation à été choisi
                            <code><?= $nbDemand ?> fois</code>

                            <?php if($note !== false) : ?>
                                et à obtenu une note moyenne de <code><?= $note ?>/5</code>.
                            <?php else: ?>
                                . <code>Aucune note disponible</code>
                            <?php endif; ?>

                        </div>
                        <div class="form-list" style="margin-top: 95px;">
                            <div class="aec-full-message-w show-pack">
                                <a href="<?= App::generateUrl('avis_formations', ['id' => $formation->getId()]) ?>" class="more-messages" style="top: -70px;">
                                    Voir tout les avis (<?= $nbAvis ?>)
                                </a>

                                <?php if($lastAvis !== false) : ?>
                                <div class="aec-full-message">
                                    <div class="message-head">
                                        <div class="user-w with-status status-green">
                                            <div class="user-avatar-w">
                                                <div class="user-avatar">
                                                    <img alt="" src="<?= App::getRessource('appbundle:images:avatar1.jpg') ?>">
                                                </div>
                                            </div>
                                            <div class="user-name">
                                                <h6 class="user-title"><?= $lastAvis->getUser()->getNom() ?></h6>
                                                <div class="user-role"><?= ProfilController::getRole($lastAvis->getUser()) ?><span>&lt; <?= $lastAvis->getUser()->getEmail() ?> &gt;</span></div>
                                            </div>
                                        </div>
                                        <div class="message-info"><?= Utils::format_date($lastAvis->getDate(), 3) ?><br> à <?= Utils::format_date($lastAvis->getDate(), 5) ?></div>
                                    </div>
                                    <div class="message-content">
                                        <?= $lastAvis->getContent() ?>

                                        <div class="message-attachments">
                                            <div class="attachments-heading">Notes</div>
                                            <div class="attachments-docs">
                                                <?php
                                                for($i = 1; $i <= 5; $i++){
                                                    $class = ($i <= $lastAvis->getNote()) ? 'start-active' : '' ;
                                                    echo '<span class="star '.$class.'"><i class="fa fa-star"></i></span>';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php else: ?>
                                    <div class="alert-msg alert-warning">Aucun avis</div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if(App::getUser()->hasRole('ROLE_CHEF')) : ?>

                <div class="element-wrapper">
                    <div class="element-box">
                        <h5 class="form-header">
                            Salariés inscrits à la formation
                        </h5>
                        <div class="form-desc">Le coût de la formation est de
                            <code><?= $formation->getPrerequis() ?> Crédits</code> et elle se déroule sur
                            <code><?= $formation->getDuree() ?> jours</code>.
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Adresse email</th>
                                    <th>Crédits restants</th>
                                    <th>Jours restants</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($demands as $demand) : ?>
                                <tr>
                                    <td><?= $demand->getUser()->getNom() ?></td>
                                    <td><?= $demand->getUser()->getEmail() ?></td>
                                    <td><?= $demand->getUser()->getCredits() ?></td>
                                    <td><?= $demand->getUser()->getNbJour() ?></td>
                                    <td class="text-center">
                                        <?php

                                        if($demand->getEtat() == -1){
                                            echo '<div class="status-pill red"></div>';
                                        }elseif($demand->getEtat() == 1){
                                            echo '<div class="status-pill yellow"></div>';
                                        }elseif($demand->getEtat() == 2){
                                            echo '<div class="status-pill green"></div>';
                                        }

                                        ?>
                                    </td>
                                    <td class="text-right">
                                        <a href="<?= App::generateUrl('showUserProfil', ['id' => $demand->getId()]) ?>" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                                        <a href="<?= App::generateUrl('accept_demand', ['id' => $demand->getId()]) ?>" class="btn btn-sm btn-success"><i class="fa fa-check"></i></a>
                                        <a href="<?= App::generateUrl('deny_demand', ['id' => $demand->getId()]) ?>" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                                        <a href="<?= App::generateUrl('wait_demand', ['id' => $demand->getId()]) ?>" class="btn btn-sm btn-warning"><i class="fa fa-exclamation"></i></a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

<?= App::render('appBundle:includes:footer') ?>