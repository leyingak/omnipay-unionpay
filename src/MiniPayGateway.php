<?php

namespace Omnipay\UnionPay;
use Omnipay\UnionPay\Message\CompleteMiniPurchaseRequest;
use Omnipay\UnionPay\Message\MiniQueryRequest;
use Omnipay\UnionPay\Message\MiniRefundQueryRequest;
use Omnipay\UnionPay\Message\MiniRefundRequest;
use Omnipay\UnionPay\Message\UacMiniOrderRequest;

class MiniPayGateway extends AbstractMiniGateway
{

    public function getName()
    {
        return 'UnionPay MiniPay Gateway';
    }

    public function purchase($options = [])
    {
        return $this->createRequest(UacMiniOrderRequest::class, $options);
    }

    public function query($options = [])
    {
        return $this->createRequest(MiniQueryRequest::class, $options);
    }

    public function completePurchase($options = [])
    {
        return $this->createRequest(CompleteMiniPurchaseRequest::class, $options);
    }

    public function refund($options = [])
    {
        return $this->createRequest(MiniRefundRequest::class, $options);
    }

    public function queryRefund($options = [])
    {
        return $this->createRequest(MiniRefundQueryRequest::class, $options);
    }

}