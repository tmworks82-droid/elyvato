<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Services;

use Exception;
use Log;

class CurlService {


    public function __construct()
    {
        $this->status                       = 'status';
        $this->message                      = 'message';
        $this->code                         = 'status_code';
        $this->data                         = 'data';
        $this->total                        = 'total_count';       

    }

    public function curlReuqest($url, $type, $header, $postData = array()) {
        // Log::info("======================CURL REQUEST================");
        // Log::info(print_r($url, true));
        // Log::info(print_r($type, true));
        // Log::info(print_r($header, true));
        // Log::info(print_r($postData, true));


        // echo "============";
        
        // echo "<pre>";
        // print_r($postData);
        // echo "</pre>";
        // die();

        try {
            if (strtoupper($type) == 'GET') {
                $url = $url . "?" . http_build_query($postData);
            }
            $curlParam = array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 300,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => false,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => $type,
                CURLOPT_HTTPHEADER => $header,
            );

            if (strtoupper($type) == 'POST') {
                $curlParam[CURLOPT_POSTFIELDS] = $postData;
            }

            $curl = curl_init();
            curl_setopt_array($curl, $curlParam);
            $response = curl_exec($curl);
            $error = curl_error($curl);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);
            $output[$this->status] = true;
            if (in_array(substr($httpcode, 0, 1), [4, 5]) || $httpcode == '0') {
                $err = is_array($error) ? json_encode($error) : ($error ?? '');
                $output[$this->message] = $httpcode . " http code error / $err";
                $output[$this->status] = false;
            } else if ($error) {
                $output[$this->message] = is_array($error) ? json_encode($error) : ($error ?? 'Something Went Wrong');
                $output[$this->status] = false;
            }
            $output[$this->data] = $response;
        } catch (\Exception $e) {
            $output[$this->status] = false;
            $output[$this->message] = $e->getMessage();
        } catch (\Exception $e) {
            $output[$this->status] = false;
            $output[$this->message] = $e->getMessage();
        }
        
        // Log::info("=======CurlService==curlResponse===".json_encode($output));
        return $output;
    }

}
