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
                                    <th>Nom du responsable</th>
                                    <th>Adresse email du responsable</th>
                                    <th>Nombre de salariés</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>#2</td>
                                    <td>John Mayers</td>
                                    <td>bvasseur77@gmail.com</td>
                                    <td>29 salariés</td>
                                    <td class="text-right">
                                        <a href="" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> Voir l'équipe</a>
                                        <a href="" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> Modifier l'équipe</a>
                                        <a href="" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Supprimer l'équipe</a>
                                        <a href="" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Ajouter un membre</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#3</td>
                                    <td>Baptiste Vasseur</td>
                                    <td>baptiste77370@hotmail.fr</td>
                                    <td>12 salariés</td>
                                    <td class="text-right">
                                        <a href="" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> Voir l'équipe</a>
                                        <a href="" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> Modifier l'équipe</a>
                                        <a href="" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Supprimer l'équipe</a>
                                        <a href="" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Ajouter un membre</a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

<?= App::render('appBundle:includes:footer') ?>