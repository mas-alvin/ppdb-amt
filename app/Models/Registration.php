<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'jenis_kelamin',
        'nisn',
        'nik',
        'no_kk',
        'tempat_lahir',
        'tanggal_lahir',
        'no_akta',
        'agama',
        'kewarganegaraan',
        'alamat',
        'rt',
        'rw',
        'dusun',
        'kelurahan',
        'kecamatan',
        'kode_pos',
        'no_hp',
        'email',
        'ayah_nama',
        'ayah_nik',
        'ayah_tahun_lahir',
        'ayah_pendidikan',
        'ayah_pekerjaan',
        'ayah_penghasilan',
        'ibu_nama',
        'ibu_nik',
        'ibu_tahun_lahir',
        'ibu_pendidikan',
        'ibu_pekerjaan',
        'ibu_penghasilan',
        'wali_nama',
        'wali_nik',
        'wali_tahun_lahir',
        'wali_pendidikan',
        'wali_pekerjaan',
        'wali_penghasilan',
        'tinggi_badan',
        'berat_badan',
        'lingkar_kepala',
        'jarak_sekolah',
        'waktu_jam',
        'waktu_menit',
        'jumlah_saudara',
        'prestasi_jenis',
        'prestasi_tingkat',
        'prestasi_nama',
        'prestasi_tahun',
        'prestasi_penyelenggara',
        'no_kks',
        'no_pkh',
        'no_kip',
        'asal_sekolah',
        'no_un',
        'no_ijazah',
        'no_skhun',
        'status',
        'catatan_admin',
        'jurusan_id',
        'wave_id',
        'is_synced_to_datacenter',
        'datacenter_student_id',
    ];

    /**
     * Get the user that owns the registration.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the jurusan for this registration.
     */
    public function jurusan(): BelongsTo
    {
        return $this->belongsTo(Jurusan::class);
    }

    /**
     * Get the wave for this registration.
     */
    public function wave(): BelongsTo
    {
        return $this->belongsTo(Wave::class);
    }
}
