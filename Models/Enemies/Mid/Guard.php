<?php

namespace Rpg\Models\Enemies\Mid;

use Rpg\Models\Archetypes\Player;
use Rpg\Models\Enemies\Enemy;

class Guard extends Enemy
{

    #[\Override] public function attack(Player $target): void
    {
        // TODO: Implement attack() method.
    }

    #[\Override] public function defence(): void
    {
        // TODO: Implement defence() method.
    }
}