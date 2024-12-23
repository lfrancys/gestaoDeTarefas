<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StatusRequest extends FormRequest
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
     * @return array
     */
    public function rules(): array
    {
        $statusId = $this->route('status') ? $this->route('status')->id : null;

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('statuses')->ignore($statusId, 'id'),
            ],
            'description' => 'required|string',
        ];
    }
}
