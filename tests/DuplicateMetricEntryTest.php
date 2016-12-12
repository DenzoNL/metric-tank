<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DuplicateMetricEntryTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Test that when we enter a metric with identical session id's,
     * the entries variable is increased by 1
     *
     * @return void
     */
    public function testEnteringADuplicateMetricEntry()
    {
        $this->withoutMiddleware();

        /* Create a metric */
        $metric = factory(App\Metric::class)->make();

        /* POST a metric */
        $this->json('POST', 'api/v1/metric', [
            'device_uid' => $metric->session->device->uid,
            'metric_name' => $metric->metric_name->name,
            'platform_name' => $metric->session->platform->name,
            // TODO: Change this to a game build hash rather than id or name
            'game_build_id' => $metric->session->game_build->id,
            'value' => $metric->value
        ])->seeJson([
            'created' => true,
            'new' => true
        ]);

        /* Make sure that there is only one entry */
        $this->json('GET', 'api/v1/metric/' . 1)
            ->seeJson(['entries' => 1]);

        /* Post it again and see that there are two entries */
        $this->json('POST', 'api/v1/metric', [
            'device_uid' => $metric->session->device->uid,
            'metric_name' => $metric->metric_name->name,
            'platform_name' => $metric->session->platform->name,
            // TODO: Change this to a game build hash rather than id or name
            'game_build_id' => $metric->session->game_build->id,
            'value' => $metric->value
        ])->seeJson([
            'created' => true,
            'new' => false,
        ]);

        /* Verify that we have two metric entries now */
        $this->json('GET', 'api/v1/metric/' . 1)
            ->seeJson(['entries' => 2]);

    }
}
