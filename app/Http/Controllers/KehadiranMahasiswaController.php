<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dhmd;
use App\Models\MataKuliah;
use App\Models\QrCode;
use SimpleSoftwareIO\QrCode\Facades\QrCode as QRCodeGenerator;
use Carbon\Carbon;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\Writer\PngWriter;

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
            'id' => 'required|exists:mata_kuliah,id',
            'tanggal' => 'required|date',
            'pertemuan' => 'required|integer|min:1',
        ]);
        $idmatkul = $request->id;
        $pertemuan = $request->pertemuan;
        $uniqueCode = uniqid(); // Generate unique QR code
        $expiredAt = Carbon::now()->addMinutes(5);
        $kehadiran = Dhmd::create([
            'id_matakuliah' => $request->id,
            'tanggal' => $request->tanggal,
            'pertemuan' => $request->pertemuan,
        ]);
        // Generate QR code data
        $qrData = json_encode([
            'idpresensi' => $kehadiran->idpresensi,
            'id_matakuliah' => $kehadiran->id,
            'tanggal' => $kehadiran->tanggal,
            'uniqueCode' => $uniqueCode,
        ]);

        QrCode::create([
            'code' => $uniqueCode,
            'expired_at' => $expiredAt,
        ]);

        if (!file_exists(public_path('qrcodes'))) {
            mkdir(public_path('qrcodes'), 0755, true);
        }
        $qrCodePath = 'qrcodes/' . $kehadiran->idpresensi . '.png';
        $fullPath = public_path($qrCodePath);
        $result = Builder::create()
            ->writer(new PngWriter()) // Use PNG writer
            ->data($qrData) // The data to encode in the QR code
            ->encoding(new Encoding('UTF-8')) // Character encoding
            ->size(300) // Set size
            ->build();
        $result->saveToFile($fullPath);
        $kehadiran->update(attributes: ['qr_code' => $qrCodePath]);
        return redirect()->route('kehadiran.mahasiswa.show', ['idpresensi' => $kehadiran->idpresensi]);
    }


    public function show($idpresensi)
    {
        
        $kehadiran = Dhmd::with('mataKuliah')->findOrFail($idpresensi);
        return view('dosen.kehadiran.show', compact('kehadiran'));
    }

    public function scan(){
        return view('user.scan');
    }

    public function presensi(Request $request)
    {
        // Validate the incoming JSON data
        $validatedData = $request->validate([
            'idpresensi' => 'required|integer',
            'id_matakuliah' => 'required|integer',
            'tanggal' => 'required|date',
            'uniqueCode' => 'required|string',
        ]);

        // Process the decoded QR data
        $idpresensi = $validatedData['idpresensi'];
        $idMatakuliah = $validatedData['id_matakuliah'];
        $tanggal = $validatedData['tanggal'];
        $uniqueCode = $validatedData['uniqueCode'];

        
    }
}
