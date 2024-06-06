<?php

namespace App\Services;

use App\DataTransferObjects\CreateProductImageDto;
use App\DataTransferObjects\UpdateProductImageDto;
use Psr\Http\Client\ClientExceptionInterface;
use Shopify\Clients\Rest;
use Shopify\Exception\UninitializedContextException;

readonly class ShopifyProductImageService
{
    public function __construct(
        private Rest $rest
    ) {
    }

    /**
     * @throws UninitializedContextException
     * @throws ClientExceptionInterface
     * @throws \JsonException
     */
    public function getAll(int $productId)
    {
        $response = $this->rest->get('products/' . $productId . '/images');

        return json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * @throws UninitializedContextException
     * @throws ClientExceptionInterface
     * @throws \JsonException
     */
    public function create(int $productId, CreateProductImageDto $dto)
    {
        $response = $this->rest->post('products/' . $productId . '/images', [
            'image' => $dto->toArray()
        ]);

        return json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * @throws UninitializedContextException
     * @throws ClientExceptionInterface
     * @throws \JsonException
     */
    public function update(int $productId, int $imageId, UpdateProductImageDto $dto)
    {
        $response = $this->rest->put('products/' . $productId . '/images/' . $imageId, [
            'image' => $dto->toArray()
        ]);

        return json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * @throws UninitializedContextException
     * @throws ClientExceptionInterface
     */
    public function delete(int $productId, int $imageId)
    {
        $this->rest->delete('products/' . $productId . '/images/' . $imageId);
    }

    /**
     * @throws UninitializedContextException
     * @throws ClientExceptionInterface
     * @throws \JsonException
     */
    public function getById(int $productId, int $imageId)
    {
        $response = $this->rest->get('products/' . $productId . '/images/' . $imageId);

        return json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
    }
}
