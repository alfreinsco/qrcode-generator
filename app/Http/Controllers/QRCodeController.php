<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class QRCodeController extends Controller
{
    public function index()
    {
        return view('qrcode-generator');
    }

    public function generate(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:2048',
            'size' => 'required|integer|min:100|max:1000'
        ]);

        try {
            // Generate unique filename
            $filename = 'qrcode_' . Str::random(10) . '.png';

            // Generate QR Code
            $qrcode = QrCode::format('png')
                ->size($request->size)
                ->errorCorrection('H')
                ->margin(1)
                ->generate($request->content);

            // Store QR Code
            Storage::disk('public')->put('qrcodes/' . $filename, $qrcode);

            // Generate public URL
            $qrcodeUrl = Storage::disk('public')->url('qrcodes/' . $filename);

            return back()->with([
                'qrcode' => $qrcodeUrl,
                'filename' => $filename,
                'success' => 'QR Code berhasil dibuat!'
            ]);
        } catch (\Exception $e) {
            return back()->withErrors(['msg' => 'Terjadi kesalahan saat membuat QR Code']);
        }
    }

    public function download($filename)
    {
        $path = storage_path('app/public/qrcodes/' . $filename);

        if (!file_exists($path)) {
            return back()->withErrors(['msg' => 'File tidak ditemukan']);
        }

        return response()->download($path, 'qrcode.png');
    }
}
