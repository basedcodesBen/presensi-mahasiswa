<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dhmd;
use App\Models\MataKuliah;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class KehadiranMahasiswaController extends Controller
{
    public function create()
    {
        $courses = MataKuliah::all();
        return view('dosen.kehadiran.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_matakuliah' => 'required|exists:mata_kuliah,id_matakuliah',
            'tanggal' => 'required|date',
            'pertemuan' => 'required|integer|min:1',
        ]);

        $kehadiran = Dhmd::create([
            'id_matakuliah' => $request->id_matakuliah,
            'tanggal' => $request->tanggal,
            'pertemuan' => $request->pertemuan,
        ]);

        // Generate QR code data
        $qrData = json_encode([
            'idpresensi' => $kehadiran->idpresensi,
            'id_matakuliah' => $kehadiran->id_matakuliah,
            'tanggal' => $kehadiran->tanggal,
        ]);

        $qrCodePath = 'qrcodes/' . $kehadiran->idpresensi . '.png';
        \SimpleSoftwareIO\QrCode\Facades\QrCode::format('png')->size(300)->generate($qrData, public_path($qrCodePath));

        $kehadiran->update(['qr_code' => $qrCodePath]);

        return redirect()->route('kehadiran.mahasiswa.show', ['idpresensi' => $kehadiran->idpresensi]);
    }


    public function show($idpresensi)
    {
        $kehadiran = Dhmd::with('mataKuliah')->findOrFail($idpresensi);
        return view('dosen.kehadiran.show', compact('kehadiran'));
    }
}
