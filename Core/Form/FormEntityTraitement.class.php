<?php

namespace Core\Form;

use App;
use Core\ClassReader\ClassReader;

class FormEntityTraitement {

    private $data;
    private $entity;
    private $isChildEntity = false;
    private $entityManager;

    public function __construct($entityName, $data, $isChildEntity = false)
    {
        $this->isChildEntity = $isChildEntity;

        if($isChildEntity) {
            $this->data = $data;
        }else{
            $this->data = $data[ strtolower(str_replace(':', '_', $entityName)) ];
        }

        $this->entityManager = App::getTable($entityName);

        if( !isset($this->data['id']) || empty($this->data['id']) ){ // Create Method
            $this->entity = $this->entityManager->new();

        }elseif( isset($this->data['id']) && !empty($this->data['id'])  ){ // Update Method
            $id = $this->data['id'];
            $this->entity = $this->entityManager->findById($id);
        }

        $this->getEntity();

//        var_dump($this->getEntity()); // TODO : check

        if( !$this->isChildEntity ) {
            $this->entityManager->save();
        }
    }

    public function getEntity() {
        $propertiesAnnotation = $this->getAnnotations();
        $this->injectValuesInEntity($propertiesAnnotation);

        return $this->entity;
    }

    private function getAnnotations(){
        $className = get_class($this->entity);
        $reader = new ClassReader($className);

        $propertiesAnnotation = $reader->getPropertiesAnnotation();
        unset($propertiesAnnotation['id']);

        return $propertiesAnnotation;
    }

    private function injectValuesInEntity($propertiesAnnotation)
    {
        foreach ($propertiesAnnotation as $propertName => $propertyAnnotation){

            $type = (isset($propertyAnnotation['type']) && !empty($propertyAnnotation['type']) ) ? $propertyAnnotation['type'] : false ;
            $relationType = (isset($propertyAnnotation['relation']) && !empty($propertyAnnotation['relation'])) ? $propertyAnnotation['relation'] : false;
            $relationTarget = (isset($propertyAnnotation['target']) && !empty($propertyAnnotation['target'])) ? $propertyAnnotation['target'] : false;
            if($type){
                $method = "set" . ucfirst($propertName);
                $this->entity->$method( $this->data[strtolower($propertName)] );
            }elseif($relationType){
                if($relationType == 'OneToOne'){

                    $newData = $this->data[ strtolower($propertName) ][0];
                    if(is_string($newData)){
                        $entity = App::getTable($relationTarget)->findById($newData);
                    }else{
                        $traitement = new FormEntityTraitement($relationTarget, $newData, true);
                        $entity = $traitement->getEntity();
                    }

                    $method = "set" . ucfirst($propertName);
                    $this->entity->$method( $entity );

                }elseif($relationType == 'OneToMany'){

                    foreach ($this->data[strtolower($propertName)] as $index => $values){
                        if(is_string($values)){
                            $entity = App::getTable($relationTarget)->findById($values);
                        }else {
                            $traitement = new FormEntityTraitement($relationTarget, $values, true);
                            $entity = $traitement->getEntity();
                        }

                        $method = "add" . ucfirst($propertName);
                        $this->entity->$method( $entity );
                    }
                }
            }
        }
    }


}