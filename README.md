Astina Tradedoubler Bundle
==========================

Symfony 2 bundle for Tradedoubler integration.

## Installation

### Step 1: Add to composer.json

```
"require" :  {
    // ...
    "astina/tradedoubler-bundle":"dev-master",
}
```

### Step 2: Enable the bundle

Enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Astina\Bundle\TradedoublerBundle\AstinaTradedoublerBundle(),
    );
}
```

### Step 3: Configuration

Add the token, feed ID and trackback infos to your config.yml:

```yaml
# app/config.yml

astina_tradedoubler:
    api_token: xxxxyyyyzzz
    feed_id: 123456
    trackback:
        organization: 1111
        event_id: 2222
        redirect_default_url: http://myshop.com
```

## Usage

Use the classes in `Model/` to create instances of `Product`, `Category`, `ProductImage` and `ProductCollection`.

Use the `astina_tradedoubler.client` service to create/update/delete Tradedoubler records:

```php
/** @var \Astina\Bundle\TradedoublerBundle\Client\Client $client **/
$client->createProducts(new ProductCollection($tradedoublerProducts));
```

### Sending all product data to Tradedoubler

You can use the `astina:tradedoubler:populate` commands to send your whole product catalogue to Tradedoubler. For this to work you have to:

1. Create a service that implements `Astina\Bundle\TradedoublerBundle\Client\ProductSourceInterface`.

2. Add the service id to the config:

```yaml
astina_tradedoubler:
    product_source: my_product_source_service
```