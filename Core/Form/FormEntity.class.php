<?php

namespace Core\Form;

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
            $this->entity = \App::getTable($entity)->new();
            if(!$formName){
                $formName = str_ireplace(['Entity', ':',], ['','_'], $entity);
            }
        }

        parent::__construct($data);

        $this->validation = new Validation( $this ) ;

        $this->setFormName($formName);
        $this->generateForm();
    }

    private function generateForm(){

        $className = get_class($this->entity);
        $reader = new ClassReader($className);

        $annotations = $reader->getPropertiesAnnotation();
        $classAnnotation = $reader->getClassAnnotation();

        foreach ($annotations as $propertName => $propertyAnnotation){
            $type = (isset($propertyAnnotation['type']) && !empty($propertyAnnotation['type']) ) ? $propertyAnnotation['type'] : false ;
            $relationType = (isset($propertyAnnotation['relation']) && !empty($propertyAnnotation['relation'])) ? $propertyAnnotation['relation'] : false;
            $isRequired = (isset($propertyAnnotation['nullable']) && $propertyAnnotation['nullable'] == 'true') ? false : true ;

            $formLabel = (isset($propertyAnnotation['formlabel']) && !empty($propertyAnnotation['formlabel'])) ? $propertyAnnotation['formlabel'] : $propertName ;
            $formType = (isset($propertyAnnotation['formType']) && !empty($propertyAnnotation['formType'])) ? $propertyAnnotation['formType'] : $type ;
            $placeholder = (isset($propertyAnnotation['formplaceholder']) && !empty($propertyAnnotation['formplaceholder'])) ? $propertyAnnotation['formplaceholder'] : '' ;

            if($type){
                $this->generateInput($formType, $formLabel, $propertName, $isRequired, $placeholder);
            }elseif($relationType){

                $this->generateRelationInput($relationType, $formLabel, $propertName, $isRequired, $propertyAnnotation);
            }
        }


        if( !$this->isIncludeForm ){
            $label = (isset($classAnnotation['formbtnlabel']) && !empty($classAnnotation['formbtnlabel'])) ? $classAnnotation['formbtnlabel'] : 'Valider' ;
            $this->submit($label);
        }
    }

    private function generateInput($type, $formLabel, $propertName, $isRequired, $placeholder){
        if($type == 'string'){ // string
            $this->text($propertName, $formLabel, $isRequired, null, ['class' => 'form-control', 'placeholder' => $placeholder]);
            $this->validation->isText($propertName, $isRequired);

        }elseif($type == 'identifier'){ // string
            $this->hidden($propertName);

        }elseif($type == 'integer'){ // string
            $this->number($propertName, $formLabel, $isRequired, null, ['class' => 'form-control', 'placeholder' => $placeholder]);
            $this->validation->isNumber($propertName, $isRequired);

        }elseif($type == 'date'){ // date
            $this->date($propertName, $formLabel, $isRequired, null, ['class' => 'form-control', 'placeholder' => $placeholder]);
            $this->validation->isDate($propertName, $isRequired);

        }elseif($type == 'time'){ // date
            $this->time($propertName, $formLabel, $isRequired, null, ['class' => 'form-control', 'placeholder' => $placeholder]);
            $this->validation->isText($propertName, $isRequired);

        }elseif($type == 'text'){ // text
            $this->textarea($propertName, $formLabel, $isRequired, null, ['class' => 'form-control', 'placeholder' => $placeholder]);
            $this->validation->isTextarea($propertName, $isRequired);

        }elseif($type == 'boolean'){ // boolean
            $this->boolean($propertName, $formLabel, $isRequired);
            $this->validation->isRequired($propertName, $isRequired);

        }elseif($type == 'array'){ // array
            $this->textarea($propertName, $formLabel, $isRequired, null, ['class' => 'form-control', 'placeholder' => $placeholder]);
            $this->validation->isTextarea($propertName, $isRequired);
        }else{
            $this->text($propertName, $formLabel, $isRequired, null, ['class' => 'form-control', 'placeholder' => $placeholder]);
            $this->validation->isText($propertName, $isRequired);
        }
    }

    private function generateRelationInput($relationType, $formLabel, $propertName, $isRequired, $propertyAnnotation)
    {
        $relationTarget = (isset($propertyAnnotation['target']) && !empty($propertyAnnotation['target'])) ? $propertyAnnotation['target'] : false;
        $formRelationMethod = (isset($propertyAnnotation['formrelationtype']) && !empty($propertyAnnotation['formrelationtype'])) ? $propertyAnnotation['formrelationtype'] : 'select' ;

        $formLabelBtnAdd = (isset($propertyAnnotation['formcreatelabel']) && !empty($propertyAnnotation['formcreatelabel'])) ? $propertyAnnotation['formcreatelabel'] : 'Ajouter : ' . $propertName ;
        $formLabelBtnRemove = (isset($propertyAnnotation['formremovelabel']) && !empty($propertyAnnotation['formremovelabel'])) ? $propertyAnnotation['formremovelabel'] : 'Supprimer : ' . $propertName ;


        if($formRelationMethod == 'select'){
            if($relationType == 'OneToOne'){
                $this->OneToOne($propertName, $formLabel, $relationTarget, [], [], $isRequired);
            }elseif($relationType == 'OneToMany'){
                $this->OneToMany($propertName, $formLabel, $relationTarget, [], [], $isRequired);
            }
        }else{

            if($relationType == 'OneToOne'){
                $this->addEntityForm($propertName, $relationTarget);
            }elseif($relationType == 'OneToMany'){
                $this->addEntityFormMultiple($propertName, $relationTarget, $formLabelBtnAdd, $formLabelBtnRemove);
            }
        }
    }

}