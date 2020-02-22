<?php

namespace App\Http\Controllers;

use App\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ChartController extends Controller
{
    /**
     * @param  Request  $request
     * @return array
     * @throws \Exception
     */
    public function index(Request $request)
    {
        $params = $request->validate([
            'period' => Rule::in(['year', 'month', 'week', 'day']),
            'source_id' => ['required', Rule::exists('currencies', 'id')],
            'target_id' => ['required', Rule::exists('currencies', 'id')],
        ]);

        return [
            'chart' => array_reverse(
                Currency::findOrFail($params['target_id'])->rates($params['source_id'])
                ->selectRaw(
                    "time_bucket_gapfill(interval '1 ".Str::plural(request('period'))."' / 150, created_at, start => ?, finish => now()) AS time, interpolate(percentile_cont(0.5) WITHIN GROUP (ORDER BY value)) as value",
                    [
                        $this->periodToCarbonStart(),
                    ])
                ->where('created_at', '>', $this->periodToCarbonStart())
                ->groupBy('time')
                ->orderByDesc('time')
                ->limit(150)
                ->get()
                ->toArray()
            ),
            'gross' => Currency::findOrFail($params['target_id'])->rates($params['source_id'])
                ->selectRaw("last(value, created_at) / first(value, created_at) * 100 - 100 as gross")
                ->where('created_at', '>', $this->periodToCarbonStart())
                ->groupBy('target_id')
                ->first()
                ->gross,
            'latest' => Currency::findOrFail($params['target_id'])->rates($params['source_id'])
                ->latest()
                ->first()
                ->value,
            'source' => Currency::findOrFail($params['source_id'])->only(['id', 'name', 'name_es'])
        ];
    }

    private function periodToCarbonStart()
    {
        if (request('period') === 'year') {
            return Carbon::now()->subYear();
        }

        if (request('period') === 'month') {
            return Carbon::now()->subMonth();
        }

        if (request('period') === 'week') {
            return Carbon::now()->subWeek();
        }

        if (request('period') === 'day') {
            return Carbon::now()->subDay();
        }

        return Carbon::now()->subDecade();
    }
}
