<?php

namespace App\Services;

use BaconQrCode\Renderer\GDLibRenderer;
use BaconQrCode\Writer;

class QrCodeService
{
    /**
     * Generate QR code as Base64 PNG (no file storage)
     */
    public function generateBase64(string $data, int $size = 200): string
    {
        // Renderer using GD (safe on most servers)
        $renderer = new GDLibRenderer($size);

        $writer = new Writer($renderer);

        // Binary PNG output
        $qrBinary = $writer->writeString($data);

        // Return Base64 for email / frontend
        return 'data:image/png;base64,' . base64_encode($qrBinary);
    }
}
