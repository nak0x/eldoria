<?php

namespace Rpg\Models\Archetypes;

use Rpg\Models\Entity;

abstract class Player extends Entity{
    public string $name;

    protected float $attackFactor;
    protected float $healFactor;
    protected float $speFactor;
    protected float $damageTakenFactor;

    private array $defaultFactors = [
        "attack" => 5,
        "heal" => 2,
        "spe" => 5,
        "damageTaken" => 100
    ];

    public function __construct(string $name){
        parent::__construct();
        $this->name = $name;
        $this->resetFactors();
        $this->life = 200;
        $this->max_life = $this->life;
    }

    public function punch(Entity $target): void
    {
        $target->takeDamage($this->attackFactor * $this->level);
    }

    public function heal(?Entity $target = null): void
    {
        if($target === null){
            $this->receiveCare($this->healFactor * $this->level);
        }else{
            $target->receiveCare($this->healFactor * $this->level);
        }
    }

    public function resetFactors(): void
    {
        $this->attackFactor = $this->defaultFactors["attack"] * $this->level;
        $this->healFactor = $this->defaultFactors["heal"] * $this->level;
        $this->speFactor = $this->defaultFactors["spe"] * $this->level;
        $this->damageTakenFactor = $this->defaultFactors["damageTaken"];
    }

    public function levelUp(float $amount): void{
        // min() return la plus petite des deux valeur
        $this->level = min($this->level + $amount, Entity::LEVEL_MAX);
    }

    public abstract function getClassName(): string;

    public abstract function buff(): void;
    public abstract function spell(Entity $target): void;
    public abstract function ulti(): void;

}