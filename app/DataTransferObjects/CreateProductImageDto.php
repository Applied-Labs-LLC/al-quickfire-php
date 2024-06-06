<?php

namespace App\DataTransferObjects;

use App\Http\Requests\CreateProductImageFormRequest;
use Illuminate\Http\UploadedFile;

class CreateProductImageDto
{
    public function __construct(
        private readonly int $position,
        private readonly UploadedFile $attachment,
        private readonly ?string $alt = null
    ) {
    }

    public static function fromRequest(CreateProductImageFormRequest $request): self
    {
        return new self(
            $request->input('position'),
            $request->file('attachment'),
            $request->input('alt')
        );
    }

    public function toArray()
    {
        return [
            'position' => $this->position,
            'attachment' => base64_encode($this->attachment->getContent()),
            'filename' => $this->attachment->getClientOriginalName()
                . '.'
                . $this->attachment->getClientOriginalExtension(),
            'metafields' => [
                [
                    "key" => "new",
                    "value" => "newvalue",
                    "type" => "single_line_text_field",
                    "namespace" => "global"
                ]
            ],
            'alt' => $this->alt
        ];
    }
}
