<?php

namespace Rpg\Models\Items;

use Rpg\Models\Uuid;

class Items
{
    public function __construct(
        public string $name,
        public int $price,
        public Uuid $uuid = new Uuid()
    )
    {
    }
}