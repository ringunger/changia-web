<?php


namespace App\Classes;


use Illuminate\Support\Env;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class BeemBroker
{
    private static $BASE_SMS_URL = 'https://apisms.beem.africa/v1/';
    private static $BASE_SMS_PUBLIC_URL = 'https://apisms.beem.africa/public/v1/';
    private static $BASE_CHECKOUT_URL = 'https://checkout.beem.africa/v1/';
    private $SOURCE_ADDRESS = 'INFO';
    private  $API_KEY = null;
    private  $SECRET_KEY = null;
    private $auth_string;

    public function __construct($api_key = null, $secret_key = null)
    {
        $this->API_KEY = $api_key ?? Env::get('BEEM_API_KEY');
        $this->SECRET_KEY = $secret_key ?? Env::get('BEEM_SECRET');
        if(!$this->API_KEY) {
            // fail;
        }
        $this->auth_string = $this->generateAuthenticationString();
    }

    /**
     * Send SMS
     * @param $to
     * @param $message
     * @param null $from
     * @return false|\GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     */
    public function sendSms($to, $message, $from = null) {
        $endPoint = 'send';
        $data = [
            "source_addr" => $from ?? $this->SOURCE_ADDRESS,
            "schedule_time" => "",
            "encoding" => 0,
            "message" => $message,
            "recipients" => [["recipient_id" => 1, "dest_addr" => $this::formatNumber($to)]]
        ];
        $response = $this->post($endPoint, $data);
        if($response){
            return $response;
        } else {
            return false;
        }
    }


    /**
     * Check Balance of SMSs
     * @return false|\GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     */
    public function checkSmsBalance(){
        $endPoint = 'vendors/balance';
        $params = [];
        $response = $this->get($endPoint, $params, $this::$BASE_SMS_PUBLIC_URL);
        return $response;
    }

    /**
     * GET LIST OF Sender names available
     * @return false|mixed
     */
    public function getSenderNames(){
        $endPoint = 'sender-names';
        $params = [];
        $response = $this->get($endPoint, $params, $this::$BASE_SMS_PUBLIC_URL);
        if($response && isset($response['data'])) {
            return $response['data'];
        } else {
            return false;
        };
    }


    /**
     * Method called
     */
    public function getWaletBalance() {
        $base_url = 'https://apitopup.beem.africa/v1/';
        $endPoint = 'credit-balance';
        $appName = 'BPAY';
        $data = [
            'app_name' => $appName
        ];
        $response = $this->get($endPoint, $data, $base_url);
        if($response && isset($response['data'])) {
            $balance = $response['data']['credit_bal'] ?? 0;
            return $balance;
        } else {
            return false;
        }
    }


    public function checkOut($phoneNumber, $amount, $base_url = null)
    {
        $base_url = $base_url ?? $this::$BASE_CHECKOUT_URL;
        $endPoint = 'checkout';
        $data = [
            'amount' => $amount,
            'transaction_id' => Str::uuid()->toString(),
            'reference_number' => 'JAF-12345',
            'sendSource' => 'true',
            'mobile' => $this::formatNumber($phoneNumber),
        ];

        $response = $this->get($endPoint, $data, $base_url);
        dump($response);
        return $response;

    }

    public function disburse($amount, $wallet_number, $wallet_code, $source = null){
        $source = $source ?? 'f09dc0d3';
        $base_url = 'https://apipay.beem.africa/webservices/disbursement/';
        $endpoint = 'transfer';
        $data = [
            "amount" => $amount,
            "client_reference_id" => time(),
            "source" => [
                "account_no" => $source,
                "currency" => "TZS"
            ],
            "destination"=> [
                "mobile" => [
                    "wallet_number" => $wallet_number,
                    "wallet_code" => $wallet_code,
                    "currency" => "TZS"
                ]
            ]
        ];
        $response = $this->post($endpoint, $data, $base_url);
        if($response) {
            return true;
        } else {
            return false;
        }

    }

    /**
     * Send a GET request to the API
     * @param $endpoint
     * @param array $params
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     */
    private function get($endpoint, $params = [], $base_url = null) {
        $base_url = $base_url ?? $this::$BASE_SMS_URL;
        $url = $base_url . $endpoint;
        dump($url);
        $response = Http::withHeaders([
            'Authorization' => $this->auth_string,
            'Content-type' => 'application/json',
            'Accept' => 'application/json'
        ])->get($url,  $params)->onError(static function($e) {
            dump($e);
            dump($e->body());
        });
        dump($response->toPsrResponse());
        if($response->ok()){
            return $response->json();
        } else {
            return false;
        }

    }

    /**
     * Send a POST request to the API
     * @param $endpoint
     * @param array $params
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     */
    private function post($endpoint, $params = [], $base_url = null) {
        $base_url = $base_url ?? $this::$BASE_SMS_URL;
        $url = $base_url . $endpoint;
        $response = Http::withHeaders([
            'Authorization' => $this->auth_string,
            'Content-type' => 'application/json',
            'Accept' => 'application/json'
        ])->post($url, $params)->onError(static function($e) {
            Log::error('POST error' );
            dump($e);
        });
        if($response->ok()){
            return $response->json();
        } else {
            return false;
        }
    }


    private function inlineGet($endpoint, $params = [], $base_url = null) {
        $i = 0;
        foreach ($params as $key => $value) {
            $endpoint .= ($i === 0 ) ? '?' : '&';
            $endpoint .= "{$key}=". (is_numeric($value) && false ? $value : '"' . $value. '"');
            $i ++;
        }
        return $this->get($endpoint, [], $base_url);
    }

    private function handleResponse($response) {

    }

    public static function formatNumber($number){
        if(self::isValidNumber($number)){
            return $number;
        }
        if(is_array($number)){
            foreach ($number as $index => &$item) {
                $item = self::formatNumber($item);
            } unset($item);
        } else {
            $number = str_replace(' ', '', $number);
            $number = (string) trim($number, '+');
            if(strlen($number) == 10){
                $number = '255' . (int) $number;
            }
            return (String) ((int) $number);
        }
        return $number;
    }

    /**
     * Check if a number is properly formated
     * @param $number
     * @return bool
     */
    public static function isValidNumber($number) {
        if(is_array($number)){
            $ok = 0;
            foreach ($number as $item) {
                $ok += self::isValidNumber($item) ? 1 : 0;
            }
            return $ok === count($number);
        } else {
            return (bool) preg_match('/(25[5|4|6]{1})(\d{3})(\d{6})/', $number, $matches);
        }

    }

    private function generateAuthenticationString(){
        return 'Basic '. base64_encode($this->API_KEY .":". $this->SECRET_KEY);
    }
}
