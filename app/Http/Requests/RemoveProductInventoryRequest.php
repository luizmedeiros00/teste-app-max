<?php

namespace App\Http\Requests;

use App\Rules\RemoveProductInventory;
use Illuminate\Foundation\Http\FormRequest;

class RemoveProductInventoryRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'product_id'    => 'required|numeric|exists:products,id',
            'amount'        => ['required','numeric', new RemoveProductInventory]
        ];
    }

    public function messages()
    {
        return [
            'product_id.required'   => 'O produto é obrigatório',
            'product_id.numeric'    => 'O produto deve ser do tipo numérico',
            'product_id.exists'     => 'O produto não existe',

            'amount.required'       => 'A quantidade é obrigatória',
            'amount.numeric'        => 'A quantidade deve ser do tipo número',
        ];
    }
}
