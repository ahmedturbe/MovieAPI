<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class StoreActorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; //Authorize request yes no
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
             'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:actors,slug|max:255'
        ];
    }
}
