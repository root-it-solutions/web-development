<?php

namespace ccxt\async;

// PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
// https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code

use Exception; // a common import
use \ccxt\ExchangeError;

class bitforex extends Exchange {

    public function describe() {
        return $this->deep_extend(parent::describe (), array(
            'id' => 'bitforex',
            'name' => 'Bitforex',
            'countries' => array( 'CN' ),
            'rateLimit' => 500, // https://github.com/ccxt/ccxt/issues/5054
            'version' => 'v1',
            'has' => array(
                'CORS' => null,
                'spot' => true,
                'margin' => false,
                'swap' => null, // has but unimplemented
                'future' => false,
                'option' => false,
                'cancelOrder' => true,
                'createOrder' => true,
                'fetchBalance' => true,
                'fetchBorrowRate' => false,
                'fetchBorrowRateHistories' => false,
                'fetchBorrowRateHistory' => false,
                'fetchBorrowRates' => false,
                'fetchBorrowRatesPerSymbol' => false,
                'fetchClosedOrders' => true,
                'fetchMarkets' => true,
                'fetchMyTrades' => null,
                'fetchOHLCV' => true,
                'fetchOpenOrders' => true,
                'fetchOrder' => true,
                'fetchOrderBook' => true,
                'fetchOrders' => null,
                'fetchTicker' => true,
                'fetchTickers' => null,
                'fetchTrades' => true,
                'fetchTransfer' => false,
                'fetchTransfers' => false,
                'transfer' => false,
            ),
            'timeframes' => array(
                '1m' => '1min',
                '5m' => '5min',
                '15m' => '15min',
                '30m' => '30min',
                '1h' => '1hour',
                '2h' => '2hour',
                '4h' => '4hour',
                '12h' => '12hour',
                '1d' => '1day',
                '1w' => '1week',
                '1M' => '1month',
            ),
            'urls' => array(
                'logo' => 'https://user-images.githubusercontent.com/51840849/87295553-1160ec00-c50e-11ea-8ea0-df79276a9646.jpg',
                'api' => 'https://api.bitforex.com',
                'www' => 'https://www.bitforex.com',
                'doc' => 'https://github.com/githubdev2020/API_Doc_en/wiki',
                'fees' => 'https://help.bitforex.com/en_us/?cat=13',
                'referral' => 'https://www.bitforex.com/en/invitationRegister?inviterId=1867438',
            ),
            'api' => array(
                'public' => array(
                    'get' => array(
                        'api/v1/market/symbols' => 20,
                        'api/v1/market/ticker' => 4,
                        'api/v1/market/depth' => 4,
                        'api/v1/market/trades' => 20,
                        'api/v1/market/kline' => 20,
                    ),
                ),
                'private' => array(
                    'post' => array(
                        'api/v1/fund/mainAccount' => 1,
                        'api/v1/fund/allAccount' => 30,
                        'api/v1/trade/placeOrder' => 1,
                        'api/v1/trade/placeMultiOrder' => 10,
                        'api/v1/trade/cancelOrder' => 1,
                        'api/v1/trade/cancelMultiOrder' => 20,
                        'api/v1/trade/cancelAllOrder' => 20,
                        'api/v1/trade/orderInfo' => 1,
                        'api/v1/trade/multiOrderInfo' => 10,
                        'api/v1/trade/orderInfos' => 20,
                    ),
                ),
            ),
            'fees' => array(
                'trading' => array(
                    'tierBased' => false,
                    'percentage' => true,
                    'maker' => $this->parse_number('0.001'),
                    'taker' => $this->parse_number('0.001'),
                ),
                'funding' => array(
                    'tierBased' => false,
                    'percentage' => true,
                    'deposit' => array(),
                    'withdraw' => array(),
                ),
            ),
            'commonCurrencies' => array(
                'BKC' => 'Bank Coin',
                'CAPP' => 'Crypto Application Token',
                'CREDIT' => 'TerraCredit',
                'CTC' => 'Culture Ticket Chain',
                'EWT' => 'EcoWatt Token',
                'IQ' => 'IQ.Cash',
                'MIR' => 'MIR COIN',
                'NOIA' => 'METANOIA',
                'TON' => 'To The Moon',
            ),
            'exceptions' => array(
                '1000' => '\\ccxt\\OrderNotFound', // array("code":"1000","success":false,"time":1643047898676,"message":"The order does not exist or the status is wrong")
                '1003' => '\\ccxt\\BadSymbol', // array("success":false,"code":"1003","message":"Param Invalid:param invalid -symbol:symbol error")
                '1013' => '\\ccxt\\AuthenticationError',
                '1016' => '\\ccxt\\AuthenticationError',
                '1017' => '\\ccxt\\PermissionDenied', // array("code":"1017","success":false,"time":1602670594367,"message":"IP not allow")
                '1019' => '\\ccxt\\BadSymbol', // array("code":"1019","success":false,"time":1607087743778,"message":"Symbol Invalid")
                '3002' => '\\ccxt\\InsufficientFunds',
                '4002' => '\\ccxt\\InvalidOrder', // array("success":false,"code":"4002","message":"Price unreasonable")
                '4003' => '\\ccxt\\InvalidOrder', // array("success":false,"code":"4003","message":"amount too small")
                '4004' => '\\ccxt\\OrderNotFound',
                '10204' => '\\ccxt\\DDoSProtection',
            ),
        ));
    }

