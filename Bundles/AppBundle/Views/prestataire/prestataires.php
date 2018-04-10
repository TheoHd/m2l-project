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
                            Gestion des prestataires
                        </h5>
                        <div class="form-desc">
                            Listing des différents préstataires enregistrés dans la base de données de la maison des ligues de lorraine.
                            <br><br>
                            <code>Si il y a plusieurs contacts pour une entreprise, veuillez créer plusieurs préstataires différents.</code>
                            <br>
                            <br>
                            <a href="<?= App::generateUrl('add_prestataire') ?>" class="btn btn-primary btn-sm">Ajouter un prestataire</a>
                        </div>
                        <?= Session::hasFlashes('success') ? "<div class='alert alert-success'>".Session::getFlash('success')."</div>" : '' ?>
                    </div>
                </div>

                <?php foreach($prestataires as $prestataire) : ?>
                <div class="element-wrapper">
                    <div class="element-box">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" style="margin-bottom:0;">
                                <thead>
                                <tr>
                                    <th>Nom de l'entreprise</th>
                                    <th>Nom du contact</th>
                                    <th>Adresse email du contact</th>
                                    <th>Numéro de téléphone du contact</th>
                                    <th>Adresse de l'entreprise</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><code><?= $prestataire->getEntrepriseName() ?></code></td>
                                    <td><?= $prestataire->getContactName() ?></td>
                                    <td class="text-center"><a href=""><?= $prestataire->getContactEmail() ?></a></td>
                                    <td class="text-center"><?= $prestataire->getContactPhone() ?></td>
                                    <td><?= $prestataire->getAdress() ?></td>
                                    <td class="text-right">
                                        <a href="" class="btn btn-primary btn-sm btn-m5"><i class="fa fa-envelope"></i> Contacter</a>
                                        <a href="<?= App::generateUrl('show_prestataire', ['id' => $prestataire->getId()]) ?>" class="btn btn-info btn-sm btn-m5"><i class="fa fa-eye"></i> Voir</a>
                                        <br>
                                        <a href="<?= App::generateUrl('update_prestataire', ['id' => $prestataire->getId()]) ?>" class="btn btn-warning btn-sm btn-m5"><i class="fa fa-pencil"></i> Modifier</a>
                                        <a href="<?= App::generateUrl('delete_prestataire', ['id' => $prestataire->getId()]) ?>" class="btn btn-danger btn-sm btn-m5 btn-delete-trigger"><i class="fa fa-times"></i> Supprimer</a>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>

            </div>
        </div>

    </div>

<?= App::render('appBundle:includes:footer') ?>