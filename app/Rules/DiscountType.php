<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class DiscountType implements Rule
{
    protected $discountTypes = ['percentage', 'fix-amount'];

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
        return in_array($value, $this->discountTypes);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The selected discount type is invalid.';
    }
}
