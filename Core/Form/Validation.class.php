<?php  

namespace Core\Form;

use App;
use DateTime;
use Exception;

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
    private $rules;

    public function validate(string $index, string $func, ... $opt){
        array_unshift($opt, strtolower($index));
        call_user_func_array([$this, 'validation_' . $func], $opt);
    }

    protected function getData($index){
        return $this->data[strtolower($index)];
    }

    public function __construct(Form $form){
        $this->form = $form;
        $this->data = $form->data[$form->getFormName()];

//        $this->validate('nom', 'required');
    }

    /*
     * Validation Method
     */

    protected function validation_isRequired(string $index){
        $value = $this->getData($index);
        if( !isset($value) OR empty($value) ){
            $this->addFormError($index,"Le champ $index n'est pas rempli");
        }
    }

    protected function validation_maxLength(string $index, int $maxLength){
        $value = $this->getData($index);
        if(!isset($value) or empty($value)){ return; }

        if( mb_strlen($value) > $maxLength ){
            var_dump($maxLength);
            $this->addFormError($index, "Le champ $index ne doit pas contenir plus de $maxLength caractères");
        }
    }

    protected function validation_minLength(string $index, int $minLength){
        $value = $this->getData($index);
        if(!isset($value) or empty($value)){ return; }

        if( mb_strlen($value) < $minLength ){
            $this->addFormError($index, "Le champ $index doit contenir plus de $minLength caractères");
        }
    }

    protected function validation_rangeLength(string $index, int $minLength, int $maxLength){
        $this->validation_minLength($index, $minLength);
        if(!isset($value) or empty($value)){ return; }

        $this->validation_maxLength($index, $maxLength);
    }

    protected function validation_exactLength(string $index, int $exactLength){
        $value = $this->getData($index);
        if(!isset($value) or empty($value)){ return; }

        if( mb_strlen($value) != $exactLength ){
            $this->addFormError($index, "Le champ $index doit contenir $exactLength caractères");
        }
    }

    protected function validation_rangeNumber(string $index, int $min, int $max){
        $value = $this->getData($index);
        if(!isset($value) or empty($value)){ return; }

        if(is_numeric($value)) {
            if ($value > $max or $value < $min) {
                $this->addFormError($index, "La valeur du champ $index doit être comprise entre $min et $max");
            }
        }else{
            $this->addFormError($index, "Le champ $index doit être un nombre");
        }
    }

    protected function validation_maxNumber(string $index, int $max){
        $value = $this->getData($index);
        if(!isset($value) or empty($value)){ return; }

        if(is_numeric($value)){
            if( $value > $max ){
                $this->addFormError($index, "La valeur du champ $index doit être inférieur à $max");
            }
        }else{
            $this->addFormError($index, "Le champ $index doit être un nombre");
        }
    }

    protected function validation_minNumber(string $index, int $min){
        $value = $this->getData($index);
        if(!isset($value) or empty($value)){ return; }

        if(is_numeric($value)){
            if( $value < $min ){
                $this->addFormError($index, "La valeur du champ $index doit être supérieur à $min");
            }
        }else{
            $this->addFormError($index, "Le champ $index doit être un nombre");
        }
    }

    protected function validation_isEmail(string $index){
        $value = $this->getData($index);
        if(!isset($value) or empty($value)){ return; }

        if( ! preg_match(self::EMAIL_REGEX, $value) ){
            $this->addFormError($index, "Veuillez saisir une adresse email valide dans le champ $index");
        }
    }

    protected function validation_isAlpha(string $index){
        $value = $this->getData($index);
        if(!isset($value) or empty($value)){ return; }

        if( ! preg_match('/^([a-zÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖßÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ])+$/i', $value) !== false ){
            $this->addFormError($index, "Merci de ne saisir que des lettres dans le champ $index");
        }
    }

    protected function validation_isAlphaNumeric(string $index){
        $value = $this->getData($index);
        if(!isset($value) or empty($value)){ return; }

        if( ! preg_match('/^([a-z0-9ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖßÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ])+$/i', $value) !== false ){
            $this->addFormError($index, "Le champ $index ne doit contenir que des caractères alphanumériques (des chiffres et des lettres)");
        }
    }

    protected function validation_isAlphaDash(string $index){
        $value = $this->getData($index);
        if(!isset($value) or empty($value)){ return; }

        if( ! preg_match('/^([a-zÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖßÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ_-])+$/i', $value) !== false ){
            $this->addFormError($index, "Seul les lettres, les tirets (-) et les underscores (_) ne sont autorisé dans le champ $index");
        }
    }

    protected function validation_isAlphaNumericDash(string $index){
        $value = $this->getData($index);
        if(!isset($value) or empty($value)){ return; }

        if( ! preg_match('/^([a-z0-9ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖßÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ_-])+$/i', $value) !== false ){
            $this->addFormError($index, "Seul les lettres, les tirets (-) et les underscores (_) ne sont autorisé dans le champ $index");
        }
    }

    protected function validation_isNumeric(string $index){
        $value = $this->getData($index);
        if(!isset($value) or empty($value)){ return; }

        if( ! is_numeric($value) ){
            $this->addFormError($index, "Le champ $index ne doit contenir que des caractères numériques (chiffres, nombres...)");
        }
    }

    protected function validation_isInteger(string $index){
        $value = $this->getData($index);
        if(!isset($value) or empty($value)){ return; }

        if( ! filter_var($value, FILTER_VALIDATE_INT) ){
            $this->addFormError($index, "Le champ $index doit contenir un entier");
        }
    }

    protected function validation_isBoolean(string $index){
        $value = $this->getData($index);
        if(!isset($value) or empty($value)){ return; }

        $booleans = ['1', 1, 'true', true, '0', 0, 'false', false, 'yes', 'no', 'on', 'off', 'oui', 'non'];
        if( ! in_array($value, $booleans, true ) ){
            $this->addFormError($index, "Le champ $index doit contenir un boolean");
        }
    }

    protected function validation_isFloat(string $index){
        $value = $this->getData($index);
        if(!isset($value) or empty($value)){ return; }

        if( ! filter_var($value, FILTER_VALIDATE_FLOAT) ){
            $this->addFormError($index, "Le champ $index doit être un chiffre/nombre décimal");
        }
    }

    protected function validation_isUrl(string $index){
        $value = $this->getData($index);
        if(!isset($value) or empty($value)){ return; }

        if( ! filter_var($value, FILTER_VALIDATE_URL) ){
            $this->addFormError($index, "Merci de saisir une url valide dans le champ $index");
        }
    }

    protected function validation_isValidUrl(string $index){
        $value = $this->getData($index);
        if(!isset($value) or empty($value)){ return; }

        if( ! filter_var($value, FILTER_VALIDATE_URL) ){
            $this->addFormError($index, "Merci de saisir une url valide dans le champ $index");
        }else{
            $url = parse_url(strtolower($value));
            if (isset($url['host'])) {
                $url = $url['host'];
            }

            if (function_exists('checkdnsrr')  && function_exists('idn_to_ascii')) {
                if (checkdnsrr(idn_to_ascii($url), 'A') === false) {
                    $this->addFormError($index, "L'url saisie dans le champ $index est invalide ou n'est pas joignable");
                }
            }else if( gethostbyname($url) == $url ){
                $this->addFormError($index, "L'url saisie dans le champ $index est invalide ou n'est pas joignable");
            }
        }
    }

    protected function validation_isIp(string $index){
        $value = $this->getData($index);
        if(!isset($value) or empty($value)){ return; }

        if( ! filter_var($value, FILTER_VALIDATE_IP)){
            $this->addFormError($index, "Merci de renseigner une adresse ip valide dans le champ $index");
        }
    }

    protected function validation_isIpv4(string $index){
        $value = $this->getData($index);
        if(!isset($value) or empty($value)){ return; }

        if( ! filter_var($value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)){
            $this->addFormError($index, "Merci de renseigner une adresse ip ipv4 valide dans le champ $index");
        }
    }

    protected function validation_isIpv6(string $index){
        $value = $this->getData($index);
        if(!isset($value) or empty($value)){ return; }

        if( ! filter_var($value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)){
            $this->addFormError($index, "Merci de renseigner une adresse ip ipv6 valide dans le champ $index");
        }
    }

    protected function validation_isDate(string $index){
        $value = $this->getData($index);
        if(!isset($value) or empty($value)){ return; }

        $date = DateTime::createFromFormat('Y-m-d', $value);
        if( $date === false){
            $this->addFormError($index, "Merci de saisir dans le champ $index une date valide");
        }
    }

    protected function validation_isDatetime(string $index){
        $value = $this->getData($index);
        if(!isset($value) or empty($value)){ return; }

        $value = str_ireplace('T', ' ', $value);
        $date = DateTime::createFromFormat('Y-m-d H:i', $value);
        if( $date === false){
            $this->addFormError($index, "Merci de saisir une date et une horaire valide dans le champ $index");
        }
    }

    protected function validation_isTime(string $index){
        $value = $this->getData($index);
        if(!isset($value) or empty($value)){ return; }

        $date = DateTime::createFromFormat('H:i', $value);
        if( $date === false){
            $this->addFormError($index, "Merci de saisir dans le champ $index une horaire valide");
        }
    }

    protected function validation_beforeDate(string $beforeIndex, string $afterIndex){
        $beforeVal = $this->getData($beforeIndex);
        $afterVal = $this->getData($afterIndex);

        if(!isset($beforeVal) or empty($beforeVal)){ return; }
        if(!isset($afterVal) or empty($afterVal)){ return; }

        $before = new DateTime($beforeVal);
        $after = new DateTime($afterVal);

        if($before->getTimestamp() > $after->getTimestamp()){
            $this->addFormError($beforeIndex, "La date du champ $beforeIndex doit être inférieur à la date du champ $afterIndex");
        }
    }

    protected function validation_contains(string $index, ...$words){
        $value = $this->getData($index);
        if(!isset($value) or empty($value)){ return; }

        foreach ($words as $word){
            if(strpos($value, "$word") === false){
                $this->addFormError($index, "Le champ $index doit contenir : $word");
            }
        }
    }

    protected function validation_notContains(string $index, ...$words){
        $value = $this->getData($index);
        if(!isset($value) or empty($value)){ return; }

        foreach ($words as $word){
            if(strpos($value, "$word") !== false){
                $this->addFormError($index, "Le champ $index ne doit pas contenir : $word");
            }
        }
    }

    protected function validation_startWith(string $index, string $start){
        $value = $this->getData($index);
        if(!isset($value) or empty($value)){ return; }

        if( strpos($value, $start) !== 0 ){
            $this->addFormError($index, "Le champ $index doit commencer par $start");
        }
    }

    protected function validation_endWith(string $index, string $end){
        $value = $this->getData($index);
        if(!isset($value) or empty($value)){ return; }

        $toFind = strlen($value) - strlen($end);
        if(strpos($value, $end) !== $toFind){
            $this->addFormError($index, "La valeur du champ $index doit finir par $end");
        }
    }

    protected function validation_isPhone(string $index){
        $value = $this->getData($index);
        if(!isset($value) or empty($value)){ return; }

        if( ! preg_match(self::PHONE_REGEX, $value) !== false){
            $this->addFormError($index, "Le champ $index doit être un numéro de téléphone valide");
        }
    }

    protected function validation_regex(string $index, string $regex){
        $value = $this->getData($index);
        if(!isset($value) or empty($value)){ return; }

        if( ! preg_match($regex, $value) !== false){
            $this->addFormError($index, "Le champ $index n'est pas valide");
        }
    }




    /* Text input in form */


    public function isText($propertyName, $isRequired = true, $formValidation = ''){
        if($formValidation !== ''){
            $this->addValidationAnnotation($propertyName, $formValidation);
        }else{
            $rules = [];
            if($isRequired){ $rules['isRequired'] = true; }
            $this->addValidation($propertyName, $rules);
        }
        return $this;
    }

    public function isEmail($propertyName, $isRequired = true, $formValidation = ''){
        if($formValidation !== ''){
            $this->addValidationAnnotation($propertyName, $formValidation);
        }else{
            $rules = ['isEmail' => true];
            if($isRequired){ $rules['isRequired'] = true; }
            $this->addValidation($propertyName, $rules);
        }
        return $this;
    }

    public function isPassword($propertyName, $isRequired = true, $formValidation = '') {
        if($formValidation !== ''){
            $this->addValidationAnnotation($propertyName, $formValidation);
        }else{
            $rules = ['rangeLength' => [5, 20]];
            if($isRequired){ $rules['isRequired'] = true; }
            $this->addValidation($propertyName, $rules);
        }
        return $this;
    }

    public function isBoolean($propertyName, $isRequired = true, $formValidation = ''){
        if($formValidation !== ''){
            $this->addValidationAnnotation($propertyName, $formValidation);
        }else{
            $rules = ['isBoolean' => true];
            if($isRequired){ $rules['isRequired'] = true; }
            $this->addValidation($propertyName, $rules);
        }
        return $this;
    }

    public function isUrl($propertyName, $isRequired = true, $formValidation = ''){
        if($formValidation !== ''){
            $this->addValidationAnnotation($propertyName, $formValidation);
        }else{
            $rules = ['isUrl' => true];
            if($isRequired){ $rules['isRequired'] = true; }
            $this->addValidation($propertyName, $rules);
        }
        return $this;
    }

    public function isPhone($propertyName, $isRequired = true, $formValidation = ''){
        if($formValidation !== ''){
            $this->addValidationAnnotation($propertyName, $formValidation);
        }else{
            $rules = ['isPhone' => true];
            if($isRequired){ $rules['isRequired'] = true; }
            $this->addValidation($propertyName, $rules);
        }
        return $this;
    }

    public function isDate($propertyName, $isRequired = true, $formValidation = ''){
        if($formValidation !== ''){
            $this->addValidationAnnotation($propertyName, $formValidation);
        }else{
            $rules = ['isDate' => true];
            if($isRequired){ $rules['isRequired'] = true; }
            $this->addValidation($propertyName, $rules);
        }
        return $this;
    }

    public function isDatetime($propertyName, $isRequired = true, $formValidation = ''){
        if($formValidation !== ''){
            $this->addValidationAnnotation($propertyName, $formValidation);
        }else{
            $rules = ['isDatetime' => true];
            if($isRequired){ $rules['isRequired'] = true; }
            $this->addValidation($propertyName, $rules);
        }
        return $this;
    }

    public function isTime($propertyName, $isRequired = true, $formValidation = ''){
        if($formValidation !== ''){
            $this->addValidationAnnotation($propertyName, $formValidation);
        }else{
            $rules = ['isTime' => true];
            if($isRequired){ $rules['isRequired'] = true; }
            $this->addValidation($propertyName, $rules);
        }
        return $this;
    }

    public function isInteger($propertyName, $isRequired = true, $formValidation = ''){
        if($formValidation !== ''){
            $this->addValidationAnnotation($propertyName, $formValidation);
        }else{
            $rules = ['isInteger' => true];
            if($isRequired){ $rules['isRequired'] = true; }
            $this->addValidation($propertyName, $rules);
        }
        return $this;
    }

    public function isTextarea($propertyName, $isRequired = true, $formValidation = ''){
        if($formValidation !== ''){
            $this->addValidationAnnotation($propertyName, $formValidation);
        }else{
            $rules = [];
            if($isRequired){ $rules['isRequired'] = true; }
            $this->addValidation($propertyName, $rules);
        }
        return $this;
    }

    public function isChecked($propertyName, $isRequired = true, $formValidation = ''){
        if($formValidation !== ''){
            $this->addValidationAnnotation($propertyName, $formValidation);
        }else{
            $rules = [];
            if($isRequired){ $rules['isRequired'] = true; }
            $this->addValidation($propertyName, $rules);
        }
        return $this;
    }

