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
                                <tr>
                                    <td><img alt="" src="<?= App::getRessource('appBundle:images:flags-icons/us.png') ?>" width="25px"></td>
                                    <td>John Mayers</td>
                                    <td>bvasseur77@gmail.com</td>
                                    <td>Formation Google</td>
                                    <td class="text-center"><small>340 / <b>2030</b></small></td>
                                    <td class="text-center"><small>2 / <b>18</b></small></td>
                                    <td class="text-center"><div class="status-pill green"></div></td>
                                    <td class="text-right">
                                        <a href="" class="btn btn-success btn-sm"><i class="fa fa-check"></i></a>
                                        <a href="" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>
                                        <a href="" class="btn btn-warning btn-sm"><i class="fa fa-spinner fa-spin"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><img alt="" src="<?= App::getRessource('appBundle:images:flags-icons/ca.png') ?>" width="25px"></td>
                                    <td>Kelly Brans</td>
                                    <td>theohd@gmail.com</td>
                                    <td>Formation Microsoft</td>
                                    <td class="text-center"><small>200 / <b>600</b></small></td>
                                    <td class="text-center"><small>2 / <b>4</b></small></td>
                                    <td class="text-center"><div class="status-pill red"></div></td>
                                    <td class="text-right">
                                        <a href="" class="btn btn-success btn-sm"><i class="fa fa-check"></i></a>
                                        <a href="" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>
                                        <a href="" class="btn btn-warning btn-sm"><i class="fa fa-spinner fa-spin"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><img alt="" src="<?= App::getRessource('appBundle:images:flags-icons/uk.png') ?>" width="25px"></td>
                                    <td>Tim Howard</td>
                                    <td>baptiste77370@hotmail.fr</td>
                                    <td>Formation Wordpress</td>
                                    <td class="text-center"><small>112 / <b>2300</b></small></td>
                                    <td class="text-center"><small>12 / <b>28</b></small></td>
                                    <td class="text-center"><div class="status-pill green"></div></td>
                                    <td class="text-right">
                                        <a href="" class="btn btn-success btn-sm"><i class="fa fa-check"></i></a>
                                        <a href="" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>
                                        <a href="" class="btn btn-warning btn-sm"><i class="fa fa-spinner fa-spin"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><img alt="" src="<?= App::getRessource('appBundle:images:flags-icons/es.png') ?>" width="25px"></td>
                                    <td>Joe Trulli</td>
                                    <td>bvasseur@charlestown.fr</td>
                                    <td>Formation Wix</td>
                                    <td class="text-center"><small>2000 / <b>1500</b></small></td>
                                    <td class="text-center"><small>2 / <b>5</b></small></td>
                                    <td class="text-center"><div class="status-pill yellow"></div></td>
                                    <td class="text-right">
                                        <a href="" class="btn btn-success btn-sm"><i class="fa fa-check"></i></a>
                                        <a href="" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>
                                        <a href="" class="btn btn-warning btn-sm"><i class="fa fa-spinner fa-spin"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><img alt="" src="<?= App::getRessource('appBundle:images:flags-icons/fr.png') ?>" width="25px"></td>
                                    <td>Fred Kolton</td>
                                    <td>johndoe@gmail.com</td>
                                    <td>Formation Gmail</td>
                                    <td class="text-center"><small>18 / <b>24</b></small></td>
                                    <td class="text-center"><small>540 / <b>2000</b></small></td>
                                    <td class="text-center"><div class="status-pill green"></div></td>
                                    <td class="text-right">
                                        <a href="" class="btn btn-success btn-sm"><i class="fa fa-check"></i></a>
                                        <a href="" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>
                                        <a href="" class="btn btn-warning btn-sm"><i class="fa fa-spinner fa-spin"></i></a>
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