    public function fetch_markets($params = array ()) {
        $response = yield $this->publicGetApiV1MarketSymbols ($params);
        //
        //    {
        //        "data" => array(
        //            array(
        //                "amountPrecision":4,
        //                "minOrderAmount":3.0E-4,
        //                "pricePrecision":2,
        //                "symbol":"coin-usdt-btc"
        //            ),
        //            ...
        //        )
        //    }
        //
        $data = $response['data'];
        $result = array();
        for ($i = 0; $i < count($data); $i++) {
            $market = $data[$i];
            $id = $this->safe_string($market, 'symbol');
            $symbolParts = explode('-', $id);
            $baseId = $symbolParts[2];
            $quoteId = $symbolParts[1];
            $base = $this->safe_currency_code($baseId);
            $quote = $this->safe_currency_code($quoteId);
            $result[] = array(
                'id' => $id,
                'symbol' => $base . '/' . $quote,
                'base' => $base,
                'quote' => $quote,
                'settle' => null,
                'baseId' => $baseId,
                'quoteId' => $quoteId,
                'settleId' => null,
                'type' => 'spot',
                'spot' => true,
                'margin' => false,
                'swap' => false,
                'future' => false,
                'option' => false,
                'active' => true,
                'contract' => false,
                'linear' => null,
                'inverse' => null,
                'contractSize' => null,
                'expiry' => null,
                'expiryDateTime' => null,
                'strike' => null,
                'optionType' => null,
                'precision' => array(
                    'amount' => $this->safe_integer($market, 'amountPrecision'),
                    'price' => $this->safe_integer($market, 'pricePrecision'),
                ),
                'limits' => array(
                    'leverage' => array(
                        'min' => null,
                        'max' => null,
                    ),
                    'amount' => array(
                        'min' => $this->safe_number($market, 'minOrderAmount'),
                        'max' => null,
                    ),
                    'price' => array(
                        'min' => null,
                        'max' => null,
                    ),
                    'cost' => array(
                        'min' => null,
                        'max' => null,
                    ),
                ),
                'info' => $market,
            );
        }
        return $result;
    }

    public function parse_trade($trade, $market = null) {
        //
        // fetchTrades (public) v1
        //
        //      {
        //          "price":57594.53,
        //          "amount":0.3172,
        //          "time":1637329685322,
        //          "direction":1,
        //          "tid":"1131019666"
        //      }
        //
        //      {
        //          "price":57591.33,
        //          "amount":0.002,
        //          "time":1637329685322,
        //          "direction":1,
        //          "tid":"1131019639"
        //      }
        //
        $market = $this->safe_market(null, $market);
        $timestamp = $this->safe_integer($trade, 'time');
        $id = $this->safe_string($trade, 'tid');
        $orderId = null;
        $priceString = $this->safe_string($trade, 'price');
        $amountString = $this->safe_string($trade, 'amount');
        $sideId = $this->safe_integer($trade, 'direction');
        $side = $this->parse_side($sideId);
        return $this->safe_trade(array(
            'info' => $trade,
            'id' => $id,
            'timestamp' => $timestamp,
            'datetime' => $this->iso8601($timestamp),
            'symbol' => $market['symbol'],
            'type' => null,
            'side' => $side,
            'price' => $priceString,
            'amount' => $amountString,
            'cost' => null,
            'order' => $orderId,
            'fee' => null,
            'takerOrMaker' => null,
        ), $market);
    }

