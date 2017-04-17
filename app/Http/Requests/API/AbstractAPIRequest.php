<?php
namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class AbstractAPIRequest extends FormRequest
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

    public function response(array $errors)
    {
        return response()->json($errors, 422);
    }
}
