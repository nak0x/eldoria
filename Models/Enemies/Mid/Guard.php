<?php

namespace Rpg\Models\Enemies\Mid;

use Rpg\Models\Archetypes\Player;
use Rpg\Models\Enemies\Enemy;
use Rpg\Enums\EnemyCode;

class Guard extends Enemy
{

    const string ENNEMY_CODE = "guard";

    #[\Override] public function attack(Player $target): void
    {
        $damage = $this->attackFactor * $this->level * max($target->level / 20, 1);
        $target->takeDamage($damage);
    }

    #[\Override] public function defence(): void
    {
        // todo : use a shield
        $this->damageTakenFactor = 0.25;
    }

    #[\Override] public function getName(): string
    {
        return "Guard";
    }

    #[\Override] public function getEnemyCode(): EnemyCode{
        return EnemyCode::Guard;
    }
}