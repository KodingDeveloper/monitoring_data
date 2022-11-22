<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawai_tmps', function (Blueprint $table) {
            $table->id('id_tmp');
            $table->string('employee_code')->unique();
            $table->string('name')->nullable()->index();
            $table->string('status')->nullable()->index();
            $table->string('status_desc')->nullable()->index();
            $table->string('work_location')->nullable()->index();
            $table->string('physical_location')->nullable()->index();
            $table->string('departemen')->nullable()->index();
            $table->string('first_position')->nullable()->index();
            $table->string('old_position')->nullable()->index();
            $table->string('new_position')->nullable()->index();
            $table->string('first_kode_posisi')->nullable()->index();
            $table->string('old_kode_posisi')->nullable()->index();
            $table->string('new_kode_posisi')->nullable()->index();
            $table->string('grade')->nullable()->index();
            $table->string('grade_desc')->nullable()->index();
            $table->string('peringkat_pegawai')->nullable()->index();
            $table->date('hire_date')->nullable()->index();
            $table->string('employee_type')->nullable()->index();
            $table->string('poh')->nullable()->index();
            $table->string('work_phone_no')->nullable()->index();
            $table->string('email')->nullable()->index();
            $table->string('personal_email')->nullable()->index();
            $table->string('birth_country')->nullable()->index();
            $table->string('usia')->nullable()->index();
            $table->string('range_usia')->nullable()->index();
            $table->string('jenis_kelamin')->nullable()->index();
            $table->string('agama')->nullable()->index();
            $table->string('golongan_darah')->nullable()->index();
            $table->string('pendidikan')->nullable()->index();
            $table->string('no_ktp')->nullable()->index();
            $table->string('no_kk')->nullable()->index();
            $table->string('no_bpjstk')->nullable()->index();
            $table->string('no_bpjskes')->nullable()->index();
            $table->string('no_npwp')->nullable()->index();
            $table->string('alamat')->nullable()->index();
            $table->string('desa')->nullable()->index();
            $table->string('kecamatan')->nullable()->index();
            $table->string('lawang_kidul')->nullable()->index();
            $table->string('kota')->nullable()->index();
            $table->string('muara_enim')->nullable()->index();
            $table->string('provinsi')->nullable()->index();
            $table->string('sumatera_selatan')->nullable()->index();
            $table->string('status_kawin')->nullable()->index();
            $table->string('suami_atau_istri')->nullable()->index();
            $table->date('spouse_birtdate')->nullable()->index();
            $table->string('spouse_gender')->nullable()->index();
            $table->string('a1')->nullable()->index();
            $table->date('a1_bdate')->nullable()->index();
            $table->string('a1_gender')->nullable()->index();
            $table->string('a2')->nullable()->index();
            $table->date('a2_bdate')->nullable()->index();
            $table->string('a2_gender')->nullable()->index();
            $table->string('a3')->nullable()->index();
            $table->date('a3_bdate')->nullable()->index();
            $table->string('a3_gender')->nullable()->index();
            $table->string('nama_ayah')->nullable()->index();
            $table->date('ayah_bdate')->nullable()->index();
            $table->string('nama_ibu')->nullable()->index();
            $table->date('ibu_bdate')->nullable()->index();
            $table->string('nama_ayah_mertua')->nullable()->index();
            $table->date('ayah_mertua_bdate')->nullable()->index();
            $table->string('nama_ibu_mertua')->nullable()->index();
            $table->date('ibu_mertua_bdate')->nullable()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pegawai_tmps');
    }
};
