<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QrCode;
use SimpleSoftwareIO\QrCode\Facades\QrCode as QRCodeGenerator;
use App\Models\absensi;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class QRCodeController extends Controller
{
    public function generate()
    {
        $uniqueCode = uniqid(); // Generate unique QR code
        $expiredAt = Carbon::now()->addMinutes(5); // Expiry time: 10 minutes

        // Save QR code to database
        QrCode::create([
            'code' => $uniqueCode,
            'expired_at' => $expiredAt,
        ]);

        // Generate QR Code
        $qrCode = QRCodeGenerator::size(300)->generate($uniqueCode);

        return view('manajer.generate', compact('qrCode', 'expiredAt'));
    }
}