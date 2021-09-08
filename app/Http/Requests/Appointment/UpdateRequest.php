<?php

namespace App\Http\Requests\Appointment;

use App\Rules\CheckPostcodeRule;
use App\Services\Postcode\Postcode;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'contact_id' => ['required', 'exists:contacts,id'],
            'address' => ['required'],
            'appointment_date' => ['required', 'dateFormat:d/m/Y H:i'],
            'postcode' => ['required', new CheckPostcodeRule(new Postcode())]
        ];
    }
}
