<?php
// protected/components/CaptchaAction.php
class CaptchaAction extends CCaptchaAction
{
    protected function generateVerifyCode()
    {
        $rand = (int) mt_rand(11111,999888);
        $time = $rand + time() - 1300000000;
        
        $str = (string) substr($time,-5,6);
        $str = str_replace('0','1',$str);
        return $str;
    }
}