<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if ($this->user()->can("update", $this->task)) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "title" => ["required", "string", "min:3", "max:255"],
            "description" => ["nullable", "string", "max:1000"],
            "date_limit" => ["required", "date","after_or_equal:today"],
        ];
    }

    public function messages(): array
    {
        return [
            "required" => "O campo :attribute é obrigatório.",
            "string" => "O campo :attribute deve ser um texto válido.",
            "min" => "O campo :attribute deve ter no mínimo :min caracteres.",
            "max" => "O campo :attribute deve ter no máximo :max caracteres.",
            "date" => "O campo :attribute deve ser uma data válida.",
            "after_or_equal" => "O campo :attribute deve conter uma data superior ou igual a hoje.",
        ];
    }
}