    public function fetch_trades($symbol, $since = null, $limit = null, $params = array ()) {
        yield $this->load_markets();
        $request = array(
            'symbol' => $this->market_id($symbol),
        );
        if ($limit !== null) {
            $request['size'] = $limit;
        }
        $market = $this->market($symbol);
        $response = yield $this->publicGetApiV1MarketTrades (array_merge($request, $params));
        //
        // {
        //  "data":
        //      array(
        //          {
        //              "price":57594.53,
        //              "amount":0.3172,
        //              "time":1637329685322,
        //              "direction":1,
        //              "tid":"1131019666"
        //          }
        //      ),
        //  "success" => true,
        //  "time" => 1637329688475
        // }
        //
        return $this->parse_trades($response['data'], $market, $since, $limit);
    }

    public function parse_balance($response) {
        $data = $response['data'];
        $result = array( 'info' => $response );
        for ($i = 0; $i < count($data); $i++) {
            $balance = $data[$i];
            $currencyId = $this->safe_string($balance, 'currency');
            $code = $this->safe_currency_code($currencyId);
            $account = $this->account();
            $account['used'] = $this->safe_string($balance, 'frozen');
            $account['free'] = $this->safe_string($balance, 'active');
            $account['total'] = $this->safe_string($balance, 'fix');
            $result[$code] = $account;
        }
        return $this->safe_balance($result);
    }

    public function fetch_balance($params = array ()) {
        yield $this->load_markets();
        $response = yield $this->privatePostApiV1FundAllAccount ($params);
        return $this->parse_balance($response);
    }

    public function parse_ticker($ticker, $market = null) {
        //
        //     {
        //         "buy":7.04E-7,
        //         "date":1643371198598,
        //         "high":7.48E-7,
        //         "last":7.28E-7,
        //         "low":7.10E-7,
        //         "sell":7.54E-7,
        //         "vol":9877287.2874
        //     }
        //
        $symbol = $this->safe_symbol(null, $market);
        $timestamp = $this->safe_integer($ticker, 'date');
        return $this->safe_ticker(array(
            'symbol' => $symbol,
            'timestamp' => $timestamp,
            'datetime' => $this->iso8601($timestamp),
            'high' => $this->safe_string($ticker, 'high'),
            'low' => $this->safe_string($ticker, 'low'),
            'bid' => $this->safe_string($ticker, 'buy'),
            'bidVolume' => null,
            'ask' => $this->safe_string($ticker, 'sell'),
            'askVolume' => null,
            'vwap' => null,
            'open' => null,
            'close' => $this->safe_string($ticker, 'last'),
            'last' => $this->safe_string($ticker, 'last'),
            'previousClose' => null,
            'change' => null,
            'percentage' => null,
            'average' => null,
            'baseVolume' => $this->safe_string($ticker, 'vol'),
            'quoteVolume' => null,
            'info' => $ticker,
        ), $market, false);
    }

    public function fetch_ticker($symbol, $params = array ()) {
        yield $this->load_markets();
        $market = $this->markets[$symbol];
        $request = array(
            'symbol' => $market['id'],
        );
        $response = yield $this->publicGetApiV1MarketTicker (array_merge($request, $params));
        $ticker = $this->safe_value($response, 'data');
        //
        //     {
        //         "data":array(
        //             "buy":37082.83,
        //             "date":1643388686660,
        //             "high":37487.83,
        //             "last":37086.79,
        //             "low":35544.44,
        //             "sell":37090.52,
        //             "vol":690.9776
        //         ),
        //         "success":true,
        //         "time":1643388686660
        //     }
        //
        return $this->parse_ticker($ticker, $market);
    }

