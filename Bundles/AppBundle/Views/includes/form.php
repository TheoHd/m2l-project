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
                <span>Equipes</span>
            </li>
        </ul>

        <div class="element-box-tp">
            <div class="content-i" style="padding:20px;">

                <div class="element-wrapper">
                    <div class="element-box">
                        <h5 class="form-header">
                            <?= $pageTitle ?>
                        </h5>
                        <div class="form-desc">
                            <?= $pageDesc ?>
                            <a href="<?= App::generateUrl($previousUrl, $previousParams) ?>" class="btn btn-info btn-sm"><i class="fa fa-arrow-left"></i> <?= $btnText ?></a>
                        </div>
                    </div>
                </div>

                <div class="element-wrapper">
                    <div class="element-box">
                        <?= $form ?>
                    </div>
                </div>


            </div>
        </div>

    </div>

<?= App::render('appBundle:includes:footer') ?>