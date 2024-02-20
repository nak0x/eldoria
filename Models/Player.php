<?php

namespace Rpg\Models;

class Player {
    public string $name;
    public ?string $class = NULL;

    public function __construct($name){
        $this->name = $name;
    }

    public function setClass(string $className): void{
        $this->class = $className;
    }
}