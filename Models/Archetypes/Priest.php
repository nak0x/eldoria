<?php

namespace Rpg\Models\Archetypes;

use Rpg\Enums\Archetypes;
use Rpg\Models\Archetypes\Player;
use Rpg\Models\Entity;

class Priest extends Player
{
  public Archetypes $archetype = Archetypes::PRIEST;


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
        $this->healFactor = 2 * max(($this->level / 2), 1);
    }

    #[\Override] public function getClassName(): string
    {
        return "Praître";
    }
}