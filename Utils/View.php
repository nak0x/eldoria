<?php

namespace Rpg\Utils;

use Rpg\Enums\GameState;

class View{

    public string $name;
    public GameState $game_state;
    public string $path;

    public function __construct(string $name, GameState $game_state, string $path){
        $this->name = $name;
        $this->game_state = $game_state;
        $this->path = $path;
    }

    // return true if the view file name is a real game view
    static function isValidViewName(string $fn): bool{
        return (
            file_exists("./views/$fn")
            && $fn != "."
            && $fn != ".."
            && $fn != "game.view.php"
            && $fn != "default.view.php"
        );
    }
}
