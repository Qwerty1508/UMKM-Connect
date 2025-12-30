<?php

namespace App\Services;

use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRCodeService
{
    /**
     * Generate unique token for order
     */
    public function generateToken(): string
    {
        return Str::uuid()->toString();
    }

    /**
     * Generate QR code SVG for token
     */
    public function generateQRCode(string $token, int $size = 200): string
    {
        return QrCode::size($size)
            ->format('svg')
            ->errorCorrection('H')
            ->generate($token);
    }

    /**
     * Generate QR code as base64 PNG
     */
    public function generateQRCodeBase64(string $token, int $size = 200): string
    {
        $qrCode = QrCode::size($size)
            ->format('png')
            ->errorCorrection('H')
            ->generate($token);

        return 'data:image/png;base64,' . base64_encode($qrCode);
    }
}
