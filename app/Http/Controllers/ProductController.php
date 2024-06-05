<?php

namespace App\Http\Controllers;

use App\DataTransferObjects\CreateProductDto;
use App\DataTransferObjects\UpdateProductDto;
use App\Http\Requests\StoreProductFormRequest;
use App\Http\Requests\UpdateProductFormRequest;
use App\Services\ShopifyProductService;
use Illuminate\Http\JsonResponse;
use Psr\Http\Client\ClientExceptionInterface;
use Shopify\Exception\UninitializedContextException;

readonly class ProductController
{
    public function __construct(
        private ShopifyProductService $service
    ) {
    }

    /**
     * @throws UninitializedContextException
     * @throws ClientExceptionInterface
     * @throws \JsonException
     */
    public function index(): JsonResponse
    {
        $products = $this->service->getAll();

        return response()->json($products);
    }

    /**
     * @throws UninitializedContextException
     * @throws ClientExceptionInterface
     * @throws \JsonException
     */
    public function show(int $id): JsonResponse
    {
        $product = $this->service->getById($id);

        return response()->json($product);
    }

    /**
     * @throws UninitializedContextException
     * @throws \JsonException|ClientExceptionInterface
     */
    public function store(StoreProductFormRequest $request): JsonResponse
    {
        $createProductDto = CreateProductDto::fromRequest($request);

        $product = $this->service->create($createProductDto);

        return response()->json($product, 201);
    }

    public function update(UpdateProductFormRequest $request, int $id)
    {
        $updateProductDto = UpdateProductDto::fromRequest($request);

        $product = $this->service->update($id,$updateProductDto);

        return response()->json($product);
    }

    public function delete(int $id)
    {
        $this->service->delete($id);

        return response()->noContent();
    }
}
