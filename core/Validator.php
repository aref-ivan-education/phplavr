<?php

namespace core;

class Validator
{
    private $rules;
    public $clean = [];
    public $errors = [];
    public $clear = [];
    public $success = false;
    
    public function setRules(array $rules)
    {
        $this->rules = $rules;
    }

    public function execute()
    {
        
    }


}