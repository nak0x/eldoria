<?php

namespace Rpg\Enums;

use Rpg\Models\Enemies\Boss\Throngrim;
use Rpg\Models\Enemies\Enemy;
use Rpg\Models\Enemies\Low\Blob;
use Rpg\Models\Enemies\Low\Goblin;
use Rpg\Models\Enemies\Low\Rat;
use Rpg\Models\Enemies\Mid\Guard;
use Rpg\Models\Enemies\Mid\Master;
use Rpg\Models\Enemies\Mid\Vampire;

enum EnemyCode: string
{
    case Blob = "blob";
    case Goblin = "goblin";
    case Rat = "rat";
    case Guard = "guard";
    case Master = "master";
    case Vampire = "vampire";
    case Throngrim = "boss";

    public static function createEnemyFromEnemyCode(EnemyCode $enemyCode, int $levelOfEnemy): Enemy{
        return match($enemyCode){
            EnemyCode::Blob => new Blob($levelOfEnemy),
            EnemyCode::Goblin => new Goblin($levelOfEnemy),
            EnemyCode::Rat => new Rat($levelOfEnemy),
            EnemyCode::Vampire => new Vampire($levelOfEnemy),
            EnemyCode::Master => new Master($levelOfEnemy),
            EnemyCode::Guard => new Guard($levelOfEnemy),
            EnemyCode::Throngrim => new Throngrim($levelOfEnemy)
        };
    }

    public static function getEnemyImage(EnemyCode $enemy): string{
        return match($enemy){
            EnemyCode::Blob => "blob.jpg",
            EnemyCode::Goblin => "goblin.jpg",
            EnemyCode::Rat => "rat.jpg",
            EnemyCode::Vampire => "vampire.jpg",
            EnemyCode::Master => "master.jpg",
            EnemyCode::Guard => "guard.png",
            EnemyCode::Throngrim => "throngrim.jpg"
        };
    }
}