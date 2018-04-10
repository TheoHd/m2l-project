<?php

namespace Bundles\AppBundle\Controller;

use App;
use Bundles\AppBundle\Entity\AvisEntity;
use Bundles\AppBundle\Form\FormEntity;
use Bundles\UserBundle\Entity\UserEntity;
use Core\Controller\Controller;
use Core\Form\Form;
use Core\Form\FormEntityTraitement;
use Core\Request\Request;
use Core\Session\Session;

Class AvisController extends Controller {


    /**
     * @RouteName add_avis
     * @RouteUrl /avis/add/{:formation}
     * @RouteParam :formation ([0-9]+)
     */
    public function addAdviceAction($params){
        $formation = App::getTable('appBundle:formation')->findById($params['formation']);
        $form = $this->getForm('appBundle:avis', 'new', Request::all());

        if($this->request->is('post')){
            if($form->isValid()){

                $table = App::getTable('appBundle:avis');

                $contenu = $form->getData('contenu');
                $note = $form->getData('note');

                $avis = new AvisEntity();
                $avis->setContent($contenu);
                $avis->setDate( new \DateTime() );
                $avis->setNote($note);
                $avis->setFormation( $formation );
                $avis->setUser( App::getUser() );

                $table->persist($avis);
                $table->save();
                Session::success('Votre avis à bien été ajouté');
                App::redirectToRoute('avis_formations', ['id' => $formation->getId()]);
            }
        }

        $this->render('appBundle:includes:form', [
            'pageTitle' => "Ajout d'un nouveau commentaire pour <code>{$formation->getNom()}</code>",
            'pageDesc' => "",
            'previousUrl' => "avis_formations",
            'previousParams' => ['id' => $formation->getId()],
            'btnText' => "Retour aux avis de la formation",
            'form' => $form->render(),
        ]);
    }

    /**
     * @RouteName update_avis
     * @RouteUrl /avis/update/{:id}
     * @RouteParam :id ([0-9]+)
     */
    public function updateAdviceAction($params){
        $entity = App::getTable('appBundle:avis')->findById($params['id']);

        $form = $this->getEntityForm('appBundle:avis', Request::all());
        $form->inject($entity);

        $this->render('appBundle:includes:form', [
            'pageTitle' => "Modification du commentaire #" . $entity->getId(),
            'pageDesc' => "",
            'previousUrl' => "list_avis",
            'previousParams' => [],
            'btnText' => "Retour à la liste des commentaires",
            'form' => $form->render(),
        ]);
    }

    /**
     * @RouteName delete_avis
     * @RouteUrl /avis/delete/{:id}
     * @RouteParam :id ([0-9]+)
     */
    public function deleteFormationAction($params){
        App::getTable('appBundle:avis')->remove($params['id']);
        Session::success('Le commentaire à bien été supprimé !');
        App::redirectToRoute('list_avis');
    }

}