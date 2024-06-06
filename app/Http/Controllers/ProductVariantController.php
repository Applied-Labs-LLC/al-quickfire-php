<?php

namespace App\Http\Controllers;

use App\DataTransferObjects\CreateProductImageDto;
use App\DataTransferObjects\UpdateProductImageDto;
use App\Http\Requests\CreateProductImageFormRequest;
use App\Http\Requests\UpdateProductImageFormRequest;
use App\Services\ShopifyProductService;
use Psr\Http\Client\ClientExceptionInterface;
use Shopify\Exception\UninitializedContextException;

class ProductVariantController extends Controller
{
    public function __construct(
        private readonly ShopifyProductService $productService
    ) {
    }

    /**
     * @throws \JsonException
     */
    public function index(int $productId)
    {
        $images = $this->productService->getVariants($productId);

        return response()->json($images);
    }

    /**
     * @throws UninitializedContextException
     * @throws ClientExceptionInterface
     * @throws \JsonException
     */
    public function show(int $productId, int $imageId)
    {
        $image = $this->productService->getVariantById($productId, $imageId);

        return response()->json($image);
    }

    /**
     * @throws UninitializedContextException
     * @throws ClientExceptionInterface
     * @throws \JsonException
     */
    public function store(CreateProductImageFormRequest $request, int $productId)
    {
        $createProductImageDto = CreateProductImageDto::fromRequest($request);

        $image = $this->productService->createProductImage($productId, $createProductImageDto);

        return response()->json($image);
    }

    /**
     * @throws \JsonException
     */
    public function update(UpdateProductImageFormRequest $request, int $productId, int $imageId)
    {
        $updateProductImageDto = UpdateProductImageDto::fromRequest($imageId, $request);

        $image = $this->productService->updateProductImage($productId, $imageId, $updateProductImageDto);

        return response()->json($image);
    }

    /**
     * @throws UninitializedContextException
     * @throws ClientExceptionInterface
     */
    public function delete(int $productId, int $imageId)
    {
        $this->productService->deleteImage($productId, $imageId);
    }
}
