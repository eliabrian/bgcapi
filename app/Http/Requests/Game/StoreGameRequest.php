<?php

namespace App\Http\Requests\Game;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class StoreGameRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'slug' => 'required|string',
            'tag_id' => 'required|uuid|exists:tags,id',
            'difficulty_id' => 'required|uuid|exists:difficulties,id',
            'player_min' => 'required|integer',
            'player_max' => 'required|integer',
            'age' => 'required|integer',
            'duration' => 'required|integer',
            'summary' => 'required|string',
            'description' => 'required|string',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => Str::slug($this->name),
        ]);
    }
}
