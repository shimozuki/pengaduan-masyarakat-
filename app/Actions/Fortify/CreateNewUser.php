<?php

namespace App\Actions\Fortify;

use App\Models\Masyarakat;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],

            'nik' => ['required', 'string', 'size:16', 'unique:masyarakat,nik'],

            'jenis_kelamin' => ['required'],

            'alamat' => ['required'],

            'no_hp' => ['required'],

            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],

            'password' => $this->passwordRules(),
        ])->validate();

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'role' => 'user',
            'password' => bcrypt($input['password']),
        ]);

        Masyarakat::create([
            'user_id' => $user->id,
            'nik' => $input['nik'],
            'jenis_kelamin' => $input['jenis_kelamin'],
            'alamat' => $input['alamat'],
            'no_hp' => $input['no_hp'],
        ]);

        return $user;
    }
}
