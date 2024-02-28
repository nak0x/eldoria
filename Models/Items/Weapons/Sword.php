<?php

namespace Rpg\Models\Items\Weapons;

use Rpg\Models\Items\Weapons\Weapon;
use Rpg\Models\Uuid;

class Sword extends Weapon
{
    public function __construct()
    {
        parent::__construct("Sword", 10, 1);
    }
}