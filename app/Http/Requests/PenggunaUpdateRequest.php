<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PenggunaUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        if ($this->password == null) {
            $this->request->remove('password');
        }
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $cek_id = $this->route('id');
        $rules = [
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $cek_id,
            'password' => 'sometimes|nullable|min:8',
            'kab_kota' => 'required',
            'no_hp' => 'required|numeric',
        ];

        return $rules;
    }
}
