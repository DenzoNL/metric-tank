<?php

namespace App\DataTables;

use App\Metric;
use App\User;
use DB;
use Yajra\Datatables\Services\DataTable;

class MetricsDataTable extends DataTable
{
    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
//            ->addColumn('action', 'path.to.action.view')
            ->make(true);
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
//        $query = DB::table('metrics')
//            ->join('metric_names', 'metric_name_id', '=', 'metric_names.id')
//            ->select('metric_names.name', 'metrics.session_id', 'metrics.value', 'metrics.entries', 'metrics.updated_at');
        $query = Metric::with('metric_name')->select('metrics.*');

        return $this->applyScopes($query);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->ajax('')
                    ->parameters([
                        'dom'          => 'Bfrtip',
                        'buttons'      => ['excel', 'reload'],
                    ]);

    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'session_id',
            'metric_name.name',
            'value',
            'entries',
            'updated_at',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'metrics_' . time();
    }
}
