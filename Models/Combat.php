<?php

namespace Rpg\Models;

use Rpg\Enums\CombatActions;
use Rpg\Enums\Levels;
use Rpg\Models\Archetypes\Player;
use Rpg\Models\Enemies\Enemy;

class Combat
{
  private array $enemies;
  private Player $player;
  public int $turn = 0;
  public bool $isOver = false;

  // IF bug et modif du joueur colnnage
  public function __construct(public Levels $level, Player $player)
  {
      // TODO : ADD ENEMIES depeing on level and location

      $this->enemies = [];
      $this->player = $player;
  }

  public function turn(CombatActions $action, int|string $enemyIndex): void{
      // TODO : AoE

      // Do the player action
      if(array_key_exists($enemyIndex, $this->enemies)){
          switch ($action){
              case CombatActions::PUNCH:
                  $this->player->punch($this->enemies[$enemyIndex]);
                  break;
              case CombatActions::HEAL:
                  $this->player->heal();
                  break;
              case CombatActions::BUFF:
                  $this->player->buff();
                  break;
              case CombatActions::SPELL:
                  $this->player->spell($this->enemies[$enemyIndex]);
                  break;
              case CombatActions::ULTI:
                  $this->player->ulti();
                  break;
          }
      }else{
          throw new \Exception("Not valid player action");
      }

      // Loop throw enemies for the actions
      foreach ($this->enemies as $enemy){
          $enemy->runAi($this->player, $this->turn, $this->level);
      }

      // Resets player
      if($this->turn % 2 == 0){
          $this->player->resetFactors();
      }

      // Reset enemies and remove them from the combat if they are dead.
      foreach ($this->enemies as $enemyIndex -> $enemy){

          if(!$enemy->isAlive){
              array_splice($this->enemies, 1, $enemyIndex);
          }

          $enemy->resetFactors();

      }

      // Turn validation && increments
      if(!$this->player->isAlive || count($this->enemies) <= 0){
          $this->isOver = true;
      }
      $this->turn++;

  }
}
