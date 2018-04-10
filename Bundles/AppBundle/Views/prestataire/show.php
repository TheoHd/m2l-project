<?php use Core\Session\Session; ?>
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
                <span>Prestataire</span>
            </li>
        </ul>

        <div class="element-box-tp">
            <div class="content-i" style="padding:20px;">

                <div class="element-wrapper">
                    <div class="element-box">
                        <h5 class="form-header">
                            Formations dispensé par <code><?= $prestataire->getEntrepriseName() ?></code>
                        </h5>
                        <div class="form-desc">
                            Listing des différentes formations dispensé par la société.
                        </div>
                    </div>
                </div>

                <div id="progress" style="display:block;" class="tab-element element-wrapper">
                    <div class="element-box">
                        <h5 class="form-header text-success" style="margin-bottom: 0;">Formations en cours</h5>
                        <div class="form-desc"></div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" style="margin-bottom:0;">
                                <thead>
                                <tr>
                                    <th>Nom de la formation</th>
                                    <th>Crédits</th>
                                    <th>Durée</th>
                                    <th>Entreprise</th>
                                    <th>Lieu</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($soon as $formation) : ?>
                                    <tr>
                                        <td><a href="<?= App::generateUrl('show_formation', ['id' => $formation->getId()]) ?>"><b><?= $formation->getNom() ?></b></a></td>
                                        <td><?= $formation->getDuree() ?> Jours</td>
                                        <td><?= $formation->getPrerequis() ?> Crédits</td>
                                        <td><code><?= $formation->getPrestataire()->getEntrepriseName() ?></code></td>
                                        <td><?= $formation->getAdress() ?></td>
                                        <td class="text-center"><div class="status-pill green"></div></td>
                                        <td class="text-right">
                                            <a href="<?= App::generateUrl('show_formation', ['id'  => $formation->getId()]); ?>" class="btn btn-info btn-sm btn-m5"><i class="fa fa-eye"></i> Voir</a>
                                            <a href="<?= App::generateUrl('update_formation', ['id' => $formation->getId()]) ?>" class="btn btn-warning btn-sm btn-m5"><i class="fa fa-pencil"></i> Modifier</a>
                                            <a href="<?= App::generateUrl('delete_formation', ['id' => $formation->getId()]) ?>" class="btn btn-danger btn-sm btn-m5"><i class="fa fa-times"></i> Supprimer</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="finished" class="tab-element element-wrapper">
                    <div class="element-box">
                        <h5 class="form-header text-primary" style="margin-bottom: 0;">Formations terminées</h5>
                        <div class="form-desc"></div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" style="margin-bottom:0;">
                                <thead>
                                <tr>
                                    <th>Nom de la formation</th>
                                    <th>Crédits</th>
                                    <th>Durée</th>
                                    <th>Entreprise</th>
                                    <th>Lieu</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($ended as $formation) : ?>
                                    <tr>
                                        <td><a href="<?= App::generateUrl('show_formation', ['id' => $formation->getId()]) ?>"><b><?= $formation->getNom() ?></b></a></td>
                                        <td><?= $formation->getDuree() ?> Jours</td>
                                        <td><?= $formation->getPrerequis() ?> Crédits</td>
                                        <td><code><?= $formation->getPrestataire()->getEntrepriseName() ?></code></td>
                                        <td><?= $formation->getAdress() ?></td>
                                        <td class="text-center"><div class="status-pill blue"></div></td>
                                        <td class="text-right">
                                            <a href="<?= App::generateUrl('show_formation', ['id'  => $formation->getId()]); ?>" class="btn btn-info btn-sm btn-m5"><i class="fa fa-eye"></i> Voir</a>
                                            <a href="<?= App::generateUrl('update_formation', ['id' => $formation->getId()]) ?>" class="btn btn-warning btn-sm btn-m5"><i class="fa fa-pencil"></i> Modifier</a>
                                            <a href="<?= App::generateUrl('delete_formation', ['id' => $formation->getId()]) ?>" class="btn btn-danger btn-sm btn-m5"><i class="fa fa-times"></i> Supprimer</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="canceled" class="tab-element element-wrapper">
                    <div class="element-box">
                        <h5 class="form-header text-danger" style="margin-bottom: 0;">Formations annulées</h5>
                        <div class="form-desc"></div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" style="margin-bottom:0;">
                                <thead>
                                <tr>
                                    <th>Nom de la formation</th>
                                    <th>Crédits</th>
                                    <th>Durée</th>
                                    <th>Entreprise</th>
                                    <th>Lieu</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($canceled as $formation) : ?>
                                    <tr>
                                        <td><a href="<?= App::generateUrl('show_formation', ['id'  => $formation->getId()]); ?>"><b><?= $formation->getNom() ?></b></a></td>
                                        <td><?= $formation->getDuree() ?> Jours</td>
                                        <td><?= $formation->getPrerequis() ?> Crédits</td>
                                        <td><code><?= $formation->getPrestataire()->getEntrepriseName() ?></code></td>
                                        <td><?= $formation->getAdress() ?></td>
                                        <td class="text-center"><div class="status-pill red"></div></td>
                                        <td class="text-right">
                                            <a href="<?= App::generateUrl('show_formation', ['id'  => $formation->getId()]); ?>" class="btn btn-info btn-sm btn-m5"><i class="fa fa-eye"></i> Voir</a>
                                            <a href="<?= App::generateUrl('update_formation', ['id' => $formation->getId()]) ?>" class="btn btn-warning btn-sm btn-m5"><i class="fa fa-pencil"></i> Modifier</a>
                                            <a href="<?= App::generateUrl('delete_formation', ['id' => $formation->getId()]) ?>" class="btn btn-danger btn-sm btn-m5"><i class="fa fa-times"></i> Supprimer</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="reported" class="tab-element element-wrapper">
                    <div class="element-box">
                        <h5 class="form-header text-warning" style="margin-bottom: 0;">Formations reportées</h5>
                        <div class="form-desc"></div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" style="margin-bottom:0;">
                                <thead>
                                <tr>
                                    <th>Nom de la formation</th>
                                    <th>Crédits</th>
                                    <th>Durée</th>
                                    <th>Entreprise</th>
                                    <th>Lieu</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($reported as $formation) : ?>
                                    <tr>
                                        <td><a href="<?= App::generateUrl('show_formation', ['id'  => $formation->getId()]); ?>"><b><?= $formation->getNom() ?></b></a></td>
                                        <td><?= $formation->getDuree() ?> Jours</td>
                                        <td><?= $formation->getPrerequis() ?> Crédits</td>
                                        <td><code><?= $formation->getPrestataire()->getEntrepriseName() ?></code></td>
                                        <td><?= $formation->getAdress() ?></td>
                                        <td class="text-center"><div class="status-pill yellow"></div></td>
                                        <td class="text-right">
                                            <a href="<?= App::generateUrl('show_formation', ['id'  => $formation->getId()]); ?>" class="btn btn-info btn-sm btn-m5"><i class="fa fa-eye"></i> Voir</a>
                                            <a href="<?= App::generateUrl('update_formation', ['id' => $formation->getId()]) ?>" class="btn btn-warning btn-sm btn-m5"><i class="fa fa-pencil"></i> Modifier</a>
                                            <a href="<?= App::generateUrl('delete_formation', ['id' => $formation->getId()]) ?>" class="btn btn-danger btn-sm btn-m5"><i class="fa fa-times"></i> Supprimer</a>
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