<?php

namespace App\DataTransferObjects;

class CreateProductVariantDto
{
    public function __construct(
        private readonly string $option1,
        private readonly string $option2,
        private readonly string $option3,
        private readonly ?string $price,
        private readonly ?string $sku = null,
        private readonly ?int $position = null,

    )
    {
    }
}
