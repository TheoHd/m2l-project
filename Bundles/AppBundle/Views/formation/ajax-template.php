<div class="tab-element element-wrapper">
    <div class="element-box">
        <h5 class="form-header" style="margin-bottom: 0;">Résultat(s) de la recherche :</h5>
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
                <?php foreach($formations as $formation) : ?>
                    <tr>
                        <td><a href="<?= App::generateUrl('show_formation', ['id'  => $formation->getId()]); ?>"><b><?= $formation->getNom() ?></b></a></td>
                        <td><?= $formation->getDuree() ?> Jours</td>
                        <td><?= $formation->getPrerequis() ?> Crédits</td>
                        <td><code><?= $formation->getPrestataire()->getEntrepriseName() ?></code></td>
                        <td><?= $formation->getAdress() ?></td>
                        <td class="text-center">
                            <?php

                            if($formation->getStatut() == 0){
                                echo '<div class="status-pill red"></div>';
                            }elseif($formation->getStatut() == 1){
                                echo '<div class="status-pill green"></div>';
                            }elseif($formation->getStatut() == 2){
                                echo '<div class="status-pill blue"></div>';
                            }elseif($formation->getStatut() == -1){
                                echo '<div class="status-pill yellow"></div>';
                            }

                            ?>
                        </td>
                        <td class="text-right">
                            <a href="<?= App::generateUrl('show_formation', ['id'  => $formation->getId()]); ?>" class="btn btn-info btn-sm btn-m5"><i class="fa fa-eye"></i> Voir</a>

                            <?php if(App::getUser()->hasRole('ROLE_ADMIN')) : ?>
                            <a href="<?= App::generateUrl('update_formation', ['id' => $formation->getId()]) ?>" class="btn btn-warning btn-sm btn-m5"><i class="fa fa-pencil"></i> Modifier</a>
                            <a href="<?= App::generateUrl('delete_formation', ['id' => $formation->getId()]) ?>" class="btn btn-danger btn-sm btn-m5"><i class="fa fa-times"></i> Supprimer</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>