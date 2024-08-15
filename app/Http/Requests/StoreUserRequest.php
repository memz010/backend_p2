<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
   {
       public function authorize()
       {
          return auth()->user()->role === 4;
       }

       public function rules()
       {
           return [
               'name' => 'required|string|max:255',
               'email' => 'required|email|unique:users,email',
               'password' => 'required|string|min:8|confirmed',
           ];
       }
   }
