<?php

namespace Core\Form;

use App;
use Core\ClassReader\ClassReader;

class FormEntityInjection {

    private $data;
    private $entity;
    private $isChildEntity;

    public function __construct($entity, $isChildEntity = false) {
        $this->entity = $entity;
        $this->isChildEntity = $isChildEntity;
    }

    public function getData() {
        $propertiesAnnotation = $this->getAnnotations();
        $this->injectValuesInEntity($propertiesAnnotation);


        if( !$this->isChildEntity ){
//            var_dump($this->data);
        }
        return $this->data;
    }

    private function getAnnotations(){
        $className = get_class($this->entity);
        $reader = new ClassReader($className);
        $propertiesAnnotation = $reader->getPropertiesAnnotation();

        return $propertiesAnnotation;
    }

    private function injectValuesInEntity($propertiesAnnotation)
    {
        foreach ($propertiesAnnotation as $propertName => $propertyAnnotation){

            $type = (isset($propertyAnnotation['type']) && !empty($propertyAnnotation['type']) ) ? $propertyAnnotation['type'] : false ;
            $relationType = (isset($propertyAnnotation['relation']) && !empty($propertyAnnotation['relation'])) ? $propertyAnnotation['relation'] : false;

            if($type){
                $method = "get" . ucfirst($propertName);
                $this->data[strtolower($propertName)] = $this->entity->$method();

            }elseif($relationType){
                if($relationType == 'OneToOne'){

                    $method = "get" . ucfirst($propertName);
                    $entity = $this->entity->$method();

                    $data = new FormEntityInjection($entity, true);
                    $this->data[strtolower($propertName)] = $data->getData();

                }elseif($relationType == 'OneToMany'){

                    $method = "get" . ucfirst($propertName);
                    $array = $this->entity->$method();

                    foreach ($array as $index => $entity){

                        $data = new FormEntityInjection($entity, true);
                        $this->data[strtolower($propertName)][] = $data->getData();

                    }
                }
            }
        }
    }


}