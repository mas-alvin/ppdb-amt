<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('jurusan_id')->nullable()->constrained('jurusans')->onDelete('set null');
            $table->foreignId('wave_id')->nullable()->constrained('waves')->onDelete('set null');
            
            // Step 1: Data Pribadi
            $table->string('nama_lengkap');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('nisn', 10)->unique();
            $table->string('nik', 16)->unique();
            $table->string('no_kk', 16);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('no_akta');
            $table->string('agama');
            $table->enum('kewarganegaraan', ['WNI', 'WNA']);
            
            // Step 1: Alamat
            $table->text('alamat');
            $table->string('rt', 5);
            $table->string('rw', 5);
            $table->string('dusun')->nullable();
            $table->string('kelurahan');
            $table->string('kecamatan');
            $table->string('kode_pos', 10);
            
            // Step 1: Kontak
            $table->string('no_hp');
            $table->string('email');
            
            // Step 2: Data Orang Tua / Wali
            // Ayah
            $table->string('ayah_nama');
            $table->string('ayah_nik', 16);
            $table->string('ayah_tahun_lahir', 4);
            $table->string('ayah_pendidikan');
            $table->string('ayah_pekerjaan');
            $table->string('ayah_penghasilan');
            
            // Ibu
            $table->string('ibu_nama');
            $table->string('ibu_nik', 16);
            $table->string('ibu_tahun_lahir', 4);
            $table->string('ibu_pendidikan');
            $table->string('ibu_pekerjaan');
            $table->string('ibu_penghasilan');
            
            // Wali
            $table->string('wali_nama')->nullable();
            $table->string('wali_nik', 16)->nullable();
            $table->string('wali_tahun_lahir', 4)->nullable();
            $table->string('wali_pendidikan')->nullable();
            $table->string('wali_pekerjaan')->nullable();
            $table->string('wali_penghasilan')->nullable();
            
            // Step 3: Data Fisik
            $table->integer('tinggi_badan');
            $table->integer('berat_badan');
            $table->integer('lingkar_kepala');
            
            // Step 3: Jarak & Waktu Tempuh
            $table->decimal('jarak_sekolah', 5, 2);
            $table->integer('waktu_jam');
            $table->integer('waktu_menit');
            
            // Step 3: Informasi Lainnya
            $table->integer('jumlah_saudara');
            
            // Step 4: Prestasi
            $table->string('prestasi_jenis')->nullable();
            $table->string('prestasi_tingkat')->nullable();
            $table->string('prestasi_nama')->nullable();
            $table->string('prestasi_tahun', 4)->nullable();
            $table->string('prestasi_penyelenggara')->nullable();
            
            // Step 4: Program Kesejahteraan
            $table->string('no_kks')->nullable();
            $table->string('no_pkh')->nullable();
            $table->string('no_kip')->nullable();
            
            // Step 5: Asal Sekolah
            $table->string('asal_sekolah');
            $table->string('no_un')->nullable();
            $table->string('no_ijazah')->nullable();
            $table->string('no_skhun')->nullable();
            
            // Status Pendaftaran
            $table->enum('status', ['pending', 'verified', 'rejected'])->default('pending');
            $table->text('catatan_admin')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
