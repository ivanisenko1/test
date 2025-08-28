<?php

namespace App\Http\Requests\Race;

use App\Rules\LapRangeRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class GetResultRaceRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'driverNumbers' => ['nullable', 'array'],
            'driverNumbers.*' => ['nullable', 'integer'],
            'lapRange' => ['nullable', 'string', new LapRangeRule],
            'duration' => ['nullable', 'string', 'in:1,2,3'],
        ];
    }
}
