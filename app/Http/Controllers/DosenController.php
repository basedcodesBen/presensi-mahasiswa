<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matakuliah;
use App\Models\MataKuliahDetail;
use App\Models\Dhmd;
use App\Models\DKBS;
use Illuminate\Support\Facades\Auth;

class DosenController extends Controller
{
    public function index()
    {
        // Fetch MataKuliahDetail with related Matakuliah for the logged-in user
        $matakuliah = MataKuliahDetail::with('mataKuliah')      
            ->where('user_nik', Auth::user()->nik)
            ->withCount(['mahasiswa as jumlah_mahasiswa']) // Alias the count
            ->get();

        // Prepare data for the view
        $matakuliahData = $matakuliah->map(function ($mk) {
            $matakuliah = $mk->mataKuliah;

            // Count the pertemuan using the relationship
            $totalPertemuan = $matakuliah->kehadiran()->distinct('pertemuan')->count();
            return [
                'nama_matakuliah' => $matakuliah->nama_matakuliah,
                'kode_matakuliah' => $matakuliah->kode_matakuliah,
                'kelas' => $mk->kelas,
                'total_pertemuan' => $totalPertemuan,
                'jumlah_mahasiswa' => $mk->jumlah_mahasiswa,
                'id_matakuliah' => $matakuliah->id,
            ];
        });
        
        // Return the view with prepared data
        return view('dosen.matakuliah', ['matakuliahData' => $matakuliahData]);
    }

    public function detail($id_matakuliah)
    {
        // Fetch the matakuliah with related pertemuan
        $matakuliah = Matakuliah::with(['kehadiran' => function ($query) {
            $query->select('idpresensi', 'id_matakuliah', 'pertemuan', 'tanggal')
                ->distinct(); // Fetch distinct pertemuan for the matakuliah
        }])->where('id', $id_matakuliah)->firstOrFail();

        // Return the view with matakuliah and pertemuan data
        return view('dosen.detail', compact('matakuliah'));
    }
    public function pertemuanDetail($id_matakuliah,$id_presensi)
    {
        // Fetch the matakuliah details
        $matakuliah = Matakuliah::findOrFail($id_matakuliah);

        // Fetch the dhmd entry for the pertemuan
        $dhmd = Dhmd::where('idpresensi', $id_presensi)
            ->where('id_matakuliah', $id_matakuliah)
            ->firstOrFail();
        
        // Fetch all users enrolled in the matakuliah (from dkbs)
        $enrolledUsers = DKBS::with('mahasiswa')
            ->where('id_matakuliah', $id_matakuliah)
            ->get();

        // Fetch users who are already listed in dhmd_detail for this dhmd_idpresensi
        $existingUsers = $dhmd->details()
            ->with('userNik')
            ->get();
        // Find users who are in dkbs but not in dhmd_detail
        $missingUsers = $enrolledUsers->filter(function ($dkbsUser) use ($existingUsers) {
            return !$existingUsers->pluck('user_nik')->contains($dkbsUser->user_nik);
        });

        // Return the view with the data
        return view('dosen.pertemuan', compact('matakuliah', 'dhmd', 'existingUsers', 'missingUsers'));
    }

}
