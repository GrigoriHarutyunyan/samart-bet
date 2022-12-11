<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LottoDrawnRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
                'machine-balls' => 'required|in:40,49',
                'lotto-config' => 'required|in:5,7',
                'user-balls' => 'required',
                'user-balls.*' => 'required|integer',
        ];
    }
}
