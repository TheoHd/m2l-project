<?php
namespace Core\Form;

use App;

class FormRenderer{

    protected $form;
    protected $constructor, $defaultConstructor;

    public $beforeSurround = "<div class='form-group'>";
    public $afterSurround = "</div>";
    public $requiredElem = '<sup style="color:red">*</sup>';
    protected $success, $error, $messages;

    public function __construct(Form $form)
    {
        $this->form = $form;
        $this->constructor = $form->getFormConstructor();
        $this->defaultConstructor = $form->getFormConstructor();

        $this->success = $form->getSuccess();
        $this->error = $form->getErrors();
        $this->messages = $form->getMessages();
    }

    public function success(){
        if( !empty($this->success) ){
            $return =  "<div class='alert alert-success'>".implode('<br>', $this->success)."</div>";
            unset($this->success);
            return $return;
        }
        return '';
    }

    public function error(){
        if( !empty($this->error) ){
           $return = "<div class='alert alert-danger'>".implode('<br>', $this->error)."</div>";
           unset($this->error);
           return $return;
        }
        return '';
    }

    public function message(){
        if( !empty($this->error) ) {
            return implode(PHP_EOL, $this->messages);
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
        $index = strtolower($index);
        $c = $this->constructor;
        if( empty($index) ){
            return "Veuillez renseigner un index dans le get()";
        }elseif( !isset($c[$index]) || empty($c[$index]) ){
            return "Aucun champs $index n'à été trouvé !";
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
    protected function surround($html){ $return = $this->beforeSurround . $html . $this->afterSurround; return $return; }

    private function inputTraitement($index)
    {
        $form = $this->form;
        $elem = $this->constructor[$index];

        $name = $form->convertElementIdToName($elem);
        $value = $form->getDefaultData($name);
        $elem = str_ireplace('data-default="__'.strtoupper($index).'__"', 'value="'.$value.'"', $elem);
        $elem = str_ireplace('default-"__'.strtoupper($index).'__"', $value, $elem);
        $elem = str_ireplace('__REQUIRED__', $this->requiredElem, $elem);

        return $this->surround($elem);
    }

    public function __toString()
    {
        return $this->success() . $this->error() . $this->message() . $this->start() . $this->end() . $this->loadScripts();
    }

}