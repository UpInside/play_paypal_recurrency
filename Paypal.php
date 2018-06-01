<?php
/**
 * Created by PhpStorm.
 * User: gustavoweb
 * Date: 30/05/2018
 * Time: 10:38
 */

namespace Payment;

class Paypal
{

    private $url;
    private $token;

    private $endPoint;
    private $param;

    public function __construct($live = true)
    {
        if ($live == true) {
            $this->url = 'https://www.paypal.com';
            $this->token = '';
        } else {
            $this->url = 'https://www.sandbox.paypal.com';
            $this->token = '';
        }
    }

    public function getDataTransaction($transaction)
    {
        $this->endPoint = '/cgi-bin/webscr';

        $this->param = [
            'cmd' => '_notify-synch',
            'tx' => $transaction,
            'at' => $this->token,
        ];

        $response = $this->post();

        $lines = explode("\n", trim($response));

        $status = $lines[0];
        unset($lines[0]);

        $key[] = 'payment_status';
        $value[] = $status;

        foreach($lines as $line){
            $key[] = explode('=', $line, 2)[0];
            $value[] = urldecode(explode('=', $line, 2)[1]);
        }

        $result = array_combine($key, $value);

        return $result;

    }

    public function post()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url . $this->endPoint);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($this->param));

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }
}