<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GameBuild extends Model
{
    protected $fillable = ['name', 'description'];
    /**
     * Get the game associated with the game build
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function game()
    {
        return $this->belongsTo('App\Game');
    }
    /**
     * Return the sessions associated with the game build
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sessions()
    {
        return $this->hasMany('App\Session');
    }
}
