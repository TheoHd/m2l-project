<?php

namespace Core\Form;

use App;
use Core\ClassReader\ClassReader;

class Form{

	public $data = [];
    protected $validation;

	protected $formName;
	protected $method = 'POST';
	protected $action = '#';
	protected $enctype = '';
	protected $isIncludeForm = false;

	protected $success = array(), $errors = array(), $messages = array(), $htmlFormConstructor = array(), $formScript = array();

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

    public function unsetData($index){
        $index = strtolower($index);
        $oldVal = $this->htmlFormConstructor[$index];
        $newVal = str_replace('__'.strtoupper($index).'__', '', $oldVal);;
        $this->htmlFormConstructor[$index] = $newVal;
        return $this;
    }

    public function clear(){
        $this->data = null;
    }

    public function getDefaultData($index, $default = ""){
        $values = $this->data;
        if(!is_null($values)){
            extract($values);
            $name = explode('[', $index)[0];
            preg_match_all("/\[([a-z0-9]+)\]/", $index, $matches);
            unset($matches[0]);
            $matches = $matches[1];

            $currentValue = $values[$name];
            foreach ($matches as $k){
                if(isset($currentValue[$k])){
                    $currentValue = $currentValue[$k];
                }
            }
            return $currentValue;
        }else{
            return '';
        }
    }

    public function getData($selectedValue = array() ){
        $values = $this->data;
        $return = [];
        foreach ($values as $k => $v) {
            if(in_array($k , $selectedValue) || empty($selectedValue)){
                $return[$k] = $v;
            }
        }
        return $return;
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
    public function setData($name, $value){ $this->data[$name] = $value; return $this; }

    public function success($success){ $this->success[] = $success; return $this; }
    public function error($error){ $this->errors[] = $error; return $this; }
    public function message($message){ $this->messages[] = $message; return $this; }

    public function getErrors(){ return $this->errors; }
    public function getSuccess(){ return $this->success; }
    public function getMessages(){ return $this->messages; }

    public function setValidation(Validation $validation){ $this->validation = $validation; return $this; }
    public function getValidation() : Validation{ return $this->validation; }

    public function isValid(){ return $this->validation->isValid(); }
    public function databaseInteraction($result, $error){ return $this->validation->databaseInteraction($result, $error); }
    public function isEqual($champs1, $champs2, $error){ return $this->validation->isEqual($champs1, $champs2, $error); }

    private function registerElement($name, $returnElem){ $this->htmlFormConstructor[$name] = $returnElem; }
    public function convertElementIdToName($elem) {
        preg_match('/name="([^"]+)"/', $elem, $matches);
        $matches = $matches[1];
        return $matches;
    }

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
            $elemOption .= $k.'="'.$v.'"';
        }

        $realName =  $this->getElementName($name);
        $id =  $this->getElementId($name);

		$requiredElem = ($isRequired) ? 'arequired' : '' ; // TODO / REMOVE a
		$asterisk = ($isRequired) ? '__REQUIRED__' : '' ;

		$labelElem = ($label != '') ? '<label for="'. $id .'">'. $label . $asterisk .'</label>' : '' ;

		if($typeElem == 'textarea'){
            $valueElem = ($value != '') ? "$value" : 'default-"__'.strtoupper($id).'__"' ;
			$returnElem = $labelElem . '<textarea '.$elemOption.' name="'.$realName.'" id="'.$id.'" '.$requiredElem.' '.$elemOption.'>'.$valueElem.'</textarea>';
		}else{
            $valueElem = ($value != '') ? 'value="$value"' : 'data-default="__'.strtoupper($id).'__"' ;
			$returnElem = $labelElem . '<input type="'.$typeElem.'" name="'.$realName.'" id="'.$id.'" '.$valueElem.' '.$requiredElem.' '.$elemOption.'>';
		}

