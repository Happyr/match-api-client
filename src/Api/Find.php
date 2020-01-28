<?php

declare(strict_types=1);

namespace HappyrMatch\ApiClient\Api;

use HappyrMatch\ApiClient\Model\Accepted;
use HappyrMatch\ApiClient\Model\Find\FindTypeCollection;
use Webmozart\Assert\Assert;

/**
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
class Find extends HttpApi
{
    public function create(string $role, string $type, string $callbackUrl, ?string $nonce = null)
    {
        Assert::notEmpty($role, 'Role cannot be empty');
        Assert::notEmpty($type, 'Type cannot be empty');
        Assert::notEmpty($callbackUrl, 'CallbackUrl cannot be empty');

        $response = $this->httpPost('/api/find', [
            'role' => $role,
            'type' => $type,
            'callback_url' => $callbackUrl,
            'nonce' => $nonce,
        ]);

        if (!$this->hydrator) {
            return $response;
        }

        // Use any valid status code here
        if (202 !== $response->getStatusCode()) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, Accepted::class);
    }

    public function getTypes()
    {
        $response = $this->httpGet('/api/find-types');
        if (!$this->hydrator) {
            return $response;
        }

        // Use any valid status code here
        if (200 !== $response->getStatusCode()) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, FindTypeCollection::class);
    }
}
