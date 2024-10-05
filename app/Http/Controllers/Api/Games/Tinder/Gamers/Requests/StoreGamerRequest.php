<?php
/**
 * Description of StoreGamerRequests.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Yehor Herasymchuk <yehor@dotsplatform.com>
 */

namespace App\Http\Controllers\Api\Games\Tinder\Gamers\Requests;


use Illuminate\Foundation\Http\FormRequest;

class StoreGamerRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:255|',
            'username' => 'required|string|min:3|max:255|unique:gamers,username',
            'email' => 'nullable|email|unique:gamers,email',
        ];
    }

}
