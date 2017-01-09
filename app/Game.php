<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description'];
    /**
     * Get the game builds associated with the game
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function game_builds()
    {
        return $this->hasMany('App\GameBuild');
    }
}
