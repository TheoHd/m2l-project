<?php

namespace Core\Form;

use App;
use Core\Session\Session;

class Form{

	public $data = [];
    protected $validation;

	protected $formName;
	protected $method = 'POST';
	protected $action = '#';
	protected $enctype = '';
	protected $isIncludeForm = false;

	protected $success = array(), $errors = array(), $messages = array(), $formConstructor = array(), $formScript = array();
    private $elementConstructor;

    public function __construct($data = [], $method = "POST", $action = '#', $formName = null){

        $this->data = $data;
        $this->method = $method;
        $this->action = $action;

		if(is_null($formName)){
		    $this->formName = get_called_class();
        }

        Session::startIfNotStarted();
	}

    public function unsetData($property){ // Un seul niveau
        $this->data[$this->getFormName()][strtolower($property)] = '';
        return $this;
    }

    public function setData($index, $value){ // Un seul niveau
        $this->data[$this->getFormName()][strtolower($index)] = $value;
        return $this;
    }

    public function getData($selectedValue = false){
        if($selectedValue) {
            $selectedValue = strtolower($selectedValue);
            return $this->data[ $this->getFormName() ][$selectedValue];
        }
        return $this->data[ $this->getFormName() ];
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

    public function getFormConstructor(){ return $this->formConstructor; }
    public function getElementConstructor(){ return $this->elementConstructor; }
    public function clear(){ $this->data = null; }

    public function success($success){ $this->success[] = $success; return $this; }
    public function error($index, $error){ $this->errors[$index][] = $error; return $this; }
    public function message($message){ $this->messages[] = $message; return $this; }

    public function getErrors(){ return $this->errors; }
    public function getSuccess(){ return $this->success; }
    public function getMessages(){ return $this->messages; }

    public function setValidation(Validation $validation){ $this->validation = $validation; return $this; }
    public function getValidation() : Validation{ return $this->validation; }

    public function isValid(){ return $this->validation->isValid(); }
    public function databaseInteraction($result, $error){ return $this->validation->databaseInteraction($result, $error); }
    public function isEqual($champs1, $champs2, $error){ return $this->validation->isEqual($champs1, $champs2, $error); }

    public function getDefaultData($name){
        $name = str_ireplace($this->formName . '_', '', $name);
        $array = explode('_', $name);
        $result = $this->data[ $this->getFormName() ];
        foreach ($array as $k => $v){
            $result = $result[$v];
        }
        return $result ?? '';
    }

    public function getElementName($name){
        $name = str_ireplace($this->formName . '_', '', $name);
        $array = explode('_', $name);
        foreach ($array as $k => $v){
            $array[$k] = "[$v]";
        }
        $array = implode('', $array);
        return $this->formName . $array;
    }

    public function getElementId($name){
        return $name;
    }

    public function render(){

        foreach ($this->elementConstructor as $inputName => $inputConsctructor){

            if($inputConsctructor['type'] == 'OneToOne'){
                $this->addRelationElement($inputConsctructor['name'], $inputConsctructor['label'], $inputConsctructor['entityRelation'], $inputConsctructor['paramQuery'], $inputConsctructor['paramOrder'], $inputConsctructor['isRequired'], $inputConsctructor['options'], 'OneToOne');

            }elseif($inputConsctructor['type'] == 'OneToMany'){
                $this->addRelationElement($inputConsctructor['name'], $inputConsctructor['label'], $inputConsctructor['entityRelation'], $inputConsctructor['paramQuery'], $inputConsctructor['paramOrder'], $inputConsctructor['isRequired'], $inputConsctructor['options'], 'OneToMany');

            }elseif($inputConsctructor['type'] == 'select'){
                $this->addSelectElement($inputConsctructor['name'], $inputConsctructor['label'], $inputConsctructor['values'], $inputConsctructor['isRequired'], $inputConsctructor['isMultiple'], $inputConsctructor['options']);

            }elseif($inputConsctructor['type'] == 'button'){
                $this->addBtnElement($inputConsctructor['name'], $inputConsctructor['value'], 'btn '. $inputConsctructor['class'], $inputConsctructor['options']);

            }elseif($inputConsctructor['type'] == 'radio'){
                $this->addRadioElement($inputConsctructor['name'], $inputConsctructor['label'], $inputConsctructor['values'], $inputConsctructor['isRequired'], $inputConsctructor['options']);

            }elseif($inputConsctructor['type'] == 'checkbox'){
                $this->addCheckboxElement($inputConsctructor['name'], $inputConsctructor['label'], $inputConsctructor['isRequired'], $inputConsctructor['value'], $inputConsctructor['options']);

            }else{
                $this->addTextElement($inputConsctructor['name'], $inputConsctructor['label'], $inputConsctructor['isRequired'], $inputConsctructor['value'], $inputConsctructor['options'], $inputConsctructor['type']);
            }
        }

        return new FormRenderer( $this );
	}

	protected function addTextElement($identifier, $label, $isRequired, $value, $options, $typeElem ){
        $elemOption = "";
        foreach ($options as $k => $v){
            $elemOption .= $k.'="'.$v.'"';
        }

        $realName =  $this->getElementName($identifier);
        $value = $this->getDefaultData($identifier);

		$requiredElem = ($isRequired) ? 'required' : '' ;
		$asterisk = ($isRequired) ? '__REQUIRED_ELEMENT__' : '' ;

		$labelElem = ($label != '') ? '<label for="'. $identifier .'">'. $label . $asterisk .'</label>' : '' ;

		if($typeElem == 'textarea'){
			$returnElem = $labelElem . '<textarea '.$elemOption.' name="'.$realName.'" id="'.$identifier.'" '.$requiredElem.' '.$elemOption.'>'.$value.'</textarea>';
		}else{
			$returnElem = $labelElem . '<input type="'.$typeElem.'" name="'.$realName.'" id="'.$identifier.'" value="'.$value.'" '.$requiredElem.' '.$elemOption.'>';
		}

        $this->createElement($identifier, $returnElem);
	}

	protected function addBtnElement($identifier, $value, $class, $options){
        $elemOption = "";
        foreach ($options as $k => $v){
            $elemOption .= $k.'="'.$v.'"';
        }

        $realName =  $this->getElementName($identifier);

		$classElem = ($class != '') ? 'class="'.$class.'"' : '' ;
        $value = htmlentities($value);
        $returnElem = '<input type="submit" id="'.$identifier.'" name="'.$realName.'" '.$classElem.' value="'.$value.'" '.$elemOption.'>';

        $this->createElement($identifier, $returnElem);
	}

	protected function addCheckboxElement($identifier, $label, $isRequired, $value, $options){
        $elemOption = '';
        foreach ($options as $k => $v){
            $elemOption .= $k . '="'.$v.'"';
        }

        $realName =  $this->getElementName($identifier);
        $value = $this->getDefaultData($identifier);

		$requiredElem = ($isRequired) ? 'required' : '' ;
		$asterisk = ($isRequired) ? '__REQUIRED_ELEMENT__' : '' ;

		$valueElem = ($value != '' && $value == true) ? "checked" : '' ;

		$inputElem = '<input type="checkbox" name="'.$realName.'" id="'.$identifier.'" '.$valueElem.' '.$requiredElem.'>';
		$returnElem = '<label '.$elemOption.' for="'.$identifier.'">'.$inputElem.' '.$label.' '.$asterisk.'</label>';

        $this->createElement($identifier, $returnElem);
	}

    protected function addRadioElement($identifier, $label, $values, $isRequired, $options){
        $elemOption = '';
        foreach ($options as $k => $v){
            $elemOption .= $k . '="'.$v.'"';
        }

        $realName =  $this->getElementName($identifier);
		$value = $this->getDefaultData($realName);

		$requiredElem = ($isRequired) ? 'required' : '' ;
		$asterisk = ($isRequired) ? '__REQUIRED_ELEMENT__' : '' ;

		$returnElem = ($label != '') ? '<label for="'.$identifier.'">'.$label.' '.$asterisk.'</label><br>' : '' ;

		foreach ($values as $k => $v) {
			$checkedElem = ($value != '' && $value == $k) ? 'checked'  : '' ;
			$returnElem .= '<label '.$elemOption.' style="font-weight:normal;"><input type="radio" name="'.$realName.'" id="'.$identifier.'" value="'.$k.'" '.$checkedElem.' '.$requiredElem.'> '.$v.'</label><br>';
		}

        $this->createElement($identifier, $returnElem);
	}

	protected function addSelectElement($identifier, $label, $values, $isRequired, $isMultiple, $options){
        $elemOption = '';

        foreach ($options as $k => $v){
            $elemOption .= $k . '="'.$v.'"';
        }

        $realName =  $this->getElementName($identifier);

        if($isMultiple){ $realName = $realName . "[]"; }

		$requiredElem = ($isRequired) ? 'required' : '' ;
		$multipleElem = ($isMultiple) ? 'multiple' : '' ;
		$asterisk = ($isRequired) ? '__REQUIRED_ELEMENT__' : '' ;

        $returnElem = ($label != '') ? '<label for="'.$identifier.'">'.$label.' '.$asterisk.'</label><br>' : '' ;

        $r = str_replace('[]', '', $realName);
		$value = $this->getDefaultData( $r );

		$returnElem .= '<select '.$elemOption.' name="'.$realName.'" id="'.$identifier.'" '.$multipleElem.' class="custom-select">';
        if(!$isMultiple){
            $values = ['' => "Sélectionner"] + $values;
        }
		foreach ($values as $k => $v) {
            if(is_array($value)){
                if(in_array($k, $value)){
                    $selectedElem = 'selected';
                }else{ $selectedElem = ''; }
            }else{ $selectedElem = ($value != '' && $value == $k) ? 'selected'  : '' ; }
			$returnElem .= '<option value="'.$k.'" '.$requiredElem.' '.$selectedElem.'>'.$v.'</option>';
		}
		$returnElem .= '</select>';

        $this->createElement($identifier, $returnElem);
	}

    public function addRelationElement($identifier, $label, $entityRelation, $paramQuery, $paramOrder ,$isRequired, $options , $type ){
        $results = App::getManager($entityRelation)->findBy($paramQuery, $paramOrder);

        $values = [];
        if($results && count($results) > 0){
            foreach ($results as $k => $element){
                $values[ $element->getId() ] = $element->__toString();
            }
        }

        $multiple = $type == 'OneToMany';
        $this->addSelectElement($identifier, $label, $values, $isRequired, $multiple, $options);
    }

    protected function registerElement($data, $childName = false){
        $identifier = $childName ? $childName : strtolower($this->getFormName() . "_" . $data['name']) ;
        $data['name'] = $identifier;
        $this->elementConstructor[ $identifier ] = $data;
    }

    protected function createElement($name, $element){
        $this->formConstructor[$name] = $element;
    }

    public function text($name, $label = '', $isRequired = true, $value = null, $options = ['class' => 'form-control'] ){
        $this->registerElement( ['type' => 'text', 'name' => $name, 'label' => $label, 'isRequired' => $isRequired, 'value' => $value, 'options' => $options] );
    }

    public function hidden($name, $label = '', $isRequired = true, $value = null, $options = ['class' => 'form-control'] ){
        $this->registerElement( ['type' => 'hidden', 'name' => $name, 'label' => $label, 'isRequired' => $isRequired, 'value' => $value, 'options' => $options] );
    }

	public function password($name, $label = '', $isRequired = true, $value = null, $options = ['class' => 'form-control'] ){
        $this->registerElement( ['type' => 'password', 'name' => $name, 'label' => $label, 'isRequired' => $isRequired, 'value' => $value, 'options' => $options] );
	}

	public function email($name, $label = '', $isRequired = true, $value = null, $options = ['class' => 'form-control'] ){
        $this->registerElement( ['type' => 'email', 'name' => $name, 'label' => $label, 'isRequired' => $isRequired, 'value' => $value, 'options' => $options] );
	}

	public function url($name, $label = '', $isRequired = true, $value = 'http://', $options = ['class' => 'form-control'] ){
        $this->registerElement( ['type' => 'url', 'name' => $name, 'label' => $label, 'isRequired' => $isRequired, 'value' => $value, 'options' => $options] );
	}

	public function phone($name, $label = '', $isRequired = true, $value = null, $options = ['class' => 'form-control'] ){
        $this->registerElement( ['type' => 'phone', 'name' => $name, 'label' => $label, 'isRequired' => $isRequired, 'value' => $value, 'options' => $options] );
	}

    public function datetime($name, $label = '', $isRequired = true, $value = null, $options = ['class' => 'form-control'] ){
        $this->registerElement( ['type' => 'datetime-local', 'name' => $name, 'label' => $label, 'isRequired' => $isRequired, 'value' => $value, 'options' => $options] );
    }

    public function date($name, $label = '', $isRequired = true, $value = null, $options = ['class' => 'form-control'] ){
        $this->registerElement( ['type' => 'date', 'name' => $name, 'label' => $label, 'isRequired' => $isRequired, 'value' => $value, 'options' => $options] );
    }

    public function time($name, $label = '', $isRequired = true, $value = null, $options = ['class' => 'form-control'] ){
        $this->registerElement( ['type' => 'time', 'name' => $name, 'label' => $label, 'isRequired' => $isRequired, 'value' => $value, 'options' => $options] );
    }

	public function number($name, $label = '', $isRequired = true, $value = null, $options = ['class' => 'form-control'] ){
        $this->registerElement( ['type' => 'number', 'name' => $name, 'label' => $label, 'isRequired' => $isRequired, 'value' => $value, 'options' => $options] );
	}

	public function range($name, $label = '', $isRequired = true, $value = null, $options = ['class' => 'form-control'] ){
        $this->registerElement( ['type' => 'range', 'name' => $name, 'label' => $label, 'isRequired' => $isRequired, 'value' => $value, 'options' => $options] );
	}

	public function color($name, $label = '', $isRequired = true, $value = null, $options = ['class' => 'form-control'] ){
		$options .= ' pattern="#[a-g0-9]{6}"';
        $this->registerElement( ['type' => 'color', 'name' => $name, 'label' => $label, 'isRequired' => $isRequired, 'value' => $value, 'options' => $options] );
	}

	public function textarea($name, $label = '', $isRequired = true, $value = null, $options = ['class' => 'form-control'] ){
        $this->registerElement( ['type' => 'textarea', 'name' => $name, 'label' => $label, 'isRequired' => $isRequired, 'value' => $value, 'options' => $options] );
	}

 	public function checkbox($name, $label = '', $isRequired = false, $value = null, $options = [] ){
        $this->registerElement( ['type' => 'checkbox', 'name' => $name, 'label' => $label, 'isRequired' => $isRequired, 'value' => $value, 'options' => $options] );
 	}

 	public function radio($name, $label = '', $values, $isRequired = true, $options = []){
        $this->registerElement( ['type' => 'radio', 'name' => $name, 'label' => $label, 'isRequired' => $isRequired, 'values' => $values, 'options' => $options] );
 	}

 	public function select($name, $label = '', $values, $isRequired = true, $isMultiple = false, $options = []){
        $this->registerElement( ['type' => 'select', 'name' => $name, 'label' => $label, 'isRequired' => $isRequired, 'values' => $values, 'options' => $options, 'isMultiple' => $isMultiple] );
 	}

    public function yesno($name, $label = '', $isRequired = true, $options = []){
 	    $values = ['Y' => "Oui", 'N' => "Non"];
 	    $this->registerElement( ['type' => 'radio', 'name' => $name, 'label' => $label, 'isRequired' => $isRequired, 'values' => $values, 'options' => $options] );
    }

    public function boolean($name, $label = '', $isRequired = true, $options = []){
        $values = ['true' => "Oui", 'false' => "Non"];
        $this->registerElement( ['type' => 'radio', 'name' => $name, 'label' => $label, 'isRequired' => $isRequired, 'values' => $values, 'options' => $options] );
    }

    public function submit($value = 'Envoyer', $name = 'submit', $class = 'btn-primary', $options = []){
        $this->registerElement( ['type' => 'button', 'name' => $name, 'value' => $value, 'class' => $class, 'options' => $options] );
    }

    public function button($value = 'Valider', $name = 'submit', $class = 'btn-primary', $options = []){
        $this->registerElement( ['type' => 'button', 'name' => $name, 'value' => $value, 'class' => $class, 'options' => $options] );
    }

	public function cancel($value = 'Annuler', $name = 'cancel', $class = 'btn-danger', $options = []){
	    $this->registerElement( ['type' => 'button', 'name' => $name, 'value' => $value, 'class' => $class, 'options' => $options] );
	}

    public function OneToOne($name, $label, $entityRelation, $paramQuery = [], $paramOrder = [] ,$isRequired = true, $options = ['class' => 'form-control'] ){
        $this->registerElement( ['name' => $name, 'label' => $label, 'entityRelation' => $entityRelation, 'paramQuery' => $paramQuery, 'paramOrder' => $paramOrder ,'isRequired' => $isRequired, 'options' => $options, 'type' => 'OneToOne'] );
    }

    public function OneToMany($name, $label, $entityRelation, $paramQuery = [], $paramOrder= [] ,$isRequired = true, $options = ['class' => 'form-control'] ){
        $this->registerElement( ['name' => $name, 'label' => $label, 'entityRelation' => $entityRelation, 'paramQuery' => $paramQuery, 'paramOrder' => $paramOrder ,'isRequired' => $isRequired, 'options' => $options, 'type' => 'OneToMany'] );
    }

// 	public function captcha($label = ''){
//
// 		$labelElem = ($label != '') ? "<label>$label</label>" : '' ;
// 		$this->formConstructor['captcha'] = $labelElem . '<div class="g-recaptcha" data-sitekey="' . App::getConfig()->get('form_Google_Public_Key') . '"></div><br>';
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
// 			$this->formConstructor[strtolower($this->formName . '_' . $name . 'Example')] = $exempleElem ;
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

//	private $singleFileScript = "<script> $('html').on('change', '.inputTrigger', function(e) { th = $(this);name = th.attr('id');label = th.attr('data-label');val = th.val().split('fakepath\\\').pop(); if (val == '') { newVal = label;} else { newVal = 'Fichier : <b>' + val + '</b>'; } $('#inputLabel-' + name).html(newVal); });</script>";
//	private $multipleFileScript = "<script>$('html').on('change', '.inputTrigger', function(e) {val = $(this).val().split('fakepath\\\').pop();if (val != '') { number = $('#inputLabel-exempleNameLabel u').html().replace('#', '') * 1 + 1;$('#inputLabel-exempleNameLabel u').text('#' + number );newName = $('#exempleInputFiles').attr('data-name') + '_' + number;exempleElem = $('#exempleInputFiles');newElem = exempleElem[0].outerHTML;newElem = newElem.replace('exempleNameLabel', newName);newElem = newElem.replace('exempleNameFor', newName);newElem = newElem.replace('exempleNameId', newName);newElem = newElem.replace('#1', '#'+ number);newElem = newElem.replace('exempleInputFiles', 'div-' + newName);$(this).parent().after( newElem );$('#' + newName).hide();$('#div-' + newName).show();}});</script>";
//	private $DeleteEmptyFileInputOnSubmitFormScript = "<script>$('#submit-btn').click(function(e){ $('.inputTrigger').each(function(e){ val = $(this).val(); if( val == null || val == '' ){ $(this).remove(); }}); });</script>";

    public function addForm($formPath, $formName, $data = []){
        $form = App::getController()->getForm($formPath, $formName, $data);

        $constructor = $form->getElementConstructor();
        foreach($constructor as $childName => $input){
            $this->registerElement($input, $childName);
        }
    }

    public function addEntityForm($propertName, $relationTarget){
        $formName = $this->getFormName() . '_' . $propertName . '_0';

        $form = new FormEntity($relationTarget, [], $formName, true);
        $constructor = $form->getElementConstructor();
        $childEntityValidation = $form->getValidation()->getValidationRules();

        foreach($constructor as $childName => $input){
            $this->registerElement($input, $childName);
        }

//        $this->getValidation()->addValidationRules($propertName . '_0', $childEntityValidation);
    }

    public function addEntityFormMultiple($propertName, $relationTarget, $labelBtnAdd = false, $labelBtnRemove = false){

        if(!$labelBtnAdd){ $labelBtnAdd = "Ajouter : ".$propertName; }
        if(!$labelBtnRemove){ $labelBtnRemove = "Supprimer : ".$propertName." __INDEX__"; }

        $name = $this->getElementName($propertName);

        $name .= "[__INDEX__]";

        $form = new FormEntity($relationTarget, [], $name, true);
        $form->render();
        $constructor = $form->getFormConstructor();

        $return = '';
        foreach($constructor as $k => $input){
            $return .= "<div class='form-group'>" . $input . "</div>";
        }

        $this->button($labelBtnAdd, 'duplicateElement', 'btn-primary form-duplicate-btn', ['data-containerClass' => $propertName . '-elements', 'data-containerName' => $propertName . '-element-', 'data-prototype' => htmlentities($return), 'data-labelBtnRemove' => $labelBtnRemove]);
        $script = " <script> $(document).ready(function(){ let count = 0; $(document).on('click', '.form-duplicate-btn', function(e){ e.preventDefault(); let template = $(this).attr('data-prototype'); let containerName = $(this).attr('data-containerName'); let className = $(this).attr('data-containerClass'); let labelBtnRemove = $(this).attr('data-labelBtnRemove'); let button = \"<button class='btn btn-danger form-remove-btn' data-target='\" + containerName + count + \"'>\" + labelBtnRemove + \"</button><br><br>\";  template = \"<div class='\" + className + \"' id='\" + containerName + count + \"'>\" + template + button + \"</div>\";    template = template.replace(/__index__/gi, count); $(this).parent().before(template); count++; }); $(document).on('click', '.form-remove-btn', function(e){ e.preventDefault(); let target = $(this).attr('data-target'); console.log(target); $('#'+target).remove(); }); }); </script>";

        $this->addFormScript($script);
    }

    public function inject($entity){
        $data = new FormEntityInjection($entity);
        var_dump($data->getData());
        $this->data[ $this->getFormName() ] = $data->getData();
    }
}
