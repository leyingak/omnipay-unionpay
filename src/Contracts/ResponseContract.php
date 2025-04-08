<?php

namespace Omnipay\UnionPay\Contracts;

interface ResponseContract
{

    public function isSuccessful();

    public function getErrCode();

    public function getMessage();

    public function getData();

    public function getRequestData();

}