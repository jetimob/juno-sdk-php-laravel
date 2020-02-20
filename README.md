# juno-sdk-php-laravel

Make sure to add **`JUNO_PRIVATE_TOKEN`**, **`JUNO_CLIENT_ID`** and **`JUNO_CLIENT_SECRET`** to your `.env` file to identify your account in every request.

> **`JUNO_PRIVATE_TOKEN`** is also referred as `X-Resource-Token` in the docs.

## Installing

Using Composer:

```sh
$ composer require jetimob/juno-sdk-php-laravel
```

### Publishing configurations

The command below will publish the configuration file to Laravel's config folder.

```sh
$ php artisan juno:install
```

## Config file

- `private_token`: sets the X-Resource-Token of the authorization endpoint
- `clientId`: in conjunction of `secret` they make the authorization header - base64(`clientId`:`secret`)
- `secret`: in conjunction of `clientId` they make the authorization header - base64(`clientId`:`secret`)
- `guzzle`: sets the configurations of Guzzle
  - `base_uri`: base uri to make the requests to the resource server ([info](https://dev.juno.com.br/api/v2#section/Servidor-de-Recursos))
    - `sandbox`
    - `production`
  - `authorization_base_uri`: base uri to make the requests to the authorization server ([info](https://dev.juno.com.br/api/v2#section/Servidor-de-Autorizacao))
    - `sandbox`
    - `production`
  - `connect_timeout`: number of seconds to wait while trying to connect to a server. 0 waits indefinitely
  - `timeout`: time needed to throw a timeout exception after a request is made. 0 waits indefinitely
  - `debug`: outputs Guzzle's debug messages to stdout
- `version`: Juno's API version
- `environment`: sets the current environment to build the request's URL. ***production*** | ***sandbox***
- `logging`: enables the logging to Laravel's Log facade
- `request_max_attempts`: Juno's API is currently unstable and being so, is common that we need to perform a request more than one time
until the request succeeds. Choose a value that you think that is acceptable. If the request fails even after the
  N times set, an exception will be thrown
- `request_attempt_delay`: Time in *ms* to wait before trying to execute a new request attempt
- `recoverable_status_codes`: Array of status codes that are considered recoverable. Only the ones specified in this array will trigger a reattempt in case of a failed request.

## Usage

Import the API namespace and use it with:

```php
use Juno;

$response = Juno::request($requestObject, $resourceToken);
```

Where `$requestObject` MUST be an instance of the Request class.

> Every class inside the `Jetimob\Juno\Lib\Http` namespace implements Request.\
> $response will **always** return an instance of `Response`.

> `$resourceToken` is required to make sure that the request is being made to the right endpoint with the right credentials.

Simple requests as `DocumentListRequest` can be made passing the class the `request` function:

```php
Juno::request(DocumentListRequest::class, $resourceToken);
```

Complex objects MUST be manually configured, as:

```php
$billing = new Billing();
$billing->name = 'NAME';
$billing->document = 'document';
$billing->phone = 'phone';
$billing->email = 'email@xxxxxxx.com';
$billing->notify = true;

$charge = new Charge();
$charge->description    = 'description';
$charge->amount         = 99999.99;
$charge->dueDate        = Juno::formatDate(2020, 2, 25);

$charge->maxOverdueDays = 99;
$charge->fine           = 9.9;
$charge->interest       = 9.9;

/** @var ChargeCreationResponse $response */
$response = Juno::request(new ChargeCreationRequest($charge, $billing), $resourceToken);
```

### Response

Every request made with the API will return an instance of the `Response` object.\
All objects that implement `Request` have they own `Response` object. i.e.: `ChargeConsultRequest` has its `ChargeConsultResponse`.\
If an error occurs during the request (a non 200 code), the returned object will be an instance of `ErrorResponse`.

### Errors

When a request is made, several problems can arise, so to prevent this from happening, wrap the `request` call with a `try`/`catch` block.\
Every Juno exception is a child of `JunoException` so all exceptions that can arise during a request can be handled within a single `try` block.

```php
try {
    Juno::request(DocumentListRequest::class, $resourceToken);
} catch (JunoAccessTokenRejection $e) {
    [...]
} catch (JunoException $e) {
    [...]
} catch (Exception $e) {
    [...]
}
```

## Access Token caching

**The authorization token (access token) is cached to Laravel's default `Cache` facade, make sure to have it correctly configured.**

> If you change the environment from `production` to `sandbox` or vice-versa, you ***MUST*** clear the cache with: **`php artisan juno:clear-cache`**. Otherwise, the cached access token will be used and you'll receive a 401 error.

## Creating a custom request

If you need to make a custom request to Juno's API, you'll need to create two classes, the `Request` and the `Response`.\
Let's imagine that we need to make a request to `docs` endpoint.\
We'll need to create `DocsCustomRequest` and `DocsCustomResponse` as exemplified:


***DocsCustomRequest.php***
```php
use Jetimob\Juno\Lib\Http\Method;
use Jetimob\Juno\Lib\Http\Request;
use Jetimob\Juno\Lib\Http\BodyType;

class DocsCustomRequest extends Request
{
    /** @var string $id pathParam */
    public string $id;

    public string $param1;
    public string $param2;

    /**
     * @var string $responseClass overrides the response serialization class.
     *
     * Every successful request will have its response cast to an instance of the class defined by
     * this property.
     *
     * If the response class has the same name with 'Request' exchanged with 'Response', you can leave
     * don't need to set this property.
     */
    protected string $responseClass = DocsCustomResponse::class;

    /**
     * @var string $bodyType overrides the request body type
     * @see http://docs.guzzlephp.org/en/stable/request-options.html
     */
    protected string $bodyType = BodyType::JSON;

    /** @var string[] $bodySchema specifies which properties of the current instance should be sent with the body */
    protected array $bodySchema = [
        'param1',
        'param2',
    ]

    /**
     * Specifies the request method
    */
    protected function method(): string
    {
        return Method::GET;
    }

    /**
     * Specifies the endpoint to be merged with base_uri defined in the configuration file.
     * Anything inside brackets {} will trigger the request to update the matched identifier with this
     * instance's property with the same name. e.g.: the {id} below will be exchanged to the value of
     * $this->id;
    */
    protected function urn(): string
    {
        return 'docs/{id}';
    }
}
```

***OddResponseObject.php***

```php
use Jetimob\Juno\Lib\Traits\Serializable;

class OddResponseObject
{
    use Serializable;

    public string $property1;
    public int $property2;
}
```

***DocsCustomResponse.php***
```php
use Jetimob\Juno\Lib\Http\Response;

/**
 * All properties defined in this class MUST match the object keys defined in Juno's API response.
 *
 * Complex objects can be typed so that the SDK can cast an instance and define this instance property
 * ($param in the class example below)
 *
 * If there is data inside an '_embedded' key, you MUST override the initComplexObjects function and
 * use the helper functions of Response class.
 *
 * @see https://dev.juno.com.br/api/v2
*/
class DocsCustomResponse extends Response
{
    protected string $id;

    protected int $value;

    protected OddResponseObject $param;

    /** @var OddResponseObject $embeddedData */
    protected array $embeddedData;

    /**
     * This function is mainly used to deserialize embedded data.
     *
     * The first parameter given to deserializeEmbeddedArray specifies in which key, inside the
     * _embedded object, is the data that we are trying to deserialize.
    */
    public function initComplexObjects(): void
    {
        $this->embeddedData = $this->deserializeEmbeddedArray(
            'propertyInsideEmbedded', // key name inside _embedded
            OddResponseObject::class, // deserialize each element to the given class
            [],                       // default value if the key is non existent
        );
    }

    [... getters]
}
```

##### usage:

```php
$requestData = new DocsCustomRequest();
$requestData->id     = 'XXXXXXXXXXXXXXXXXXXXXXXXX';
$requestData->param1 = 'XXXXXXXXXXXXXXXXXXXXXXXXX';
$requestData->param2 = 'XXXXXXXXXXXXXXXXXXXXXXXXX';

// error handling ignored for example readability
/** @var DocsCustomResponse $response */
$response = Juno::request($requestData, $resourceToken);

// all properties are initialized and can be easily accessed:
$response->getParam()->property1;
```

---

For more information about Juno's API, see the docs [here](https://dev.juno.com.br/api/v2) and [here (detailed PDF)](https://dev.juno.com.br/junoAPI20Integration.pdf).
