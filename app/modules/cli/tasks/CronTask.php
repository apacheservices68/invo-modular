<?php
/**
 * Created by PhpStorm.
 * User: Vinh Banh <apacheservices68@gmail.com>
 * Version: 1.0
 * Date: 29/11/2016
 * Time: 08:30
 */

namespace Utils\Modules\Cli\Tasks;

use Utils\common\library\Curl;

class CronTask extends \Phalcon\Cli\Task
{
    public function mainAction()
    {
        echo "1";
    }

    public function testAction(array $params){
        if(!isset($params[0])){
            echo "Argument 1 is required";
        }else{
            $domain = "https://www.5giay.vn/";
            $url = $domain.$params[0];
            $login = "dac_san_ha_tien";
            $password = "ongbaylu";
            $register = "0";
            $remember = "1";
            $cookie_check = '0';
            #$redirect = "/threads/nha-mat-tien-duong-vuon-thom-x-binh-loi-h-binh-chanh.8100686/up";
            $redirect = $params[0];
            $_xfToken = "";
            $posts = array(
                'login' => $login,
                'password' => $password,
                'remember' => $remember,
                'register' => $register,
                'cookie_check' => $cookie_check,
                'redirect' => $redirect,
                '_xkToken' => $_xfToken,
                #'5s_session' => $files_session,
            );
            $c = new Curl();
            $return  = $c->post("https://www.5giay.vn/login/login" , http_build_query($posts) );
            #var_dump($return);die;
            if($return)
            echo "1";
        }

    }
}