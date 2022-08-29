<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PasswordRule implements Rule
{
    /**
     * Checks if given string contains at least one lowercase character, one uppercase character, and one digit
     *
     * @param  string  $attribute
     * @param  string  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).+$/', $value);
    }

    /**
     * Returns the validation error message
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be contain at least one lowercase character, one uppercase character, and one digit';
    }
}
