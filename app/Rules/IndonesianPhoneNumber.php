<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class IndonesianPhoneNumber implements Rule
{
    public function passes($attribute, $value)
    {
        // Validasi format nomor telepon Indonesia
        return preg_match('/^628[0-9]{8,12}$/', $value);
    }

    public function message()
    {
        return 'Format nomor telepon tidak valid. Harap gunakan format 628xxxxxxxxxx.';
    }
}
