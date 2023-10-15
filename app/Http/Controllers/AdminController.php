<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function showUsersFeatured(Request $request)
    {
        if ($request->segment(2) == 'unitedstates') {
            $usersfeatured = User::where('isfeatured', '!=', 0)->where('featuredin', '=', 'unitedstates')->get();
            $usersfeaturedman = User::where('isfeatured', '!=', 0)->where('featuredin', '=', 'unitedstates')->where('gender', '=', 'man')->get();
            $usersfeaturedwoman = User::where('isfeatured', '!=', 0)->where('featuredin', '=', 'unitedstates')->where('gender', '=', 'woman')->get();
            $country = 'United States';
            return view('admin.featured-users.showfeatured')->with([
                'usersfeatured' => $usersfeatured,
                'usersfeaturedman' => $usersfeaturedman,
                'usersfeaturedwoman' => $usersfeaturedwoman,
                'country' => $country,
            ]);
        } elseif ($request->segment(2) == 'singapore') {
            $usersfeatured = User::where('isfeatured', '!=', 0)->where('featuredin', '=', 'singapore')->get();
            $usersfeaturedman = User::where('isfeatured', '!=', 0)->where('featuredin', '=', 'singapore')->where('gender', '=', 'man')->get();
            $usersfeaturedwoman = User::where('isfeatured', '!=', 0)->where('featuredin', '=', 'singapore')->where('gender', '=', 'woman')->get();
            $country = 'Singapore';
            return view('admin.featured-users.showfeatured')->with([
                'usersfeatured' => $usersfeatured,
                'usersfeaturedman' => $usersfeaturedman,
                'usersfeaturedwoman' => $usersfeaturedwoman,
                'country' => $country,
            ]);
        } elseif ($request->segment(2) == 'thailand') {
            $usersfeatured = User::where('isfeatured', '!=', 0)->where('featuredin', '=', 'thailand')->get();
            $usersfeaturedman = User::where('isfeatured', '!=', 0)->where('featuredin', '=', 'thailand')->where('gender', '=', 'man')->get();
            $usersfeaturedwoman = User::where('isfeatured', '!=', 0)->where('featuredin', '=', 'thailand')->where('gender', '=', 'woman')->get();

            $country = 'Thailand';
            return view('admin.featured-users.showfeatured')->with([
                'usersfeatured' => $usersfeatured,
                'usersfeaturedman' => $usersfeaturedman,
                'usersfeaturedwoman' => $usersfeaturedwoman,
                'country' => $country,
            ]);
        } elseif ($request->segment(2) == 'indonesia') {
            $usersfeatured = User::where('isfeatured', '!=', 0)->where('featuredin', '=', 'indonesia')->get();
            $usersfeaturedman = User::where('isfeatured', '!=', 0)->where('featuredin', '=', 'indonesia')->where('gender', '=', 'man')->get();
            $usersfeaturedwoman = User::where('isfeatured', '!=', 0)->where('featuredin', '=', 'indonesia')->where('gender', '=', 'woman')->get();
            $country = 'Indonesia';
            return view('admin.featured-users.showfeatured')->with([
                'usersfeatured' => $usersfeatured,
                'usersfeaturedman' => $usersfeaturedman,
                'usersfeaturedwoman' => $usersfeaturedwoman,
                'country' => $country,
            ]);
        } elseif ($request->segment(2) == 'home') {
            $usersfeatured = User::where('featurehome', '!=', 0)->get();
            $usersfeaturedman = User::where('featurehome', '!=', 0)->where('gender', '=', 'man')->get();
            $usersfeaturedwoman = User::where('featurehome', '!=', 0)->where('gender', '=', 'woman')->get();
            $country = 'Home';
            return view('admin.featured-users.showfeatured')->with([
                'usersfeatured' => $usersfeatured,
                'usersfeaturedman' => $usersfeaturedman,
                'usersfeaturedwoman' => $usersfeaturedwoman,
                'country' => $country,
            ]);
        }

        $usersfeatured = User::where('isfeatured', '!=', 0)->where('featuredin', '=', 'malaysia')->get();
        $usersfeaturedman = User::where('isfeatured', '!=', 0)->where('featuredin', '=', 'malaysia')->where('gender', '=', 'man')->get();
        $usersfeaturedwoman = User::where('isfeatured', '!=', 0)->where('featuredin', '=', 'malaysia')->where('gender', '=', 'woman')->get();
        $country = 'Malaysia';
        return view('admin.featured-users.showfeatured')->with([
            'usersfeatured' => $usersfeatured,
            'usersfeaturedman' => $usersfeaturedman,
            'usersfeaturedwoman' => $usersfeaturedwoman,
            'country' => $country,
        ]);
        return view('admin.featured-users.showfeatured')->with([
            'usersfeatured' => $usersfeatured,
            'usersfeaturedman' => $usersfeaturedman,
            'usersfeaturedwoman' => $usersfeaturedwoman,
            'country' => $country,
        ]);
    }
}
