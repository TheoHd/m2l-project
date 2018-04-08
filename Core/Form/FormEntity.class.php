<?php

namespace Core\Form;

use App;
use Core\ClassReader\ClassReader;
use Core\Entity\Entity;
use Core\Request\Request;

class FormEntity extends Form {

    protected $entity;
    protected $isIncludeForm = false;
    protected $validation;

    public function __construct(?String $entity, array $data = [], $formName = false, $isIncludeForm = false)
    {
        if(empty($data)){ $data =  Request::all(); }
        $this->isIncludeForm = $isIncludeForm;
        if($entity instanceof Entity){
            $this->entity = $entity;
        }elseif(is_string($entity)){
            $this->entity = App::getTable($entity)->new();
            if(!$formName){
                $formName = str_ireplace(['Entity', ':',], ['','_'], $entity);
            }
        }

        parent::__construct($data);
        $this->setFormName($formName);

        $this->validation = new Validation( $this ) ;

        $this->generateForm();
    }

    private function generateForm(){

        $className = get_class($this->entity);
        $reader = new ClassReader($className);

        $annotations = $reader->getPropertiesAnnotation();
        $classAnnotation = $reader->getClassAnnotation();

        foreach ($annotations as $propertName => $propertyAnnotation){

            $type = $propertyAnnotation['type'] ?? false ;
            $relationType = $propertyAnnotation['relation'] ?? false;

            $isRequired = (isset($propertyAnnotation['nullable']) && $propertyAnnotation['nullable'] == 'true') ? false : true ;

            $formLabel = $propertyAnnotation['formlabel'] ?? $propertName ;
            $formType = $propertyAnnotation['formtype'] ?? $type ;
            $placeholder = $propertyAnnotation['formplaceholder'] ?? '' ;

            $validation = $propertyAnnotation['formvalidation'] ?? '' ;

            if($type){
                $this->generateInput($formType, $formLabel, $propertName, $isRequired, $placeholder, $validation);
            }elseif($relationType){
                $this->generateRelationInput($relationType, $formLabel, $propertName, $isRequired, $propertyAnnotation);
            }
        }


        if( !$this->isIncludeForm ){
            $label = $classAnnotation['formbtnlabel'] ?? 'Valider' ;
            $this->submit($label);
        }
    }

    private function generateInput($type, $formLabel, $propertName, $isRequired, $placeholder, $formValidation){

        if($type == 'string'){
            $this->text($propertName, $formLabel, $isRequired, null, ['class' => 'form-control', 'placeholder' => $placeholder]);
            $this->validation->isText($propertName, $isRequired, $formValidation);

        }elseif($type == 'email'){
            $this->email($propertName, $formLabel, $isRequired, null, ['class' => 'form-control', 'placeholder' => $placeholder]);
            $this->validation->isEmail($propertName, $isRequired, $formValidation);

        }elseif($type == 'password'){
            $this->password($propertName, $formLabel, $isRequired, null, ['class' => 'form-control', 'placeholder' => $placeholder]);
            $this->validation->isPassword($propertName, $isRequired, $formValidation);

        }elseif($type == 'identifier'){
            $this->hidden($propertName);

        }elseif($type == 'integer'){
            $this->number($propertName, $formLabel, $isRequired, null, ['class' => 'form-control', 'placeholder' => $placeholder]);
            $this->validation->isInteger($propertName, $isRequired, $formValidation);

        }elseif($type == 'datetime'){ // date
            $this->datetime($propertName, $formLabel, $isRequired, null, ['class' => 'form-control', 'placeholder' => $placeholder]);
            $this->validation->isDatetime($propertName, $isRequired, $formValidation);

        }elseif($type == 'date'){ // date
            $this->date($propertName, $formLabel, $isRequired, null, ['class' => 'form-control', 'placeholder' => $placeholder]);
            $this->validation->isDate($propertName, $isRequired, $formValidation);

        }elseif($type == 'time'){ // date
            $this->time($propertName, $formLabel, $isRequired, null, ['class' => 'form-control', 'placeholder' => $placeholder]);
            $this->validation->isTime($propertName, $isRequired, $formValidation);

        }elseif($type == 'text'){ // text
            $this->textarea($propertName, $formLabel, $isRequired, null, ['class' => 'form-control', 'placeholder' => $placeholder]);
            $this->validation->isText($propertName, $isRequired, $formValidation);

        }elseif($type == 'boolean'){ // boolean
            $this->boolean($propertName, $formLabel, $isRequired);
            $this->validation->isBoolean($propertName, $isRequired, $formValidation);

        }elseif($type == 'array'){ // array
            $this->textarea($propertName, $formLabel, $isRequired, null, ['class' => 'form-control', 'placeholder' => $placeholder]);

        }else{
            $this->text($propertName, $formLabel, $isRequired, null, ['class' => 'form-control', 'placeholder' => $placeholder]);
            $this->validation->isText($propertName, $isRequired, $formValidation);
        }
    }

    private function generateRelationInput($relationType, $formLabel, $propertName, $isRequired, $propertyAnnotation)
    {
        $relationTarget = $propertyAnnotation['target'] ?? false;
        $formRelationMethod = $propertyAnnotation['formrelationtype'] ?? 'select' ;
        $formLabelBtnAdd = $propertyAnnotation['formcreatelabel'] ?? 'Ajouter : ' . $propertName ;
        $formLabelBtnRemove = $propertyAnnotation['formremovelabel'] ?? 'Supprimer : ' . $propertName ;


        if($formRelationMethod == 'select'){
            if($relationType == 'OneToOne'){
                $this->OneToOne($propertName, $formLabel, $relationTarget, [], [], $isRequired);
            }elseif($relationType == 'OneToMany'){
                $this->OneToMany($propertName, $formLabel, $relationTarget, [], [], $isRequired);
            }
        }elseif($formRelationMethod == 'create'){

            if($relationType == 'OneToOne'){
                $this->addEntityForm($propertName, $relationTarget);
            }elseif($relationType == 'OneToMany'){
                $this->addEntityFormMultiple($propertName, $relationTarget, $formLabelBtnAdd, $formLabelBtnRemove);
            }
        }else{
            die('Method incorrect');
        }
    }

}