<?php

namespace Omnipay\UnionPay\Message;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Message\AbstractRequest as BaseAbstractRequest;
use Omnipay\UnionPay\Common\Signer;
use Omnipay\UnionPay\Common\StringUtil;

/**
 * Class AbstractRequest
 * @package Omnipay\UnionPay\Message
 */
abstract class AbstractRequest extends BaseAbstractRequest
{
    protected $sandboxEndpoint = 'https://gateway.test.95516.com/gateway/api/';

    protected $productionEndpoint = 'https://gateway.95516.com/gateway/api/';

    protected $sandboxBillDownloadPoint = 'https://filedownload.test.95516.com/';
    protected $productionBillDownloadPoint = 'https://filedownload.test.95516.com/';

    protected $methods = array(
        'front' => 'frontTransReq.do',
        'back'  => 'backTransReq.do',
        'app'   => 'appTransReq.do',
        'query' => 'queryTrans.do',
    );


    public function getEndpoint($type)
    {
        if ('billdownload' == $type) {
            if ($this->getEnvironment() == 'production') {
                return $this->productionBillDownloadPoint;
            } else {
                return $this->sandboxBillDownloadPoint;
            }
        }
        if ($this->getEnvironment() == 'production') {
            return $this->productionEndpoint . $this->methods[$type];
        } else {
            return $this->sandboxEndpoint . $this->methods[$type];
        }
    }


    public function getEnvironment()
    {
        return $this->getParameter('environment');
    }


    public function setVersion($value)
    {
        return $this->setParameter('version', $value);
    }


    public function getVersion()
    {
        return $this->getParameter('version');
    }


    public function setEncoding($value)
    {
        return $this->setParameter('encoding', $value);
    }


    public function getEncoding()
    {
        return $this->getParameter('encoding');
    }


    public function setTxnType($value)
    {
        return $this->setParameter('txnType', $value);
    }


    public function getTxnType()
    {
        return $this->getParameter('txnType');
    }


    public function getTxnSubType()
    {
        return $this->getParameter('txnSubType');
    }


    public function setTxnSubType($value)
    {
        return $this->setParameter('txnSubType', $value);
    }


    public function setBizType($value)
    {
        return $this->setParameter('bizType', $value);
    }


    public function getBizType()
    {
        return $this->getParameter('bizType');
    }


    public function setReturnUrl($value)
    {
        return $this->setParameter('returnUrl', $value);
    }


    public function getReturnUrl()
    {
        return $this->getParameter('returnUrl');
    }


    public function setNotifyUrl($value)
    {
        return $this->setParameter('notifyUrl', $value);
    }


    public function getNotifyUrl()
    {
        return $this->getParameter('notifyUrl');
    }


    public function setSignMethod($value)
    {
        return $this->setParameter('signMethod', $value);
    }


    public function getSignMethod()
    {
        return $this->getParameter('signMethod');
    }


    public function setChannelType($value)
    {
        return $this->setParameter('channelType', $value);
    }


    public function getChannelType()
    {
        return $this->getParameter('channelType');
    }


    public function setAccessType($value)
    {
        return $this->setParameter('accessType', $value);
    }


    public function getAccessType()
    {
        return $this->getParameter('accessType');
    }


    public function setMerId($value)
    {
        return $this->setParameter('merId', $value);
    }


    public function getMerId()
    {
        return $this->getParameter('merId');
    }


    public function setCurrencyCode($value)
    {
        return $this->setParameter('currencyCode', $value);
    }


    public function getCurrencyCode()
    {
        return $this->getParameter('currencyCode');
    }


    public function setEnvironment($value)
    {
        return $this->setParameter('environment', $value);
    }


    public function setCertPath($value)
    {
        return $this->setParameter('certPath', $value);
    }


    public function getCertPath()
    {
        return $this->getParameter('certPath');
    }


    public function setCertPassword($value)
    {
        return $this->setParameter('certPassword', $value);
    }


    public function getCertPassword()
    {
        return $this->getParameter('certPassword');
    }


    public function setOrderDesc($value)
    {
        return $this->setParameter('orderDesc', $value);
    }


    public function getOrderDesc()
    {
        return $this->getParameter('orderDesc');
    }


    public function setReqReserved($value)
    {
        return $this->setParameter('reqReserved', $value);
    }


