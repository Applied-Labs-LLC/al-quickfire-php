<?php

namespace App\Services;

use App\DataTransferObjects\CreateProductDto;
use App\DataTransferObjects\UpdateProductDto;
use Psr\Http\Client\ClientExceptionInterface;
use Shopify\Clients\Rest;
use Shopify\Exception\UninitializedContextException;

class ShopifyProductService
{
    public function __construct(
        private readonly Rest $rest
    ) {
    }

    /**
     * @throws UninitializedContextException
     * @throws ClientExceptionInterface
     * @throws \JsonException
     */
    public function getAll()
    {
        $response = $this->rest->get(
            path: 'products'
        );

        return json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * @throws UninitializedContextException
     * @throws ClientExceptionInterface
     * @throws \JsonException
     */
    public function getById(int $id): array
    {
        $response = $this->rest->get(
            path: 'products/' . $id
        );

        return json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * @throws UninitializedContextException
     * @throws ClientExceptionInterface
     * @throws \JsonException
     */
    public function create(CreateProductDto $dto): array
    {
        $response = $this->rest->post(
            path: 'products',
            body: [
                'product' => $dto->toArrray()
            ]
        );

        return json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * @throws UninitializedContextException
     * @throws ClientExceptionInterface
     * @throws \JsonException
     */
    public function update(int $id, UpdateProductDto $dto): array
    {
        $response = $this->rest->put(
            path: 'products/' . $id,
            body: [
                'product' => $dto->toArrray()
            ]
        );

        return json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * @throws UninitializedContextException
     * @throws ClientExceptionInterface
     */
    public function delete(int $id): void
    {
        $this->rest->delete('products/' . $id);
    }
}
