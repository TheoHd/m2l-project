<?php

namespace Core\Form;

use App;

class Form{

	public $data = [];
    protected $validation;

	protected $formName;
	protected $method = 'POST';
	protected $action = '#';
	protected $enctype = '';
	protected $isIncludeForm = false;

	protected $success = array(), $error = array(), $message = array(), $htmlFormConstructor = array(), $formScript = array();

    public function __construct($data = []){
		$this->data = $data;
		$this->formName = get_called_class();
		if (session_status() == PHP_SESSION_NONE) {
    		session_start();
		}
		$this->addFormScript($this->loadJqueryCdnFile);
	}

	public function render(){
        return new FormRenderer( $this );
	}

    public function getDefaultData($index, $default = ""){
        $value = $this->data;
        if(isset($value[$index]) && !empty($value[$index])){
            return $value[$index];
        }
        return $default;
    }

    public function unsetData($index){
        $value = $this->data;
        if(isset($value[$index]) && !empty($value[$index])){
            $this->data[$index] = '';
        }
        return $this;
    }
    public function clear(){
        $data = $this->data;
        foreach ($data as $k => $v){
            $this->unsetData($k);
        }
    }

	public function addFormScript($script){ $this->formScript[] = $script; }
	public function loadFormScript(){ return implode('', $this->formScript); }

	public function setAction($action){ $this->action = $action; return $this; }
	public function getAction(){ return $this->action; }

	public function setMethod($method){ $this->method = $method; return $this; }
	public function getMethod(){ return $this->method; }

	public function setFormName($formName){ $this->formName = strtolower($formName); return $this; }
	public function getFormName(){ return $this->formName; }

	public function setEnctype($enctype){ $this->enctype = $enctype; return $this; }
	public function getEnctype(){ return $this->enctype; }

    public function getFormConstructor(){ return $this->htmlFormConstructor; }
	public function success($value){ $this->success[] = $value; return $this; }
    public function error($value){ $this->error[] = $value; return $this; }
    public function setData($name, $value){ $this->data[$name] = $value; return $this; }
    public function injectData($value){ $this->data = $value; return $this; }
    public function setValidation(Validation $validation){ $this->validation = $validation; return $this; }
    public function getValidation() : Validation{ return $this->validation; }
    public function isValid(){ return $this->validation->isValid(); }
    public function getData(){ return $this->validation->getData(); }
    public function databaseInteraction($result, $error){ return $this->validation->databaseInteraction($result, $error); }
    public function isEqual($champs1, $champs2, $error = 'default'){ return $this->validation->isEqual($champs1, $champs2, $error); }

    public function getErrors(){ return $this->validation->getErrors(); }
    public function getSuccess(){ return $this->success; }
    public function getMessage(){ return $this->message; }

    private function registerElement($name, $returnElem){ $this->htmlFormConstructor[$name] = $returnElem; }

    public function getElementName($name){
        return strtolower($this->formName . '[' . $name . ']');
    }
    public function getElementId($name){
        if( !$this->isIncludeForm ) {
            return strtolower($this->formName . '_' . $name);
        }else{
            $name = str_replace(['[', ']'], ['_'], $this->formName . "_$name");
            return $name;
        }
    }

	protected function addTextElement($name, $label, $isRequired, $value, $options, $typeElem ){

        $elemOption = "";
        foreach ($options as $k => $v){
            $elemOption .= "$k='$v'";
        }

        $realName =  $this->getElementName($name);
        $id =  $this->getElementId($name);

		$requiredElem = ($isRequired) ? 'required' : '' ;
		$asterisk = ($isRequired) ? '__REQUIRED__' : '' ;

		$labelElem = ($label != '') ? "<label for='$id'>$label $asterisk</label>" : '' ;

		if($typeElem == 'textarea'){
            $valueElem = ($value != '') ? "$value" : 'default-"__'.strtoupper($id).'__"' ;
			$returnElem = $labelElem . "<textarea $elemOption name='$realName' id='$id' $requiredElem $options>$valueElem</textarea>";
		}else{
            $valueElem = ($value != '') ? "value='$value'" : 'data-default="__'.strtoupper($id).'__"' ;
			$returnElem = $labelElem . "<input $elemOption type='$typeElem' name='$realName' id='$id' $valueElem $requiredElem $options>";
		}

        $this->registerElement($id, $returnElem);
	}