        $this->registerElement($id, $returnElem);
	}

	protected function addBtnElement($name, $value, $class){
        $realName =  $this->getElementName($name);
        $id =  $this->getElementId($name);

		$classElem = ($class != '') ? 'class="'.$class.'"' : '' ;
        $value = htmlentities($value);
        $returnElem = '<input type="submit" id="'.$id.'" name="'.$realName.'" '.$classElem.' value="'.$value.'">';

        $this->registerElement($id, $returnElem);
	}

	protected function addCheckboxElement($name, $label, $isRequired, $value, $options){
        $elemOption = '';
        foreach ($options as $k => $v){
            $elemOption .= $k . '="'.$v.'"';
        }

        $realName =  $this->getElementName($name);
        $id =  $this->getElementId($name);

		$requiredElem = ($isRequired) ? 'required' : '' ;
		$asterisk = ($isRequired) ? '__REQUIRED__' : '' ;

		$value = $this->getDefaultData($realName, $value);
		$valueElem = ($value != '' && $value == true) ? "checked" : '' ;

		$inputElem = '<input type="checkbox" name="'.$realName.'" id="'.$id.'" '.$valueElem.' '.$requiredElem.'>';
		$returnElem = '<label '.$elemOption.' for="'.$id.'">'.$inputElem.' '.$label.' '.$asterisk.'</label>';

        $this->registerElement($id, $returnElem);
	}

    protected function addRadioElement($name, $label, $values, $isRequired, $options){
        $elemOption = '';
        foreach ($options as $k => $v){
            $elemOption .= $k . '="'.$v.'"';
        }

        $realName =  $this->getElementName($name);
        $id =  $this->getElementId($name);

		$requiredElem = ($isRequired) ? 'required' : '' ;
		$asterisk = ($isRequired) ? '__REQUIRED__' : '' ;

		$returnElem = ($label != '') ? '<label for="'.$id.'">'.$label.' '.$asterisk.'</label><br>' : '' ;
		$value = $this->getDefaultData($realName);

		foreach ($values as $k => $v) {
			$checkedElem = ($value != '' && $value == $k) ? 'checked'  : '' ;
			$returnElem .= '<label '.$elemOption.' style="font-weight:normal;"><input type="radio" name="'.$realName.'" id="'.$id.'" value="'.$k.'" '.$checkedElem.' '.$requiredElem.'> '.$v.'</label><br>';
		}

        $this->registerElement($id, $returnElem);
	}

	protected function addSelectElement($name, $label, $values, $isRequired, $isMultiple, $options){
        $elemOption = '';
        foreach ($options as $k => $v){
            $elemOption .= $k . '="'.$v.'"';
        }

        $realName =  $this->getElementName($name);
        $id =  $this->getElementId($name);

        if($isMultiple){ $realName = $realName . "[]"; }

		$requiredElem = ($isRequired) ? 'required' : '' ;
		$multipleElem = ($isMultiple) ? 'multiple' : '' ;
		$asterisk = ($isRequired) ? '__REQUIRED__' : '' ;

        $returnElem = ($label != '') ? '<label for="'.$id.'">'.$label.' '.$asterisk.'</label><br>' : '' ;

        $r = str_replace('[]', '', $realName);
		$value = $this->getDefaultData( $r );

		$returnElem .= '<select '.$elemOption.' name="'.$realName.'" id="'.$id.'" '.$multipleElem.' class="custom-select">';
		foreach ($values as $k => $v) {
            if(is_array($value)){
                if(in_array($k, $value)){
                    $selectedElem = 'selected';
                }else{ $selectedElem = ''; }
            }else{ $selectedElem = ($value != '' && $value == $k) ? 'selected'  : '' ; }
			$returnElem .= '<option value="'.$k.'" '.$requiredElem.' '.$selectedElem.'>'.$v.'</option>';
		}
		$returnElem .= '</select>';

        $this->registerElement($id, $returnElem);
	}

    // Text input Form

    public function text($name, $label = '', $isRequired = true, $value = null, $options = ['class' => 'form-control'] ){
        $this->addTextElement($name, $label, $isRequired, $value, $options, 'text'); return $this;
    }

    public function hidden($name, $label = '', $isRequired = true, $value = null, $options = ['class' => 'form-control'] ){
        $this->addTextElement($name, $label, $isRequired, $value, $options, 'hidden'); return $this;
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

    public function datetime($name, $label = '', $isRequired = true, $value = null, $options = ['class' => 'form-control'] ){
        $this->addTextElement($name, $label, $isRequired, $value, $options, 'datetime'); return $this;
    }

    public function date($name, $label = '', $isRequired = true, $value = null, $options = ['class' => 'form-control'] ){
        $options['pattern'] = "\d{4}-\d{2}-\d{2}"; $option['placeholder'] = "YYYY-MM-DD";
        $this->addTextElement($name, $label, $isRequired, $value, $options, 'date'); return $this;
    }

    public function time($name, $label = '', $isRequired = true, $value = null, $options = ['class' => 'form-control'] ){
        $this->addTextElement($name, $label, $isRequired, $value, $options, 'time'); return $this;
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

	public function submit($value = 'Envoyer', $name = 'submit', $class = 'btn-primary'){
		$this->addBtnElement($name, $value, 'btn '.$class); return $this;
	}

	public function cancel($value = 'Annuler', $name = 'cancel', $class = 'btn-danger'){
		$this->addBtnElement($name, $value, 'btn '.$class); return $this;
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
        $name .= "[0]";
        $form = new FormEntity($relationTarget, [], $name, true);
        $constructor = $form->getFormConstructor();

        foreach($constructor as $k => $input){
            $this->htmlFormConstructor[$k] = ($input);
        }
    }

    public function addEntityFormMultiple($propertName, $relationTarget, $labelBtnAdd = false, $labelBtnRemove = false){

        if(!$labelBtnAdd){ $labelBtnAdd = "Ajouter : prestataire"; }
        if(!$labelBtnRemove){ $labelBtnRemove = "Supprimer : prestataire __INDEX__"; }

        $name = $this->getElementName($propertName);
        $id = $this->getElementId($propertName);

        $name .= "[__INDEX__]";

        $form = new FormEntity($relationTarget, [], $name, true);
        $constructor = $form->getFormConstructor();

        $return = '<div class="group-form">';
        foreach($constructor as $k => $input){
            $return .= $input;
        }
        $return .= "</div>";

        $return = htmlentities($return);
        $template = '<button  class="btn btn-primary form-duplicate-btn" data-containerClass="'.$propertName.'-elements" data-containerName="'.$propertName.'-element-" data-prototype="'.$return.'" data-labelBtnRemove="'.$labelBtnRemove.'">'.$labelBtnAdd.'</button>';
        $script = " <script> $(document).ready(function(){ let count = 0; $(document).on('click', '.form-duplicate-btn', function(e){ e.preventDefault(); let template = $(this).attr('data-prototype');    let containerName = $(this).attr('data-containerName');    let className = $(this).attr('data-containerClass');    let labelBtnRemove = $(this).attr('data-labelBtnRemove'); let button = \"<button class='btn btn-danger form-remove-btn' data-target='\" + containerName + count + \"'>\" + labelBtnRemove + \"</button><br><br>\";  template = \"<div class='\" + className + \"' id='\" + containerName + count + \"'>\" + template + button + \"</div>\";    template = template.replace(/__index__/gi, count); $(this).before(template); count++; }); $(document).on('click', '.form-remove-btn', function(e){ e.preventDefault(); let target = $(this).attr('data-target'); console.log(target); $('#'+target).remove(); }); }); </script>";

        $this->addFormScript($script);
        $this->htmlFormConstructor[$id] = $template;
    }


    public function inject($entity){
        $data = new FormEntityInjection($entity);
        $this->data[ $this->getFormName() ] = $data->getData();
    }
}
