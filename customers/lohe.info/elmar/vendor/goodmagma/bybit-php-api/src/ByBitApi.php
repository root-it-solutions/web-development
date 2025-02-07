<?php
namespace ByBit\SDK;

use ByBit\SDK\Api\MarketApi;
use ByBit\SDK\Api\PositionApi;
use ByBit\SDK\Api\AccountApi;
use ByBit\SDK\Api\TradeApi;
use ByBit\SDK\Api\UserApi;
use ByBit\SDK\Api\AssetApi;
use ByBit\SDK\Api\PreUpgradeApi;
use ByBit\SDK\Api\SpotLeverageTokenApi;
use ByBit\SDK\Api\SpotMarginTradeUtaApi;
use ByBit\SDK\Api\SpotMarginTradeNormalApi;
use ByBit\SDK\Api\InstitutionalLendingApi;
use ByBit\SDK\Api\C2CLendingApi;
use ByBit\SDK\Api\BrokerApi;

/**
 * ByBitApi Client
 *
 */
class ByBitApi {

    /**
     * @var string SDK Version
     */
    const NAME = "ByBit-PHP-SDK";
    
    /**
     * @var string SDK Version
     */
    const VERSION = "0.6.1";
    
    /**
     * @var string SDK update date
     */
    const UPDATE_DATE = "2023.10.19";

    /**
     * @var string sandbox API URL
     */
    const TESTNET_API_URL = "https://api-testnet.bybit.com";

    /**
     * @var string prod API URL
     */
    const PROD_API_URL = "https://api.bybit.com";

    /**
     * @var string demo API URL
     */
    const DEMO_API_URL = "https://api-demo.bybit.com";
    
    
    protected $key;
    protected $secret;
    protected $host;
    
    
    /**
     * Constructor
     * 
     * @param string $key
     * @param string $secret
     * @param string $sandbox, default false, true for use sandbox api
     */
    function __construct(string $key = '', string $secret = '', string $host = self::PROD_API_URL) {
        $this->key = $key;
        $this->secret = $secret;
        $this->host = $host;
    }
    
    
    /**
     * Get Market Api
     */
    public function marketApi(){
        return new MarketApi($this->key, $this->secret, $this->host);
    }
    
    
    /**
     * Get Trade Api
     */
    public function tradeApi(){
        return new TradeApi($this->key, $this->secret, $this->host);
    }
    

    /**
     * Get Position Api
     */
    public function positionApi(){
        return new PositionApi($this->key, $this->secret, $this->host);
    }
    
    
    /**
     * Get Pre Upgrade Api
     */
    public function preUpgradeApi(){
        return new PreUpgradeApi($this->key, $this->secret, $this->host);
    }
    
    
    /**
     * Get Account Api
     */
    public function accountApi(){
        return new AccountApi($this->key, $this->secret, $this->host);
    }
    
    
    /**
     * Get Asset Api
     */
    public function assetApi(){
        return new AssetApi($this->key, $this->secret, $this->host);
    }
    
    
    /**
     * Get User Api
     */
    public function userApi(){
        return new UserApi($this->key, $this->secret, $this->host);
    }
    

    /**
     * Get Spot Leverage Token Api
     */
    public function spotLeverageTokenApi(){
        return new SpotLeverageTokenApi($this->key, $this->secret, $this->host);
    }

    
    /**
     * Get Spot Margin Trade (UTA) Api
     */
    public function spotMarginTradeUtaApi(){
        return new SpotMarginTradeUtaApi($this->key, $this->secret, $this->host);
    }
    
    
    /**
     * Get Spot Margin Trade (Normal) Api
     */
    public function spotMarginTradeNormalApi(){
        return new SpotMarginTradeNormalApi($this->key, $this->secret, $this->host);
    }
    
    
    /**
     * Institutional Lending Api
     */
    public function institutionalLendingApi(){
        return new InstitutionalLendingApi($this->key, $this->secret, $this->host);
    }

    
    /**
     * C2C Lending Api
     */
    public function c2CLendingApi(){
        return new C2CLendingApi($this->key, $this->secret, $this->host);
    }

    
    /**
     * Broker Api
     */
    public function brokerApi(){
        return new BrokerApi($this->key, $this->secret, $this->host);
    }

}