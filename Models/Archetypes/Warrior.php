<?php

namespace Rpg\Models\Archetypes;

use Rpg\Models\Entity;
use Rpg\Models\Items\Weapons\Sword;
use Rpg\Models\Items\Weapons\Weapon;

class Warrior extends Player
{
    private Weapon $weapon;

    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->weapon = new Sword();
    }

    #[\Override] public function buff(): void{
        $this->attackFactor *= 2 * $this->level;
    }

    #[\Override] public function spell(Entity $target): void{
        $damage = $this->weapon->damage * $this->level * $this->attackFactor;
        $target->takeDamage($damage);
    }

    #[\Override] public function ulti(): void{
        $this->damageTakenFactor /= 2 * $this->level;
    }

    #[\Override] public function getClassName(): string
    {
        return "Guerrier";
    }
}