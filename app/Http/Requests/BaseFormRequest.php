<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BaseFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
}
