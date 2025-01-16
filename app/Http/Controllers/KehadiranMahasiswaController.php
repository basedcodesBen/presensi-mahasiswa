<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dhmd;
use App\Models\MataKuliah;
use App\Models\QrCode;
use App\Models\DhmdDetail;
use App\Models\MatakuliahDetail;
use App\Models\User;
use SimpleSoftwareIO\QrCode\Facades\QrCode as QRCodeGenerator;
use Carbon\Carbon;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Auth;

class KehadiranMahasiswaController extends Controller
{
    public function create()
    {
        $user = Auth::User();
        $courses = MataKuliahDetail::with('mataKuliah')      
            ->where('user_nik', Auth::user()->nik)
            ->get();
        
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
        $expiredAt = Carbon::parse($request->tanggal)->addMinutes(60);
        $kehadiran = Dhmd::create([
            'id_matakuliah' => $request->id,
            'tanggal' => $request->tanggal,
            'pertemuan' => $request->pertemuan,
        ]);

        $data_kehadiran = Dhmd::with('mataKuliah')
            ->where('idpresensi',$kehadiran->idpresensi)
            ->get();
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
        $exsists = MatakuliahDetail::with('mahasiswa')
            ->where('matkul_id', $dhmd->id_matakuliah)
            ->get();

        // Check if mahasiswa (DKBS records) exist for each MatakuliahDetail
        $filteredMahasiswa = $exsists->map(function ($matakuliahDetail) {
            return $matakuliahDetail->mahasiswa->where('user_nik', Auth::user()->nik);
        });

        // Check if any mahasiswa data is found for any MatakuliahDetail
        $filteredMahasiswa = $filteredMahasiswa->filter(function ($mahasiswaCollection) {
            return $mahasiswaCollection->isNotEmpty(); // Ensure there's at least one mahasiswa
        });

        if ($filteredMahasiswa->isEmpty()) {
            // No mahasiswa found for the current user's nik in any of the MatakuliahDetails
            return redirect()->route('user.scanner')->with('error', 'Anda tidak terdaftar dalam kelas ini!');
        }
        $qrCode = QrCode::where('code', $uniqueCode)->first();
        if (Carbon::now('Asia/Jakarta')->greaterThan($qrCode->expired_at)) {
            // Redirect if the QR code has expired
            return redirect()->route('user.scanner')->with('error', 'QR Code telah kedaluwarsa!.');
        }
            return view('user.photo',compact('dhmd'));
    }
        
    
    // public function takePhoto(){
    //     return view('user.photo');
    // }
    public function savePhoto(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'idPresensi' => 'required|integer',
        ]);
        $user = auth()->user();
        $dhmdDetail = DhmdDetail::where('dhmd_idpresensi', $request ->idPresensi)
            ->where('user_nik', $user->nik)
            ->first();
        if($dhmdDetail){
            return response()->json([
                'message' => 'Photo not uploaded successfully!',
                'redirect_url' => route('user.scanner',['error' => 'Attendance record can only submit once!'])
            ]);
        }
        if ($request->hasFile('photo')) {
            // Process and save the photo
            
            $file = $request->file('photo');
            $fileName = 'attendance_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/attendance'), $fileName); // Save to the public/images/attendance folder
            $filePath = 'images/attendance/' . $fileName;
            $dhmddetail = DhmdDetail::create(
                [
                    'dhmd_idpresensi' => $request->idPresensi,
                    'user_nik' => Auth::User()->nik,
                    'status' => 'hadir',
                    'Image' => $filePath
                ]
            );
            // Return success response
            return response()->json([
                'message' => 'Photo uploaded successfully!',
                'redirect_url' => route('user.scanner',['message' => 'Your attendance was recorded successfully!'])
            ]);
        } 
    }

}
