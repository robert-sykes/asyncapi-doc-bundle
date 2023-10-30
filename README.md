# Async API Symfony Bundle

## Installation

```bash
composer require ferror/asyncapi-doc-bundle
```

```php
# config/bundles.php
return [
    Ferror\AsyncapiDocBundle\Symfony\Bundle::class => ['all' => true],
];
```
```yaml
# config/packages/asyncapi_doc_bundle.yaml
ferror_asyncapi_doc_bundle:
  title: 'Service Example API'
  version: '1.2.3'
```
```yaml
# config/routes.yaml
ferror_asyncapi_doc_bundle_yaml:
    path: /asyncapi.yaml
    controller: ferror.asyncapi_doc_bundle.controller.yaml
    methods: GET

ferror_asyncapi_doc_bundle_json:
    path: /asyncapi.yaml
    controller: ferror.asyncapi_doc_bundle.controller.json
    methods: GET

ferror_asyncapi_doc_bundle_html:
    path: /asyncapi
    controller: ferror.asyncapi_doc_bundle.controller.ui
    methods: GET
```

## Minimal Usage

> Async API Symfony Byndle will use Reflection to determine the type and name of properties.
>
> Check out the other example if you want to define them manually.

```php
use DateTime;
use Ferror\AsyncapiDocBundle\Attribute\Message;

#[Message(name: 'ProductCreated', channel: 'product.created')]
final readonly class ProductCreated
{
    public function __construct(
        public int $id,
        public float $amount,
        public string $currency,
        public bool $isPaid,
        public DateTime $createdAt,
        public Week $week,
        public Payment $payment,
        public array $products,
        public array $tags,
    ) {
    }
}
```

## Usage

```php
use DateTime;
use Ferror\AsyncapiDocBundle\Attribute\Message;
use Ferror\AsyncapiDocBundle\Attribute\Property;
use Ferror\AsyncapiDocBundle\Attribute\PropertyArray;
use Ferror\AsyncapiDocBundle\Attribute\PropertyArrayObject;
use Ferror\AsyncapiDocBundle\Attribute\PropertyEnum;
use Ferror\AsyncapiDocBundle\Attribute\PropertyObject;
use Ferror\AsyncapiDocBundle\Schema\Format;
use Ferror\AsyncapiDocBundle\Schema\PropertyType;

#[Message(name: 'ProductCreated', channel: 'product.created')]
final readonly class ProductCreated
{
    public function __construct(
        #[Property(name: 'id', type: PropertyType::INTEGER)]
        public int $id,
        #[Property(name: 'amount', type: PropertyType::FLOAT)]
        public float $amount,
        #[Property(name: 'currency', type: PropertyType::STRING)]
        public string $currency,
        #[Property(name: 'isPaid', type: PropertyType::BOOLEAN)]
        public bool $isPaid,
        #[Property(name: 'createdAt', type: PropertyType::STRING, format: Format::DATETIME)]
        public DateTime $createdAt,
        #[PropertyEnum(name: 'week', enum: Week::class)]
        public Week $week,
        #[PropertyObject(name: 'payment', class: Payment::class)]
        public Payment $payment,
        #[PropertyArrayObject(name: 'products', class: Product::class)]
        public array $products,
        #[PropertyArray(name: 'tags', itemsType: 'string')]
        public array $tags,
    ) {
    }
}
```