//    public function isValidCaptcha($nomChamp, $isRequired = true){
//        if($isRequired){
//            $value = $this->data[$nomChamp];
//            $GooglePrivateKey = App::getConfig()->get('form_Google_Private_Key');
//            $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $GooglePrivateKey . "&response=" . $value . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
//            $responseKeys = json_decode($response,true);
//            if(intval($responseKeys["success"]) !== 1) {
//                $this->addFormError("Le <b>captcha</b> est invalide !");
//                return false;
//            }
//            return $this;
//        }
//    }
//
//
//
    public function isEqual($champ1, $champ2, $error){
        if($champ1 === $champ2){ return true; }
        $this->addFormError('global', $error);
        return false;
    }

    public function databaseInteraction($result, $error){
        if($result === false){
            $this->addFormError('global', $error);
            return false;
        }
}


    public function isValid(){
        $this->launchValidation();
        return empty($this->form->getErrors());
    }

    public function addValidation(string $index, array $rules) {
        $this->rules[$index] = $rules;

    }

    protected function addFormError($index, $error) {
        $this->form->error($index, $error);
    }

    protected function launchValidation()
    {
        foreach ($this->rules as $index => $rules){ // Pour chaques champs
            foreach ($rules as $ruleName => $ruleOptions){ // Pour chaques fonction de validation
                if(is_array($ruleOptions)){
                    $this->validate($index, $ruleName, ...$ruleOptions);
                }else{
                    $this->validate($index, $ruleName, $ruleOptions);
                }
            }
        }
    }

    public function addValidationAnnotation($name, $rules){
        $rules = str_ireplace(['[', ']'], [''], $rules);
        preg_match_all('/[a-zA-Z]+\([\w,"-_]*\)/i', $rules, $matches);
        $matches = $matches[0];

        $formatedRules = [];
        foreach ($matches as $rule){
            preg_match('/([a-zA-Z]+)\(([\w,"-_]*)\)/i', $rule, $params);
            $paramsOption = explode(',', $params[2]);

            $methodName = 'validation_' . $params[1];
            if(method_exists($this, $methodName)){
                if(count($paramsOption) == 1){
                    $formatedRules[ $params[1] ] = $params[2];
                }else{
                    $formatedRules[ $params[1] ] = $paramsOption;
                }
            }else{
                throw new Exception("Erreur ! La méthode de validation : '{$params[1]}' n'existe pas.");
            }
        }

        $this->addValidation($name, $formatedRules);
    }

    public function getValidationRules(){
        $newRules = [];
        foreach ($this->rules as $propertyName => $rules){
            $newRules[$propertyName] = $rules;
        }

        return $newRules;
    }

//    public function addValidationRules($entityPropName, $entityRules){
//        foreach ($entityRules as $propertyName => $rules){
//            $this->addValidation($entityPropName .'_' . $propertyName, $rules);
//        }
//    }

}