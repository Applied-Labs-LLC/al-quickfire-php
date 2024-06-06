<?php

namespace App\Services;

use App\DataTransferObjects\CreateProductVariantDto;
use App\DataTransferObjects\UpdateProductVariantDto;
use Psr\Http\Client\ClientExceptionInterface;
use Shopify\Clients\Rest;
use Shopify\Exception\UninitializedContextException;

readonly class ShopifyProductVariantService
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
        $response = $this->rest->get('products/' . $productId . '/variants');

        return json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * @throws UninitializedContextException
     * @throws ClientExceptionInterface
     * @throws \JsonException
     */
    public function create(int $productId, CreateProductVariantDto $dto)
    {
        $response = $this->rest->post('products/' . $productId . '/variants', [
            'variant' => $dto->toArray()
        ]);

        return json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * @throws UninitializedContextException
     * @throws ClientExceptionInterface
     * @throws \JsonException
     */
    public function update(int $productId, int $variantId, UpdateProductVariantDto $dto)
    {
        $response = $this->rest->put('products/' . $productId . '/variants/' . $variantId, [
            'variant' => $dto->toArray()
        ]);

        return json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * @throws UninitializedContextException
     * @throws ClientExceptionInterface
     */
    public function delete(int $productId, int $variantId)
    {
        $this->rest->delete('products/' . $productId . '/variants/' . $variantId);
    }

    /**
     * @throws UninitializedContextException
     * @throws ClientExceptionInterface
     * @throws \JsonException
     */
    public function getById(int $productId, int $variantId)
    {
        $response = $this->rest->get('products/' . $productId . '/variants/' . $variantId);

        return json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
    }
}
