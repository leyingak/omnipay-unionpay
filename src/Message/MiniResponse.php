<?php

namespace Omnipay\UnionPay\Message;


use Omnipay\UnionPay\Contracts\ResponseContract;

class MiniResponse implements ResponseContract
{

    protected $success = 'SUCCESS';

    /**
     * @var AbstractMiniRequest $request
     */
    protected $request;

    protected $response;

    public function __construct($response, $request = null)
    {
        $this->request = $request;
        $this->setResponse($response);
    }

    public function setResponse($response)
    {
        if (is_string($response)) {
            $response = json_decode($response, true);
        }

        if (is_array($response) && $this->request) {
            $response = $this->request->handlePrefix($response, false);
        }

        $this->response = $response;
    }

    public function getResponse($key = null, $default = null)
    {
        if (is_null($key)) {
            return $this->response;
        } else {
            return array_get($this->response, $key, $default);
        }
    }

    public function getErrCode()
    {
        return $this->getResponse('errCode');
    }

    public function isSuccessful()
    {
        return $this->success === $this->getResponse('errCode');
    }

    public function getMessage()
    {
        return $this->getResponse('errMsg');
    }

    public function getData()
    {
        return $this->getResponse();
    }

    public function getTradeNo()
    {
        return $this->getResponse('merOrderId');
    }

    public function getOutTradeNo()
    {
        return $this->getResponse('targetOrderId');
    }


    public function getRequestData()
    {
        if ($this->request instanceof AbstractMiniRequest) {
            return $this->request->getData();
        }

        return null;
    }


}