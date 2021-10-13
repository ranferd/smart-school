<?php

namespace App\Services;

use App\Models\School;
use App\Notifications\SignUpNotification;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AuthServices
{
    public static function signUp($input)
    {
        DB::beginTransaction();
        try {
            $school = School::create($input);
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
}
