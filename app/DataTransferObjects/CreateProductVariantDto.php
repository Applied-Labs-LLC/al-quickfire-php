<?php

namespace App\DataTransferObjects;

use App\Http\Requests\CreateProductVariantFormRequest;

class CreateProductVariantDto
{
    public function __construct(
        private readonly string $title,
        private readonly string $option1,
        private readonly string $price,
        private readonly ?string $option2,
        private readonly ?string $option3,
        private readonly ?string $sku = null,
        private readonly ?int $position = null,
    ) {
    }

    public static function fromRequest(CreateProductVariantFormRequest $request)
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
        $data = [
            'title' => $this->title,
            'option1' => $this->option1,
            'price' => $this->price,
        ];

        if ($this->option2) {
            $data['option2'] = $this->option2;
        }

        return $data;
    }
}
