<?php

return [
    // Add you bot's API key and name
    'telegramBot' => [
        'api_key'      => '5380399983:AAGUqTklwwulM0oQB1dQOAYTvU-K24gNAV8',
        'bot_username' => 'root_monitoring_bot', // Without "@"

        // [Manager Only] Secret key required to access the webhook
        'secret'       => 'super_secret1qayse4',

        // When using the getUpdates method, this can be commented out
        //    'webhook'        => [
        //        'url'         => 'https://due-trading-bot.root-it.solutions/hook.php',
        //        // Use self-signed certificate
        //        'certificate' => '/ris/apache/certs/due-trading-bot.root-it.solutions/due-trading-bot.root-it.solutions-cert.pem',
        //        // Limit maximum number of connections
        //        // 'max_connections' => 5,
        //    ],

        // All command related configs go here
        'commands'     => [
            // Define all paths for your custom commands
            'paths'   => [
                __DIR__ . '/Commands',
            ],
            // Here you can set any command-specific parameters
            'configs' => [
                // - Google geocode/timezone API key for /date command (see DateCommand.php)
                // 'date'    => ['google_api_key' => 'your_google_api_key_here'],
                // - OpenWeatherMap.org API key for /weather command (see WeatherCommand.php)
                // 'weather' => ['owm_api_key' => 'your_owm_api_key_here'],
                // - Payment Provider Token for /payment command (see Payments/PaymentCommand.php)
                // 'payment' => ['payment_provider_token' => 'your_payment_provider_token_here'],
            ],
        ],
        'sticker'      => [
            'CAACAgIAAxkBAANuYU48XVFL1y6mRg0KOKS6YPOL43QAAnwDAAJHFWgJOQF6ZvTunlghBA',
            'CAACAgIAAxkBAANtYU48IBCu9oe4A27x7xeLJDsQt-wAAksHAAJG-6wEmMJl6KNpDy4hBA',
            'CAACAgIAAxkBAANsYU48EwlB2VC0oJIqj8gytct5ovMAAhoBAAJSiZEjxmJqaGGJYv0hBA',
            'CAACAgIAAxkBAANrYU48BMNR0zjFfZlvDHIWG4iVe0sAAtQFAAKW-hIF26c4bXKA1XohBA',
            'CAACAgIAAxkBAANqYU479u6T2-rTs0vpfjwsqzb-5ywAAhkDAAJWnb0K-rEPSjpiUmEhBA',
            'CAACAgIAAxkBAANpYU47xhHUYReJ2aadKUQOWkQVKy0AAi8DAALEq2gLAVn7BHoMiYshBA',
            'CAACAgIAAxkBAANoYU47bysLSbTQPPMUpkuc1d7O3J4AAmYDAALuxKEK-PlMzoycWWQhBA',
            'CAACAgIAAxkBAANnYU47V2XK0vZtmmcFMZvPhBWCDrYAAkoCAAJWnb0KyWrGaGAYevAhBA',
        ],
        'admin'        => 516011308,

        'logging' => [
            'debug'  => __DIR__ . '/php-telegram-bot-debug.log',
            'error'  => __DIR__ . '/php-telegram-bot-error.log',
            'update' => __DIR__ . '/php-telegram-bot-update.log',
        ],
    ],
    // Define all IDs of admin users

    'assets'          => [
        //wallets
        'multiplikator' => [
            '3HVjNLMocGfcmsWZahiyiKauGC4Z2mUHsN' => 0.5,
            '0xfc67f6689dfe3aa15fd795b88075d51ef67f5123' => 0.5,
        ],
        'exchanges' => [
            'kucoin'     => [
                'apiKey'     => '6790e188ee2685000154abcf',
                'secret'     => 'f7efc516-8621-4084-b672-fd9cb644fd0d',
                'passphrase' => 'syntad-cuNdoc-5kitdu',
            ],
            'binance'    => [
                'apiKey'     => '9KhQJXy4hGnjCyG6lHcQZ6ZD0jZ6vr2ygF3ilkUGj2DqPEb3tlK48F6KHM2GtyqY',
                'secret'     => 'XSVgzgpnTeuQfjm7Maa5o2XrjsZe2O2wANs0SpwvX8NzjMWz1t2FZsri80FACtnq',
                'passphrase' => '',
            ],
            'coinbase'   => [
                'apiKey'     => 'organizations/b21880e6-af40-40c3-8989-8fff1a1e046a/apiKeys/b1ba910f-0cf1-4c92-b583-e9d871a4d15b',
                'secret'     => '-----BEGIN EC PRIVATE KEY-----\nMHcCAQEEIHp9YaJFf5RKvBFRI1aJyNKPvnADYP3PuFwNGh/A3hCzoAoGCCqGSM49\nAwEHoUQDQgAE87/frFFvLB9dKooqwAO9V3mAwbZ2CNbSMTu5NUK4MmrDHPU0wPui\njv5VLXdsi7MOBEwsb7e7abr7vWdpYXidKw==\n-----END EC PRIVATE KEY-----\n',
                'passphrase' => '',
                'keyID'      => 'b1ba910f-0cf1-4c92-b583-e9d871a4d15b',
            ],
            'coinbase2'  => [
                'apiKey'     => 'organizations/b21880e6-af40-40c3-8989-8fff1a1e046a/apiKeys/4ea5d735-5a65-41bf-808f-5a9d41d94375',
                'secret'     => '-----BEGIN EC PRIVATE KEY-----\nMHcCAQEEILEusQiiWllieDlIoyV2kxqhfH4TLpnaTwvgREKoGMyboAoGCCqGSM49\nAwEHoUQDQgAE6z7cTGLPaYK7p9MX5h5+sNMZcQIHrsWcz/gplS8L6DBdU1eANApa\nGGgzRr9OjupKOZOII0YJp5oibIcLkwCF/g==\n-----END EC PRIVATE KEY-----\n',
                'passphrase' => '',
                'keyID'      => '4ea5d735-5a65-41bf-808f-5a9d41d94375',
            ],
            'blockchain' => [
                'apiKey'     => '',
                'secret'     => '',
                'passphrase' => '',
            ],
            'bybit'      => [
                'apiKey'     => '3QEpyljS1sXpMZ6MnO',
                'secret'     => '4lZVXuwvVfriotGXEH5rh5q5IzcJosld0GW6',
                'passphrase' => '',
            ],
            'huobit'     => [
                'apiKey'     => '',
                'secret'     => '',
                'passphrase' => '',
            ],
            'crypto.com' => [
                'apiKey'     => '',
                'secret'     => '',
                'passphrase' => '',
            ],
        ],
        'wallets'   => [
            'btc'   => [
                'xpub6CSURMs5EsTmUrgNBtGzxsJSBPrRjLXBKSrbKTjYetD8zcNy9KkugB2SZMz5zczjjCfLgWw6potbqkbaR8xSoD4a77YrvzGPCH9J5W13NzF', // Ledger All Elmar
                '3HVjNLMocGfcmsWZahiyiKauGC4Z2mUHsN', //DuE Mining
            ],
            'etc'   => [
                '0x12A7Cdf4793AE724cF678EcA2B5A7492d6dF5064', // Ledger
                '0xfc67f6689DfE3aa15fd795B88075d51ef67F5123', // DuE Mining
            ],
            'ark'   => [
                'Aei4J7ceReK8DKq5fj1zZ5z36VprBXysoP',
            ],
            'eth'   => [
                '0x3937a65ff331D387681a684F311Fd190788ACa2b', // Ledger - Metamask (PLU)
                '0x6e907D014eD62DB47C6546b96dAa8Dbaf4206ACd', // Ledger PLU
                '0xC1ECf0F8cae39C273Ee3cb321c88c47700d203C4', // Ledger
                '0xEd10338dDa62d8470e7fD475C263f348363EC9E7', // Ledger
            ],
            'ada'   => [
                'addr1qymcremf07wgeqh33qtc7yxamz6seay4kk50zze8xehsmff262wnw2kdh2c5jq48jchk6ywm8yakd2qas4f0f8rqgfvqt44pnl',
            ],
            'sc'    => [
                'f302eeff9bce641699e917ba02714e54ca5843f008dc4d28a2035d2fc601a57f57294f22a19d',
            ],
            'ltc'   => [
                'ltc1q2juz520w799pfssfphnrhuc33f6rlvz74kphar',
            ],
            'doge'  => [
                'DAcfP3mT7LJCPYPCM95XAkdV5d2jb79dbF',
            ],
            'sol'   => [
                '6PkSHmbvTHSfaXb2DhHijhwkX7VsoFFVBvR3WBCaUJFd', // Ledger
            ],
            'trx'   => [
                'TBpVJihegutgbrpBPrLmeRob7hmkoaRv27', // Ledger Handy App TronLink
            ],
            'hydra' => [
                'HL5VWciTrHAnfoKV1iAM6NZBDm8p6muQ1R', // Handy Wallet
            ],
        ],
    ],
    'explorerAPIKeys' => [
        'cardanoscan' => '4018b089-6324-402e-a428-1472f8ded359',
        'blockfrost'  => 'mainnetqCQGC5KDezJ3wfg2FZJTudGvqBy1EfDz',
        'bitquery'    => 'ory_at_vvDo0jNxgx58u8eJmiv-FVR3TmoVnsYVlBe1pe3bsAU.pzYGomO_Q3lsZWJ-tqrIVS1LHnR1wmci2PMLnjwit6E',
        'oklink'      => '525f1848-579c-4b54-a4a5-2854e21ce7b4',
        'solanafm'    => 'sk_live_f883a5e1590c4e9a805a18be48c6ecd0',
        'solanabeach' => 'd11dad45-e278-4769-b5d6-465c05e1b034',
        'cryptoid'    => 'd1c40f3c6295',
        'tronscan'    => '3ac413ed-efa7-4932-9e55-15d61fd0ae10',
    ],
    'kucoin'          => [
        'APIKeys' => [
            'trade'     => [
                'key'        => '6692900f1f1b2400019c2f98',
                'secret'     => 'c151d7e8-e53a-482b-a6d1-0666b27398e6',
                'passphrase' => '!Rve8hf23or(f2v8hfpo-afl',
            ],
            'future'    => [
                'key'        => '6733b300b40cab000166333e',
                'secret'     => '2c420df4-ca65-4592-99f2-8233ebe7279e',
                'passphrase' => '!Rve8hf23or(f2v8hfpo-afl',
            ],
            'futureSub' => [
                'key'        => '673cce610bb0b1000144d0d6',
                'secret'     => '53c89b04-3f11-41ab-9daa-77cdaa0fdfff',
                'passphrase' => 'feuwdfwiuz!fsdgsg345#',
            ],
            //            'future' => [
            //                'key'        => '673450e1118fff000184aaf5',
            //                'secret'     => '0e8401ee-eeaa-41d7-b0a1-4ca6ba811d12',
            //                'passphrase' => 'bottrade',
            //            ],
        ],
        'coins'   => [
            'BTC'   => [
                'mainID'   => '60132c58b5023400065375fc',
                //                'tradeID'  => '5f3c2b32c354640006970a45',
                'tradeID'  => '4580597766',
                'trade'    => false,
                'transfer' => [
                    'from' => 'trade',
                    'to'   => 'main',
                ],
            ],
            'HYDRA' => [
                'mainID'   => '6138b5129388480006b7673d',
                //                'tradeID'  => '605599be5f777500069ac271',
                'tradeID'  => '4580600838',
                'trade'    => [
                    'minAvailable' => 1.5,
                    'pair'         => 'HYDRA-USDT',
                    'side'         => 'sell',
                ],
                'transfer' => [
                    'from' => 'main',
                    'to'   => 'trade',
                ],
            ],
            'USDT'  => [
                'mainID'   => '601d07a15ba0f4000637cee1',
                //                'tradeID'  => '6013c43b86a31e00063fda95',
                'tradeID'  => '4580603910',
                'trade'    => [
                    'minAvailable' => 5,
                    'pair'         => 'BTC-USDT',
                    'side'         => 'buy',
                ],
                'transfer' => [
                    'from' => 'main',
                    'to'   => 'trade',
                ],
            ],
            'DFI'   => [
//                'tradeID'  => '6078cc921c780e0007526234',
'tradeID'  => '4580598790',
'trade'    => [
    'minAvailable' => 1,
    'pair'         => 'DFI-BTC',
    'side'         => 'sell',
],
'transfer' => false,
            ],
        ],
    ],

    // Enter your MySQL d atabase credentials
    //    'mysql'          => [
    //        'host'     => '127.0.0.1',
    //        'port'     => '3306',
    //        'user'     => 'due-trading-bot',
    //        'password' => '/lsAf9byXv8ayPv05bj6SbnmXbz8pzmj',
    //        'database' => 'due-trading-bot',
    //        'charset'  => 'utf8mb4',
    //        'encoding' => 'utf8mb4_unicode_520_ci',
    //    ],
    // Logging (Debug, Error and Raw Updates)

    // Set custom Upload and Download paths
    'paths'           => [
        'download' => __DIR__ . '/Download',
        'upload'   => __DIR__ . '/Upload',
    ],

    // Requests Limiter (tries to prevent reaching Telegram API limits)
    'limiter'         => [
        'enabled' => true,
    ],

    'coinScale' => [
        'BTC' => 8,
        'LTC' => 8,
        'ARK' => 8,
        'DFI' => 8,
        'ETC' => 18,
        'ETH' => 18,
        'SC'  => 12,
    ],

    'kucoinTP' => [
        'futureTradingPairs' => [
            'XBTUSDTM'    => 'BTC/USDT',
            'XBTUSDM'     => 'BTC/USD',
            'ETHUSDTM'    => 'ETH/USDT',
            'BCHUSDTM'    => 'BCH/USDT',
            'BSVUSDTM'    => 'BSV/USDT',
            'LINKUSDTM'   => 'LINK/USDT',
            'UNIUSDTM'    => 'UNI/USDT',
            'YFIUSDTM'    => 'YFI/USDT',
            'EOSUSDTM'    => 'EOS/USDT',
            'DOTUSDTM'    => 'DOT/USDT',
            'FILUSDTM'    => 'FIL/USDT',
            'ADAUSDTM'    => 'ADA/USDT',
            'XRPUSDTM'    => 'XRP/USDT',
            'LTCUSDTM'    => 'LTC/USDT',
            'ETHUSDM'     => 'ETH/USD',
            'TRXUSDTM'    => 'TRX/USDT',
            'GRTUSDTM'    => 'GRT/USDT',
            'SUSHIUSDTM'  => 'SUSHI/USDT',
            'XLMUSDTM'    => 'XLM/USDT',
            '1INCHUSDTM'  => '1INCH/USDT',
            'ZECUSDTM'    => 'ZEC/USDT',
            'DASHUSDTM'   => 'DASH/USDT',
            'DOTUSDM'     => 'DOT/USD',
            'XRPUSDM'     => 'XRP/USD',
            'AAVEUSDTM'   => 'AAVE/USDT',
            'KSMUSDTM'    => 'KSM/USDT',
            'DOGEUSDTM'   => 'DOGE/USDT',
            'VETUSDTM'    => 'VET/USDT',
            'BNBUSDTM'    => 'BNB/USDT',
            'SXPUSDTM'    => 'SXP/USDT',
            'SOLUSDTM'    => 'SOL/USDT',
            'IOSTUSDTM'   => 'IOST/USDT',
            'CRVUSDTM'    => 'CRV/USDT',
            'ALGOUSDTM'   => 'ALGO/USDT',
            'AVAXUSDTM'   => 'AVAX/USDT',
            'FTMUSDTM'    => 'FTM/USDT',
            'MATICUSDTM'  => 'MATIC/USDT',
            'THETAUSDTM'  => 'THETA/USDT',
            'ATOMUSDTM'   => 'ATOM/USDT',
            'CHZUSDTM'    => 'CHZ/USDT',
            'ENJUSDTM'    => 'ENJ/USDT',
            'MANAUSDTM'   => 'MANA/USDT',
            'DENTUSDTM'   => 'DENT/USDT',
            'OCEANUSDTM'  => 'OCEAN/USDT',
            'BATUSDTM'    => 'BAT/USDT',
            'XEMUSDTM'    => 'XEM/USDT',
            'QTUMUSDTM'   => 'QTUM/USDT',
            'XTZUSDTM'    => 'XTZ/USDT',
            'SNXUSDTM'    => 'SNX/USDT',
            'NEOUSDTM'    => 'NEO/USDT',
            'ONTUSDTM'    => 'ONT/USDT',
            'XMRUSDTM'    => 'XMR/USDT',
            'COMPUSDTM'   => 'COMP/USDT',
            'ETCUSDTM'    => 'ETC/USDT',
            'WAVESUSDTM'  => 'WAVES/USDT',
            'BANDUSDTM'   => 'BAND/USDT',
            'MKRUSDTM'    => 'MKR/USDT',
            'RVNUSDTM'    => 'RVN/USDT',
            'DGBUSDTM'    => 'DGB/USDT',
            'SHIBUSDTM'   => 'SHIB/USDT',
            'ICPUSDTM'    => 'ICP/USDT',
            'DYDXUSDTM'   => 'DYDX/USDT',
            'AXSUSDTM'    => 'AXS/USDT',
            'HBARUSDTM'   => 'HBAR/USDT',
            'EGLDUSDTM'   => 'EGLD/USDT',
            'ALICEUSDTM'  => 'ALICE/USDT',
            'YGGUSDTM'    => 'YGG/USDT',
            'NEARUSDTM'   => 'NEAR/USDT',
            'SANDUSDTM'   => 'SAND/USDT',
            'C98USDTM'    => 'C98/USDT',
            'ONEUSDTM'    => 'ONE/USDT',
            'VRAUSDTM'    => 'VRA/USDT',
            'GALAUSDTM'   => 'GALA/USDT',
            'TLMUSDTM'    => 'TLM/USDT',
            'CHRUSDTM'    => 'CHR/USDT',
            'LRCUSDTM'    => 'LRC/USDT',
            'FLOWUSDTM'   => 'FLOW/USDT',
            'RNDRUSDTM'   => 'RNDR/USDT',
            'IOTXUSDTM'   => 'IOTX/USDT',
            'CROUSDTM'    => 'CRO/USDT',
            'WAXPUSDTM'   => 'WAXP/USDT',
            'PEOPLEUSDTM' => 'PEOPLE/USDT',
            'OMGUSDTM'    => 'OMG/USDT',
            'LINAUSDTM'   => 'LINA/USDT',
            'IMXUSDTM'    => 'IMX/USDT',
            'NFTUSDTM'    => 'NFT/USDT',
            'CELRUSDTM'   => 'CELR/USDT',
            'ENSUSDTM'    => 'ENS/USDT',
            'CELOUSDTM'   => 'CELO/USDT',
            'CTSIUSDTM'   => 'CTSI/USDT',
            'SLPUSDTM'    => 'SLP/USDT',
            'ARPAUSDTM'   => 'ARPA/USDT',
            'KNCUSDTM'    => 'KNC/USDT',
            'API3USDTM'   => 'API3/USDT',
            'ROSEUSDTM'   => 'ROSE/USDT',
            'AGLDUSDTM'   => 'AGLD/USDT',
            'APEUSDTM'    => 'APE/USDT',
            'JASMYUSDTM'  => 'JASMY/USDT',
            'ZILUSDTM'    => 'ZIL/USDT',
            'GMTUSDTM'    => 'GMT/USDT',
            'RUNEUSDTM'   => 'RUNE/USDT',
            'LOOKSUSDTM'  => 'LOOKS/USDT',
            'AUDIOUSDTM'  => 'AUDIO/USDT',
            'KDAUSDTM'    => 'KDA/USDT',
            'KAVAUSDTM'   => 'KAVA/USDT',
            'BALUSDTM'    => 'BAL/USDT',
            'GALUSDTM'    => 'GAL/USDT',
            'LUNAUSDTM'   => 'LUNA/USDT',
            'LUNCUSDTM'   => 'LUNC/USDT',
            'OPUSDTM'     => 'OP/USDT',
            'XCNUSDTM'    => 'XCN/USDT',
            'UNFIUSDTM'   => 'UNFI/USDT',
            'LITUSDTM'    => 'LIT/USDT',
            'DUSKUSDTM'   => 'DUSK/USDT',
            'STORJUSDTM'  => 'STORJ/USDT',
            'RSRUSDTM'    => 'RSR/USDT',
            'JSTUSDTM'    => 'JST/USDT',
            'OGNUSDTM'    => 'OGN/USDT',
            'TRBUSDTM'    => 'TRB/USDT',
            'PERPUSDTM'   => 'PERP/USDT',
            'KLAYUSDTM'   => 'KLAY/USDT',
            'ANKRUSDTM'   => 'ANKR/USDT',
            'LDOUSDTM'    => 'LDO/USDT',
            'WOOUSDTM'    => 'WOO/USDT',
            'RENUSDTM'    => 'REN/USDT',
            'CVCUSDTM'    => 'CVC/USDT',
            'INJUSDTM'    => 'INJ/USDT',
            'APTUSDTM'    => 'APT/USDT',
            'MASKUSDTM'   => 'MASK/USDT',
            'REEFUSDTM'   => 'REEF/USDT',
            'TONUSDTM'    => 'TON/USDT',
            'MAGICUSDTM'  => 'MAGIC/USDT',
            'CFXUSDTM'    => 'CFX/USDT',
            'AGIXUSDTM'   => 'AGIX/USDT',
            'FXSUSDTM'    => 'FXS/USDT',
            'FETUSDTM'    => 'FET/USDT',
            'ARUSDTM'     => 'AR/USDT',
            'GMXUSDTM'    => 'GMX/USDT',
            'BLURUSDTM'   => 'BLUR/USDT',
            'ASTRUSDTM'   => 'ASTR/USDT',
            'HIGHUSDTM'   => 'HIGH/USDT',
            'ACHUSDTM'    => 'ACH/USDT',
            'STXUSDTM'    => 'STX/USDT',
            'COCOSUSDTM'  => 'COCOS/USDT',
            'SSVUSDTM'    => 'SSV/USDT',
            'FLOKIUSDTM'  => 'FLOKI/USDT',
            'CKBUSDTM'    => 'CKB/USDT',
            'TRUUSDTM'    => 'TRU/USDT',
            'QNTUSDTM'    => 'QNT/USDT',
            'ETHUSDCM'    => 'ETH/USDC',
            'XBTMH23'     => 'BTC/USD',
        ],
    ],

    'cgCoinMapping' => [
        'shib'   => 'shiba-inu',
        'btc'    => 'bitcoin',
        'eth'    => 'ethereum',
        'dfi'    => 'defichain',
        'etc'    => 'ethereum-classic',
        'sol'    => 'solana',
        'plu'    => 'pluton',
        'ada'    => 'cardano',
        'doge'   => 'dogecoin',
        'ltc'    => 'litecoin',
        'sia'    => 'siacoin',
        'kas'    => 'kaspa',
        'ark'    => 'ark',
        'hydra'  => 'hydra',
        'trx'    => 'tron',
        'xrp'    => 'ripple',
        'hnt'    => 'helium',
        'dot'    => 'polkadot',
        'lunc'   => 'terra-luna',
        'luna'   => 'terra-luna-2',
        'kcs'    => 'kucoin-shares',
        'bnb'    => 'binancecoin',
        'xlm'    => 'stellar',
        'vet'    => 'vechain',
        'nft'    => 'apenft',
        'alpine' => 'alpine-f1-team-fan-token',
        'ethw'   => 'ethereum-pow-iou',
        'vtho'   => 'vethor-token',
        'meme'   => 'meme-brc-20',
        'usual'  => 'usual',
        'vana'   => 'vana',
        'pengu'  => 'pudgy-penguins',
        'bio'    => 'bio-protocol',
        'anime'  => 'anime',
        'bera'   => 'berachain-bera',
        'mnt'    => 'mantle',
        'kasta'  => 'kasta',
        'caps'   => 'coin-capsule',
        'sc'     => 'siacoin',
        'grt'    => 'the-grap',
        'vara'   => 'vara-network',
        'chz'    => 'chiliz',
        'rly'    => 'rally-2',
        'comp' => 'compound-governance-token',
        'bond' => 'barnbridge',
        'amp' => 'amp-token',
        'lpt' => 'livepeer',
    ],
];
