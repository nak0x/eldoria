<?php

namespace Rpg\Models\Enemies;
use Rpg\Enums\Levels;
use Rpg\Models\Archetypes\Player;
use Rpg\Models\Entity;
use Rpg\Enums\EnemyCode;

abstract class Enemy extends Entity {
    public int $defenceCount = 0;
    protected int $attackFactor = 2;
    protected int $speFactor = 2;
    protected int $damageTakenFactor = 1;

    private array $baseFactor = [
        "attack" => 5,
        "spe" => 5,
        "damageTaken" => 1
    ];

    // Override de la function takeDamage pour appliqué le facteur de damageTaken
    #[\Override] public function takeDamage(float|int $amount): void
    {
        $this->life -= $amount * $this->damageTakenFactor;
        if($this->life <= 0){
            $this->die();
        }
    }

    public abstract function attack(Player $target): void;
    public abstract function defence(): void;
    public abstract function getName(): string;
    public abstract function getEnemyCode(): EnemyCode;

    public function runAi(Entity $target,int $turn, Levels $level): void{
        // TODO : basic enemy ai
        // Todo : Change to abstract and define proper enemies ai
        
        $this->attack($target);
        
    }

    #[\Override] public function resetFactors(): void
    {
        $this->attackFactor = $this->baseFactor["attack"] * $this->level;
        $this->speFactor = $this->baseFactor["spe"] * $this->level;
        $this->damageTakenFactor = $this->baseFactor["damageTaken"] * $this->level;
    }

}