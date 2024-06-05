<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Shopify\Rest\Admin2024_04\Product;

class StoreProductFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'body_html' => 'required|string',
            'vendor' => 'required|string',
            'product_type' => 'required|string',
            'status' => 'required|in:draft,active,archived'
        ];
    }
}
