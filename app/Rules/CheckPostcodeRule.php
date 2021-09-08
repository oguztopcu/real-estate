<?php

namespace App\Rules;

use App\Services\Postcode\Postcode;
use Illuminate\Contracts\Validation\Rule;

class CheckPostcodeRule implements Rule
{
    /**
     * @var Postcode $postcode
     */
    private $postcode;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(Postcode $postcode)
    {
        $this->postcode = $postcode;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return (bool) $this->postcode->lookup($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return trans('validation.postcode');
    }
}
