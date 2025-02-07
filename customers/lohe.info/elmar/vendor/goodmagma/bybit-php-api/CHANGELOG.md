# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).


## [0.7.0] - 2024-08-26

### Added

- Added support for DEMO Trading
- Added ByBitApi::DEMO_API_URL

### Breaking Change

Unfortunatly this release has a breaking change on the constructor of ByBitApi. 
The "sandbox" boolean parameter is replaced by "host" string parameter that represent the API endpoint.

The old code was: 
```
$bybitApi = new ByBitApi($api_key, $api_secret, $sandbox);`
```

The new code will be: 
```
$bybitApi = new ByBitApi($api_key, $api_secret, $host);
```

Possible host values: 

* `ByBit\SDK\ByBitApi::TESTNET_API_URL`
* `ByBit\SDK\ByBitApi::DEMO_API_URL`
* `ByBit\SDK\ByBitApi::PROD_API_URL`

You can replace the old code with:

```
$bybitApi = new ByBitApi($key, $secret, $sandbox ? ByBitApi::TESTNET_API_URL : ByBitApi::PROD_API_URL);
```


## [0.6.1] - 2023-10-19

### Added

- added more enums definitions


## [0.6.0] - 2023-09-22

### Added

- Added Broker API


## [0.5.0] - 2023-09-12

### Added

- Added Institutional Lending Api and C2C Lending Api


## [0.4.0] - 2023-09-11

### Changed

- Completed UserApi, Added SpotLeverageTokenApi, SpotMarginTradeUtaApi, SpotMarginTradeNormalApi


## [0.3.0] - 2023-09-11

### Added

- Added Spot Leverage Token Api


## [0.2.0] - 2023-09-10

### Added

- Added AssetApi and PreUpgradeApi


## [0.1.0] - 2023-09-09

First public release that cover the following API's: Market, Trade, Position, Account, User



[0.7.0]: https://github.com/goodmagma/bybit-php-api/compare/v0.6.1...v0.7.0
[0.6.1]: https://github.com/goodmagma/bybit-php-api/compare/v0.6.0...v0.6.1
[0.6.0]: https://github.com/goodmagma/bybit-php-api/compare/v0.5.0...v0.6.0
[0.5.0]: https://github.com/goodmagma/bybit-php-api/compare/v0.4.0...v0.5.0
[0.4.0]: https://github.com/goodmagma/bybit-php-api/compare/v0.3.0...v0.4.0
[0.3.0]: https://github.com/goodmagma/bybit-php-api/compare/v0.2.0...v0.3.0
[0.2.0]: https://github.com/goodmagma/bybit-php-api/compare/v0.1.0...v0.2.0
[0.1.0]: https://github.com/goodmagma/bybit-php-api/releases/tag/v0.1.0