	protected function addBtnElement($name, $value, $class){
        $realName =  $this->getElementName($name);
        $id =  $this->getElementId($name);


		$classElem = ($class != '') ? "class='$class'" : "" ;
        $value = htmlentities($value);
        $returnElem = '<input type="submit" id="'.$id.'" name="'.$realName.'" '.$classElem.' value="'.$value.'">';

        $this->registerElement($id, $returnElem);
	}

	protected function addCheckboxElement($name, $label, $isRequired, $value, $options){
//        $id =  strtolower($this->formName . '_' . "$name");
//        $name = strtolower($this->formName . "[$name]");

		$requiredElem = ($isRequired) ? 'required' : '' ;
		$asterisk = ($isRequired) ? '__REQUIRED__' : '' ;

		$value = $this->getDefaultData($name, $value);
		$valueElem = ($value != '' && $value == true) ? "checked" : '' ;

		$inputElem = "<input type='checkbox' name='$name' id='$id' $valueElem $requiredElem>";
		$returnElem = "<label for='$id'>$inputElem $label $asterisk</label>";

        $this->registerElement($name, $returnElem);
	}

    protected function addRadioElement($name, $label, $values, $isRequired, $options){
//        $id =  strtolower($this->formName . '_' . "$name");
//        $name = strtolower($this->formName . "[$name]");

		$requiredElem = ($isRequired) ? 'required' : '' ;
		$asterisk = ($isRequired) ? '__REQUIRED__' : '' ;

		$returnElem = ($label != '') ? "<label for='$id'>$label $asterisk</label><br>" : '' ;
		$value = $this->getDefaultData($name);

		foreach ($values as $k => $v) {
			$checkedElem = ($value != '' && $value == $k) ? 'checked'  : '' ;
			$returnElem .= "<label style='font-weight:normal;'><input type='radio' name='$name' id='$id' value='$k' $checkedElem $requiredElem> $v</label><br>";
		}

        $this->registerElement($name, $returnElem);
	}

	protected function addSelectElement($name, $label, $values, $isRequired, $isMultiple, $options){

        $elemOption = '';
        foreach ($options as $k => $v){
            $elemOption .= "$k='$v'";
        }

        $realName = $name;
//        $id =  strtolower($this->formName . '_' . "$name");
//        $name = strtolower($this->formName . "[$name]");

        if($isMultiple){ $name = $name . "[]"; }

		$requiredElem = ($isRequired) ? 'required' : '' ;
		$multipleElem = ($isMultiple) ? 'multiple' : '' ;
		$asterisk = ($isRequired) ? '__REQUIRED__' : '' ;

		$returnElem = ($label != '') ? "<label for='$id'>$label $asterisk</label> " : '' ;
        $r = str_replace('[]', '', $realName);
		$value = $this->getDefaultData( strtolower($this->formName) );
		if(isset($value[$r])){
		    $value = $value[$r];
        }else{ $value = []; }

		$returnElem .= "<select $elemOption name='$name' id='$id' $multipleElem class='custom-select'>";
		foreach ($values as $k => $v) {
            if(is_array($value)){
                if(in_array($k, $value)){
                    $selectedElem = 'selected';
                }else{ $selectedElem = ''; }
            }else{ $selectedElem = ($value != '' && $value == $k) ? 'selected'  : '' ; }
			$returnElem .= "<option value='$k' $requiredElem $selectedElem>$v</option>";
		}
		$returnElem .= '</select>';

        $this->registerElement($name, $returnElem);
	}

    // Text input Form

	public function text($name, $label = '', $isRequired = true, $value = null, $options = ['class' => 'form-control'] ){
	    $this->addTextElement($name, $label, $isRequired, $value, $options, 'text'); return $this;
	}

	public function password($name, $label = '', $isRequired = true, $value = null, $options = ['class' => 'form-control'] ){
	    $this->addTextElement($name, $label, $isRequired, $value, $options, 'password'); return $this;
	} 

	public function email($name, $label = '', $isRequired = true, $value = null, $options = ['class' => 'form-control'] ){
	    $this->addTextElement($name, $label, $isRequired, $value, $options, 'email'); return $this;
	}

