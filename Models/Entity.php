<?php

namespace Rpg\Models;

abstract class Entity
{
    public int $life;
    public bool $isAlive = true;
    public bool $skipNextRound = false;
    protected int $max_life;

    const float LEVEL_MAX = 100;

    public function __construct(
        public float $level = 1,
        public Uuid $uuid = new Uuid()
    ) {
        $this->life = 100 * $this->level;
        $this->max_life = $this->life;
    }

    public function takeDamage(int|float $amount): void
    {
        $this->life -= round($amount);
    }

    /**
     * Return true if the entity is still alive
     * 
     * @return bool
     */
    public function isAlive(): bool
    {
        return $this->isAlive;
    }

    /**
     * Care the entity by the amount provided
     * 
     * @param $amount int|float The amount of life to care
     * 
     * @return void
     */
    public function receiveCare(int|float $amount): void
    {
        $this->life += round($amount);
        // Maximise la monté en points de vie
        $this->life = min($this->life, $this->max_life);
    }

    /**
     * Mark the entity as dead and set the LP to 0
     * 
     * @return void
     */
    public function die():void
    {
        $this->life = 0;
        $this->isAlive = false;
    }

    /**
     * Reset the factors of the entity such as damageTaken of attack
     * 
     * @return void
     */
    public abstract function resetFactors(): void;

    /**
     * Return the private int max_life
     * 
     * @return int Return the entity max life
     */
    public function getMaxLife(): int
    {
        return $this->max_life;
    }
}
