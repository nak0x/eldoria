<?php

namespace Rpg\Models\Enemies\Mid;

use Rpg\Models\Archetypes\Player;
use Rpg\Models\Enemies\Enemy;
use Rpg\Enums\EnemyCode;

class Vampire extends Enemy
{

    const string ENNEMY_CODE = "vampire";

    #[\Override] public function attack(Player $target): void
    {
        $damage = $target->life * 0.17;
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
        return "Vampire";
    }

    #[\Override] public function getEnemyCode(): EnemyCode{
        return EnemyCode::Vampire;
    }
}