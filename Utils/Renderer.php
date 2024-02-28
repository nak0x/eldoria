<?php

namespace Rpg\Utils;

use Rpg\Utils\View;
use Rpg\Enums\GameState;

class Renderer{
    public ?array $views;

    public function __construct(){
        // Fetch all my view
        $raw_views = scandir("./views");

        // loop throw all the views
        foreach($raw_views as $fp){
            if(View::isValidViewName($fp)){
                $exploded_fn = explode(".", $fp);
                // Naming convention : viewname.gamestep.view.php => [name, step, view, php]
                $this->views[] = new View($exploded_fn[0], GameState::getStateFromInt(intval($exploded_fn[1])), "views/$fp");
            }
        }
    }
    
    // Loop throw all View in $views and return it path if the gameState match 
    public function render(GameState $gameState): string{
        foreach($this->views as $view){
            if($view->game_state === $gameState){
                return $view->path;
            }
        }
        return "views/default.view.php";   
    }
}