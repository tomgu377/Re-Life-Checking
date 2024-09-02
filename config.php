<?php
$config = [
    /* [ LISENCE APIKEY CONFIGURATION ] */
    'apikey'            => 'APIKEY KAMU',

    /* [ PROXY USER:PASS AUTH CONFIGURATION ] */
    'proxyserver'       => false,                           // hidup/matikan penggunaan proxy
    'proxy_auth'        => false,
    'proxyuser'        => 'USER:PW',
    'serverorip_proxy'  => 'ip/domain:port or file.txt',    // gunakan 1 koneksi ke server proxy

    /* [ PROGRAM CONFIGURATION PROCESSING ] */
    'proxytype'         => 'socks5',                        // proxy tipe. pilih: HTTP / HTTP_1_0 / HTTPS / SOCKS4 / SOCKS4A / SOCKS5_HOSTNAME / SOCKS5
    'thread'            => 2,                               // kecepatan proses bot per detik
    'delay'             => 3,                               // jeda program berjalan
    'display'           => true,                            // menampilkan berjalannya bot

    /* [ APLICATION CONFIGURATION ] */
    'appversion'        => '39.0.0.1',                      // versi aplikasi
    'checkingmode'      => 'full',                          // full: untuk pengecekkan keseluruhan sampai dengan balance di akun, email: hanya cek email terdaftar/tidak
    'detectgenerate'    => false,                           // otomatis detect generate empas

    'hidebooking'       => false,                           // true untuk mengakftifkan penyembunyian pesanan, wajib di isi orderid dan false untuk menonaktifkan sembunyikan pesanan
    'orderid'           => 'orderid pesanan',               // 1 orderid 1akun, wajib mode full dan thread 2

    /* [ SAVE CONFIGURATION ] */
    'save_on_internal'  => false,                           // hasil akan disave pada local folder
    'save_on_external'  => false,                           // hasil akan disave pada spreadsheet
    'external_link_tosave' => 'link spreadsheet'            // google spreadsheet app script link
];
