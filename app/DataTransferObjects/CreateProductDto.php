<?php

namespace App\DataTransferObjects;

use App\Enums\ProductStatusEnum;
use App\Http\Requests\StoreProductFormRequest;

class CreateProductDto
{
    public function __construct(
        private readonly string $title,
        private readonly string $bodyHtml,
        private readonly string $vendor,
        private readonly string $productType,
        private readonly ?string $handle,
        private readonly ?string $tags,
        private readonly ProductStatusEnum $status,
        private readonly ?array $variants,
        private readonly ?array $options,
        private readonly ?array $images,
        private readonly ?array $image
    )
    {
    }

    public static function fromRequest(StoreProductFormRequest $request)
    {
        return new self(
            $request->input('title'),
            $request->input('body_html'),
            $request->input('vendor'),
            $request->input('product_type'),
            $request->input('handle'),
            $request->input('tags'),
            ProductStatusEnum::from($request->input('status')),
            $request->input('variants'),
            $request->input('options'),
            $request->input('images'),
            $request->input('image')
        );
    }

    public function toArrray()
    {
        return [
            'title' => $this->title,
            'body_html' => $this->bodyHtml,
            'vendor' => $this->vendor,
            'product_type' => $this->productType,
            'status' => $this->status->value,
        ];
    }
}
