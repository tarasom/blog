<?php

namespace App\Http\Controllers;

use App\Entities\UserSession;
use Illuminate\Http\JsonResponse;

class UserSessionController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $userSessions = \DB::table('user_sessions')
            ->select('browser_family', \DB::raw('count(*) as total'))
            ->groupBy('browser_family')
            ->get();

        return view('user_sessions.index', [
            'sessions' => $userSessions,
        ]);
    }
}
