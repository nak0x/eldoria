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
    )
    {
        $this->life = 100 * $this->level;
        $this->max_life = $this->life;
    }

    public function takeDamage(int $amount): void
    {
        $this->life -= $amount;
    }

    public function receiveCare(int $amount): void
    {
        $this->life += $amount;
        // Maximise la monté en points de vie
        $this->life = min($this->life, $this->max_life);
    }

    public function die():void
    {
        $this->life = 0;
        $this->isAlive = false;
    }

    public abstract function resetFactors(): void;
}