    public function parse_ohlcv($ohlcv, $market = null) {
        //
        //     {
        //         "close":0.02505143,
        //         "currencyVol":0,
        //         "high":0.02506422,
        //         "low":0.02505143,
        //         "open":0.02506095,
        //         "time":1591508940000,
        //         "vol":51.1869
        //     }
        //
        return array(
            $this->safe_integer($ohlcv, 'time'),
            $this->safe_number($ohlcv, 'open'),
            $this->safe_number($ohlcv, 'high'),
            $this->safe_number($ohlcv, 'low'),
            $this->safe_number($ohlcv, 'close'),
            $this->safe_number($ohlcv, 'vol'),
        );
    }

    public function fetch_ohlcv($symbol, $timeframe = '1m', $since = null, $limit = null, $params = array ()) {
        yield $this->load_markets();
        $market = $this->market($symbol);
        $request = array(
            'symbol' => $market['id'],
            'ktype' => $this->timeframes[$timeframe],
        );
        if ($limit !== null) {
            $request['size'] = $limit; // default 1, max 600
        }
        $response = yield $this->publicGetApiV1MarketKline (array_merge($request, $params));
        //
        //     {
        //         "data":array(
        //             array("close":0.02505143,"currencyVol":0,"high":0.02506422,"low":0.02505143,"open":0.02506095,"time":1591508940000,"vol":51.1869),
        //             array("close":0.02503914,"currencyVol":0,"high":0.02506687,"low":0.02503914,"open":0.02505358,"time":1591509000000,"vol":9.1082),
        //             array("close":0.02505172,"currencyVol":0,"high":0.02507466,"low":0.02503895,"open":0.02506371,"time":1591509060000,"vol":63.7431),
        //         ),
        //         "success":true,
        //         "time":1591509427131
        //     }
        //
        $data = $this->safe_value($response, 'data', array());
        return $this->parse_ohlcvs($data, $market, $timeframe, $since, $limit);
    }

    public function fetch_order_book($symbol, $limit = null, $params = array ()) {
        yield $this->load_markets();
        $marketId = $this->market_id($symbol);
        $request = array(
            'symbol' => $marketId,
        );
        if ($limit !== null) {
            $request['size'] = $limit;
        }
        $response = yield $this->publicGetApiV1MarketDepth (array_merge($request, $params));
        $data = $this->safe_value($response, 'data');
        $timestamp = $this->safe_integer($response, 'time');
        return $this->parse_order_book($data, $symbol, $timestamp, 'bids', 'asks', 'price', 'amount');
    }

    public function parse_order_status($status) {
        $statuses = array(
            '0' => 'open',
            '1' => 'open',
            '2' => 'closed',
            '3' => 'canceled',
            '4' => 'canceled',
        );
        return (is_array($statuses) && array_key_exists($status, $statuses)) ? $statuses[$status] : $status;
    }

    public function parse_side($sideId) {
        if ($sideId === 1) {
            return 'buy';
        } else if ($sideId === 2) {
            return 'sell';
        } else {
            return null;
        }
    }

    public function parse_order($order, $market = null) {
        $id = $this->safe_string($order, 'orderId');
        $timestamp = $this->safe_number($order, 'createTime');
        $lastTradeTimestamp = $this->safe_number($order, 'lastTime');
        $symbol = $market['symbol'];
        $sideId = $this->safe_integer($order, 'tradeType');
        $side = $this->parse_side($sideId);
        $type = null;
        $price = $this->safe_string($order, 'orderPrice');
        $average = $this->safe_string($order, 'avgPrice');
        $amount = $this->safe_string($order, 'orderAmount');
        $filled = $this->safe_string($order, 'dealAmount');
        $status = $this->parse_order_status($this->safe_string($order, 'orderState'));
        $feeSide = ($side === 'buy') ? 'base' : 'quote';
        $feeCurrency = $market[$feeSide];
        $fee = array(
            'cost' => $this->safe_number($order, 'tradeFee'),
            'currency' => $feeCurrency,
        );
        return $this->safe_order(array(
            'info' => $order,
            'id' => $id,
            'clientOrderId' => null,
            'timestamp' => $timestamp,
            'datetime' => $this->iso8601($timestamp),
            'lastTradeTimestamp' => $lastTradeTimestamp,
            'symbol' => $symbol,
            'type' => $type,
            'timeInForce' => null,
            'postOnly' => null,
            'side' => $side,
            'price' => $price,
            'stopPrice' => null,
            'cost' => null,
            'average' => $average,
            'amount' => $amount,
            'filled' => $filled,
            'remaining' => null,
            'status' => $status,
            'fee' => $fee,
            'trades' => null,
        ), $market);
    }

