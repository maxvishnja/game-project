<?php

namespace App\Http\Controllers;

use App\Result;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserPageController extends Controller
{


    /** Show page with users link
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($link)
    {
        $user = User::where('link', $link)->first();

        return view('user.index', compact('user'));
    }


    /**
     * Generate new link
     * @return \Illuminate\Http\RedirectResponse
     */
    public function generateLink()
    {
        $user = Auth::user();

        $newlink = str_random(20);

        $user->link = $newlink;
        $user->link_expired = Carbon::now()->addDays(7);

        $user->save();

        return redirect()->route('user.home', $user->link);

    }

    /**
     * Remove link with user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function removeLink()
    {
        $user = Auth::user();

        Auth::logout();

        $user->delete();

        return redirect('/');

    }

    /**
     * Calculated result for user
     * @param Request $request
     * @return array|bool
     */

    public function calculatedResult(Request $request)
    {
        if ($request->ajax()) {

            $item = rand(1, 1000);
            $res_array = [];

            if ($item % 2 !== 0) {
                $res_array['message'] = 'Lose';
                $res_array['result'] = 0;
            } else {
                if ($item > 900) {
                    $value = $item * 0.7;
                } elseif ($item > 600) {
                    $value = $item * 0.5;
                } elseif ($item >= 300) {
                    $value = $item * 0.3;
                } else {
                    $value = $item * 0.1;
                }
                $res_array['message'] = 'Win';
                $res_array['result'] = round($value, 2);
            }

            $result = new Result();

            $result->value = $res_array['result'];
            $result->user_id = Auth::user()->id;
            $result->save();

            return $res_array;
        } else {
            return false;
        }

    }

    /**
     * Get history of 3 last result
     * @param Request $request
     * @return bool
     */
    public function getHistory(Request $request)
    {

        if ($request->ajax()) {
            $user = Auth::user();

            $histories = $user->results()->latest()->limit(3)->pluck('value');

            return $histories;
        }
        return false;
    }

}
