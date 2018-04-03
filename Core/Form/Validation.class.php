<?php  

namespace Core\Form;

use App;

class Validation{

    protected $typeForm;
    protected $data;
    protected $form;
    protected $validationRegistry;

    const GOOGLE_CAPTCHA_NAME = 'g-recaptcha-response';

    const REQUIRED = true;
    const NOT_REQUIRED = false;
    const EMAIL_REGEX = '/^[a-z0-9_\-.]{3,64}@[a-z0-9-_]{3,64}\.([a-z]{2,5})$/' ;
    const PASSWORD_REGEX = '/^[a-zA-Z0-9]{5,20}$/';
    const URL_REGEX = '/^((https?:\/\/)?(www.)?)?[a-zA-Z0-9.]+\.[a-zA-Z]{2,5}(\/?(.+))?$/';
    const PHONE_REGEX = '/^(0|\+33)[0-9]([ .-]?[0-9]{2}){4}$/';
    const DATE_REGEX = '/^\d{2}[-|\/]\d{2}[-|\/]\d{4}$/';
    const NUMBER_REGEX = '/^[0-9]+$/';
    const COLOR_REGEX = '/^#?([a-f0-9]{6}|[a-f0-9]{3})$/';
    const NO_REGEX = '';

    public function __construct(Form $form){
        $this->form = $form;
        $this->data = reset($form->data);

    }

    /* Text input in form */


    public function isText($nomChamp, $isRequired = true, $options = []){
        $this->registerValidation($nomChamp, $isRequired, null, $options);
        return $this;
    }

    public function isEmail($nomChamp, $isRequired = true, $options = []){
        $this->registerValidation($nomChamp, $isRequired, self::EMAIL_REGEX, $options);
        return $this;
    }

    public function isPassword($nomChamp, $isRequired = true, $options = []){
        $this->registerValidation($nomChamp, $isRequired, self::PASSWORD_REGEX, $options);
        return $this;
    }
    public function isUrl($nomChamp, $isRequired = true, $options = []){
        $this->registerValidation($nomChamp, $isRequired, self::URL_REGEX, $options);
        return $this;
    }

    public function isPhone($nomChamp, $isRequired = true, $options = []){
        $this->registerValidation($nomChamp, $isRequired, self::PHONE_REGEX, $options);
        return $this;
    }

    public function isDate($nomChamp, $isRequired = true, $options = []){
        $this->registerValidation($nomChamp, $isRequired, null, $options);
        return $this;
    }

    public function isNumber($nomChamp, $isRequired = true, $options = []){
        $this->registerValidation($nomChamp, $isRequired, self::NUMBER_REGEX, $options);
        return $this;
    }

    public function isRange($nomChamp, $isRequired = true, $options = []){
        $this->registerValidation($nomChamp, $isRequired, self::NUMBER_REGEX, $options);
        return $this;
    }

    public function isColor($nomChamp, $isRequired = true, $options = []){
        $this->registerValidation($nomChamp, $isRequired, self::COLOR_REGEX, $options);
        return $this;
    }

    public function isTextarea($nomChamp, $isRequired = true, $options = []){
        $this->registerValidation($nomChamp, $isRequired, null, $options);
        return $this;
    }

    public function isChecked($nomChamp, $isRequired = false, $options = []){
        $this->registerValidation($nomChamp, $isRequired, null, $options);
        return $this;
    }

    public function registerValidation($nomChamp, $isRequired, $regexCompare, $options){
        $this->validationRegistry[$nomChamp] = ['required' => $isRequired, 'regexCompare' => $regexCompare, 'options' => $options];
    }


    public function isValidCaptcha($nomChamp, $isRequired = true, $options = []){
        if($isRequired){
            $value = $this->data[$nomChamp];
            $GooglePrivateKey = App::getConfig()->get('form_Google_Private_Key');
            $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $GooglePrivateKey . "&response=" . $value . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
            $responseKeys = json_decode($response,true);
            if(intval($responseKeys["success"]) !== 1) {
                $this->addFormError("Le <b>captcha</b> est invalide !");
                return false;
            }
            return $this;
        }
    }



    public function isEqual($champs1, $champs2, $error){
        if($champs1 === $champs2){ return true; }
       
        $this->addFormError($error);
        return false;
    }

    public function databaseInteraction($result, $error){
        if(!$result){
            $this->addFormError($error);
            return false;
        }
    }

    public function isRequired($nomChamp, $isRequired = true, $options = []){
        if(isset($this->data[$nomChamp])){
            $value = $this->data[$nomChamp];
        }else{
            $this->addFormError("Le champs <b>'$nomChamp'</b> n'est pas défini !");
            return false;
        }
        if($isRequired){
            if( $value == '' || $value == null){
                 if(isset($options['emptyMsg']) && !empty($options['emptyMsg'])) {
                     $this->addFormError($options['emptyMsg']);
                 }else{
                     $this->addFormError("Veuillez remplir le champs<b> '$nomChamp' </b>!");
                 }
            }else{
                return true;
            }
        }
        return false;
    }

    public function regexCompare($nomChamp, $regexCompare, $options = []){
        $value = $this->data[$nomChamp];
        if(preg_match($regexCompare, $value) == false){
            if(isset($options['regexErrorMsg']) && !empty($options['regexErrorMsg'])) {
                $this->addFormError($options['regexErrorMsg']);
            }else{
                $this->addFormError("Le champs <b>$nomChamp</b> n'est pas valide !");
            }
            return false;
        }
        return true;
    }

    public function isValid(){
        $this->launchValidation();
        return empty($this->form->getErrors());
    }

    protected function addFormError($error) {
        $this->form->error($error);
    }

    protected function launchValidation()
    {
        foreach ($this->validationRegistry as $inputName => $inputParam){
            $inputName = strtolower($inputName);
            if ($this->isRequired($inputName, $inputParam['required'], $inputParam['options'] ) ){
                if(!is_null($inputParam['regexCompare'])){
                    $this->regexCompare($inputName, $inputParam['regexCompare'], $inputParam['options']);
                }
            }
        }
    }

}