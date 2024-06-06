<?php

namespace App\Http\Controllers;

use App\DataTransferObjects\CreateProductImageDto;
use App\DataTransferObjects\UpdateProductImageDto;
use App\Http\Requests\CreateProductImageFormRequest;
use App\Http\Requests\UpdateProductImageFormRequest;
use App\Services\ShopifyProductImageService;
use Illuminate\Http\JsonResponse;
use Psr\Http\Client\ClientExceptionInterface;
use Shopify\Exception\UninitializedContextException;

class ProductImageController extends Controller
{
    public function __construct(
        private readonly ShopifyProductImageService $productImageService
    ) {
    }

    /**
     * @throws \JsonException
     */
    public function index(int $productId)
    {
        $images = $this->productImageService->getAll($productId);

        return response()->json($images);
    }

    /**
     * @throws UninitializedContextException
     * @throws ClientExceptionInterface
     * @throws \JsonException
     */
    public function show(int $productId, int $imageId)
    {
        $image = $this->productImageService->getById($productId, $imageId);

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

        $image = $this->productImageService->create($productId, $createProductImageDto);

        return response()->json($image, 201);
    }

    /**
     * @param UpdateProductImageFormRequest $request
     * @param int $productId
     * @param int $imageId
     * @return JsonResponse
     * @throws ClientExceptionInterface
     * @throws UninitializedContextException
     * @throws \JsonException
     */
    public function update(UpdateProductImageFormRequest $request, int $productId, int $imageId)
    {
        $updateProductImageDto = UpdateProductImageDto::fromRequest($request);

        $image = $this->productImageService->update($productId, $imageId, $updateProductImageDto);

        return response()->json($image);
    }

    /**
     * @throws UninitializedContextException
     * @throws ClientExceptionInterface
     */
    public function delete(int $productId, int $imageId)
    {
        $this->productImageService->delete($productId, $imageId);

        return response()->noContent();
    }
}
