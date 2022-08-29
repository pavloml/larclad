<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use ReCaptcha\ReCaptcha;

class CaptchaRule implements Rule
{
    private ReCaptcha $recaptcha;
    private string $userIP;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($userIP)
    {
        $this->recaptcha = new ReCaptcha(config('services.recaptcha.secret'));
        $this->userIP = $userIP;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $response = $this->recaptcha->setExpectedHostname(config('app.hostname'))->verify($value, $this->userIP);
        return $response->isSuccess();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('Captcha is not valid');
    }
}
