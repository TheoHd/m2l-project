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
                <span>Equipes</span>
            </li>
        </ul>

        <div class="element-box-tp">
            <div class="content-i" style="padding:20px;">

                <div class="element-wrapper">
                    <div class="element-box">
                        <h5 class="form-header">
                            Gestion des équipes
                        </h5>
                        <div class="form-desc">
                            Vous pouvez <code>voir</code>, <code>supprimer</code> et <code>ajouter</code> des membres à une équipe.
                            <br><br>
                            <code>Chaques équipes doit bénéficier d'un chef afin que celui-ci puisse valider les demandes.</code>
                            <br><br>
                            <a href="<?= App::generateUrl('add_equipe') ?>" class="btn btn-primary btn-sm">Créer une nouvelle équipe</a>
                        </div>
                    </div>
                </div>

                <div class="element-wrapper">
                    <div class="element-box">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>numéro</th>
                                    <th>Nom de l'équipe</th>
                                    <th>Nom du responsable</th>
                                    <th>Adresse email du responsable</th>
                                    <th>Nombre de salariés</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($equipes as $equipe) : ?>
                                    <tr>
                                        <td>#<?= $equipe->getId() ?></td>
                                        <td><?= $equipe->getNom() ?></td>
                                        <td><?= $equipe->getChef()->getNom() ?></td>
                                        <td><?= $equipe->getChef()->getEmail() ?></td>
                                        <td><?= count($equipe->getEmploye()->all()) ?> membres</td>
                                        <td class="text-right">
                                            <a href="<?=App::generateUrl('list_equipe', ['id' => $equipe->getId()]) ?>" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> Voir l'équipe</a>
                                            <a href="<?= App::generateUrl('update_equipe', ['id' => $equipe->getId()]) ?>" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> Modifier l'équipe</a>
                                            <br><div style="margin-top: 5px;"></div>
                                            <a href="<?= App::generateUrl('delete_equipe', ['id' => $equipe->getId()]) ?>" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Supprimer l'équipe</a>
                                            <a href="<?= App::generateUrl('update_equipe', ['id' => $equipe->getId()]) ?>" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Ajouter un membre</a>
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