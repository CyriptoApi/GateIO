<?php

/**
 * Author: Barış Demir github.com/barisdemir49 
 * Web Site: botcex.com
 * GateIO V4: https://www.gate.io/docs/developers/apiv4/en/#spot
 */
class GateIO
{

    protected $key = "";
    protected $secret = "";
    protected $host = "https://api.gateio.ws";
    protected $version = "/api/v4";
    protected $path = "";
    protected $curlUrl = "";
    protected $sign = "";
    protected $que = [];
    protected $type = "POST";
    protected $headers = [];



    function __construct($key = "", $secret = "")
    {
        $this->key = $key;
        $this->secret = $secret;
        $this->curlUrl = $this->host . $this->version;
    }

    private function reset()
    {
        $this->header = [];
        $this->que = [];
        $this->version = "/api/v4";
        $this->curlUrl = $this->host . $this->version;
        $this->sign = "";
        $this->path = "";
    }
    private function createSignkey()
    {
        $fmt = "%s\n%s\n%s\n%s\n%s";
        $time = time();
        if ($this->type == 'POST') {
            $data = json_encode($this->que);
        } else {
            $query_string = empty($this->que) ? '' : http_build_query($this->que, '', '&');
        }
        $hashed_payload = hash("sha512", $data ?? '');
        $signature_string = sprintf($fmt, $this->type, $this->version . $this->path, $query_string ?? '', $hashed_payload, $time);
        $this->sign = hash_hmac("sha512", $signature_string, $this->secret);
        /**set header params */
        $this->headers = array(
            'KEY:' . $this->key,
            'SIGN:' . $this->sign,
            'Content-Type:application/json',
            'Timestamp:' . $time
        );
    }

    protected function curlRequest()
    {
        $this->curlUrl .= $this->path;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->curlUrl . ($this->type != 'POST' ? '?' . http_build_query($this->que, '', '&') : null),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 60,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $this->type,
            CURLOPT_HTTPHEADER => $this->headers,
            CURLOPT_POSTFIELDS => $this->type == 'POST' ? json_encode($this->que) : http_build_query($this->que, '', '&'),
            CURLOPT_VERBOSE => 0,
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $this->reset();
        return json_decode($response);
    }

    /**---- Spot Methods ---- **/
    /**buy and sell order */
    function orderCreate(string $symbol, string $amount, string $price, string $side = 'buy')
    {
        $this->que = array(
            'currency_pair' => $symbol,
            'side' => $side,
            'amount' => $amount,
            'price' => $price,
            'type' => 'limit',
            'account' => 'spot',
            'text' => 't-101'
        );
        $this->path = '/spot/orders';
        $this->type = 'POST';
        $this->createSignkey();
        return $this->curlRequest();
    }
    /**GET Open Orders */
    function getOpenOrders(string $symbol = null, int $limit = 100)
    {
        if ($symbol) {
            $this->que = array(
                'currency_pair' => strtoupper($symbol),
                'status' => 'open'
            );
            $this->path = '/spot/orders';
        } else {
            $this->que = array(
                'limit' => $limit
            );
            $this->path = '/spot/open_orders';
        }

        $this->type = 'GET';
        $this->createSignkey();
        $res = $this->curlRequest();
        if ($res and is_array($res) and count($res) > 0)
            return $res;
        return false;
    }
    /** Get Order */
    function getOrder(string $id = null, string $symbol = null)
    {
        $this->que = array(
            'order_id' => $id,
            'currency_pair' => strtoupper($symbol),
        );
        $this->path = '/spot/orders/' . $id;
        $this->type = 'GET';
        $this->createSignkey();
        return $this->curlRequest();
    }

    /** Get Finished Orders */
    function getFinishedOrders(string $symbol = null, $limit = 100)
    {
        $this->que = array(
            'status' => 'finished',
            'limit' => $limit
        );
        if ($symbol)
            $this->que['currency_pair'] = strtoupper($symbol);
        $this->path = '/spot/orders/';
        $this->type = 'GET';
        $this->createSignkey();
        return $this->curlRequest();
    }

    /**cancel Order  */
    function cancelOrder(string $id, string $symbol)
    {
        $this->que = array(
            'order_id' => $id,
            'currency_pair' => strtoupper($symbol),
        );
        $this->path = '/spot/orders/' . $id;
        $this->type = 'DELETE';
        $this->createSignkey();
        return $this->curlRequest();
    }

    /**my wallet */
    function myWallet(string $currency = null)
    {
        if ($currency) {
            $this->que = array(
                'currency' => strtoupper($currency)
            );
        }
        $this->path = '/spot/accounts';
        $this->type = 'GET';
        $this->createSignkey();
        $res = $this->curlRequest();
        if ($currency and $res and isset($res[0])) return $res[0];
        elseif ($res) return  $res;
        else return false;
    }

    /** currency pairs */
    function pairs(string $symbol = null)
    {
        $this->que = array(
            'currency_pair' => strtoupper($symbol)
        );
        $this->path = '/spot/currency_pairs/' . ($symbol ? strtoupper($symbol) : null);
        $this->type = 'GET';
        return $this->curlRequest();
    }
    /** trades */
    function trades(string $symbol)
    {
        $this->que = array(
            'currency_pair' => strtoupper($symbol)
        );
        $this->path = '/spot/trades';
        $this->type = 'GET';
        return $this->curlRequest();
    }
    /** Tickers */
    function tickers(string $symbol)
    {
        $this->que = array(
            'currency_pair' => strtoupper($symbol)
        );
        $this->path = '/spot/tickers';
        $this->type = 'GET';
        return $this->curlRequest();
    }
    /**Get Order Book  */
    function order_book(string $symbol)
    {
        $this->que = array(
            'currency_pair' => strtoupper($symbol)
        );
        $this->path = '/spot/order_book';
        $this->type = 'GET';
        return $this->curlRequest();
    }

    /**  */
    function withdrawalStatus(string $currency = null)
    {
        if ($currency) {
            $this->que = array(
                'currency' => strtoupper($currency)
            );
        }
        $this->path = '/wallet/withdraw_status';
        $this->type = 'GET';
        $this->createSignkey();
        $res = $this->curlRequest();
        if ($currency and $res and isset($res[0])) return $res[0];
        elseif ($res) return  $res;
        else return false;
    }

    /**  */
    function withdrawals(string $currency)
    {

        if ($currency) {
            $this->que = array(
                'currency' => strtoupper($currency)
            );
        }
        $this->path = '/withdrawals';
        $this->type = 'POST';
        $this->createSignkey();
        return  $this->curlRequest();
    }
}
