<?php

namespace Omnipay\UnionPay\Message;

use Omnipay\Common\Message\ResponseInterface;
use Omnipay\UnionPay\Common\ResponseVerifyHelper;
use Omnipay\UnionPay\Common\Signer;

/**
 * Class ExpressCompletePurchaseRequest
 * @package Omnipay\UnionPay\Message
 */
class ExpressCompletePurchaseRequest extends AbstractRequest
{

    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return mixed
     */
    public function getData()
    {
        return $this->getRequestParams();
    }


    public function setRequestParams($value)
    {
        $this->setParameter('request_params', $value);
    }


    public function getRequestParams()
    {
        return $this->getParameter('request_params');
    }


    public function setCertDir($value)
    {
        $this->setParameter('certDir', $value);
    }


    public function getCertDir()
    {
        return $this->getParameter('certDir');
    }


    public function getRequestParam($key)
    {
        $params = $this->getRequestParams();
        if (isset($params[$key])) {
            return $params[$key];
        } else {
            return null;
        }
    }


    /**
     * Send the request with specified data
     *
     * @param  mixed $data The data to send
     *
     * @return ResponseInterface
     */
    public function sendData($data)
    {
//        $signer = new Signer($data);
//        $signer->setIgnores(array('signature'));
//        $alg = isset($data['version']) && $data['version'] == '5.0.0' ? OPENSSL_ALGO_SHA1 : OPENSSL_ALGO_SHA256;
//        //$alg = OPENSSL_ALGO_SHA256;
//        $content   = $signer->getContentToSign($alg);
//        $publicKey = $this->getPublicKey();
//
//        /*if (! $this->getPublicKey()) {
//            $certId = $this->getCertId();
//            if ($certId) {
//                $publicKey = Signer::findPublicKey($certId, $this->getCertDir());
//            }
//        }*/
//        $publicKey = $data['signPubKeyCert']; //无条件相信发送方的公钥是对的！
//        /**
//         * todo 使用ca证书验证公钥的有效性
//         * 我咋感觉5.1的验签还没有5.0安全。唯一增强的是sha1变成sha256, 但公钥使用响应内容里的signPubKeyCert，
//         * 然后使用ca证书验证这个公钥的有效性，整个很繁琐。但并不如商户本地直接存储银联公钥有效。
//         */
//
//        $data['verify_success'] = $signer->verifyWithRSA($content, $data['signature'], $publicKey, $alg);
        $env        = $this->getEnvironment();
        $rootCert   = $this->getRootCert();
        $middleCert = $this->getMiddleCert();

        $data['verify_success'] = ResponseVerifyHelper::verify($data, $env, $rootCert, $middleCert);

        $data['is_paid'] = $data['verify_success'] && ($this->getRequestParam('respCode') == '00');

        return $this->response = new ExpressCompletePurchaseResponse($this, $data);
    }
}
