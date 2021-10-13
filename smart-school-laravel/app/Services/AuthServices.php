<?php

namespace App\Services;

use App\Models\School;
use App\Models\User;
use App\Notifications\SignUpNotification;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AuthServices
{
    public static function signUp($input)
    {
        DB::beginTransaction();
        try {
            $school = School::create($input);

            $email = explode('@', $input['email']);
            $input['username'] = $email[0] . '-' . Str::lower(Str::random(4));
            $input['role'] = 'school-admin';
            $input['password_string'] = $input['password'];
            $input['password'] = bcrypt($input['password']);
            $user = $school->user()->create($input);

            $user->notify(new SignUpNotification($user, $input['password_string']));

            $result['status'] = true;
            $result['data'] = null;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("ERROR " . (__METHOD__) . ": " . $e->getMessage());

            $result['status'] = false;
            $result['data'] = $e->getMessage();
        }
        DB::commit();

        return $result;
    }

    public static function login($input)
    {
        try {
            if (Auth::attempt(['username' => $input['username'], 'password' => $input['password']])) {
                $user = User::select('id', 'name', 'email', 'username', 'role', 'school_id')
                    ->find(auth()->id());
                $token = $user->createToken($user->username . '-smart-school', ['role:' . $user->role])->plainTextToken;

                $result['status'] = true;
                $result['data']['user'] = $user;
                $result['data']['token'] = $token;
            } else {
                throw new Exception('Unauthorized');
            }
        } catch (Exception $e) {
            Log::error("ERROR " . (__METHOD__) . ": " . $e->getMessage());

            $result['status'] = false;
            $result['data'] = $e->getMessage();
        }

        return $result;
    }

    public static function logout()
    {
        try {
            $user = User::find(auth()->id());
            $user->tokens()->delete();
            Session::flush();

            $result['status'] = true;
            $result['data'] = null;
        } catch (Exception $e) {
            Log::error("ERROR " . (__METHOD__) . ": " . $e->getMessage());

            $result['status'] = false;
            $result['data'] = $e->getMessage();
        }

        return $result;
    }
}
