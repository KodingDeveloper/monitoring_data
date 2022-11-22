<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $labels = config('constants.pegawai');

        $data = [];
        foreach ($labels as $label) {
            $fieldName = str_replace(' ', '_', strtolower($label));
            $data[] = Pegawai::whereNull($fieldName)->where('status', 'A')->count();
        }

        $bg = [];
        foreach ($labels as $label) {
            $bg[] = '#' . substr(md5($label), 0, 6);
        }

        $url = [];
        foreach ($labels as $label) {
            $url[] = url('pegawai?active=1&nullBy=' . str_replace(' ', '_', strtolower($label)));
        }

        $totalPegawai = [
            'active' => Pegawai::where('status', 'A')->count(),
            'inactive' => Pegawai::where('status', 'Z')->count(),
        ];

        $icons = [
            'key',
            'identification',
            'eye',
            'eye',
            'map',
            'map-pin',
            'rectangle-group',
            'tag',
            'tag',
            'tag',
            'tag',
            'tag',
            'tag',
            'arrow-trending-up',
            'arrow-trending-up',
            'chart-bar',
            'calendar',
            'users',
            'viewfinder-circle',
            'phone',
            'envelope',
            'envelope',
            'globe-alt',
            'user',
            'adjustments-vertical',
            'bug-ant',
            'building-library',
            'beaker',
            'academic-cap',
            'identification',
            'identification',
            'identification',
            'identification',
            'identification',
            'map-pin',
            'home',
            'home',
            'map-pin',
            'map-pin',
            'map-pin',
            'map',
            'map',
            'users',
            'users',
            'calendar',
            'face-smile',
            'viewfinder-circle',
            'calendar',
            'face-smile',
            'viewfinder-circle',
            'calendar',
            'face-smile',
            'viewfinder-circle',
            'calendar',
            'face-smile',
            'user',
            'calendar',
            'user',
            'calendar',
            'user',
            'calendar',
            'user',
            'calendar',
            'calendar-days',
        ];

        $monitoring = [];
        foreach ($labels as $label) {
            $fieldName = str_replace(' ', '_', strtolower($label));
            $monitoring[] = Pegawai::join('pegawai_tmps', function ($join) use ($fieldName) {
                $join->on('pegawais.employee_code', '=', 'pegawai_tmps.employee_code')
                    ->where(DB::raw('pegawais.' . $fieldName), '<>', DB::raw('pegawai_tmps.' . $fieldName));
            })->count();
        }

        return view('dashboard', compact('labels', 'data', 'bg', 'url', 'totalPegawai', 'icons', 'monitoring'));
    }
}
