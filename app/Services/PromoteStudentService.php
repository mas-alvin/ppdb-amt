<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Registration;

class PromoteStudentService
{
    /**
     * Promote a verified PPDB student registration to the Data Center.
     *
     * @param Registration $registration
     * @return void
     * @throws \Exception
     */
    public function promote(Registration $registration): void
    {
        // 1. Pre-validation checks
        if ($registration->status !== 'verified') {
            throw new \Exception('Registrasi harus berstatus "verified" untuk dapat dipromosikan ke Data Center.');
        }

        if ($registration->is_synced_to_datacenter) {
            return;
        }

        // 2. Perform synchronization in a direct Data Center database transaction
        DB::connection('datacenter')->transaction(function () use ($registration) {
            
            // A. Fetch first available school institution from Data Center
            $schoolInstitution = DB::connection('datacenter')->table('school_institutions')->first();
            $schoolInstitutionId = $schoolInstitution ? $schoolInstitution->id : null;

            // B. Split nama_lengkap into first_name and last_name
            $nameParts = explode(' ', trim($registration->nama_lengkap));
            $firstName = $nameParts[0];
            $lastName = count($nameParts) > 1 ? implode(' ', array_slice($nameParts, 1)) : null;

            // C. Find or Create Person record in Data Center
            $person = DB::connection('datacenter')->table('persons')
                ->where('identity_number', $registration->nik)
                ->orWhere('email', $registration->email)
                ->first();

            if (!$person) {
                $personId = (string) Str::uuid();
                DB::connection('datacenter')->table('persons')->insert([
                    'id' => $personId,
                    'school_institution_id' => $schoolInstitutionId,
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'email' => $registration->email,
                    'phone' => $registration->no_hp,
                    'address' => $registration->alamat,
                    'gender' => $registration->jenis_kelamin === 'L' ? 'male' : 'female',
                    'birth_date' => $registration->tanggal_lahir,
                    'birth_place' => $registration->tempat_lahir,
                    'identity_number' => $registration->nik,
                    'religion' => $registration->agama,
                    
                    // Address components
                    'rt' => $registration->rt,
                    'rw' => $registration->rw,
                    'dusun' => $registration->dusun,
                    'kelurahan' => $registration->kelurahan,
                    'kecamatan' => $registration->kecamatan,
                    'kewarganegaraan' => $registration->kewarganegaraan,

                    // Detailed Parent Fields
                    'father_name' => $registration->ayah_nama,
                    'father_nik' => $registration->ayah_nik,
                    'father_birth_year' => $registration->ayah_tahun_lahir,
                    'father_education' => $registration->ayah_pendidikan,
                    'father_occupation' => $registration->ayah_pekerjaan,
                    'father_income' => $registration->ayah_penghasilan,

                    'mother_name' => $registration->ibu_nama,
                    'mother_nik' => $registration->ibu_nik,
                    'mother_birth_year' => $registration->ibu_tahun_lahir,
                    'mother_education' => $registration->ibu_pendidikan,
                    'mother_occupation' => $registration->ibu_pekerjaan,
                    'mother_income' => $registration->ibu_penghasilan,

                    'guardian_name' => $registration->wali_nama,
                    'guardian_nik' => $registration->wali_nik,
                    'guardian_birth_year' => $registration->wali_tahun_lahir,
                    'guardian_education' => $registration->wali_pendidikan,
                    'guardian_occupation' => $registration->wali_pekerjaan,
                    'guardian_income' => $registration->wali_penghasilan,

                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } else {
                $personId = $person->id;
                // Update empty fields to align profiles
                DB::connection('datacenter')->table('persons')
                    ->where('id', $personId)
                    ->update([
                        'religion' => $person->religion ?: $registration->agama,
                        'rt' => $person->rt ?? $registration->rt,
                        'rw' => $person->rw ?? $registration->rw,
                        'dusun' => $person->dusun ?? $registration->dusun,
                        'kelurahan' => $person->kelurahan ?? $registration->kelurahan,
                        'kecamatan' => $person->kecamatan ?? $registration->kecamatan,
                        'kewarganegaraan' => $person->kewarganegaraan ?? $registration->kewarganegaraan,

                        'father_name' => $person->father_name ?: $registration->ayah_nama,
                        'father_nik' => $person->father_nik ?? $registration->ayah_nik,
                        'father_birth_year' => $person->father_birth_year ?? $registration->ayah_tahun_lahir,
                        'father_education' => $person->father_education ?? $registration->ayah_pendidikan,
                        'father_occupation' => $person->father_occupation ?? $registration->ayah_pekerjaan,
                        'father_income' => $person->father_income ?? $registration->ayah_penghasilan,

                        'mother_name' => $person->mother_name ?: $registration->ibu_nama,
                        'mother_nik' => $person->mother_nik ?? $registration->ibu_nik,
                        'mother_birth_year' => $person->mother_birth_year ?? $registration->ibu_tahun_lahir,
                        'mother_education' => $person->mother_education ?? $registration->ibu_pendidikan,
                        'mother_occupation' => $person->mother_occupation ?? $registration->ibu_pekerjaan,
                        'mother_income' => $person->mother_income ?? $registration->ibu_penghasilan,

                        'guardian_name' => $person->guardian_name ?: $registration->wali_nama,
                        'guardian_nik' => $person->guardian_nik ?? $registration->wali_nik,
                        'guardian_birth_year' => $person->guardian_birth_year ?? $registration->wali_tahun_lahir,
                        'guardian_education' => $person->guardian_education ?? $registration->wali_pendidikan,
                        'guardian_occupation' => $person->guardian_occupation ?? $registration->wali_pekerjaan,
                        'guardian_income' => $person->guardian_income ?? $registration->wali_penghasilan,
                        'updated_at' => now(),
                    ]);
            }

            // D. Find or Create User credentials in Data Center
            $user = DB::connection('datacenter')->table('users')
                ->where('email', $registration->email)
                ->first();

            if (!$user) {
                // Fetch the hashed password from PPDB's users table
                $ppdbUser = DB::table('users')->where('id', $registration->user_id)->first();
                $passwordHash = $ppdbUser ? $ppdbUser->password : bcrypt('password123');

                $userId = (string) Str::uuid();
                DB::connection('datacenter')->table('users')->insert([
                    'id' => $userId,
                    'name' => $registration->nama_lengkap,
                    'email' => $registration->email,
                    'username' => $registration->nisn, // Use NISN as username
                    'password' => $passwordHash, // Copy exact hash for instant SSO
                    'person_id' => $personId,
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // E. Find or Create Student Academic Master record in Data Center
            $student = DB::connection('datacenter')->table('students')
                ->where('student_id', $registration->nisn)
                ->first();

            // Resolve Major Name from Jurusan ID
            $majorName = null;
            if ($registration->jurusan_id) {
                $jurusan = DB::table('jurusans')->where('id', $registration->jurusan_id)->first();
                if ($jurusan) {
                    $majorName = $jurusan->nama_jurusan;
                }
            }

            $entryYear = date('Y');
            $schoolYear = $entryYear . '/' . ($entryYear + 1);

            if (!$student) {
                $studentId = (string) Str::uuid();
                DB::connection('datacenter')->table('students')->insert([
                    'id' => $studentId,
                    'person_id' => $personId,
                    'school_institution_id' => $schoolInstitutionId,
                    'student_id' => $registration->nisn,
                    'student_code' => $registration->nisn,
                    'enrollment_number' => $registration->nisn,
                    'enrollment_date' => now(),
                    'major' => $majorName,
                    'entry_year' => $entryYear,
                    'school_year' => $schoolYear,
                    'status' => 'active',

                    // Demographics & Welfare
                    'no_kk' => $registration->no_kk,
                    'no_akta' => $registration->no_akta,
                    'tinggi_badan' => $registration->tinggi_badan,
                    'berat_badan' => $registration->berat_badan,
                    'lingkar_kepala' => $registration->lingkar_kepala,
                    'jarak_sekolah' => $registration->jarak_sekolah,
                    'waktu_jam' => $registration->waktu_jam,
                    'waktu_menit' => $registration->waktu_menit,
                    'jumlah_saudara' => $registration->jumlah_saudara,
                    'no_kks' => $registration->no_kks,
                    'no_pkh' => $registration->no_pkh,
                    'no_kip' => $registration->no_kip,

                    // Intake details
                    'asal_sekolah' => $registration->asal_sekolah,
                    'no_un' => $registration->no_un,
                    'no_ijazah' => $registration->no_ijazah,
                    'no_skhun' => $registration->no_skhun,

                    // Achievements
                    'prestasi_jenis' => $registration->prestasi_jenis,
                    'prestasi_tingkat' => $registration->prestasi_tingkat,
                    'prestasi_nama' => $registration->prestasi_nama,
                    'prestasi_tahun' => $registration->prestasi_tahun,
                    'prestasi_penyelenggara' => $registration->prestasi_penyelenggara,

                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } else {
                $studentId = $student->id;
                // Update student academic fields
                DB::connection('datacenter')->table('students')
                    ->where('id', $studentId)
                    ->update([
                        'major' => $majorName,
                        'entry_year' => $entryYear,
                        'school_year' => $schoolYear,
                        'no_kk' => $student->no_kk ?? $registration->no_kk,
                        'no_akta' => $student->no_akta ?? $registration->no_akta,
                        'tinggi_badan' => $student->tinggi_badan ?? $registration->tinggi_badan,
                        'berat_badan' => $student->berat_badan ?? $registration->berat_badan,
                        'lingkar_kepala' => $student->lingkar_kepala ?? $registration->lingkar_kepala,
                        'jarak_sekolah' => $student->jarak_sekolah ?? $registration->jarak_sekolah,
                        'waktu_jam' => $student->waktu_jam ?? $registration->waktu_jam,
                        'waktu_menit' => $student->waktu_menit ?? $registration->waktu_menit,
                        'jumlah_saudara' => $student->jumlah_saudara ?? $registration->jumlah_saudara,
                        'no_kks' => $student->no_kks ?? $registration->no_kks,
                        'no_pkh' => $student->no_pkh ?? $registration->no_pkh,
                        'no_kip' => $student->no_kip ?? $registration->no_kip,
                        'asal_sekolah' => $student->asal_sekolah ?? $registration->asal_sekolah,
                        'no_un' => $student->no_un ?? $registration->no_un,
                        'no_ijazah' => $student->no_ijazah ?? $registration->no_ijazah,
                        'no_skhun' => $student->no_skhun ?? $registration->no_skhun,
                        'prestasi_jenis' => $student->prestasi_jenis ?? $registration->prestasi_jenis,
                        'prestasi_tingkat' => $student->prestasi_tingkat ?? $registration->prestasi_tingkat,
                        'prestasi_nama' => $student->prestasi_nama ?? $registration->prestasi_nama,
                        'prestasi_tahun' => $student->prestasi_tahun ?? $registration->prestasi_tahun,
                        'prestasi_penyelenggara' => $student->prestasi_penyelenggara ?? $registration->prestasi_penyelenggara,
                        'updated_at' => now(),
                    ]);
            }

            // F. Find or Create PersonTypeMembership (link as 'Siswa')
            $personType = DB::connection('datacenter')->table('person_types')
                ->where('name', 'Siswa')
                ->where('school_institution_id', $schoolInstitutionId)
                ->first();

            if ($personType) {
                $membership = DB::connection('datacenter')->table('person_type_memberships')
                    ->where('person_id', $personId)
                    ->where('person_type_id', $personType->id)
                    ->first();

                if (!$membership) {
                    DB::connection('datacenter')->table('person_type_memberships')->insert([
                        'id' => (string) Str::uuid(),
                        'person_id' => $personId,
                        'person_type_id' => $personType->id,
                        'joined_date' => now(),
                        'is_active' => true,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            // G. Update tracking fields in local PPDB registration record
            $registration->update([
                'is_synced_to_datacenter' => true,
                'datacenter_student_id' => $studentId,
            ]);
        });
    }
}