    public function getReqReserved()
    {
        return $this->getParameter('reqReserved');
    }


    public function setOrderId($value)
    {
        return $this->setParameter('orderId', $value);
    }


    public function getOrderId()
    {
        return $this->getParameter('orderId');
    }


    public function setTxnTime($value)
    {
        return $this->setParameter('txnTime', $value);
    }


    public function getTxnTime()
    {
        return $this->getParameter('txnTime');
    }


    public function setTxnAmt($value)
    {
        return $this->setParameter('txnAmt', $value);
    }


    public function getTxnAmt()
    {
        return $this->getParameter('txnAmt');
    }


    public function setRequestType($value)
    {
        return $this->setParameter('requestType', $value);
    }


    public function getRequestType()
    {
        return $this->getParameter('requestType');
    }


    public function setDefaultPayType($value)
    {
        return $this->setParameter('defaultPayType', $value);
    }


    public function getDefaultPayType()
    {
        return $this->getParameter('defaultPayType');
    }


    public function setCertDir($value)
    {
        return $this->setParameter('certDir', $value);
    }


    public function getCertDir()
    {
        return $this->getParameter('certDir');
    }


    /**
     * @return mixed
     */
    public function getCertId()
    {
        return $this->getParameter('certId');
    }


    /**
     * @param $value
     *
     * @return $this
     */
    public function setCertId($value)
    {
        return $this->setParameter('certId', $value);
    }


    /**
     * @return mixed
     */
    public function getPrivateKey()
    {
        return $this->getParameter('privateKey');
    }


    /**
     * @param $value
     *
     * @return $this
     */
    public function setPrivateKey($value)
    {
        return $this->setParameter('privateKey', $value);
    }


    /**
     * @return mixed
     */
    public function getPublicKey()
    {
        return $this->getParameter('publicKey');
    }


    /**
     * @param $value
     *
     * @return $this
     */
    public function setPublicKey($value)
    {
        return $this->setParameter('publicKey', $value);
    }


    /**
     * @return mixed
     */
    public function getEncryptCertId()
    {
        return $this->getParameter('encryptCertId');
    }


    /**
     * @param $value
     *
     * @return $this
     */
    public function setEncryptCertId($value)
    {
        return $this->setParameter('encryptCertId', $value);
    }


    /**
     * @param $method
     * @param $data
     *
     * @return array
     * @throws \Psr\Http\Client\Exception\NetworkException
     * @throws \Psr\Http\Client\Exception\RequestException
     */
    protected function httpRequest($method, $data)
    {
        $url  = $this->getEndpoint($method);
        $body = http_build_query($data);

        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded'
        ];

        // 新版omnipay-common中无post()方法，会导致单元测试失败,除非omnipay/common: v3.0-alpha.1
        // 但为不影响微信支付在支付项目中不升级omnipay
        //$response = $this->httpClient->request('POST', $url, $headers, $body)->getBody();
        //$response = $this->httpClient->createRequest('POST', $url, $headers, $body)->send()->getBody();
        $response = $this->httpClient->post($url, $headers, $body)->getBody();
        $content = $response->getContents();
        $payload  = StringUtil::parseFuckStr($response);

        return $payload;
    }


    protected function getTheCertId()
    {
        if ($this->getCertId()) {
            return $this->getCertId();
        } else {
            $cert = Signer::readCert($this->getCertPath(), $this->getCertPassword());

            return Signer::readCertId($cert);
        }
    }


    protected function sign($params, $signType = 'RSA2')
    {
        $signer = new Signer($params);
        $signer->setIgnores(array('sign'));

        $signType = strtoupper($signType);

        if ($signType == 'RSA' || $signType == 'RSA2') {
            $alg = $signType == 'RSA' ? OPENSSL_ALGO_SHA1 : OPENSSL_ALGO_SHA256;

            if ($this->getPrivateKey()) {
                $sign = $signer->signWithRSA($this->getPrivateKey(), $alg);
            } else {
                $sign = $signer->signWithCert($this->getCertPath(), $this->getCertPassword(), $alg);
            }
        } else {
            throw new InvalidRequestException('The signType is invalid');
        }

        return $sign;
    }


    protected function filter($params)
    {
        return array_filter($params, 'strlen');
    }
}
