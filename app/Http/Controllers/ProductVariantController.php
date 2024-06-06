<?php

namespace App\Http\Controllers;

use App\DataTransferObjects\CreateProductVariantDto;
use App\DataTransferObjects\UpdateProductVariantDto;
use App\Http\Requests\CreateProductVariantFormRequest;
use App\Http\Requests\UpdateProductVariantFormRequest;
use App\Services\ShopifyProductVariantService;
use Psr\Http\Client\ClientExceptionInterface;
use Shopify\Exception\UninitializedContextException;

class ProductVariantController extends Controller
{
    public function __construct(
        private readonly ShopifyProductVariantService $productVariantService
    ) {
    }

    /**
     * @throws UninitializedContextException
     * @throws ClientExceptionInterface
     * @throws \JsonException
     */
    public function index(int $productId)
    {
        $variants = $this->productVariantService->getAll($productId);

        return response()->json($variants);
    }

    /**
     * @throws UninitializedContextException
     * @throws ClientExceptionInterface
     * @throws \JsonException
     */
    public function show(int $productId, int $variantId)
    {
        $variant = $this->productVariantService->getById($productId, $variantId);

        return response()->json($variant);
    }

    /**
     * @throws UninitializedContextException
     * @throws ClientExceptionInterface
     * @throws \JsonException
     */
    public function store(CreateProductVariantFormRequest $request, int $productId)
    {
        $createProductVariantDto = CreateProductVariantDto::fromRequest($request);

        $variant = $this->productVariantService->create($productId, $createProductVariantDto);

        return response()->json($variant, 201);
    }

    /**
     * @throws UninitializedContextException
     * @throws ClientExceptionInterface
     * @throws \JsonException
     */
    public function update(UpdateProductVariantFormRequest $request, int $productId, int $variantId)
    {
        $updateProductVariantDto = UpdateProductVariantDto::fromRequest($request);

        $variant = $this->productVariantService->update($productId, $variantId, $updateProductVariantDto);

        return response()->json($variant);
    }

    /**
     * @throws UninitializedContextException
     * @throws ClientExceptionInterface
     */
    public function delete(int $productId, int $variantId)
    {
        $this->productVariantService->delete($productId, $variantId);

        return response()->noContent();
    }
}
