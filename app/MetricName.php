<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MetricName extends Model
{
    protected $guarded = [];
    /**
     * Get the category the metric name belongs to
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function metric_category()
    {
        return $this->belongsTo('App\MetricCategory');
    }
    /**
     * Return the metrics associated with the metric name
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function metrics()
    {
        return $this->hasMany('App\Metric');
    }
}
