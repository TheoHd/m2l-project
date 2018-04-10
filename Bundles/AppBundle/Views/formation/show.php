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
                        <div class="form-header">
                            Lieu de la formation
                        </div>
                        <div class="form-content">
                            <iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDp8sy6lzY-CS0TR-wTAKwyUbtv0cxe89U&q=<?= str_ireplace(' ', '+', $formation->getPrestataire()->getAdress()) ?>" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
                <div class="element-wrapper">
                    <div class="element-box">
                        <h5 class="form-header">
                            Avis sur la formation
                        </h5>
                        <div class="form-desc">Cette formation à été choisi
                            <code>650 fois</code> et à obtenu une note moyenne de
                            <code>3.5/5</code>.
                        </div>
                        <div class="form-list" style="margin-top: 95px;">
                            <div class="aec-full-message-w show-pack">
                                <a href="<?= App::generateUrl('avis_formations', ['id' => $formation->getId()]) ?>" class="more-messages" style="top: -70px;">
                                    Voir tout les avis (7)
                                </a>
                                <div class="aec-full-message">
                                    <div class="message-head">
                                        <div class="user-w with-status status-green">
                                            <div class="user-avatar-w">
                                                <div class="user-avatar">
                                                    <img alt="" src="<?= App::getRessource('appbundle:images:avatar1.jpg') ?>">
                                                </div>
                                            </div>
                                            <div class="user-name">
                                                <h6 class="user-title">John Mayers</h6>
                                                <div class="user-role">Salarié<span>&lt; john@solutions.com &gt;</span></div>
                                            </div>
                                        </div>
                                        <div class="message-info">January 12th, 2017<br>1:24pm</div>
                                    </div>
                                    <div class="message-content">
                                        Hi Mike,
                                        <br><br>When the equation, first to ability the forwards, the a but travelling, outlines sentinels bad expand to goodness. Behind if have at the even I and how work, completely deference who boss actually designer; Monstrous with geared from far and these, morals, phase rome; Class. Called get amidst of next.
                                        <br><br>Monstrous with geared from far and these, morals, phase rome; Class. Called get amidst of next.Monstrous with geared from far and these, morals, phase rome; Class. Called get amidst of next.
                                        <br><br>Regards,
                                        <br>Mike Mayers

                                        <div class="message-attachments">
                                            <div class="attachments-heading">Notes</div>
                                            <div class="attachments-docs">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="element-wrapper">
                    <div class="element-box">
                        <h5 class="form-header">
                            Salariés inscrits à la formation
                        </h5>
                        <div class="form-desc">Le coût de la formation est de
                            <code>650 Crédits</code> et elle se déroule sur
                            <code>3 jours</code>.
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
                                <tr>
                                    <td>John Mayers</td>
                                    <td>bvasseur77@gmail.com</td>
                                    <td>4000</td>
                                    <td>23</td>
                                    <td class="text-center"><div class="status-pill green"></div></td>
                                    <td class="text-right">
                                        <a href="" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                                        <a href="" class="btn btn-sm btn-success"><i class="fa fa-check"></i></a>
                                        <a href="" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                                        <a href="" class="btn btn-sm btn-warning"><i class="fa fa-exclamation"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Kelly Brans</td>
                                    <td>admin@gmail.com</td>
                                    <td>3200</td>
                                    <td>10</td>
                                    <td class="text-center"><div class="status-pill red"></div></td>
                                    <td class="text-right">
                                        <a href="" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                                        <a href="" class="btn btn-sm btn-success"><i class="fa fa-check"></i></a>
                                        <a href="" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                                        <a href="" class="btn btn-sm btn-warning"><i class="fa fa-exclamation"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Joe Trulli</td>
                                    <td>baptiste77370@gmail.com</td>
                                    <td>1200</td>
                                    <td>29</td>
                                    <td class="text-center"><div class="status-pill yellow"></div></td>
                                    <td class="text-right">
                                        <a href="" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                                        <a href="" class="btn btn-sm btn-success"><i class="fa fa-check"></i></a>
                                        <a href="" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                                        <a href="" class="btn btn-sm btn-warning"><i class="fa fa-exclamation"></i></a>
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