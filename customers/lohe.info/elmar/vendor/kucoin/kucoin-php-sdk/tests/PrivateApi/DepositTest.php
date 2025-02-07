<?php

namespace KuCoin\SDK\Tests\PrivateApi;

use KuCoin\SDK\Exceptions\BusinessException;
use KuCoin\SDK\PrivateApi\Deposit;

class DepositTest extends TestCase
{
    protected $apiClass = Deposit::class;

    /**
     * @dataProvider apiProvider
     * @param Deposit $api
     * @return array|string
     * @throws \KuCoin\SDK\Exceptions\BusinessException
     * @throws \KuCoin\SDK\Exceptions\HttpException
     * @throws \KuCoin\SDK\Exceptions\InvalidApiUriException
     */
    public function testCreateAddress(Deposit $api)
    {
        $this->markTestSkipped();
        return;
        $address = $api->createAddress('BTC');
        $this->assertInternalType('array', $address);
        $this->assertArrayHasKey('address', $address);
        $this->assertArrayHasKey('memo', $address);
    }

    /**
     * @dataProvider apiProvider
     * @param Deposit $api
     * @return array|string
     * @throws \KuCoin\SDK\Exceptions\BusinessException
     * @throws \KuCoin\SDK\Exceptions\HttpException
     * @throws \KuCoin\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetAddress(Deposit $api)
    {
        try {
            $address = $api->getAddress('USDT');
            if ($address !== null) {
                $this->assertInternalType('array', $address);
                $this->assertArrayHasKey('address', $address);
                $this->assertArrayHasKey('memo', $address);
            }
        } catch (BusinessException $e) {
            // deposit.disabled
            if ($e->getResponse()->getApiCode() == '260200') {
                return;
            }
            throw $e;
        }
    }

    /**
     * @dataProvider apiProvider
     * @param Deposit $api
     * @return array|string
     * @throws \KuCoin\SDK\Exceptions\BusinessException
     * @throws \KuCoin\SDK\Exceptions\HttpException
     * @throws \KuCoin\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetAddresses(Deposit $api)
    {
        $addresses = $api->getAddresses('USDT');
        foreach ($addresses as $address) {
            $this->assertInternalType('array', $address);
            $this->assertArrayHasKey('address', $address);
            $this->assertArrayHasKey('memo', $address);
            $this->assertArrayHasKey('chain', $address);
            $this->assertArrayHasKey('contractAddress', $address);
        }
    }

    /**
     * @dataProvider apiProvider
     * @param Deposit $api
     * @return array|string
     * @throws \KuCoin\SDK\Exceptions\BusinessException
     * @throws \KuCoin\SDK\Exceptions\HttpException
     * @throws \KuCoin\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetDeposits(Deposit $api)
    {
        $data = $api->getDeposits(['currency' => 'BTC'], ['currentPage' => 1, 'pageSize' => 10]);
        $this->assertPagination($data);
        foreach ($data['items'] as $item) {
            $this->assertArrayHasKey('address', $item);
            $this->assertArrayHasKey('memo', $item);
            $this->assertArrayHasKey('amount', $item);
            $this->assertArrayHasKey('fee', $item);
            $this->assertArrayHasKey('currency', $item);
            $this->assertArrayHasKey('isInner', $item);
            $this->assertArrayHasKey('walletTxId', $item);
            $this->assertArrayHasKey('status', $item);
            $this->assertArrayHasKey('createdAt', $item);
            $this->assertArrayHasKey('updatedAt', $item);
        }
    }

    /**
     * @dataProvider apiProvider
     * @param Deposit $api
     * @return array|string
     * @throws \KuCoin\SDK\Exceptions\BusinessException
     * @throws \KuCoin\SDK\Exceptions\HttpException
     * @throws \KuCoin\SDK\Exceptions\InvalidApiUriException
     */
    public function testGetV1Deposits(Deposit $api)
    {
        $this->markTestSkipped();
        return;
        $data = $api->getV1Deposits(['currency' => 'ETH'], ['currentPage' => 1, 'pageSize' => 10]);
        $this->assertPagination($data);
        foreach ($data['items'] as $item) {
            $this->assertArrayHasKey('amount', $item);
            $this->assertArrayHasKey('currency', $item);
            $this->assertArrayHasKey('isInner', $item);
            $this->assertArrayHasKey('walletTxId', $item);
            $this->assertArrayHasKey('createAt', $item);
            $this->assertArrayHasKey('status', $item);
        }
    }
}