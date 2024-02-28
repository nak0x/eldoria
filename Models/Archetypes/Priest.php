<?php

namespace Rpg\Models\Archetypes;

use Rpg\Models\Archetypes\Player;
use Rpg\Models\Entity;

class Priest extends Player
{

    #[\Override] public function buff(): void
    {
        $this->speFactor *= 2 * $this->level;
    }

    #[\Override] public function spell(Entity $target): void
    {
        if($target->life <= $this->speFactor * $this->level * 10){
            $target->die();
            return;
        }

        $damage = $this->attackFactor * $this->level;
        $target->takeDamage($damage);
    }

    #[\Override] public function ulti(): void
    {
        // TODO: Implement ulti() method.
    }

    #[\Override] public function getClassName(): string
    {
        return "Praître";
    }
}