# Happyr Match API client

[![Latest Version](https://img.shields.io/github/release/Happyr/match-api-client.svg?style=flat-square)](https://github.com/Happyr/match-api-client/releases)
[![Total Downloads](https://img.shields.io/packagist/dt/happyr-match/api-client.svg?style=flat-square)](https://packagist.org/packages/happyr-match/api-client)

Api client for https://api.happyrmatch.com.

## Install

Via Composer

``` bash
$ composer require happyr-match/api-client
```

## Usage

``` php
$apiClient = ApiClient::create($endpoint, $clientId, $clientSecret);
$accessToken = $apiClient->createNewAccessToken($code, $redirectUri);
$apiClient->authenticate($accessToken);
$findTypes = $apiClient->find()->getTypes();
```

### Hydrator

The end user chooses which hydrator to use. The default one should return domain objects.

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
