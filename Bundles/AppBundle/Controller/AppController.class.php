<?php

namespace Bundles\AppBundle\Controller;

use App;
use Bundles\UserBundle\Entity\UserEntity;
use Core\Controller\Controller;
use PDO;

class AppController extends Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!App::getUser()) {
            App::redirectToRoute('login');
        }
    }

    public function indexAction()
    {

        $user = App::getUser();

        $notes = App::getTable('appBundle:avis')->findBy(['user_id' => $user->getId()], ['date' => 'DESC']);
        $formations = App::getTable('appBundle:formation')->findBy(['statut' => 1], ['deb' => 'DESC']);

        $administrateur = App::getDb()->query('SELECT * FROM user WHERE roles LIKE "%ROLE_ADMIN%"', true, PDO::FETCH_CLASS, UserEntity::class);
        $chefId = App::getDb()->query('SELECT e.chef_id as id FROM equipe_user eu, equipe e WHERE eu.equipe_id = e.id AND eu.user_id = ' . $user->getId(), true);
        if ($chefId != false) {
            $chef = App::getDb()->query('SELECT * FROM user WHERE id = ' . $chefId->id, true, PDO::FETCH_CLASS, UserEntity::class);
        } else {
            $chef = App::getUser();
        }


        $last3formations = App::getTable('appBundle:formation')->findBy(['statut' => 1], ['deb' => 'DESC'], 3);
        foreach ($last3formations as $f) {
            $avisFormation = App::getTable('appBundle:avis')->findBy(['formation_id' => $f->getId()]);

            if (!empty($avisFormation)) {
                $noteFormation = 0;
                foreach ($avisFormation as $avis) {
                    $noteFormation += $avis->getNote();
                }

                $round = (int)round($noteFormation / count($avisFormation));
                if ($round == 1) {
                    $noteTitle = 'Facile';
                } elseif ($round == 2) {
                    $noteTitle = 'Moyen';
                } elseif ($round == 3) {
                    $noteTitle = 'Intermédiaire';
                } elseif ($round == 4) {
                    $noteTitle = 'Difficile';
                } elseif ($round == 5) {
                    $noteTitle = 'Trés difficile';
                } else {
                    $noteTitle = 'Aucun avis';
                }

                $f->noteTitle = $noteTitle;
                $f->notePercent = ($noteFormation / count($avisFormation)) * 100 / 5;
            } else {
                $f->notePercent = "0";
                $f->noteTitle = "Aucun avis";
            }
        }

        $lastNote = reset($notes);
        $lastNote = ($lastNote !== false) ? $lastNote->getNote() : 0;

        $moyenne = 0;
        $nbNotes = count($notes) > 1 ? count($notes) : 1;
        foreach ($notes as $n) {
            $moyenne += $n->getNote();
        }
        $r = $moyenne / $nbNotes;

        return $this->render('appBundle:pages:home', [
            'user' => $user,
            'moyenne' => $r,
            'lastNote' => $lastNote,
            'nbFormations' => count($formations),
            'administrateur' => $administrateur,
            'chef' => $chef,
            'last3formations' => $last3formations
        ]);
    }

    /**
     * @RouteName contact
     * @RouteUrl /contact
     */
    public function contactAction()
    {
        return $this->render('appBundle:pages:contact');
    }
}