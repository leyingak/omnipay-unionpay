<?php

namespace Omnipay\UnionPay\Message;

use Omnipay\UnionPay\Common\Signer;
use Omnipay\UnionPay\Contracts\NotifyResponseContract;

class CompleteMiniPurchaseRequest extends AbstractMiniRequest
{
    protected $prefixFields = [
        'merOrderId',
        'refundOrderId',
    ];

    protected $validateFields = [];

    public function getUriPath()
    {
        return '';
    }

    public function validateFields()
    {
        return ['notifyKey', 'notifyParams'];
    }

    /**
     * @return NotifyResponseContract
     */
    public function sendData($data)
    {
        $sign = Signer::notifySign($this->getNotifyKey(), $data, $this->getSignType());

        $responseData = [];
        if ($sign !== strtoupper($data['sign'])) {
            $responseData['signature'] = false;
            $responseData['status'] = false;
        } else {
            $responseData['signature'] = true;
            $responseData['status'] = $data['status'];
        }

        $responseData['merOrderId'] = $data['merOrderId'];
        $responseData['seqId'] = $data['seqId'];
        $responseData['targetOrderId'] = $data['targetOrderId'];

        if (!empty($data['refundOrderId'])) {
            $responseData['refundOrderId'] = $data['refundOrderId'];
        }

        return new MiniNotifyResponse($responseData, $this);
    }

    public function getData()
    {
        $data = parent::getData();
        return $data['notifyParams'];
    }

    public function getNotifyKey()
    {
        return $this->getParameter('notifyKey');
    }
    public function setNotifyKey($notifyKey)
    {
        return $this->setParameter('notifyKey', $notifyKey);
    }

    public function getSignType()
    {
        return $this->getParameter('signType');
    }

    public function setSignType($signType)
    {
        return $this->setParameter('signType', $signType);
    }

    public function getNotifyParams()
    {
        return $this->getParameter('notifyParams');
    }

    public function setNotifyParams($notifyParams)
    {
        return $this->getParameter('notifyParams', $notifyParams);
    }

}