<?php

namespace Rpg\Models\Enemies\Low;

use Rpg\Models\Archetypes\Player;
use Rpg\Models\Enemies\Enemy;

class Goblin extends Enemy
{
    public int $ragePoints = 1;

    #[\Override] public function attack(Player $target): void
    {
        $damage = $this->attackFactor * $this->level * $this->ragePoints;
        $target->takeDamage($damage);
        $this->ragePoints++;
    }

    #[\Override] public function defence(): void
    {
        if(rand(0, 1) && ($this->defenceCount % 3 == 0 || $this->defenceCount == 0)){
            $this->skipNextRound = true;
        }
        $this->defenceCount++;
    }

    public function resetFactors(): void
    {
        parent::resetFactors();
        if($this->ragePoints > 3){
            $this->ragePoints = 1;
        }
    }
}