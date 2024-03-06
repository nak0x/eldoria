<?php

namespace Rpg\Models\Enemies\Mid;

use Rpg\Models\Archetypes\Player;
use Rpg\Models\Enemies\Enemy;
use Rpg\Enums\EnemyCode;

class Master extends Enemy
{

    const string ENNEMY_CODE = "master";

    #[\Override] public function attack(Player $target): void
    {
        $damage = $this->attackFactor * ($this->speFactor / 2) * $this->level * max($target->level / 2, 1);
        $target->takeDamage($damage);

    }

    #[\Override] public function defence(): void
    {
        $this->damageTakenFactor = 0.9;
    }

    #[\Override] public function getName(): string
    {
        return "Master";
    }

    #[\Override] public function getEnemyCode(): EnemyCode{
        return EnemyCode::Master;
    }
}