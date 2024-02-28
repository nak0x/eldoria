<?php

namespace Rpg\Models\Items\Weapons;

use Rpg\Models\Items\Items;
use Rpg\Models\Uuid;

abstract class Weapon extends Items
{
    public function __construct(
        string $name,
        int $price,
        public int $damage,
        Uuid $uuid = new Uuid()
    )
    {
        parent::__construct($name, $price, $uuid);
    }
}