<?php
namespace Core\Form;

use App;

class FormRenderer{

    protected $form;
    protected $constructor, $defaultConstructor;

    public $beforeSurround = "<div class='form-group'>";
    public $afterSurround = "</div>";

//    public $beforeSurround = "";
//    public $afterSurround = "";
    public $requiredElem = "<sup style='color:red'>*</sup>";
    protected $success, $error, $messages;
    protected $formStart = false;

    public function __construct(Form $form)
    {
        $this->form = $form;
        $this->constructor = $form->getFormConstructor();
        $this->success = $form->getSuccess();
        $this->error = $form->getErrors();
        $this->messages = $form->getMessages();
    }

    public function getSuccess($implodeElements = true, $format = false){
        if( !empty($this->success) ){
            $return = '';
            if($implodeElements){
                foreach ($this->success as $k => $success){
                    if(!is_array($success)){ $success = [$success]; }
                    $return .= implode('<br>', $success) . '<br>';
                    unset($this->success[$k]);
                }
            }else{
                $return = $this->success;
            }

            if($format){
                $return = "<div class='alert alert-success'>" . $return . "</div>";
            }
            return $return;
        }
        return '';
    }

    public function getErrors($implodeElements = true, $format = false){
        if( !empty($this->error) ){
            $return = '';
            if($implodeElements){
                foreach ($this->error as $k => $errors){
                    if(!is_array($errors)){ $errors = [$errors]; }
                   $return .= implode('<br>', $errors) . '<br>';
                   unset($this->error[$k]);
                }
            }else{
                $return = $this->error;
            }

            if($format){
                $return = "<div class='alert alert-danger'>" . $return . "</div>";
            }
            return $return;
        }
        return '';
    }

    public function getMessages($implodeElements = true, $format = false){
        if( !empty($this->message) ){
            $return = '';
            if($implodeElements){
                foreach ($this->message as $k => $message){
                    if(!is_array($message)){ $message = [$message]; }
                    $return .= implode('<br>', $message) . '<br>';
                    unset($this->message[$k]);
                }
            }else{
                $return = $this->message;
            }

            if($format){
                $return = "<div class='alert alert-info'>" . $return . "</div>";
            }
            return $return;
        }
        return '';
    }

    public function hasError($index = false){
        if($index){
            return !empty($this->error[$index]);
        }else{
            return !empty($this->error);
        }
    }

    public function hasSuccess($index = false){
        if($index){
            return !empty($this->success[$index]);
        }else{
            return !empty($this->success);
        }
    }

    public function hasMessages($index = false){
        if($index){
            return !empty($this->messages[$index]);
        }else{
            return !empty($this->messages);
        }
    }

    public function getError($index){
        if( !empty($this->error[$index]) ){
            $return = implode('', $this->error[$index]);
            unset($this->error[$index]);
            return $return;
        }
        return '';
    }

    public function getAll(){

        $return = [];
        foreach ($this->constructor as $k => $elem){
            $return[] = $this->inputTraitement($k);
            unset($this->constructor[$k]);
        }

        return implode('', $return);
    }


    public function get($index){
        $index = strtolower( $this->form->getFormName() . '_' . $index);
        $c = $this->constructor;
        if( empty($index) ){
            die("Veuillez renseigner un index dans le get()");
        }elseif( !isset($c[$index]) || empty($c[$index]) ){
            die("Aucun champs <b>$index</b> n'à été trouvé !");
        }

        $return = $this->inputTraitement($index);
        unset($this->constructor[$index]);
        return $return;
    }

    public function next(){
        reset($this->constructor);
        $index = key($this->constructor);
        $return = $this->inputTraitement($index);
        unset($this->constructor[$index]);
        return $return;
    }

    public function start(){
        $form = $this->form;
        $enctypeElem = ($form->getEnctype() != '') ? "enctype='{$form->getEnctype()}'": '' ;
        return "<form action='{$form->getAction()}' method='{$form->getMethod()}' id='{$form->getFormName()}' $enctypeElem>";
    }

    public function end(){
        return $this->getAll() . "</form>";
    }

    public function loadScripts(){ return $this->form->loadFormScript(); }
    protected function surround($html){ return $this->beforeSurround . $html . $this->afterSurround; }

    private function inputTraitement($index) {
        $elem = $this->constructor[$index];
        $elem = str_ireplace('__REQUIRED_ELEMENT__', $this->requiredElem, $elem);
        return $this->surround($elem);
    }

    public function __toString() {
        return $this->getSuccess(true, true) . $this->getErrors(true, true) . $this->getMessages(true, true) . $this->start() . $this->end() . $this->loadScripts();
    }

    public function foreach(callable $callback){
        foreach ($this->constructor as $index => $input){
            $index = str_ireplace($this->form->getFormName() . '_', '', $index);
            $callback($index, $this);
        }
    }

}