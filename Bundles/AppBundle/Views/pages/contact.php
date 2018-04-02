<?= App::render('appBundle:includes:header') ?>

    <div class="content-w">
        <ul class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= BASE_URL ?>">Accueil</a>
            </li>
            <li class="breadcrumb-item">
                <span>Contact</span>
            </li>
        </ul>
        <div class="content-i">
            <div class="content-box" style="padding: 20px;">
                <div class="element-wrapper">
                    <h6 class="element-header">
                        Nous contacter
                    </h6>
                    <div class="element-box">
                        <h5 class="form-header">
                            Via notre adresse email
                        </h5>
                        <div class="form-desc">
                            Si vous souhaitez nous faire parvenir des documents (PDF, Photos, Documents ...), merci de nous envoyer un email à <u><b style="color:#274AB1;">contact@baptiste-vasseur.fr</b></u>
                            <br>Nous vous répondrons dans un délai de 24 à 48h. Merci de renseigner un objet à votre email et de ne pas écrire en language SMS.
                            <br>Merci de nous faire parvenir les informations suivantes : <u>nom</u>, <u>email</u> et <u>numéro de téléphone</u>.
                        </div>
                        <h5 class="form-header">
                            Via ce formulaire
                        </h5>
                        <div class="form-desc" style="border-bottom: none;">
                            Le délai de réponse est généralement de 24 à 48h.
                        </div>
                        <form>
                            <div class="form-group col-md-6" style="padding-left: 0; float: left;">
                                <label class="sr-only">Nom Complet</label>
                                <input class="form-control mb-2 mr-sm-2 mb-sm-0" placeholder="Nom Complet..." type="text">
                            </div>
                            <div class="form-group col-md-6" style="padding-right: 0; float: left;">
                                <label class="sr-only">Adresse Email</label>
                                <input class="form-control" placeholder="Adresse Email..." type="text">
                            </div>
                            <div class="form-group col-md-6" style="padding-left: 0; float: left;">
                                <label class="sr-only">Numéro de téléphone</label>
                                <input class="form-control" placeholder="Numéro de téléphone..." type="text">
                            </div>
                            <div class="form-group col-md-6" style="padding-right: 0; float: left;">
                                <label class="sr-only">Sujet</label>
                                <input class="form-control mb-2 mr-sm-2 mb-sm-0" placeholder="Sujet..." type="text">
                            </div>
                            <div class="form-group">
                                <label class="sr-only">Message</label>
                                <textarea class="form-control mb-2 mr-sm-2 mb-sm-0" placeholder="Votre message..." rows="15"></textarea>
                            </div>
                            <button class="btn btn-primary" type="submit">Envoyer le message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?= App::render('appBundle:includes:footer') ?>