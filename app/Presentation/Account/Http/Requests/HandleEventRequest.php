<?php

namespace App\Presentation\Account\Http\Requests;

use App\Domain\Accounts\Enums\EventTypes;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class HandleEventRequest extends FormRequest
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
            'type' => [
                'required',
                'string',
                Rule::enum(EventTypes::class)
            ],
            'origin' => [
                Rule::requiredIf(fn () => in_array($this->input('type'), [
                    EventTypes::WITHDRAW->value,
                    EventTypes::TRANSFER->value,
                ])),
                'integer'
            ],
            'destination' => [
                Rule::requiredIf(fn () => in_array($this->input('type'), [
                    EventTypes::DEPOSIT->value,
                    EventTypes::TRANSFER->value
                ])),
                'integer'
            ],
            'amount' => [
                'required',
                'integer',
                'numeric'
            ],
        ];
    }
}