    public function fetch_order($id, $symbol = null, $params = array ()) {
        yield $this->load_markets();
        $market = $this->market($symbol);
        $request = array(
            'symbol' => $this->market_id($symbol),
            'orderId' => $id,
        );
        $response = yield $this->privatePostApiV1TradeOrderInfo (array_merge($request, $params));
        $order = $this->parse_order($response['data'], $market);
        return $order;
    }

    public function fetch_open_orders($symbol = null, $since = null, $limit = null, $params = array ()) {
        yield $this->load_markets();
        $market = $this->market($symbol);
        $request = array(
            'symbol' => $this->market_id($symbol),
            'state' => 0,
        );
        $response = yield $this->privatePostApiV1TradeOrderInfos (array_merge($request, $params));
        return $this->parse_orders($response['data'], $market, $since, $limit);
    }

    public function fetch_closed_orders($symbol = null, $since = null, $limit = null, $params = array ()) {
        yield $this->load_markets();
        $market = $this->market($symbol);
        $request = array(
            'symbol' => $this->market_id($symbol),
            'state' => 1,
        );
        $response = yield $this->privatePostApiV1TradeOrderInfos (array_merge($request, $params));
        return $this->parse_orders($response['data'], $market, $since, $limit);
    }

    public function create_order($symbol, $type, $side, $amount, $price = null, $params = array ()) {
        yield $this->load_markets();
        $sideId = null;
        if ($side === 'buy') {
            $sideId = 1;
        } else if ($side === 'sell') {
            $sideId = 2;
        }
        $request = array(
            'symbol' => $this->market_id($symbol),
            'price' => $price,
            'amount' => $amount,
            'tradeType' => $sideId,
        );
        $response = yield $this->privatePostApiV1TradePlaceOrder (array_merge($request, $params));
        $data = $response['data'];
        return array(
            'info' => $response,
            'id' => $this->safe_string($data, 'orderId'),
        );
    }

    public function cancel_order($id, $symbol = null, $params = array ()) {
        yield $this->load_markets();
        $request = array(
            'orderId' => $id,
        );
        if ($symbol !== null) {
            $request['symbol'] = $this->market_id($symbol);
        }
        $results = yield $this->privatePostApiV1TradeCancelOrder (array_merge($request, $params));
        $success = $results['success'];
        $returnVal = array( 'info' => $results, 'success' => $success );
        return $returnVal;
    }

    public function sign($path, $api = 'public', $method = 'GET', $params = array (), $headers = null, $body = null) {
        $url = $this->urls['api'] . '/' . $this->implode_params($path, $params);
        $query = $this->omit($params, $this->extract_params($path));
        if ($api === 'public') {
            if ($query) {
                $url .= '?' . $this->urlencode($query);
            }
        } else {
            $this->check_required_credentials();
            $payload = $this->urlencode(array( 'accessKey' => $this->apiKey ));
            $query['nonce'] = $this->milliseconds();
            if ($query) {
                $payload .= '&' . $this->urlencode($this->keysort($query));
            }
            // $message = '/' . 'api/' . $this->version . '/' . $path . '?' . $payload;
            $message = '/' . $path . '?' . $payload;
            $signature = $this->hmac($this->encode($message), $this->encode($this->secret));
            $body = $payload . '&signData=' . $signature;
            $headers = array(
                'Content-Type' => 'application/x-www-form-urlencoded',
            );
        }
        return array( 'url' => $url, 'method' => $method, 'body' => $body, 'headers' => $headers );
    }

    public function handle_errors($code, $reason, $url, $method, $headers, $body, $response, $requestHeaders, $requestBody) {
        if (gettype($body) !== 'string') {
            return; // fallback to default error handler
        }
        if (($body[0] === '{') || ($body[0] === '[')) {
            $feedback = $this->id . ' ' . $body;
            $success = $this->safe_value($response, 'success');
            if ($success !== null) {
                if (!$success) {
                    $code = $this->safe_string($response, 'code');
                    $this->throw_exactly_matched_exception($this->exceptions, $code, $feedback);
                    throw new ExchangeError($feedback);
                }
            }
        }
    }
}