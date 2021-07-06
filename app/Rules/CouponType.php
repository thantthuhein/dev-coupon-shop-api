<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CouponType implements Rule
{
    protected $couponTypes = ['public', 'private'];

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        return in_array($value, $this->couponTypes);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The selected coupon type is invalid.';
    }
}
