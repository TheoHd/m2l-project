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
                <span>Demandes</span>
            </li>
        </ul>

        <div class="element-box-tp">
            <div class="content-i" style="padding:20px;">

                <div class="element-wrapper">
                    <div class="element-box">
                        <h5 class="form-header">
                            Gestion des demandes
                        </h5>
                        <div class="form-desc">
                            La demande de formation n'est possible que lorsque l'utilisateur posséde assez de credit et dispose de jours suffisant.
                            Chaques demandes de formation par un membre de votre équipe est soumise à votre approbation.
                            <br>
                            <br>
                            Vous pouvez <code>confirmer</code>, <code>refuser</code> ou <code>mettre en attente</code> une demande.
                            <br><br>
                            <code>Pour toutes question n"hésitez pas à contacter directement le salarié.</code>
                        </div>
                    </div>
                </div>

<!--                <div class="element-wrapper">-->
<!--                    <div class="element-box">-->
<!--                        <h5 class="form-header">-->
<!--                            Gestion des demandes-->
<!--                        </h5>-->
<!--                        <div class="form-desc">-->
<!--                            <a href="--><?//= App::generateUrl('') ?><!--" class="btn btn-sm btn-primary">Voir les demandes </a>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->

                <div class="element-wrapper">
                    <div class="element-box">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Photo</th>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Formation</th>
                                    <th class="text-center">Crédit nécessaire <br> <b>Crédit restant</b></th>
                                    <th class="text-center">Jours nécessaire <br> <b>Jours restant</b></th>
                                    <th class="text-center">Status</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php foreach($demands as $demand) : ?>
                                <tr>
                                    <td><img alt="" src="<?= App::getRessource('appBundle:images:flags-icons/us.png') ?>" width="25px"></td>
                                    <td><?= $demand->getUser()->getNom() ?></td>
                                    <td><?= $demand->getUser()->getEmail() ?></td>
                                    <td><?= $demand->getFormation()->getNom() ?></td>
                                    <td class="text-center"><small><?= $demand->getFormation()->getPrerequis() ?> / <b><?= $demand->getUser()->getCredits() ?></b></small></td>
                                    <td class="text-center"><small><?= $demand->getFormation()->getDuree() ?> / <b><?= $demand->getUser()->getNbJour() ?></b></small></td>
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
                                        <a href="<?= App::generateUrl('accept_demand', ['id' => $demand->getId()]) ?>" class="btn btn-sm btn-success"><i class="fa fa-check"></i></a>
                                        <a href="<?= App::generateUrl('deny_demand', ['id' => $demand->getId()]) ?>" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                                        <a href="<?= App::generateUrl('wait_demand', ['id' => $demand->getId()]) ?>" class="btn btn-sm btn-warning"><i class="fa fa-spin fa-spinner"></i></a>

                                    </td>
                                </tr>
                                <?php endforeach; ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

<?= App::render('appBundle:includes:footer') ?>