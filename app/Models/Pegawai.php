<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $primaryKey = 'employee_id';

    protected $fillable = [
        'employee_code',
        'name',
        'status',
        'status_desc',
        'work_location',
        'physical_location',
        'departemen',
        'first_position',
        'old_position',
        'new_position',
        'first_kode_posisi',
        'old_kode_posisi',
        'new_kode_posisi',
        'grade',
        'grade_desc',
        'peringkat_pegawai',
        'hire_date',
        'employee_type',
        'poh',
        'work_phone_no',
        'email',
        'personal_email',
        'birth_country',
        'usia',
        'range_usia',
        'jenis_kelamin',
        'agama',
        'golongan_darah',
        'pendidikan',
        'no_ktp',
        'no_kk',
        'no_bpjstk',
        'no_bpjskes',
        'no_npwp',
        'alamat',
        'desa',
        'kecamatan',
        'lawang_kidul',
        'kota',
        'muara_enim',
        'provinsi',
        'sumatera_selatan',
        'status_kawin',
        'suami_/_istri',
        'spouse_birtdate',
        'spouse_gender',
        'a1',
        'a1_bdate',
        'a1_gender',
        'a2',
        'a2_bdate',
        'a2_gender',
        'a3',
        'a3_bdate',
        'a3_gender',
        'nama_ayah',
        'ayah_bdate',
        'nama_ibu',
        'ibu_bdate',
        'nama_ayah_mertua',
        'ayah_mertua_bdate',
        'nama_ibu_mertua',
        'ibu_mertua_bdate',
        'last_mode_date',
        'is_active'
    ];
}
