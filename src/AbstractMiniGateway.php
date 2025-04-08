<?php

namespace Omnipay\UnionPay;

use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Exception\InvalidRequestException;
use Symfony\Component\HttpFoundation\ParameterBag;

abstract class AbstractMiniGateway extends AbstractGateway
{

    protected $endpoints = [
        'production' => 'https://api-mop.chinaums.com',
        'sandbox'    => 'https://test-api-open.chinaums.com',
    ];


    public function getDefaultParameters(): array
    {
        return [
            'requestTimestamp' => date('Y-m-d H:i:s', time()),
            'instMid' => 'MINIDEFAULT',
        ];
    }

    public function getEndpoint()
    {
        return $this->getParameter('endpoint');
    }

    /**
     * @throws InvalidRequestException
     */
    public function production(): self
    {
        return $this->setEnvironment('production');
    }

    public function setEnvironment($value): self
    {
        $env = strtolower($value);

        if (! isset($this->endpoints[$env])) {
            throw new InvalidRequestException('The environment is invalid');
        }

        $this->setEndpoint($this->endpoints[$env]);

        return $this;
    }

    public function setEndpoint($value): self
    {
        return $this->setParameter('endpoint', $value);
    }

    public function sandbox(): self
    {
        return $this->setEnvironment('sandbox');
    }

    public function initialize(array $parameters = []): self
    {
        $this->parameters = new ParameterBag();

        foreach ($this->getDefaultParameters() as $key => $value) {
            if (is_array($value)) {
                $this->parameters->set($key, reset($value));
            } else {
                $this->parameters->set($key, $value);
            }
        }

        foreach ($parameters as $key => $value) {
            if (in_array($key, $this->allowFields())) {
                $this->parameters->set($key, $value);
            } else if ($key === 'env') {
                method_exists($this, $value) && call_user_func([$this, $value]);
            }
        }

        return $this;
    }

    protected function allowFields(): array
    {
        return [
            'requestTimestamp',
            'merOrderId',
            'mid',
            'tid',
            'subAppId',
            'notifyKey',
            'signType',
            'appId',
            'appKey',
            'totalAmount',
            'tradeType',
            'msgId',
            'srcReserve',
            'instMid',
            'goods',
            'attachedData',
            'expireTime',
            'goodsTag',
            'orderDesc',
            'originalAmount',
            'merOrderId',
            'targetOrderId',
            'refundAmount',
            'targetOrderId',
            'refundOrderId',
            'platformAmount',
        ];
    }

}