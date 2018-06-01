<?php

namespace Bundles\UserBundle\Controller;

use App;
use Bundles\UserBundle\Entity\UserEntity;
use Core\Authentification\Authentification;
use Core\Config\Config;
use Core\Controller\Controller;
use Core\Database\Database;
use Core\Email\Email;
use Core\Email\Exception;
use Core\Email\PHPMailer;
use Core\Request\Request;
use Core\Server\Server;
use Core\Session\Session;
use Core\Translations\Translations;

class AccountController extends Controller {

    public function __construct()
    {
        if( !App::getUser() ){
            App::redirectToRoute('login');
        }
        parent::__construct();
    }

    public function changePasswordAction(){

        $form = $this->getForm('userBundle:Account', 'changePassword', $_POST);

        if( $this->request->is('post') ){
            $auth = App::getAuthentification();
            $userManager = App::getTable('userBundle:user');
            $currentUser = $auth->getUser();
            $currentUserPassword = $currentUser->getPassword();

            $newPassword = $form->getData('newPassword');
            $repeatPassword = $form->getData('repeatPassword');
            $oldPassword = $form->getData('oldPassword');

            $form->isEqual($currentUserPassword, $auth->encryptPassword($oldPassword), App::translate('userBundle:error_invalidOldPassword'));
            $form->isEqual($newPassword, $repeatPassword, App::translate('userBundle:error_passwordDoesntMatch'));

            if( $form->isValid() ){

                $mail = new Email();
                $mail->setSubject( App::translate('userBundle:email_subject_passwordChanged') );
                $mail->setContent( $this->render('userBundle:emails:changePassword', [
                    'nom' => $currentUser->getNom(),
                    'ip' => Server::getClientIp(),
                    'password' => $newPassword
                ], true) );
                $mail->addAddress($currentUser->getEmail());
                $mail->send();

                $userManager->update($currentUser, ['password' => $auth->encryptPassword($newPassword)]);
                $form->success( App::translate('userBundle:success_passwordChanged') );

            }
        }

        return $this->render( Config::get('userBundle:template_changePassword') , [
            'form' => $form->render()
        ]);
    }

    public function changeEmailAction(){

        $form = $this->getForm('userBundle:Account', 'changeEmail', $_POST);
        $auth = App::getAuthentification();
        $currentUser = $auth->getUser();
        $currentUserEmail = $currentUser->getEmail();

        $form->setData('oldEmail', $currentUserEmail);

        if( $this->request->is('post') ){
            $newEmail = $form->getData('newEmail');
            $userManager = App::getTable('userBundle:user');
            $hasUser = $userManager->has(['email' => $newEmail ]);
            $form->databaseInteraction( !$hasUser , App::translate('userBundle:error_emailAlreadyInDatabase') );
            if( $form->isValid() ){

                $mail = new Email();
                $mail->setSubject( App::translate('userBundle:email_subject_EmailChanged') );
                $mail->setContent( $this->render('userBundle:emails:changeEmail', [
                    'nom' => $currentUser->getNom(),
                    'ip' => Server::getClientIp(),
                    'oldEmail' => $currentUserEmail,
                    'newEmail' => $newEmail
                ], true) );
                $mail->addAddress($newEmail);
                $mail->send();

                $userManager->update($currentUser, ['email' => $newEmail]);
                $form->success( App::translate('userBundle:success_emailChanged') );
            }
        }

        return $this->render( Config::get('userBundle:template_changeEmail') , [
            'form' => $form->render()
        ]);
    }

    public function changePseudoAction(){

    }

}