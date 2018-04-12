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
                <span>Formations</span>
            </li>
        </ul>

        <div class="element-box-tp">

            <div class="content-i" style="padding:20px;">

                <div class="element-wrapper">
                    <div class="element-box">
                        <h5 class="form-header">
                            Gestion des formations
                        </h5>
                        <div class="form-desc">
                            Listing des différents formations enregistrés dans la base de données de la maison des ligues de lorraine.
                            <br><br>
                            <code>Vous pouvez postuler aux formations uniquement si vous possédez assez de crédits et de jours restants</code>
                            <br><br>
                            <a href="<?= App::generateUrl('add_formation') ?>" class="btn btn-primary btn-sm">Ajouter une formation</a>
                        </div>
                    </div>
                </div>

                <div class="os-tabs-w">
                    <div class="os-tabs-controls">
                        <ul class="nav nav-tabs upper">
                            <li class="nav-item"><a class="nav-link active" href="#progress">En cours</a></li>
                            <li class="nav-item"><a class="nav-link" href="#finished">Terminées</a></li>
                            <li class="nav-item"><a class="nav-link" href="#canceled">Annulées</a></li>
                            <li class="nav-item"><a class="nav-link" href="#reported">Reportées</a></li>
                        </ul>
                    </div>
                </div>

                <div id="progress" style="display:block;" class="tab-element element-wrapper">
                    <div class="element-box">
                        <h5 class="form-header" style="margin-bottom: 0;">Formations en cours</h5>
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
                <div id="finished" style="display:none;" class="tab-element element-wrapper">
                    <div class="element-box">
                        <h5 class="form-header" style="margin-bottom: 0;">Formations terminées</h5>
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
                <div id="canceled" style="display:none;" class="tab-element element-wrapper">
                    <div class="element-box">
                        <h5 class="form-header" style="margin-bottom: 0;">Formations annulées</h5>
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
                <div id="reported" style="display:none;" class="tab-element element-wrapper">
                    <div class="element-box">
                        <h5 class="form-header" style="margin-bottom: 0;">Formations reportées</h5>
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