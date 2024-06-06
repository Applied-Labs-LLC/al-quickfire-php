<?php

namespace App\DataTransferObjects;

use App\Http\Requests\CreateProductImageFormRequest;
use App\Http\Requests\UpdateProductImageFormRequest;
use Illuminate\Http\UploadedFile;

class UpdateProductImageDto
{
    public function __construct(
        private readonly int $id,
        private readonly ?int $position = null,
        private readonly ?UploadedFile $attachment = null,
        private readonly ?string $alt = null
    ) {
    }

    public static function fromRequest(int $id, UpdateProductImageFormRequest $request): self
    {
        return new self(
            $id,
            $request->input('position'),
            $request->file('attachment'),
            $request->input('alt')
        );
    }

    public function toArray()
    {
        $data = [
            'id' => $this->id
        ];

        if ($this->position) {
            $data['position'] = $this->position;
        }

        if ($this->attachment) {
            $data['attachment'] = base64_encode($this->attachment->getContent());
            $data['filename'] = $this->attachment->getClientOriginalName()
                . '.'
                . $this->attachment->getClientOriginalExtension();
        }

        if ($this->alt) {
            $data['alt'] = $this->alt;
        }

        return $data;
    }
}
