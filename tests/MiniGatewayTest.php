<?php

use Omnipay\Omnipay;
use Omnipay\Tests\GatewayTestCase;
use Omnipay\UnionPay\Contracts\MiniPayResponseContract;
use Omnipay\UnionPay\Message\MiniNotifyResponse;
use Omnipay\UnionPay\Message\MiniRefundResponse;
use Omnipay\UnionPay\MiniPayGateway;

class MiniGatewayTest extends GatewayTestCase
{
    /**
     * @var $gateway MiniPayGateway
     */
    protected $gateway;

    protected $support;

    public function setUp()
    {
        try {
            parent::setUp();
            $this->gateway = Omnipay::create('UnionPay_MiniPay');
            $this->gateway->initialize([
                'appId'     => '1111',
                'appKey'    => '1111',
                'notifyKey' => '1111',
                'subAppId'  => '1111',
                'mid'       => '1111',
                'tid'       => '1111',
                'signType'  => 'SHA256',
            ])->sandbox();
        } catch (\Exception $e) {
            print_r($e->getTraceAsString());
        }
    }

    public function testPurchase()
    {
        $data = [
            'merOrderId'  => date('YmdHis'),
            'totalAmount' => '100',
            'clientIp'    => '127.0.0.1',
            'subOpenId'   => '11111111',
            'notifyUrl'   => ''
        ];

        /**
         * @var $response MiniPayResponseContract
         */
        $response = $this->gateway->purchase($data)->send();
        $this->assertTrue($response->isSuccessful());
        $this->assertTrue($response->getMiniPayRequest());
    }

    public function testCompletePurchase()
    {
        $data = [
            'notifyParams' => [
                "payTime"                  => "",
                "sssss"                    => "",
                "mid"                      => "89846017299APP4",
                "tid"                      => "C9FNU8V6",
                "instMid"                  => "",
                "attachedData"             => "",
                "bankCardNo"               => "",
                "billFunds"                => "",
                "billFundsDesc"            => "",
                "buyerId"                  => "",
                "buyerUsername"            => "",
                "buyerPayAmount"           => "",
                "totalAmount"              => "1",
                "invoiceAmount"            => "",
                "merOrderId"               => "dd20220419111222",
                "receiptAmount"            => "",
                "refId"                    => "",
                "refundAmount"             => "",
                "refundDesc"               => "",
                "seqId"                    => "",
                "settleDate"               => "",
                "status"                   => "TRADE_SUCCESS",
                "subBuyerId"               => "",
                "targetOrderId"            => "",
                "targetSys"                => "",
                "sign"                     => "45D410AFA057F2AF8264AAED5790DE917146040938FE4F62AF2B5A418290A15E",
                "couponMerchantContribute" => "",
                "couponOtherContribute"    => "",
                "activityIds"              => "",
                "refundTargetOrderId"      => "",
                "refundPayTime"            => "",
                "refundSettleDate"         => "",
                "orderDesc"                => "",
                "createTime"               => "",
                "mchntUuid"                => "",
                "connectSys"               => "",
                "subInst"                  => "",
                "yxlmAmount"               => "",
                "refundExtOrderId"         => "",
                "goodsTradeNo"             => "",
                "extOrderId"               => "",
                "secureStatus"             => "",
                "completeAmount"           => "",
                "refundOrderId"            => "",
                "couponAmount"             => "",
                "bankInfo"                 => ""
            ]
        ];

        /**
         * @var $response MiniNotifyResponse
         */
        $response = $this->gateway->completePurchase($data)->send();
        $this->assertTrue($response->isPaid());
        $this->assertTrue($response->isSignMatch());
    }

    public function testQuery()
    {
        $params = [
            'merOrderId' => '1111'
        ];

        /**
         * @var $response MiniNotifyResponse
         */
        $response = $this->gateway->query($params)->send();
        $this->assertTrue($response->isSuccessful());
        $this->assertTrue($response->isPaid());
        $this->assertTrue($response->isSignMatch());
    }

    public function testRefund()
    {
        /**
         * order_no         退款订单号
         * charge_order_no  原始订单号
         * amount           退款金额
         * description      备注信息
         * notify_url
         */
        $data = [
            'merOrderId' => '11111111',
            'refundOrderId' => '22222222',
            'refundAmount' => '100',
        ];

        /**
         * @var $response MiniRefundResponse
         */
        $response = $this->gateway->refund($data)->send();
        $this->assertTrue($response->isRefund());
    }

    public function testRefundQuery()
    {
        $params = [
            'merOrderId' => '22222222',
        ];

        /**
         * @var $response MiniRefundResponse
         */
        $response = $this->gateway->queryRefund($params)->send();
        $this->assertTrue($response->isRefund());
    }

}