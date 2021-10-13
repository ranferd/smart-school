<?php

namespace App\Services;

use App\Models\School;
use App\Models\User;
use App\Notifications\InvitationNotification;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class UserServices
{
    public static function list($roles = ['school-admin', 'teacher', 'student'])
    {
        try {
            $users = User::select('id', 'name', 'email', 'username', 'role')
                ->inSchool()
                ->excludeSelf()
                ->whereIn('role', $roles)->get();

            $result['status'] = true;
            $result['data'] = compact('users');
        } catch (Exception $e) {
            Log::error("ERROR " . (__METHOD__) . ": " . $e->getMessage());

            $result['status'] = false;
            $result['data'] = $e->getMessage();
        }

        return $result;
    }

    public static function invite($input)
    {
        DB::beginTransaction();
        try {
            $password = Str::random(10);
            $input['school_id'] = auth()->user()->school_id;
            $input['password_string'] = $password;
            $input['password'] = bcrypt($password);

            $user = User::create($input);
            $school = School::find($input['school_id']);

            $user->notify(new InvitationNotification($user, $school, $input['password_string']));

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

    public static function delete($user_id)
    {
        DB::beginTransaction();
        try {
            $user = User::inSchool()->where('id', $user_id)->delete();
            if (!$user) {
                throw new Exception('User not found');
            }

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
