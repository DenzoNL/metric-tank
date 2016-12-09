<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    /**
     * Get the game builds associated with the game
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function game_builds()
    {
        return $this->hasMany('App\GameBuild');
    }
}
