<?php

namespace Omnipay\UnionPay\Contracts;

interface NotifyResponseContract extends ResponseContract
{

    public function isSuccessful();

    public function isPaid();

    public function isSignMatch();

}