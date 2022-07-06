<?php

namespace Laravel\Asaas\Support;

use Laravel\Asaas\Support\Exceptions\BadRequestException;
use Laravel\Asaas\Support\Exceptions\NotFoundException;
use Laravel\Asaas\Support\Exceptions\RequestForbiddenException;
use Laravel\Asaas\Support\Exceptions\ServerErrorException;
use Laravel\Asaas\Support\Exceptions\TooManyRequestsException;
use Laravel\Asaas\Support\Exceptions\UnauthorizedException;
use Exception;
use Http;
use Illuminate\Http\Client\PendingRequest;

use function PHPUnit\Framework\isEmpty;

abstract class BaseGateway {
    protected string $url;
    protected string $accessToken;
    protected PendingRequest $httpClient;
    const POST = 'post';
    const GET = 'get';
    const DELETE = 'delete';

    public function __construct()
    {
        $isSandbox = config("asaas.is_sandbox", true);
        $this->url = $isSandbox ? config("asaas.sandbox_url") : config("asaas.production_url");
        $this->accessToken = config("asaas.access_token", "");

        if (empty($this->accessToken)) {
            throw new Exception("You must to set the ACCESS_TOKEN variable, please see the config file 'asaas.php'");
        }

        $this->httpClient = Http::withHeaders([
            'access_token' => $this->accessToken
        ]);
    }

    abstract protected function path(): string;

    protected function endpoint(): string
    {
        return "{$this->url}/api/v3{$this->path()}";
    }

    protected function makeRequest(array $body, string $httpVerb, string $param = ""): \Illuminate\Http\Client\Response
    {

        $endpoint = !empty($param) ? "{$this->endpoint()}/{$param}" : $this->endpoint();

        /**
         * @var \Illuminate\Http\Client\Response $response
         */
        $response = $httpVerb !== self::GET
            ? $this->httpClient->{$httpVerb}($endpoint, $body)
            : $this->httpClient->{$httpVerb}($endpoint);

        if ($response->successful()) {
            return $response;
        }

        if ($response->serverError()) {
            throw new ServerErrorException();
        }

        if ($response->status() === 400) {
            throw new BadRequestException($response->json());
        }

        if ($response->status() === 401) {
            throw new UnauthorizedException();
        }

        if ($response->status() === 404) {
            throw new NotFoundException();
        }

        if ($response->status() === 403) {
            throw new RequestForbiddenException();
        }

        if ($response->status() === 429) {
            throw new TooManyRequestsException($response->json());
        }
    }
}