	public function url($name, $label = '', $isRequired = true, $value = 'http://', $options = ['class' => 'form-control'] ){
	    $this->addTextElement($name, $label, $isRequired, $value, $options, 'url'); return $this;
	}

	public function phone($name, $label = '', $isRequired = true, $value = null, $options = ['class' => 'form-control'] ){
	    $this->addTextElement($name, $label, $isRequired, $value, $options, 'tel'); return $this;
	}

	public function date($name, $label = '', $isRequired = true, $value = null, $options = ['class' => 'form-control'] ){
		$options['pattern'] = "\d{4}-\d{2}-\d{2}"; $option['placeholder'] = "YYYY-MM-DD";
		$this->addTextElement($name, $label, $isRequired, $value, $options, 'date'); return $this;
	}

	public function number($name, $label = '', $isRequired = true, $value = null, $options = ['class' => 'form-control'] ){
	    $this->addTextElement($name, $label, $isRequired, $value, $options, 'number'); return $this;
	}

	public function range($name, $label = '', $isRequired = true, $value = null, $options = ['class' => 'form-control'] ){
	    $this->addTextElement($name, $label, $isRequired, $value, $options, 'range'); return $this;
	}

	public function color($name, $label = '', $isRequired = true, $value = null, $options = ['class' => 'form-control'] ){
		$options .= ' pattern="#[a-g0-9]{6}"';
		$this->addTextElement($name, $label, $isRequired, $value, $options, 'color'); return $this;
	}

	public function textarea($name, $label = '', $isRequired = true, $value = null, $options = ['class' => 'form-control'] ){
	    $this->addTextElement($name, $label, $isRequired, $value, $options, 'textarea'); return $this;
	}

 	public function checkbox($name, $label = '', $isRequired = false, $value = null, $options = null ){
 		$this->addCheckboxElement($name, $label, $isRequired, $value, $options); return $this;
 	}

 	public function radio($name, $label = '', $values, $isRequired = true, $options = null){
 		$this->addRadioElement($name, $label, $values, $isRequired, $options); return $this;
 	}

 	public function select($name, $label = '', $values, $isRequired = true, $isMultiple = false, $options = null){
 		$this->addSelectElement($name, $label, $values, $isRequired, $isMultiple, $options); return $this;
 	}

    public function YesNo($name, $label = '', $isRequired = true, $options = null){
        $this->radio($name, $label, ['Y' => "Oui", 'N' => "Non"], $isRequired, $options); return $this;
    }

    public function boolean($name, $label = '', $isRequired = true, $options = null){
        $this->radio($name, $label, ['true' => "Oui", 'false' => "Non"], $isRequired, $options); return $this;
    }

	public function submit($value = 'Envoyer', $name = 'submit', $class = 'btn-primary', $inline = true){
		$this->addBtnElement($name, $value, 'btn '.$class, $inline); return $this;
	}

	public function cancel($value = 'Annuler', $name = 'cancel', $class = 'btn-danger', $inline = true){ 
		$this->addBtnElement($name, $value, 'btn '.$class, $inline); return $this;
	}


    // Other inpur Form

// 	public function captcha($label = ''){
//
// 		$labelElem = ($label != '') ? "<label>$label</label>" : '' ;
// 		$this->htmlFormConstructor['captcha'] = $labelElem . '<div class="g-recaptcha" data-sitekey="' . App::getConfig()->get('form_Google_Public_Key') . '"></div><br>';
// 	}

// 	public function file($name, $label, $class = 'btn btn-info', $multiple = false){
// 		$classElem = ($class != '') ? "class=' $class'" : '' ;
// 		$labelElem =  "<label $classElem id='inputLabel-$name' for='$name'>$label</label>" ;
//
// 		if($multiple){
// 			$nameElem = $name . '[]';
// 			$labelExemple =  "<label $classElem id='inputLabel-exempleNameLabel' for='exempleNameFor'>$label</label>" ;
// 			$exempleInput = $labelExemple . "<input id='exempleNameId' name='$nameElem' data-label='$label' class='inputTrigger' type='file'>";
// 			$exempleElem = "<div id='exempleInputFiles' data-name='$name' class='form-group' style='display:none;'>" . $exempleInput . "</div>";
// 			$this->htmlFormConstructor[strtolower($this->formName . '_' . $name . 'Example')] = $exempleElem ;
// 		}else{
// 			$nameElem = $name;
// 		}
//
// 		$element = $this->surround( $labelElem . "<input id='$name' name='$nameElem' data-label='$label' class='inputTrigger' type='file' style='display:none'>" );
//
// 		$element ;
// 	 $this->addFormScript( $this->singleFileScript );
// 		$this->enctype = 'multipart/form-data';
//
// 		return $this;
// 	}
//
// 	public function files($name, $label, $class = 'btn btn-info'){
//
// 		$this->file($name, $label.' <u>#1</u>', $class, true);
// 		$this->addFormScript( $this->multipleFileScript );
// 		$this->addFormScript( $this->DeleteEmptyFileInputOnSubmitFormScript );
// 	}


