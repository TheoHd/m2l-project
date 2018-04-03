<?php

namespace Core\Form;

use Core\ClassReader\ClassReader;
use Core\Entity\Entity;
use Core\Request\Request;

class FormEntity extends Form {

    private $entity;
    protected $isIncludeForm = false;

    public function __construct(?String $entity, array $data = [], $formName = false, $isIncludeForm = false)
    {
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

        $this->setFormName($formName);
        $this->generateForm();
    }

    private function generateForm(){

        $className = get_class($this->entity);
        $reader = new ClassReader($className);

        $annotations = $reader->getPropertiesAnnotation();
        $classAnnotation = $reader->getClassAnnotation();
        unset($annotations['id']);

        foreach ($annotations as $propertName => $propertyAnnotation){
            $type = (isset($propertyAnnotation['type']) && !empty($propertyAnnotation['type']) ) ? $propertyAnnotation['type'] : false ;
            $relationType = (isset($propertyAnnotation['relation']) && !empty($propertyAnnotation['relation'])) ? $propertyAnnotation['relation'] : false;
            $relationTarget = (isset($propertyAnnotation['target']) && !empty($propertyAnnotation['target'])) ? $propertyAnnotation['target'] : false;
            $isRequired = (isset($propertyAnnotation['nullable']) && $propertyAnnotation['nullable'] == 'true') ? false : true ;

            $isRequired = false; // TODO : à supprimer

            $formLabel = (isset($propertyAnnotation['formlabel']) && !empty($propertyAnnotation['formlabel'])) ? $propertyAnnotation['formlabel'] : $propertName ;
            $formType = (isset($propertyAnnotation['formType']) && !empty($propertyAnnotation['formType'])) ? $propertyAnnotation['formType'] : $type ;
            $placeholder = (isset($propertyAnnotation['formplaceholder']) && !empty($propertyAnnotation['formplaceholder'])) ? $propertyAnnotation['formplaceholder'] : '' ;

            if($type){
                $this->generateInput($formType, $formLabel, $propertName, $isRequired, $placeholder);
            }elseif($relationType){
                $formRelationMethod = (isset($propertyAnnotation['formrelationtype']) && !empty($propertyAnnotation['formrelationtype'])) ? $propertyAnnotation['formrelationtype'] : 'select' ;
                $this->generateRelationInput($relationType, $relationTarget, $formRelationMethod, $formLabel, $propertName, $isRequired);
            }
        }

        $submitLabel = (isset($classAnnotation['formsubmitlabel']) && !empty($classAnnotation['formsubmitlabel'])) ? $classAnnotation['formsubmitlabel'] : 'Create' ;

        if( !$this->isIncludeForm ){
            $this->submit($submitLabel);
        }
    }

    private function generateInput($type, $formLabel, $propertName, $isRequired, $placeholder){
        if($type == 'string'){ // string
            $this->text($propertName, $formLabel, $isRequired, null, ['class' => 'form-control', 'placeholder' => $placeholder]);
        }elseif($type == 'datetime'){ // date
            $this->date($propertName, $formLabel, $isRequired, null, ['class' => 'form-control', 'placeholder' => $placeholder]);
        }elseif($type == 'text'){ // text
            $this->textarea($propertName, $formLabel, $isRequired, null, ['class' => 'form-control', 'placeholder' => $placeholder]);
        }elseif($type == 'boolean'){ // boolean
            $this->boolean($propertName, $formLabel, $isRequired);
        }elseif($type == 'array'){ // array
            $this->textarea($propertName, $formLabel, $isRequired, null, ['class' => 'form-control', 'placeholder' => $placeholder]);
        }
    }

    private function generateRelationInput($relationType, $relationTarget, $formRelationMethod, $formLabel, $propertName, $isRequired)
    {
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
                $this->addEntityFormMultiple($propertName, $relationTarget);
            }
        }
    }

}