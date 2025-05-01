<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'phone' => ['nullable', 'string', 'max:15'],
            'address' => ['nullable', 'string'],
            'bio' => ['nullable', 'string'],
            'pet_info' => ['nullable', 'array'],
            'pet_info.pet_name' => ['nullable', 'string', 'max:255'],
            'pet_info.age' => ['nullable', 'string', 'max:50'],
            'pet_info.breed' => ['nullable', 'string', 'max:255'],
            'pet_info.weight' => ['nullable', 'string', 'max:50'],
            'pet_info.medicalHistory' => ['nullable', 'string'],
            'pet_info.specialRequirements' => ['nullable', 'string'],
            'pet_info.vaccinations' => ['nullable', 'array'],
            'pet_info.vaccinations.rabies' => ['nullable', 'boolean'],
            'pet_info.vaccinations.dhpp' => ['nullable', 'boolean'],
        ];
    }
}
