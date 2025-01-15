<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dhmd;
use App\Models\MataKuliah;
use App\Models\QrCode;
use App\Models\DhmdDetail;
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

        $uniqueCode = uniqid(); // Generate unique QR code
        $expiredAt = Carbon::parse($request->tanggal)->addMinutes(5);
        $kehadiran = Dhmd::create([
            'id_matakuliah' => $request->id,
            'tanggal' => $request->tanggal,
            'pertemuan' => $request->pertemuan,
        ]);
        // Generate QR code data
        $qrData = json_encode([
            'idpresensi' => $kehadiran->idpresensi,
            'id_matakuliah' => $kehadiran->id_matakuliah,
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

    public function presensi(Request $request, $idpresensi)
    {
        $uniqueCode = $request->query('uniqueCode');
        $tanggal = $request->query('tanggal');
        $dhmd = Dhmd::with('Matakuliah')->findOrFail($idpresensi);

         // Check if the QR code exists and has not expired
        $qrCode = QrCode::where('code', $uniqueCode)->first();
        if (Carbon::now('Asia/Jakarta')->greaterThan($qrCode->expired_at)) {
            // Redirect if the QR code has expired
            return redirect()->route('user.scanner')->with('error', 'QR Code telah kedaluwarsa.');
        }
        $user = auth()->user();
        $dhmdDetail = DhmdDetail::where('dhmd_idpresensi', $idpresensi)
            ->where('user_nik', $user->nik)
            ->first();
        if($dhmdDetail){
            return redirect()->route('user.scanner')->with('error', 'Anda sudah presensi');
        }else{
            $presensi = DhmdDetail::create([
                'dhmd_idpresensi' => $idpresensi,
                'user_nik' => $user->nik,
                'status' => 'hadir',
            ]);
            return redirect()->route('user.scanner')->with('message', 'Presensi sudah berhasil dilakukan');
        }
        
    }
}
