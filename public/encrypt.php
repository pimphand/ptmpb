<?php

function encryptMessage($plaintext, $key)
{
    $iv = random_bytes(16); // Generate IV
    $ciphertext = openssl_encrypt($plaintext, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);

    return base64_encode($iv.$ciphertext); // Gabungkan IV dan pesan terenkripsi
}

function decryptMessage($ciphertext, $key)
{
    $data = base64_decode($ciphertext);
    $iv = substr($data, 0, 16); // Ekstrak IV
    $ciphertext = substr($data, 16);

    return openssl_decrypt($ciphertext, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);
}

// Contoh penggunaan
$key = hash('sha256', 'kunci-rahasia-anda', true); // Pastikan kunci memiliki panjang 256 bit
$message = 'Pesan rahasia';

$encrypted = encryptMessage($message, $key);
echo 'Terenkripsi: '.$encrypted.PHP_EOL;

$decrypted = decryptMessage($encrypted, $key);
echo 'Dekripsi: '.$decrypted.PHP_EOL;
