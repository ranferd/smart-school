<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\V1\BaseController;
use App\Http\Requests\InviteRequest;
use App\Services\UserServices;

class UserController extends BaseController
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct(UserServices $user)
    {
        $this->user = $user;
    }

    /**
     * Show all teachers and students in school.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = $this->user->list();

        if ($response['status'] == true) {
            return $this->sendResponse($response['data'], 'Get Users Success');
        } else {
            return $this->sendError('Get Users Failed', $response['data'], 400);
        }
    }

    /**
     * Invite teacher or student.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function invite(InviteRequest $request)
    {
        $response = $this->user->invite($request->all());

        if ($response['status'] == true) {
            return $this->sendResponse($response['data'], 'Invite User Success');
        } else {
            return $this->sendError('Invite User Failed', $response['data'], 400);
        }
    }

    /**
     * Remove teachers or students in school.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $response = $this->user->delete($id);

        if ($response['status'] == true) {
            return $this->sendResponse($response['data'], 'Delete Users Success');
        } else {
            return $this->sendError('Delete Users Failed', $response['data'], 400);
        }
    }

    /**
     * Show all teachers in school.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function teachers()
    {
        $response = $this->user->list(['teacher']);

        if ($response['status'] == true) {
            return $this->sendResponse($response['data'], 'Get Teachers Success');
        } else {
            return $this->sendError('Get Teachers Failed', $response['data'], 400);
        }
    }

    /**
     * Show all students in school.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function students()
    {
        $response = $this->user->list(['student']);

        if ($response['status'] == true) {
            return $this->sendResponse($response['data'], 'Get Students Success');
        } else {
            return $this->sendError('Get Students Failed', $response['data'], 400);
        }
    }
}
