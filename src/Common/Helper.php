<?php
/**
 * Created by PhpStorm.
 * User: Lyen
 * Date: 2019/4/10
 * Time: 16:43
 */

namespace Omnipay\UnionPay\Common;


class Helper
{
    public static function createAutoFormHtml($params, $reqUrl) {
        // <body onload="javascript:document.pay_form.submit();">
        $encodeType = isset ( $params ['encoding'] ) ? $params ['encoding'] : 'UTF-8';
        $html = <<<eot
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset={$encodeType}" />
</head>
<body onload="javascript:document.pay_form.submit();">
    <form id="pay_form" name="pay_form" action="{$reqUrl}" method="post">
	
eot;
        foreach ( $params as $key => $value ) {
            $html .= "    <input type=\"hidden\" name=\"{$key}\" id=\"{$key}\" value=\"{$value}\" />\n";
        }
        $html .= <<<eot
   <!-- <input type="submit" type="hidden">-->
    </form>
</body>
</html>
eot;
        return $html;
    }
}