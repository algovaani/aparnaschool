<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require_once APPPATH . "third_party/omnipay/vendor/autoload.php";

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

class Qr_code
{

    public function __construct()
    {
        $CI = &get_instance();
    }

    public function generate($upload_path, $text, $file_name)
    {
        $data = $text;
    
        $options = new QROptions([
            // 'version' => 5,
            'eccLevel' => QRCode::ECC_H,
            'scale' => 2,
            'imageBase64' => false,
            'imageTransparent' => true,
            'foregroundColor' => '#000000',
            'backgroundColor' => '#ffffff',
            'qrCodeHeight'    => 10,
            'qrCodeWidth'     => 10,
            'outputType' => QRCode::OUTPUT_IMAGE_PNG
        ]);
    
        // Ensure the upload directory exists
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0755, true);
        }
    
        $fullPath = $upload_path . $file_name . '.png';
    
        // Generate the QR code and save it to the path
        $qrCode = new QRCode($options);
        $qrCode->render($data, $fullPath);
    
        // ✅ Check if the file was successfully created
        if (file_exists($fullPath)) {
            return true;
        } else {
            return false;
        }
    }

}
