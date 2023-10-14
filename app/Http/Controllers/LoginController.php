<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Useractivity;
use Illuminate\Http\Request;
use App\Models\Subscriptions;
use App\Models\DeactivateAccount;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;

class LoginController extends Controller
{
    /**
     * Do login process
     * @param Request $request
     * @return $this
     */
    public function postLogin(Request $request)
    {
        //dd($request->all());

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $remember = $request->has('remember') ? true : false;
        $email = $request->input('email');
        $password = $request->input('password');
        $lang = $request->input('lang');
        $social_fb = 'false';

        return $this->LoginAUser($email, $password, $remember, $lang, $social_fb);
    }

    function LoginAUser($email, $password, $remember, $lang, $social_fb)
    {

        //Login with social - facebook
        if ($social_fb == 'true') {
            $user = User::where('email', '=', $email)->first();
            Auth::login($user);
        }
        //Login with username and password
        else {

            if (!Auth::attempt(['email' => $email, 'password' => $password])) {
                //Username and password do not match
                return redirect()->route('login')->with('danger', 'Wrong username / password ');
            }
        }

        if (Auth::user()->issuspended) {
            $reason = 'default reason';

            if (Auth::user()->issuspendedfor == 'chargeback') {
                $reason = 'some reason for chargeback';
            } else if (Auth::user()->issuspendedfor == 'scammer') {
                $reason = 'some reason for scammer';
            } else if (Auth::user()->issuspendedfor == 'contact-sharing') {

                $date = 'further notice';

                if (!empty(Auth::user()->suspended)) {
                    if (!empty(Auth::user()->suspended->suspended_end)) {

                        //If suspended_end is more than now/current time, remove suspended and activate user
                        if (Carbon::now() >= Auth::user()->suspended->suspended_end) {

                            $user = User::find(Auth::user()->id);
                            $user->flag = 1;
                            $user->issuspended = 0;
                            $user->issuspendedfor = '';
                            $user->save();

                            $user->suspended->suspended_start = NULL;
                            $user->suspended->suspended_end = NULL;
                            $user->suspended->suspended = 0;
                            $user->suspended->acknowledge = 0;
                            $user->suspended->acknowledge_time = NULL;
                            $user->suspended->save();

                            //Redirect user to members dashboard
                            return redirect()->intended('member');
                        }

                        $end = Carbon::parse(Auth::user()->suspended->suspended_end)->addHours(8);

                        $date = $end . ' GMT+8';
                    }
                }

                $reason = "some reason for violation " . $date;
            } else if (Auth::user()->issuspendedfor == 'unusual-activity') {
                $reason = 'reason for unusual activity';
            }
            Auth::logout();

            return view('errors.chargeback-suspension')
                ->with('reason', $reason);
        }

        //tracking whether user is logged in or not
        $user = User::where('email', Auth::user()->email)->first();

        $returnUser = '';

        if ($user->flag == 0) {
            $user->flag = 1;
            $returnUser = 1;
            $deactivate = DeactivateAccount::where('user_id', '=', $user->id)->first();
            if ($deactivate) {
                $deactivate->delete();
            }
        }

        $user->isloggedin = 1;
        $user->save();


        //update last activity time
        $activity = $user->useractivity ?: new Useractivity;

        $activity->userid = Auth::user()->id;
        $activity->lastloggedin = Carbon::now();
        $user->Useractivity()->save($activity);

        $user->language = $lang;
        $user->save();

        $this->checkSubscriptionDates();

        if (islangZh()) {

            $checkFirstTimeLoggin = Auth::user()->remember_token;

            if (empty($checkFirstTimeLoggin)) {
                return redirect()->intended('profile/basic');
            }

            //redirecting to Dashboard
            return redirect()->intended('member');
        }


        /**
         * Check if user login first time, redirect to edit profile page
         */
        $checkFirstTimeLoggin = Auth::user()->remember_token;

        if (empty($checkFirstTimeLoggin)) {
            return redirect()->intended('profile/basic');
        }


        if ($returnUser == 1) {
            Session::set('returnUser', 1);
        }

        Session()->put('hasclicked', 'a');
        Session()->put('locale', 'zh');

        app()->setLocale("zh");

        return redirect()->intended('member');
    }

    public function checkSubscriptionDates()
    {
        $currentdate = Carbon::now('Singapore');
        $subscriptions = Subscriptions::where('ends_at', '<', $currentdate)->get();
        foreach ($subscriptions as $subscriber) {
            if ($subscriber) {
                $subscriber->subscription_status = 0;
                $subscriber->save();
                $user = User::where('id', '=', $subscriber->user_id)->first();
                $user->membershiptype = 'free';
                $user->save();
            }
        }
    }
}
