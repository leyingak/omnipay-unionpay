<?php

namespace Omnipay\UnionPay\Message;

use Omnipay\UnionPay\Contracts\NotifyResponseContract;
use Omnipay\UnionPay\Contracts\ResponseContract;

class MiniQueryRequest extends AbstractMiniRequest
{

    public function getUriPath()
    {
        return '/v1/netpay/query';
    }

    public function validateFields()
    {
        return [];
    }

    /**
     * @return NotifyResponseContract
     */
    public function handleResponse($response)
    {
        return new MiniNotifyResponse($response, $this);
    }


}