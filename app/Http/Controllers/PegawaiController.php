<?php

namespace App\Http\Controllers;

use App\Exports\ReportExport;
use App\Imports\PegawaiImport;
use App\Imports\PegawaiTmpImport;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $nullBy = $request->get('nullBy');
        $isActive = $request->get('active');
        $keyword = $request->get('keyword');
        $fields = config('constants.pegawai');
        $query = Pegawai::latest()->where(function ($model) use ($nullBy, $isActive, $fields, $keyword) {
            $model->where('status', $isActive ? 'A' : 'Z');
            if ($nullBy) {
                $model->whereNull($nullBy);
            }
        });

        if ($keyword) {
            $query->where(function ($query) use ($fields, $keyword) {
                foreach ($fields as $field) {
                    $field = str_replace(' ' , '_', strtolower($field));
                    $query->orWhere($field, 'like', '%' . $keyword . '%');
                }
            });
        }

        $pegawai = $query->paginate(5);
        return view('pegawai.index', compact('pegawai', 'fields', 'isActive', 'nullBy', 'keyword'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $isActive = $request->get('isActive');
        $fields = config('constants.pegawai');
        return view('pegawai.form', compact('fields', 'isActive'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pegawai = Pegawai::create($request->all());
        alert()->success('Success','Data pegawai berhasil disimpan');
        return redirect()->route('pegawai.index', ['isActive' => $pegawai->status])->with('message', 'Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Pegawai $pegawai
     * @return \Illuminate\Http\Response
     */
    public function show(Pegawai $pegawai)
    {
        $isActive = $request->get('isActive');
        $fields = config('constants.pegawai');
        return view('pegawai.form', compact('pegawai', 'fields', 'isActive'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Pegawai $pegawai
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Pegawai $pegawai)
    {
        $isActive = $request->get('isActive');
        $fields = config('constants.pegawai');
        return view('pegawai.form', compact('pegawai', 'fields', 'isActive'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Pegawai $pegawai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pegawai $pegawai)
    {
        $fields = config('constants.pegawai');
        $data = [];
        foreach ($fields as $field) {
            $fieldName = str_replace(' ', '_', strtolower($field));
            $data[$fieldName] = $request->$fieldName;
        }
        $pegawai->update($data);

        alert()->success('Success','Data pegawai berhasil diubah');

        return redirect()->route('pegawai.index', ['active' => $pegawai->status === 'A'])->with('message', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Pegawai $pegawai
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pegawai $pegawai)
    {
        $pegawai->delete();
        alert()->success('Success','Data pegawai berhasil dihapus');
        return redirect()->route('pegawai.index')->with('message', 'Deleted Successfully');
    }

    public function import(Request $request)
    {
        $isActive = $request->get('isActive');
        Excel::import(new PegawaiImport(),request()->file('file'));

        alert()->success('Success','Data pegawai berhasil diupload');

        return back();
    }

    public function export() 
    {
        return new ReportExport(Pegawai::all()->toArray());
    }

    public function importTmp(Request $request)
    {
        $isActive = $request->get('isActive');
        Excel::import(new PegawaiTmpImport(),request()->file('file'));

        alert()->success('Success','Data perbandingan berhasil diupload');

        return redirect()->route('monitoring.index')->with('success', 'Successfully Upload');
    }
}
