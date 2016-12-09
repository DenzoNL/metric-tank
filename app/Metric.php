<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Metric extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    /**
     * Return the session associated with the metric
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function session()
    {
        return $this->belongsTo('App\Session');
    }
    /**
     * Return the metric name associated with the metric
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function metric_name()
    {
        return $this->belongsTo('App\MetricName');
    }
}
