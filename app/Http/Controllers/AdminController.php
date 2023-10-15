<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function showUsersFeatured(Request $request)
    {
        if ($request->segment(2) == 'unitedstates') {
            $usersfeatured = User::with(['usercity', 'tempphoto'])->where('isfeatured', '!=', 0)->where('featuredin', '=', 'unitedstates')->get();
            $usersfeaturedman = User::with(['usercity', 'tempphoto'])->where('isfeatured', '!=', 0)->where('featuredin', '=', 'unitedstates')->where('gender', '=', 'man')->get();
            $usersfeaturedwoman = User::with(['usercity', 'tempphoto'])->where('isfeatured', '!=', 0)->where('featuredin', '=', 'unitedstates')->where('gender', '=', 'woman')->get();
            $country = 'United States';
            return view('admin.featured-users.showfeatured')->with([
                'usersfeatured' => $usersfeatured,
                'usersfeaturedman' => $usersfeaturedman,
                'usersfeaturedwoman' => $usersfeaturedwoman,
                'country' => $country,
            ]);
        } elseif ($request->segment(2) == 'singapore') {
            $usersfeatured = User::with(['usercity', 'tempphoto'])->where('isfeatured', '!=', 0)->where('featuredin', '=', 'singapore')->get();
            $usersfeaturedman = User::with(['usercity', 'tempphoto'])->where('isfeatured', '!=', 0)->where('featuredin', '=', 'singapore')->where('gender', '=', 'man')->get();
            $usersfeaturedwoman = User::with(['usercity', 'tempphoto'])->where('isfeatured', '!=', 0)->where('featuredin', '=', 'singapore')->where('gender', '=', 'woman')->get();
            $country = 'Singapore';
            return view('admin.featured-users.showfeatured')->with([
                'usersfeatured' => $usersfeatured,
                'usersfeaturedman' => $usersfeaturedman,
                'usersfeaturedwoman' => $usersfeaturedwoman,
                'country' => $country,
            ]);
        } elseif ($request->segment(2) == 'thailand') {
            $usersfeatured = User::with(['usercity', 'tempphoto'])->where('isfeatured', '!=', 0)->where('featuredin', '=', 'thailand')->get();
            $usersfeaturedman = User::with(['usercity', 'tempphoto'])->where('isfeatured', '!=', 0)->where('featuredin', '=', 'thailand')->where('gender', '=', 'man')->get();
            $usersfeaturedwoman = User::with(['usercity', 'tempphoto'])->where('isfeatured', '!=', 0)->where('featuredin', '=', 'thailand')->where('gender', '=', 'woman')->get();

            $country = 'Thailand';
            return view('admin.featured-users.showfeatured')->with([
                'usersfeatured' => $usersfeatured,
                'usersfeaturedman' => $usersfeaturedman,
                'usersfeaturedwoman' => $usersfeaturedwoman,
                'country' => $country,
            ]);
        } elseif ($request->segment(2) == 'indonesia') {
            $usersfeatured = User::with(['usercity', 'tempphoto'])->where('isfeatured', '!=', 0)->where('featuredin', '=', 'indonesia')->get();
            $usersfeaturedman = User::with(['usercity', 'tempphoto'])->where('isfeatured', '!=', 0)->where('featuredin', '=', 'indonesia')->where('gender', '=', 'man')->get();
            $usersfeaturedwoman = User::with(['usercity', 'tempphoto'])->where('isfeatured', '!=', 0)->where('featuredin', '=', 'indonesia')->where('gender', '=', 'woman')->get();
            $country = 'Indonesia';
            return view('admin.featured-users.showfeatured')->with([
                'usersfeatured' => $usersfeatured,
                'usersfeaturedman' => $usersfeaturedman,
                'usersfeaturedwoman' => $usersfeaturedwoman,
                'country' => $country,
            ]);
        } elseif ($request->segment(2) == 'home') {
            $usersfeatured = User::with(['usercity', 'tempphoto'])->where('featurehome', '!=', 0)->get();
            $usersfeaturedman = User::with(['usercity', 'tempphoto'])->where('featurehome', '!=', 0)->where('gender', '=', 'man')->get();
            $usersfeaturedwoman = User::with(['usercity', 'tempphoto'])->where('featurehome', '!=', 0)->where('gender', '=', 'woman')->get();
            $country = 'Home';
            return view('admin.featured-users.showfeatured')->with([
                'usersfeatured' => $usersfeatured,
                'usersfeaturedman' => $usersfeaturedman,
                'usersfeaturedwoman' => $usersfeaturedwoman,
                'country' => $country,
            ]);
        }

        $usersfeatured = User::with(['usercity', 'tempphoto'])->where('isfeatured', '!=', 0)->where('featuredin', '=', 'malaysia')->get();
        $usersfeaturedman = User::with(['usercity', 'tempphoto'])->where('isfeatured', '!=', 0)->where('featuredin', '=', 'malaysia')->where('gender', '=', 'man')->get();
        $usersfeaturedwoman = User::with(['usercity', 'tempphoto'])->where('isfeatured', '!=', 0)->where('featuredin', '=', 'malaysia')->where('gender', '=', 'woman')->get();
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

    public function index(Request $request)
    {
        $segment = $request->segment(2);

        $countries = [
            'unitedstates' => ['name' => 'United States', 'featuredin' => 'unitedstates'],
            'singapore' => ['name' => 'Singapore', 'featuredin' => 'singapore'],
            'thailand' => ['name' => 'Thailand', 'featuredin' => 'thailand'],
            'indonesia' => ['name' => 'Indonesia', 'featuredin' => 'indonesia'],
            'home' => ['name' => 'Home', 'featuredin' => null, 'featurehome' => true],
            'malaysia' => ['name' => 'Malaysia', 'featuredin' => 'malaysia'], // Default country
        ];

        $countryData = $countries[$segment] ?? $countries['malaysia'];

        $baseQuery = User::where('isfeatured', '!=', 0);

        if (isset($countryData['featurehome'])) {
            $baseQuery->where('featurehome', '!=', 0);
        } else {
            $baseQuery->where('featuredin', '=', $countryData['featuredin']);
        }

        $usersfeatured = $baseQuery->paginate(50);
        $usersfeatured->load(['usercity', 'tempphoto']);  // Lazy eager load after main fetch

        $usersfeaturedman = $usersfeatured->where('gender', 'man');
        $usersfeaturedwoman = $usersfeatured->where('gender', 'woman');

        return view('admin.featured-users.showfeatured')->with([
            'usersfeatured' => $usersfeatured,
            'usersfeaturedman' => $usersfeaturedman,
            'usersfeaturedwoman' => $usersfeaturedwoman,
            'country' => $countryData['name'],
        ]);
    }
}
