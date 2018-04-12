<?php

namespace Bundles\AppBundle\Controller;

use App;
use Bundles\AppBundle\Entity\DemandEntity;
use Bundles\UserBundle\Entity\UserEntity;
use Core\Controller\Controller;
use Core\Email\Email;
use Core\Router\Router;
use PDO;

Class DemandController extends Controller {

    public function __construct()
    {
        parent::__construct();

        if(!App::getUser()){
            App::redirectToRoute('login');
        }
    }



    /**
     * @RouteName new_demand
     * @RouteUrl /demand/new/{:id}
     * @RouteParam :id ([0-9]+)
     */
    public function contactAction($params){

        $formation = App::getTable('appBundle:formation')->findById( $params['id'] );
        $manager = App::getTable('appBundle:demand');
        $user = App::getUser();


        $demand = new DemandEntity();
        $demand->setUser($user);
        $demand->setFormation($formation);
        $demand->setEtat(1);
        $demand->setDate( new \DateTime() );

        $manager->persist($demand)->save();

        App::redirectToRoute('show_formation', ['id' => $params['id'] ]);
    }

    /**
     * @RouteName cancel_demand
     * @RouteUrl /demand/cancel/{:id}
     * @RouteParam :id ([0-9]+)
     */
    public function cancelAction($params){

        $formation = App::getTable('appBundle:formation')->findById( $params['id'] );
        $manager = App::getTable('appBundle:demand');
        $user = App::getUser();

        $demand = $manager->findOneBy(['user_id' => $user->getId(), 'formation_id' => $formation->getId()]);

        if(count($demand) > 0){
            $manager->remove($demand);
        }

        App::redirectToRoute('show_formation', ['id' => $params['id'] ]);
    }

    /**
     * @RouteName accept_demand
     * @RouteUrl /demand/accept/{:id}
     * @RouteParam :id ([0-9]+)
     */
    public function acceptAction($params){
        $manager = App::getTable('appBundle:demand');
        $demand = $manager->findById( $params['id'] );
        $manager->update($demand, ['etat' => 2]);

        $email = new Email();
        $email->setContent( $this->render('appBundle:email:demand_accepted', [
            'formation' => $demand->getFormation(),
            'user' => $demand->getUser()
        ], true) );
        $email->setSubject('Candidature accepté');
        $email->addAddress($demand->getUser()->getEmail());
        $email->send();

        App::redirectToPreviousRoute();
    }

    /**
     * @RouteName deny_demand
     * @RouteUrl /demand/deny/{:id}
     * @RouteParam :id ([0-9]+)
     */
    public function denyAction($params){
        $manager = App::getTable('appBundle:demand');
        $demand = $manager->findById( $params['id'] );
        $manager->update($demand, ['etat' => -1]);

        $email = new Email();
        $email->setContent( $this->render('appBundle:email:demand_denied', [
            'formation' => $demand->getFormation(),
            'user' => $demand->getUser()
        ], true) );
        $email->setSubject('Candidature refusé');
        $email->addAddress($demand->getUser()->getEmail());
        $email->send();

        App::redirectToPreviousRoute();
    }

    /**
     * @RouteName wait_demand
     * @RouteUrl /demand/wait/{:id}
     * @RouteParam :id ([0-9]+)
     */
    public function waitAction($params){
        $manager = App::getTable('appBundle:demand');
        $demand = $manager->findById( $params['id'] );
        $manager->update($demand, ['etat' => 1]);

        App::redirectToPreviousRoute();
    }
}