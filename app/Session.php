<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $guarded = [];
    /**
     * Return the device the session belongs to
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function device()
    {
        return $this->belongsTo('App\Device');
    }
    /**
     * Return the platform the session belongs to
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function platform()
    {
        return $this->belongsTo('App\Platform');
    }
    /**
     * Return the game build the session belongs to
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function game_build()
    {
        return $this->belongsTo('App\GameBuild');
    }
    /**
     * Return the metrics associated with the session
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function metrics()
    {
        return $this->hasMany('App\Metric');
    }
}
