<?php

namespace App\DataTransferObjects;

use App\Http\Requests\CreateProductVariantFormRequest;
use App\Http\Requests\UpdateProductVariantFormRequest;

class UpdateProductVariantDto
{
    public function __construct(
        private readonly ?string $title,
        private readonly ?string $option1,
        private readonly ?string $price,
        private readonly ?string $option2,
        private readonly ?string $option3,
        private readonly ?string $sku = null,
        private readonly ?int $position = null,
    ) {
    }

    public static function fromRequest(UpdateProductVariantFormRequest $request)
    {
        return new self(
            $request->input('title'),
            $request->input('option1'),
            $request->input('price'),
            $request->input('option2'),
            $request->input('option3'),
            $request->input('sku'),
            $request->input('position'),
        );
    }

    public function toArray()
    {
        $data = [];

        if ($this->title) {
            $data['title'] = $this->title;
        }

        if ($this->option1) {
            $data['option1'] = $this->option1;
        }

        if ($this->price) {
            $data['price'] = $this->price;
        }

        if ($this->option2) {
            $data['option2'] = $this->option2;
        }

        if ($this->option3) {
            $data['option3'] = $this->option3;
        }

        if ($this->sku) {
            $data['sku'] = $this->sku;
        }

        if ($this->position) {
            $data['position'] = $this->position;
        }

        return $data;
    }
}
