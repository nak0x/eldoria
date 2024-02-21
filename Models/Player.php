<?php

namespace Rpg\Models;

class Player {
    public string $name;
    public ?string $class = NULL;

    public function __construct(string $name, string $className){
        $this->name = $name;
        $this->class = $className;
    }

}