<?php
namespace App\Imports;

use App\Models\PegawaiTmp;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class PegawaiTmpImport implements ToModel, WithHeadingRow, WithUpserts
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $data = [];
        $fields = config('constants.pegawai');

        $dateFields = [
            'hire_date',
            'spouse_birtdate',
            'a1_bdate',
            'a2_bdate',
            'a3_bdate',
            'ayah_bdate',
            'ibu_bdate',
            'ayah_mertua_bdate',
            'ibu_mertua_bdate',
            'updated_at',
        ];

        foreach ($fields as $field) {
            $field = str_replace(' ' , '_', strtolower($field));
            if (isset($row[$field])) {
                $data[$field] = in_array($field, $dateFields, true) ? date('Y-m-d' ,strtotime($row[$field])) : trim($row[$field]);
            }
        }

        return new PegawaiTmp($data);
    }

    public function headingRow(): int
    {
        return 3;
    }

    public function uniqueBy()
    {
        return 'employee_code';
    }
}
