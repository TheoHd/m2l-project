<?= App::render('appBundle:includes:header') ?>

    <div class="content-w">
        <ul class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="../../../../Public/index.php">Accueil</a>
            </li>
            <li class="breadcrumb-item">
                <a href="../../../../Public/index.php">Products</a>
            </li>
            <li class="breadcrumb-item">
                <span>Laptop with retina screen</span>
            </li>
        </ul>
        <div class="content-panel-toggler">
            <i class="os-icon os-icon-grid-squares-22"></i><span>Sidebar</span>
        </div>
        <div class="content-i" style="padding:20px;">
            <div class="content-box">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="user-profile compact">
                            <div class="up-head-w" style="background-image:url(<?= App::getRessource('appBundle:images:profile_bg1.jpg') ?>)">
                                <div class="up-main-info">
                                    <h2 class="up-header">Baptiste Vasseur</h2>
                                    <h6 class="up-sub-header">bvasseur77@gmail.com</h6>
                                </div>
                                <svg class="decor" width="842px" height="219px" viewBox="0 0 842 219" preserveAspectRatio="xMaxYMax meet" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g transform="translate(-381.000000, -362.000000)" fill="#FFFFFF"><path class="decor-path" d="M1223,362 L1223,581 L381,581 C868.912802,575.666667 1149.57947,502.666667 1223,362 Z"></path></g></svg>
                            </div>
                            <div class="up-controls">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="value-pair">
                                            <div class="label">Status:</div>
                                            <div class="value badge badge-pill badge-success">Administrateur</div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 text-right">
                                        <a class="btn btn-primary btn-sm" href=""><i class="os-icon os-icon-email-forward"></i><span>Contacter</span></a>
                                    </div>
                                </div>
                            </div>
                            <div class="up-contents">
                                <div class="m-b">
                                    <div class="row m-b">
                                        <div class="col-sm-6 b-r b-b">
                                            <div class="el-tablo centered padded-v">
                                                <div class="value">19</div>
                                                <div class="label">Jours restants</div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 b-b">
                                            <div class="el-tablo centered padded-v">
                                                <div class="value">3200</div>
                                                <div class="label">Crédits restants</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="padded">
                                        <div class="os-progress-bar blue">
                                            <div class="bar-labels">
                                                <div class="bar-label-left">
                                                    <span>Avancement de votre Profil</span><span class="positive">+40</span>
                                                </div>
                                                <div class="bar-label-right">
                                                    <span class="info">72/100</span>
                                                </div>
                                            </div>
                                            <div class="bar-level-1" style="width: 100%">
                                                <div class="bar-level-2" style="width: 80%">
                                                    <div class="bar-level-3" style="width: 30%"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="os-progress-bar blue">
                                            <div class="bar-labels">
                                                <div class="bar-label-left">
                                                    <span>Crédits restants</span><span class="negative">-500</span>
                                                </div>
                                                <div class="bar-label-right">
                                                    <span class="info">3200/5000</span>
                                                </div>
                                            </div>
                                            <div class="bar-level-1" style="width: 100%">
                                                <div class="bar-level-2" style="width: 30%">
                                                    <div class="bar-level-3" style="width: 10%"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="os-progress-bar blue">
                                            <div class="bar-labels">
                                                <div class="bar-label-left">
                                                    <span>Jours restants</span><span class="negative">-2</span>
                                                </div>
                                                <div class="bar-label-right">
                                                    <span class="info">19/21</span>
                                                </div>
                                            </div>
                                            <div class="bar-level-1" style="width: 100%">
                                                <div class="bar-level-2" style="width: 80%">
                                                    <div class="bar-level-3" style="width: 60%"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="element-wrapper">
                            <div class="element-box">
                                <h6 class="element-header">
                                    Mes dernières formations
                                </h6>
                                <div class="timed-activities compact">
                                    <div class="timed-activity">
                                        <div class="ta-record-w">
                                            <div class="ta-record">
                                                <div class="ta-timestamp">
                                                    <strong>22 Janvier 2018</strong> 09h - 18h
                                                </div>
                                                <div class="ta-activity">
                                                    Formation Suite office - <a href="#">Voir la formation</a>
                                                </div>
                                            </div>
                                            <div class="ta-record">
                                                <div class="ta-timestamp">
                                                    <strong>31 Février 2017</strong> 12h à 15h
                                                </div>
                                                <div class="ta-activity">
                                                    Formation Google - <a href="#">Voir la formation</a>
                                                </div>
                                            </div>
                                            <div class="ta-record">
                                                <div class="ta-timestamp">
                                                    <strong>15 Mars 2017</strong> 10h - 12h
                                                </div>
                                                <div class="ta-activity">
                                                    Formation communication - <a href="#">Voir la formation</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="element-wrapper">
                            <div class="element-box">
                                <form id="formValidate">
                                    <div class="element-info">
                                        <div class="element-info-with-icon">
                                            <div class="element-info-icon">
                                                <div class="os-icon os-icon-wallet-loaded"></div>
                                            </div>
                                            <div class="element-info-text">
                                                <h5 class="element-inner-header">
                                                    Réglages de votre profil
                                                </h5>
                                                <div class="element-inner-desc">
                                                    Merci de saisir des informations valides. <a href="" target="_blank">Voir les conditions générales d'utilisations</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        <div class="form-group" style="margin-left: 0;">
                                            <label for="">Adresse Email</label>
                                            <br>
                                            <a href="<?= App::generateUrl('changeEmail') ?>" class="form-control btn btn-primary">Cliquez ici pour modifier votre adresse email</a>
                                        </div>
                                    <br>
                                        <div class="form-group" style="margin-left: 0;">
                                            <label for="">Mot de passe</label>
                                            <br>
                                            <a href="<?= App::generateUrl('changePassword') ?>" class="form-control btn btn-primary">Cliquez ici pour modifier votre mot de passe</a>
                                        </div>
                                    <br>
                                    <div class="form-group">
                                        <label for="">Status</label><select class="form-control">
                                            <option>Veuillez choisir un statut</option>
                                            <option value="">Administrateur</option>
                                            <option value="">Chef d'équipe</option>
                                            <option value="">Salarié</option>
                                        </select>
                                    </div>
                                    <fieldset class="form-group">
                                        <legend>
                                            <span>Modifier vos informations</span>
                                        </legend>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="">Nom</label>
                                                    <input class="form-control" placeholder="ex. Dupont" type="text">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="">Prenom</label>
                                                    <input class="form-control" placeholder="ex. John" type="text">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="">Date de naissance</label>
                                                    <input class="form-control" placeholder="Date de naissance" type="text">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="">Téléphone</label>
                                                    <input class="form-control" placeholder="Numéro de téléphone..." type="text">
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <div class="form-check">
                                        <label class="form-check-label"><input class="form-check-input" type="checkbox">Je certifie la conformité des informations saisies</label>
                                    </div>
                                    <div class="form-buttons-w">
                                        <button class="btn btn-primary" type="submit">Modifier</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>

<?= App::render('appBundle:includes:footer') ?>