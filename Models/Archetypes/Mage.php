<?php

namespace Rpg\Models\Archetypes;

use Rpg\Enums\Archetypes;
use Rpg\Models\Archetypes\Player;
use Rpg\Models\Entity;

class Mage extends Player
{

  public Archetypes $archetype = Archetypes::MAGE;

    #[\Override] public function buff(): void{
        $this->healFactor *= 2 * $this->level;
    }

    #[\Override] public function spell(Entity $target): void{
        $damage = round(($this->attackFactor * $this->level) / 2);

        $target->takeDamage($damage);
        $this->receiveCare($damage);

    }

    #[\Override] public function ulti():void
    {
        $this->damageTakenFactor /= 3 * $this->level;
    }

    #[\Override] public function getClassName(): string
    {
        return "Mage";
    }
}