<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class InsertMetricTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * Test to verify that we can insert metric data into the database
     *
     * @return void
     */
    public function testInsertingMetricIntoDatabase()
    {
//        $device = factory(App\Device::class)->create();
//        $metric_name = factory(App\MetricName::class)->create();
//        $platform = factory(App\Platform::class)->create();
//        $game_build = factory(App\GameBuild::class)->create();

        $metric = factory(App\Metric::class)->create();

        $this->json('POST', '/metrics', [
            'device_uid' => $metric->session->device->uid,
            'metric_name' => $metric->metric_name->name,
            'platform_name' => $metric->session->platform->name,
            // TODO: Change this to a game build hash rather than id or name
            'game_build_id' => $metric->game_build->id
        ])->seeJson([
                'created' => true,
            ]);
    }
}
