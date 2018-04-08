<?php

namespace Bundles\UserBundle\Form;
use Core\Form\Form;
use Core\Form\Validation;

class LoginForm extends Form
{
    /*
     *
     * Connexion - formulaire & validation
     *
     */

    public function loginForm()
    {
        $this->setAction('#')->setMethod('POST')->setFormName('loginForm');
        $this->email('email', 'Email :');
        $this->password('password', 'Mot de passe :');
        $this->checkbox('remember', 'Se souvenir de moi');
        $this->submit('Se connecter');

        $this->loginFormValidation();

        return $this;
    }

    public function loginFormValidation()
    {
        $validation = new Validation( $this );
        $validation->isEmail('email');
        $validation->isPassword('password');

        $this->setValidation($validation);
    }

    /*
     *
     * Mot de passe oublié - formulaire & validation
     *
     */

    public function forgotPasswordForm()
    {
        $this->setAction('#')->setMethod('POST')->setFormName('forgotPasswordForm');
        $this->email('email', 'Saisir votre Adresse Email :');
        //$this->captcha();
        $this->submit('Réinitialiser mon mot de passe');

        $this->forgotPasswordFormValidation();
        return $this;
    }

    public function forgotPasswordFormValidation()
    {
        $validation = new Validation( $this );
        $validation->isEmail('email');
        //$validation->isValidCaptcha( $validation::GOOGLE_CAPTCHA_NAME );

        $this->setValidation($validation);
    }

    /*
     *
     * Mot de passe oublié - formulaire & validation
     *
     */

    public function registerForm()
    {
        $this->setAction('#')->setMethod('POST')->setFormName('registerForm');
        $this->text('nom', 'Nom :');
        $this->email('email', 'Email :');
        $this->password('password', 'Mot de passe :');
        $this->password('repeatPassword', 'Retapez votre mot de passe :');
        //$this->captcha();
        $this->submit("S'inscrire");

        $this->registerFormValidation();
        return $this;
    }

    public function registerFormValidation()
    {
        $validation = new Validation( $this );

        $validation->isText('nom');
        $validation->isEmail('email');
        $validation->isPassword('password');
        $validation->isPassword('repeatPassword');
        //$validation->isValidCaptcha( $validation::GOOGLE_CAPTCHA_NAME);

        $this->setValidation($validation);
    }

    /*
     *
     * Réinitialisation du mot de passe - formulaire & validation
     *
     */

    public function resetPasswordForm()
    {;
        $this->setAction('#')->setMethod('POST')->setFormName('resetPasswordForm');
        $this->password('newPassword', 'Nouveau mot de passe :');
        $this->password('repeatPassword', 'Vérification du nouveau mot de passe :');
        $this->submit("Enregistrer le nouveau mot de passe");

        $this->resetPasswordFormValidation();
        return $this;
    }

    public function resetPasswordFormValidation()
    {
        $validation = new Validation( $this );
        $validation->isPassword('newPassword');
        $validation->isPassword('repeatPassword');

        $this->setValidation($validation);
    }

}