	private $loadJqueryCdnFile = '<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>';
//	private $singleFileScript = "<script> $('html').on('change', '.inputTrigger', function(e) { th = $(this);name = th.attr('id');label = th.attr('data-label');val = th.val().split('fakepath\\\').pop(); if (val == '') { newVal = label;} else { newVal = 'Fichier : <b>' + val + '</b>'; } $('#inputLabel-' + name).html(newVal); });</script>";
//	private $multipleFileScript = "<script>$('html').on('change', '.inputTrigger', function(e) {val = $(this).val().split('fakepath\\\').pop();if (val != '') { number = $('#inputLabel-exempleNameLabel u').html().replace('#', '') * 1 + 1;$('#inputLabel-exempleNameLabel u').text('#' + number );newName = $('#exempleInputFiles').attr('data-name') + '_' + number;exempleElem = $('#exempleInputFiles');newElem = exempleElem[0].outerHTML;newElem = newElem.replace('exempleNameLabel', newName);newElem = newElem.replace('exempleNameFor', newName);newElem = newElem.replace('exempleNameId', newName);newElem = newElem.replace('#1', '#'+ number);newElem = newElem.replace('exempleInputFiles', 'div-' + newName);$(this).parent().after( newElem );$('#' + newName).hide();$('#div-' + newName).show();}});</script>";
//	private $DeleteEmptyFileInputOnSubmitFormScript = "<script>$('#submit-btn').click(function(e){ $('.inputTrigger').each(function(e){ val = $(this).val(); if( val == null || val == '' ){ $(this).remove(); }}); });</script>";

    public function OneToOne($name, $label, $entityRelation, $paramQuery = [], $paramOrder = [] ,$isRequired = true, $options = ['class' => 'form-control'] ){

        $results = App::getManager($entityRelation)->findBy($paramQuery, $paramOrder);

        $values = [];
        if($results && count($results) > 0){
            foreach ($results as $k => $element){
                $values[ $element->getId() ] = $element->__toString();
            }
        }

        $this->select($name, $label, $values, $isRequired, false, $options);
        return $this;
    }

    public function OneToMany($name, $label, $entityRelation, $paramQuery = [], $paramOrder= [] ,$isRequired = true, $options = ['class' => 'form-control'] ){

        $results = App::getManager($entityRelation)->findBy($paramQuery, $paramOrder);

        $values = [];
        if($results && count($results) > 0){
            foreach ($results as $k => $element){
                $values[ $element->getId() ] = $element->__toString();
            }
        }

        $this->select($name, $label, $values, $isRequired, true, $options);
        return $this;
    }

    public function addForm($formPath, $formName, $data = []){
        $form = App::getController()->getForm($formPath, $formName, $data);

        $constructor = $form->getFormConstructor();
        foreach($constructor as $k => $input){
            $this->htmlFormConstructor[$k] = $input;
        }
    }

    public function addEntityForm($propertName, $relationTarget){
        $name = $this->getElementName($propertName);
        $form = new FormEntity($relationTarget, [], $name, true);
        $constructor = $form->getFormConstructor();
        foreach($constructor as $k => $input){
            $this->htmlFormConstructor[$k] = $input;
        }
    }

    public function addEntityFormMultiple($propertName, $relationTarget){
        $name = $this->getElementName($propertName);
        $name .= "[%%INDEX%%]";
        $form = new FormEntity($relationTarget, [], $name, true);
        $constructor = $form->getFormConstructor();
        foreach($constructor as $k => $input){
            $this->htmlFormConstructor[$k] = $input;
        }
    }

}
