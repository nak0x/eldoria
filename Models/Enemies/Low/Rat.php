<?php

namespace Rpg\Models\Enemies\Low;

use Rpg\Models\Archetypes\Player;
use Rpg\Models\Enemies\Enemy;
use Rpg\Enums\EnemyCode;

class Rat extends Enemy
{

    const string ENNEMY_CODE = "rat";

    #[\Override] public function attack(Player $target): void
    {
        $damage = $this->attackFactor * $this->level;
        $target->takeDamage($damage);
    }

    #[\Override] public function defence(): void
    {
        if(($this->defenceCount % 3 == 0 || $this->defenceCount == 0)){
            $this->skipNextRound = true;
        }
        $this->defenceCount++;
    }

    #[\Override] public function getName(): string
    {
        return "Rat";
    }

    #[\Override] public function getEnemyCode(): EnemyCode{
        return EnemyCode::Rat;
    }
}