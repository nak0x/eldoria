<?php

namespace Rpg\Models\Enemies\Boss;

use Rpg\Models\Archetypes\Player;
use Rpg\Models\Enemies\Enemy;
use Rpg\Models\Entity;
use Rpg\Enums\Levels;
use Rpg\Enums\EnemyCode;

class Throngrim extends Enemy
{
    const string ENNEMY_CODE = "boss";

    public function __construct(
        public float $level = 1){
        parent::__construct($level);
        $this->max_life = 15000;
        $this->life = $this->max_life;
    }

    #[\Override] public function attack(Player $target): void
    {
        // Throngrim is the boss so his attack should be powerfull
        // Attack remove 25% of max life points
        $target->takeDamage($target->getMaxLife() * 0.25);
    }

    #[\Override] public function defence(): void
    {
        // His deffence cast increase his deffence by 500%
        $this->damageTakenFactor = 0.5;
    }

    #[\Override] public function runAi(Entity $target, int $turn, Levels $level): void{
        // Todo : implement different Ai at least for the boss
        $this->attack($target);
    }

    #[\Override] public function getName(): string
    {
        return "Throngrim";
    }

    #[\Override] public function getEnemyCode(): EnemyCode{
        return EnemyCode::Throngrim;
    }
}