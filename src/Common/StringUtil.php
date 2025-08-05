<?php

namespace Omnipay\UnionPay\Common;

/**
 * String Util for UnionPay
 * Class StringUtil
 * @package Omnipay\UnionPay\Common
 */
class StringUtil
{
    public static function parseFuckStr($str, $data = array())
    {
        preg_match_all('#(?<k>[^=]+)=(?<v>[^&{]+|{[^}]+}|\[[^]]+])&?#', $str, $matches);

        foreach ($matches['k'] as $i => $key) {
            $data[$key] = $matches['v'][$i];
        }

        return $data;
    }

    public static function start($value, $prefix)
    {
        $quoted = preg_quote($prefix, '/');

        return $prefix.preg_replace('/^(?:'.$quoted.')+/u', '', $value);
    }

    public static function startsWith($haystack, $needles)
    {
        foreach ((array) $needles as $needle) {
            if ((string) $needle !== '' && strncmp($haystack, $needle, strlen($needle)) === 0) {
                return true;
            }
        }

        return false;
    }

    public static function replaceFirst($search, $replace, $subject)
    {
        if ($search == '') {
            return $subject;
        }

        $position = strpos($subject, $search);

        if ($position !== false) {
            return substr_replace($subject, $replace, $position, strlen($search));
        }

        return $subject;
    }

    public static function replaceStart($search, $replace, $subject)
    {
        $search = (string) $search;

        if ($search === '') {
            return $subject;
        }

        if (static::startsWith($subject, $search)) {
            return static::replaceFirst($search, $replace, $subject);
        }

        return $subject;
    }

}
