<?php

namespace Omnipay\UnionPay\Message;

use Omnipay\Common\Message\AbstractRequest as OmnipayAbstractRequest;
use Omnipay\UnionPay\Common\Signer;
use Omnipay\UnionPay\Contracts\ResponseContract;
use Symfony\Component\HttpFoundation\ParameterBag;

abstract class AbstractMiniRequest extends OmnipayAbstractRequest
{

    protected $endpoint = 'https://api-mop.chinaums.com';

    protected $validateFields = [
        'requestTimestamp',
        'merOrderId',
        'mid',
        'tid',
        'appId',
        'appKey',
    ];

    public function sendData($data)
    {
        $method = $this->getRequestMethod();
        $url    = $this->getRequestUrl();
        $body   = json_encode($data);

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $this->getAuthorization($body),
        ];

        $response = $this->httpClient->send($method, $url, $headers, $body);
        return $this->handleResponse((string)$response->getBody());
    }

    protected function getAuthorization($body = null): string
    {
        return Signer::getOpenBodySig($this->getAppId(), $this->getAppKey(), $body);
    }

    public function getAppId()
    {
        return $this->getParameter('appId');
    }

    public function setAppId($value)
    {
        return $this->setParameter('appId', $value);
    }

    public function getAppKey()
    {
        return $this->getParameter('appKey');
    }

    public function setAppKey($value)
    {
        return $this->setParameter('appKey', $value);
    }

    protected function getRequestMethod(): string
    {
        return 'POST';
    }

    protected function getRequestUrl(): string
    {
        return sprintf("%s%s", $this->getEndpoint(), $this->getUriPath());
    }

    public function getEndpoint()
    {
        return $this->getParameter('endpoint') ?: $this->endpoint;
    }

    public function setEndpoint($value)
    {
        return $this->setParameter('endpoint', $value);
    }

    abstract public function getUriPath(): string;

    public function handleResponse($response): ResponseContract
    {
        return new MiniResponse($response, $this);
    }

    public function getData()
    {
        $data = $this->getParameters();
        call_user_func_array(
            [$this, 'validate'],
            array_merge($this->validateFields, $this->validateFields())
        );

        return $this->getParameters();
    }

    public function initialize(array $parameters = []): self
    {
        $this->parameters = new ParameterBag();

        foreach ($parameters as $key => $value) {
            $this->parameters->set($key, $value);
        }

        return $this;
    }

    abstract function validateFields(): array;
}