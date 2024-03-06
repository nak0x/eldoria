<?php

namespace Rpg\Enums;

use Rpg\Models\Entity;

enum LevelRange: int
{
    case Low = 0;
    case Med = 1;
    case High = 2;

    public static function getRangeFromLevel(int $level): LevelRange{
        if($level >= 10 && $level < 50){
            return LevelRange::Med;
        }else if($level >= 50 && $level < Entity::LEVEL_MAX){
            return LevelRange::High;
        }else{
            return LevelRange::Low;
        }
    }
}