<?php
/**
 * Created by PhpStorm.
 * User: Vinh Banh <apacheservices68@gmail.com>
 * Version: 1.0
 * Date: 28/11/2016
 * Time: 10:49
 */

namespace Utils\common\library;

class Curl
{
    protected $headers;
    protected $user_agent;
    protected $compression;
    protected $cookie_file;
    protected $proxy;

    public function __construct($cookies=TRUE,$cookie='/var/www/html/phan/utils/utils/app/common/library/cookie.txt',$compression='gzip',$proxy='') {
        $this->headers[] = 'Accept: image/gif, image/x-bitmap, image/jpeg, image/pjpeg';
        $this->headers[] = 'Connection: Keep-Alive';
        $this->headers[] = 'Content-type: application/x-www-form-urlencoded;charset=UTF-8';
        $this->user_agent = 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.95 Safari/537.36';
        $this->compression=$compression;
        $this->proxy=$proxy;
        $this->cookies=$cookies;
        if ($this->cookies == TRUE) $this->cookie($cookie);
    }
    public function cookie($cookie_file) {
        if (file_exists($cookie_file)) {
            $this->cookie_file=$cookie_file;
        } else {
            fopen($cookie_file,'w+') or $this->error('The cookie file could not be opened. Make sure this directory has the correct permissions');
            $this->cookie_file=$cookie_file;
            fclose($this->cookie_file);
        }
    }

    public function getheader($url) {
        $process = curl_init($url);
        curl_setopt($process, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($process, CURLOPT_HEADER, 1);
        curl_setopt($process, CURLOPT_USERAGENT, $this->user_agent);
        if ($this->cookies == TRUE) curl_setopt($process, CURLOPT_COOKIEFILE, $this->cookie_file);
        if ($this->cookies == TRUE) curl_setopt($process, CURLOPT_COOKIEJAR, $this->cookie_file);
        curl_setopt($process,CURLOPT_ENCODING , $this->compression);
        curl_setopt($process, CURLOPT_TIMEOUT, 30);
        curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
        //curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($process,CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($process,CURLOPT_CAINFO, NULL);
        curl_setopt($process,CURLOPT_CAPATH, NULL);
        $return = curl_exec($process);
        curl_close($process);
        return $return;
    }

    public function get($url) {
        $process = curl_init($url);
        curl_setopt($process, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($process, CURLOPT_HEADER, 0);
        curl_setopt($process, CURLOPT_USERAGENT, $this->user_agent);
        if ($this->cookies == TRUE) curl_setopt($process, CURLOPT_COOKIEFILE, $this->cookie_file);
        if ($this->cookies == TRUE) curl_setopt($process, CURLOPT_COOKIEJAR, $this->cookie_file);
        curl_setopt($process,CURLOPT_ENCODING , $this->compression);
        curl_setopt($process, CURLOPT_TIMEOUT, 30);
        curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
        #curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($process,CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($process,CURLOPT_CAINFO, NULL);
        curl_setopt($process,CURLOPT_CAPATH, NULL);
        $return = curl_exec($process);
        curl_close($process);
        return $return;
    }
    public function post($url,$data) {
        $process = curl_init($url);
        curl_setopt($process, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($process, CURLOPT_HEADER, 1);
        curl_setopt($process, CURLOPT_USERAGENT, $this->user_agent);
        if ($this->cookies == TRUE) curl_setopt($process, CURLOPT_COOKIEFILE, $this->cookie_file);
        if ($this->cookies == TRUE) curl_setopt($process, CURLOPT_COOKIEJAR, $this->cookie_file);
        curl_setopt($process, CURLOPT_ENCODING , $this->compression);
        curl_setopt($process, CURLOPT_TIMEOUT, 30);
        curl_setopt($process, CURLOPT_POSTFIELDS, $data);

        curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($process, CURLOPT_POST, 1);
        curl_setopt($process,CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($process,CURLOPT_CAINFO, NULL);
        curl_setopt($process,CURLOPT_CAPATH, NULL);
        $return = curl_exec($process);
        curl_close($process);
        return $return;
    }
    public function error($error) {
        echo "<center><div style='width:500px;border: 3px solid #FFEEFF; padding: 3px; background-color: #FFDDFF;font-family: verdana; font-size: 10px'><b>cURL Error</b><br>$error</div></center>";
        die;
    }
}
