<?php

namespace App\Http\Controllers;

use App\Imports\PegawaiImport;
use App\Imports\PegawaiTmpImport;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class MonitoringController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $diffBy = $request->get('diffBy');
        $keyword = $request->get('keyword');
        $fields = config('constants.pegawai');
        $select = [];
        foreach ($fields as $field) {
            $field = str_replace(' ' , '_', strtolower($field));
//            $select[] = DB::raw('pegawais.' . $field . 'p' . strtolower($field));
            $select[] = DB::raw('pegawais.' . $field . ' p' . $field);
        }
        $select[] = DB::raw('employee_id pemployee_id');
        foreach ($fields as $field) {
            $field = str_replace(' ' , '_', strtolower($field));
            $select[] = DB::raw('pegawai_tmps.' . $field . ' tmp' . $field);
        }
//        dd($select);
        $query = Pegawai::select($select)->join('pegawai_tmps', function ($join) {
            $join->on('pegawais.employee_code', '=', 'pegawai_tmps.employee_code');
        })->where(function ($model) use ($diffBy, $fields, $keyword) {
            if ($diffBy) {
                $model->where(DB::raw('pegawais.' . $diffBy), '<>', DB::raw('pegawai_tmps.' . $diffBy));
            }
        });

        if ($keyword) {
            $query->where(function ($query) use ($fields, $keyword) {
                foreach ($fields as $field) {
                    $field = str_replace(' ' , '_', strtolower($field));
                    $query->orWhere('pegawais.' . $field, 'like', '%' . $keyword . '%');
                }
            });
        }

        $pegawai = $query->paginate(5);
        return view('monitoring.index', compact('pegawai', 'fields', 'diffBy', 'keyword'));
    }
}
