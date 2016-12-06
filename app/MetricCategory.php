<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MetricCategory extends Model
{
    /**
     * Return the associated metric names for this category
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function metric_names()
    {
        return $this->hasMany('App\MetricName');
    }
}
