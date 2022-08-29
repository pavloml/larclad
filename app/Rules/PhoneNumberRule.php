<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PhoneNumberRule implements Rule
{
    /**
     * Checks if the provided string is a phone number in the correct format
     * Currently, this software isn't ready for international use, so e164NA must be used
     * @param  string  $attribute
     * @param  string  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return $this->e164NA($value);
    }

    /**
     * Returns the validation error message
     *
     * @return string
     */
    public function message(): string
    {
        return 'The :attribute must be in the correct format';
    }


    /**
     * Checks if the provided string is a phone number in E.164 format
     * @param string $number Phone number to validate
     * @return bool
     */
    private function e164(string $number): bool
    {
        return (bool) preg_match('/^\+[1-9]\d{1,14}$/', $number);
    }

    /**
     * Checks if the provided string is a phone number in E.164 format, the country code is +1, and the subscriber number is 10 digits long
     * @param string $number Phone number to validate
     * @return bool
     */
    private function e164NA(string $number): bool
    {
        return (bool) preg_match('/^\+1\d{10}$/', $number);
    }
}
