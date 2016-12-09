<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RetrieveMetricTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Assert that we can retrieve a metric from the database
     *
     * @return void
     */
    public function testRetrievingMetricFromDatabase()
    {
        /* Generate a metric */
        $metric = factory(App\Metric::class)->create();

        /* Submit a GET request to the API and verify that we retrieve the exact metric
         * that we created
         */
        $this->json('GET', 'api/v1/metric/' . $metric->id)
            ->seeJsonEquals($metric->toArray());
    }
}
