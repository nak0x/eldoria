<?php

namespace Rpg\Models\Enemies;
use Rpg\Models\Archetypes\Player;
use Rpg\Models\Entity;

abstract class Enemy extends Entity {

    public int $defenceCount = 0;

    protected int $attackFactor;
    protected int $speFactor;
    protected int $damageTakenFactor;

    private array $baseFactor = [
        "attack" => 5,
        "spe" => 5,
        "damageTaken" => 100
    ];

    public abstract function attack(Player $target): void;
    public abstract function defence(): void;

    #[\Override] public function resetFactors(): void
    {
        $this->attackFactor = $this->baseFactor["attack"] * $this->level;
        $this->speFactor = $this->baseFactor["spe"] * $this->level;
        $this->damageTakenFactor = $this->baseFactor["damageTaken"] * $this->level;
    }
}