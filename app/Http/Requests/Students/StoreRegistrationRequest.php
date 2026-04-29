<?php

namespace App\Http\Requests\Students;

use Illuminate\Foundation\Http\FormRequest;

class StoreRegistrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role === 'student';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // Step 1
            'jurusan_id' => 'required|exists:jurusans,id',
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'nisn' => 'required|string|size:10|unique:registrations,nisn',
            'nik' => 'required|string|size:16|unique:registrations,nik',
            'no_kk' => 'required|string|size:16',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'no_akta' => 'required|string|max:255',
            'agama' => 'required|string|max:50',
            'kewarganegaraan' => 'required|in:WNI,WNA',
            'alamat' => 'required|string',
            'rt' => 'required|string|max:5',
            'rw' => 'required|string|max:5',
            'dusun' => 'nullable|string|max:255',
            'kelurahan' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kode_pos' => 'required|string|max:10',
            'no_hp' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            
            // Step 2
            'ayah_nama' => 'required|string|max:255',
            'ayah_nik' => 'required|string|size:16',
            'ayah_tahun_lahir' => 'required|string|size:4',
            'ayah_pendidikan' => 'required|string',
            'ayah_pekerjaan' => 'required|string',
            'ayah_penghasilan' => 'required|string',
            
            'ibu_nama' => 'required|string|max:255',
            'ibu_nik' => 'required|string|size:16',
            'ibu_tahun_lahir' => 'required|string|size:4',
            'ibu_pendidikan' => 'required|string',
            'ibu_pekerjaan' => 'required|string',
            'ibu_penghasilan' => 'required|string',
            
            'wali_nama' => 'nullable|string|max:255',
            'wali_nik' => 'nullable|string|size:16',
            'wali_tahun_lahir' => 'nullable|string|size:4',
            'wali_pendidikan' => 'nullable|string',
            'wali_pekerjaan' => 'nullable|string',
            'wali_penghasilan' => 'nullable|string',
            
            // Step 3
            'tinggi_badan' => 'required|integer',
            'berat_badan' => 'required|integer',
            'lingkar_kepala' => 'required|integer',
            'jarak_sekolah' => 'required|numeric',
            'waktu_jam' => 'required|integer',
            'waktu_menit' => 'required|integer',
            'jumlah_saudara' => 'required|integer',
            
            // Step 4
            'prestasi_jenis' => 'nullable|string',
            'prestasi_tingkat' => 'nullable|string',
            'prestasi_nama' => 'nullable|string',
            'prestasi_tahun' => 'nullable|string|size:4',
            'prestasi_penyelenggara' => 'nullable|string',
            'no_kks' => 'nullable|string|max:50',
            'no_pkh' => 'nullable|string|max:50',
            'no_kip' => 'nullable|string|max:50',
            
            // Step 5
            'asal_sekolah' => 'required|string|max:255',
            'no_un' => 'nullable|string|max:50',
            'no_ijazah' => 'nullable|string|max:50',
            'no_skhun' => 'nullable|string|max:50',
        ];
    }
}
