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
                            Listing des différents préstataires enregistrés dans la base de données de la maison des ligues de lorraine.
                            <br><br>
                            <code>Si il y a plusieurs contacts pour une entreprise, veuillez créer plusieurs préstataires différents.</code>
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
                                <tr>
                                    <td><a href=""><b>Formation Google</b></a></td>
                                    <td>3 Jours</td>
                                    <td>340 Crédits</td>
                                    <td><code>Charlestown</code></td>
                                    <td>52 Rue kléber, 92100 Levallois-Perret</td>
                                    <td class="text-center"><div class="status-pill green"></div></td>
                                    <td class="text-right">
                                        <a href="" class="btn btn-info btn-sm btn-m5"><i class="fa fa-eye"></i> Voir</a>
                                        <a href="" class="btn btn-warning btn-sm btn-m5"><i class="fa fa-pencil"></i> Modifier</a>
                                        <a href="" class="btn btn-danger btn-sm btn-m5"><i class="fa fa-times"></i> Supprimer</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><a href=""><b>Formation Google</b></a></td>
                                    <td>3 Jours</td>
                                    <td>340 Crédits</td>
                                    <td><code>Charlestown</code></td>
                                    <td>52 Rue kléber, 92100 Levallois-Perret</td>
                                    <td class="text-center"><div class="status-pill green"></div></td>
                                    <td class="text-right">
                                        <a href="" class="btn btn-info btn-sm btn-m5"><i class="fa fa-eye"></i> Voir</a>
                                        <a href="" class="btn btn-warning btn-sm btn-m5"><i class="fa fa-pencil"></i> Modifier</a>
                                        <a href="" class="btn btn-danger btn-sm btn-m5"><i class="fa fa-times"></i> Supprimer</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><a href=""><b>Formation Google</b></a></td>
                                    <td>3 Jours</td>
                                    <td>340 Crédits</td>
                                    <td><code>Charlestown</code></td>
                                    <td>52 Rue kléber, 92100 Levallois-Perret</td>
                                    <td class="text-center"><div class="status-pill green"></div></td>
                                    <td class="text-right">
                                        <a href="" class="btn btn-info btn-sm btn-m5"><i class="fa fa-eye"></i> Voir</a>
                                        <a href="" class="btn btn-warning btn-sm btn-m5"><i class="fa fa-pencil"></i> Modifier</a>
                                        <a href="" class="btn btn-danger btn-sm btn-m5"><i class="fa fa-times"></i> Supprimer</a>
                                    </td>
                                </tr>
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
                                <tr>
                                    <td><a href=""><b>Formation Google</b></a></td>
                                    <td>3 Jours</td>
                                    <td>340 Crédits</td>
                                    <td><code>Charlestown</code></td>
                                    <td>52 Rue kléber, 92100 Levallois-Perret</td>
                                    <td class="text-center"><div class="status-pill green"></div></td>
                                    <td class="text-right">
                                        <a href="" class="btn btn-info btn-sm btn-m5"><i class="fa fa-eye"></i> Voir</a>
                                        <a href="" class="btn btn-warning btn-sm btn-m5"><i class="fa fa-pencil"></i> Modifier</a>
                                        <a href="" class="btn btn-danger btn-sm btn-m5"><i class="fa fa-times"></i> Supprimer</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><a href=""><b>Formation Google</b></a></td>
                                    <td>3 Jours</td>
                                    <td>340 Crédits</td>
                                    <td><code>Charlestown</code></td>
                                    <td>52 Rue kléber, 92100 Levallois-Perret</td>
                                    <td class="text-center"><div class="status-pill green"></div></td>
                                    <td class="text-right">
                                        <a href="" class="btn btn-info btn-sm btn-m5"><i class="fa fa-eye"></i> Voir</a>
                                        <a href="" class="btn btn-warning btn-sm btn-m5"><i class="fa fa-pencil"></i> Modifier</a>
                                        <a href="" class="btn btn-danger btn-sm btn-m5"><i class="fa fa-times"></i> Supprimer</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><a href=""><b>Formation Google</b></a></td>
                                    <td>3 Jours</td>
                                    <td>340 Crédits</td>
                                    <td><code>Charlestown</code></td>
                                    <td>52 Rue kléber, 92100 Levallois-Perret</td>
                                    <td class="text-center"><div class="status-pill green"></div></td>
                                    <td class="text-right">
                                        <a href="" class="btn btn-info btn-sm btn-m5"><i class="fa fa-eye"></i> Voir</a>
                                        <a href="" class="btn btn-warning btn-sm btn-m5"><i class="fa fa-pencil"></i> Modifier</a>
                                        <a href="" class="btn btn-danger btn-sm btn-m5"><i class="fa fa-times"></i> Supprimer</a>
                                    </td>
                                </tr>
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
                                <tr>
                                    <td><a href=""><b>Formation Google</b></a></td>
                                    <td>3 Jours</td>
                                    <td>340 Crédits</td>
                                    <td><code>Charlestown</code></td>
                                    <td>52 Rue kléber, 92100 Levallois-Perret</td>
                                    <td class="text-center"><div class="status-pill green"></div></td>
                                    <td class="text-right">
                                        <a href="" class="btn btn-info btn-sm btn-m5"><i class="fa fa-eye"></i> Voir</a>
                                        <a href="" class="btn btn-warning btn-sm btn-m5"><i class="fa fa-pencil"></i> Modifier</a>
                                        <a href="" class="btn btn-danger btn-sm btn-m5"><i class="fa fa-times"></i> Supprimer</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><a href=""><b>Formation Google</b></a></td>
                                    <td>3 Jours</td>
                                    <td>340 Crédits</td>
                                    <td><code>Charlestown</code></td>
                                    <td>52 Rue kléber, 92100 Levallois-Perret</td>
                                    <td class="text-center"><div class="status-pill green"></div></td>
                                    <td class="text-right">
                                        <a href="" class="btn btn-info btn-sm btn-m5"><i class="fa fa-eye"></i> Voir</a>
                                        <a href="" class="btn btn-warning btn-sm btn-m5"><i class="fa fa-pencil"></i> Modifier</a>
                                        <a href="" class="btn btn-danger btn-sm btn-m5"><i class="fa fa-times"></i> Supprimer</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><a href=""><b>Formation Google</b></a></td>
                                    <td>3 Jours</td>
                                    <td>340 Crédits</td>
                                    <td><code>Charlestown</code></td>
                                    <td>52 Rue kléber, 92100 Levallois-Perret</td>
                                    <td class="text-center"><div class="status-pill green"></div></td>
                                    <td class="text-right">
                                        <a href="" class="btn btn-info btn-sm btn-m5"><i class="fa fa-eye"></i> Voir</a>
                                        <a href="" class="btn btn-warning btn-sm btn-m5"><i class="fa fa-pencil"></i> Modifier</a>
                                        <a href="" class="btn btn-danger btn-sm btn-m5"><i class="fa fa-times"></i> Supprimer</a>
                                    </td>
                                </tr>
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
                                <tr>
                                    <td><a href=""><b>Formation Google</b></a></td>
                                    <td>3 Jours</td>
                                    <td>340 Crédits</td>
                                    <td><code>Charlestown</code></td>
                                    <td>52 Rue kléber, 92100 Levallois-Perret</td>
                                    <td class="text-center"><div class="status-pill green"></div></td>
                                    <td class="text-right">
                                        <a href="" class="btn btn-info btn-sm btn-m5"><i class="fa fa-eye"></i> Voir</a>
                                        <a href="" class="btn btn-warning btn-sm btn-m5"><i class="fa fa-pencil"></i> Modifier</a>
                                        <a href="" class="btn btn-danger btn-sm btn-m5"><i class="fa fa-times"></i> Supprimer</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><a href=""><b>Formation Google</b></a></td>
                                    <td>3 Jours</td>
                                    <td>340 Crédits</td>
                                    <td><code>Charlestown</code></td>
                                    <td>52 Rue kléber, 92100 Levallois-Perret</td>
                                    <td class="text-center"><div class="status-pill green"></div></td>
                                    <td class="text-right">
                                        <a href="" class="btn btn-info btn-sm btn-m5"><i class="fa fa-eye"></i> Voir</a>
                                        <a href="" class="btn btn-warning btn-sm btn-m5"><i class="fa fa-pencil"></i> Modifier</a>
                                        <a href="" class="btn btn-danger btn-sm btn-m5"><i class="fa fa-times"></i> Supprimer</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><a href=""><b>Formation Google</b></a></td>
                                    <td>3 Jours</td>
                                    <td>340 Crédits</td>
                                    <td><code>Charlestown</code></td>
                                    <td>52 Rue kléber, 92100 Levallois-Perret</td>
                                    <td class="text-center"><div class="status-pill green"></div></td>
                                    <td class="text-right">
                                        <a href="" class="btn btn-info btn-sm btn-m5"><i class="fa fa-eye"></i> Voir</a>
                                        <a href="" class="btn btn-warning btn-sm btn-m5"><i class="fa fa-pencil"></i> Modifier</a>
                                        <a href="" class="btn btn-danger btn-sm btn-m5"><i class="fa fa-times"></i> Supprimer</a>
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