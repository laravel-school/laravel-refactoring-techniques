<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\RegistererIp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserStatisticsController extends Controller
{
    public function showUsersStatistics(Request $request)
    {


        $from = $request->input('from');
        if ($from == '00-00-00' or $from == '') {
            $from = '2015-01-01 00:00:00';
        }


        $to = $request->input('to');
        if ($to == '00-00-00' or $to == '') {
            $to = Carbon::now('Singapore');
        }


        $fromdate = Carbon::parse($from)->addHour(-8);
        $todate = Carbon::parse($to)->addHour(-8);


        $users = '';


        $countusers = User::where('created_at', '>=', $fromdate)
            ->where('created_at', '<=', $todate)
            ->orderBy('created_at', 'desc')
            ->count();


        $countrylist = ["Afghanistan", "Albania", "Algeria", "Andorra", "Angola", "Anguilla", "Argentina", "Armenia", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Bermuda", "Bhutan", "Bolivia", "Bosnia", "Botswana", "Brazil", "British Virgin Islands", "Brunei", "Bulgaria", "Burkina Faso", "Cambodia", "Cameroon", "Chad", "Chile", "China", "Colombia", "Congo", "Costa Rica", "Cote D Ivoire", "Croatia", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Estonia", "Ethiopia", "Fiji", "Finland", "France", "Gambia", "Georgia", "Germany", "Ghana", "Greece", "Greenland", "Guatemala", "Guinea", "Haiti", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jersey", "Jordan", "Kazakhstan", "Kenya", "Kuwait", "Kyrgyz Republic", "Laos", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Mauritania", "Mauritius", "Mexico", "Moldova", "Monaco", "Mongolia", "Morocco", "Mozambique", "Namibia", "Nepal", "Netherlands", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Norway", "Oman", "Pakistan", "Palestine", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Poland", "Portugal", "Puerto Rico", "Qatar", "Romania", "Russia", "Rwanda", "Samoa", "Saudi Arabia", "Senegal", "Serbia", "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "South Africa", "South Korea", "Spain", "Sri Lanka", "Sudan", "Swaziland", "Sweden", "Switzerland", "Syria", "Taiwan", "Tajikistan", "Tanzania", "Thailand", "Togo", "Tonga", "Trinidad &amp; Tobago", "Tunisia", "Turkey", "Turkmenistan", "Uganda", "Ukraine", "United States", "United Arab Emirates", "United Kingdom", "Uruguay", "Uzbekistan", "Venezuela", "Vietnam", "Virgin Islands (US)", "Yemen", "Zambia", "Zimbabwe"];

        $countries = array();

        foreach ($countrylist as $country) {

            $users = DB::select("SELECT us.id FROM usercities as cities LEFT JOIN users as us on cities.userid = us.id Where cities.currentcountry LIKE '%" . $country . "%' AND us.created_at BETWEEN '" . $from . "' AND '" . $to . "' ");
            /////////By User
            //Male
            $usersmale = DB::select("SELECT us.id FROM usercities as cities LEFT JOIN users as us on cities.userid = us.id Where cities.currentcountry LIKE '%" . $country . "%' AND us.gender = 'man' AND us.createdby != 'admin' AND us.created_at BETWEEN '" . $from . "' AND '" . $to . "' ");
            $usersmaleSD = DB::select("SELECT us.id FROM usercities as cities LEFT JOIN users as us on cities.userid = us.id Where cities.currentcountry LIKE '%" . $country . "%' AND us.gender = 'man' AND us.createdby != 'admin' AND us.wanttobe = 'sugardaddy' AND us.created_at BETWEEN '" . $from . "' AND '" . $to . "' ");
            $usersmaleSB = DB::select("SELECT us.id FROM usercities as cities LEFT JOIN users as us on cities.userid = us.id Where cities.currentcountry LIKE '%" . $country . "%' AND us.gender = 'man' AND us.createdby != 'admin' AND us.wanttobe = 'sugarbaby' AND us.created_at BETWEEN '" . $from . "' AND '" . $to . "' ");
            // Male Complete profiles
            $usersmaleSDcomplete = DB::select("SELECT us.id FROM usercities as cities LEFT JOIN users as us on cities.userid = us.id Where cities.currentcountry LIKE '%" . $country . "%' AND us.gender = 'man' AND us.createdby != 'admin' AND us.wanttobe = 'sugardaddy' AND us.created_at BETWEEN '" . $from . "' AND '" . $to . "' AND us.aboutme !='' AND us.lookingfordetails !='' AND us.tagline !='' AND us.username !='' AND us.profilephoto !='' ");
            $usersmaleSBcomplete = DB::select("SELECT us.id FROM usercities as cities LEFT JOIN users as us on cities.userid = us.id Where cities.currentcountry LIKE '%" . $country . "%' AND us.gender = 'man' AND us.createdby != 'admin' AND us.wanttobe = 'sugarbaby' AND us.created_at BETWEEN '" . $from . "' AND '" . $to . "' AND us.aboutme !='' AND us.lookingfordetails !='' AND us.tagline !='' AND us.username !='' AND us.profilephoto !='' ");

            //Female
            $usersfemale = DB::select("SELECT us.id FROM usercities as cities LEFT JOIN users as us on cities.userid = us.id Where cities.currentcountry LIKE '%" . $country . "%' AND us.gender = 'woman' AND us.createdby != 'admin' AND us.created_at BETWEEN '" . $from . "' AND '" . $to . "' ");
            $usersfemaleSD = DB::select("SELECT us.id FROM usercities as cities LEFT JOIN users as us on cities.userid = us.id Where cities.currentcountry LIKE '%" . $country . "%' AND us.gender = 'woman' AND us.createdby != 'admin' AND us.wanttobe = 'sugardaddy' AND us.created_at BETWEEN '" . $from . "' AND '" . $to . "' ");
            $usersfemaleSB = DB::select("SELECT us.id FROM usercities as cities LEFT JOIN users as us on cities.userid = us.id Where cities.currentcountry LIKE '%" . $country . "%' AND us.gender = 'woman' AND us.createdby != 'admin' AND us.wanttobe = 'sugarbaby' AND us.created_at BETWEEN '" . $from . "' AND '" . $to . "' ");
            //Female Complete Profiles
            $usersfemaleSDcomplete = DB::select("SELECT us.id FROM usercities as cities LEFT JOIN users as us on cities.userid = us.id Where cities.currentcountry LIKE '%" . $country . "%' AND us.gender = 'woman' AND us.createdby != 'admin' AND us.wanttobe = 'sugardaddy' AND us.created_at BETWEEN '" . $from . "' AND '" . $to . "' AND us.aboutme !='' AND us.lookingfordetails !='' AND us.tagline !='' AND us.username !='' AND us.profilephoto !=''  ");
            $usersfemaleSBcomplete = DB::select("SELECT us.id FROM usercities as cities LEFT JOIN users as us on cities.userid = us.id Where cities.currentcountry LIKE '%" . $country . "%' AND us.gender = 'woman' AND us.createdby != 'admin' AND us.wanttobe = 'sugarbaby' AND us.created_at BETWEEN '" . $from . "' AND '" . $to . "' AND us.aboutme !='' AND us.lookingfordetails !='' AND us.tagline !='' AND us.username !='' AND us.profilephoto !='' ");


            //Created By admin Needs Fixes
            $adminmale = DB::select("SELECT us.id FROM usercities as cities LEFT JOIN users as us on cities.userid = us.id Where cities.currentcountry LIKE '%" . $country . "%' AND us.gender = 'man' AND us.createdby = 'admin' AND us.created_at BETWEEN '" . $from . "' AND '" . $to . "' ");
            $adminmaleSD = DB::select("SELECT us.id FROM usercities as cities LEFT JOIN users as us on cities.userid = us.id Where cities.currentcountry LIKE '%" . $country . "%' AND us.gender = 'man' AND us.createdby = 'admin' AND us.wanttobe = 'sugardaddy' AND us.created_at BETWEEN '" . $from . "' AND '" . $to . "' ");
            $adminmaleSB = DB::select("SELECT us.id FROM usercities as cities LEFT JOIN users as us on cities.userid = us.id Where cities.currentcountry LIKE '%" . $country . "%' AND us.gender = 'man' AND us.createdby = 'admin' AND us.wanttobe = 'sugarbaby' AND us.created_at BETWEEN '" . $from . "' AND '" . $to . "' ");


            $adminfemale = DB::select("SELECT us.id FROM usercities as cities LEFT JOIN users as us on cities.userid = us.id Where cities.currentcountry LIKE '%" . $country . "%' AND us.gender = 'woman' AND us.createdby = 'admin' AND us.created_at BETWEEN '" . $from . "' AND '" . $to . "' ");
            $adminfemaleSD = DB::select("SELECT us.id FROM usercities as cities LEFT JOIN users as us on cities.userid = us.id Where cities.currentcountry LIKE '%" . $country . "%' AND us.gender = 'woman' AND us.createdby = 'admin' AND us.wanttobe = 'sugardaddy' AND us.created_at BETWEEN '" . $from . "' AND '" . $to . "' ");
            $adminfemaleSB = DB::select("SELECT us.id FROM usercities as cities LEFT JOIN users as us on cities.userid = us.id Where cities.currentcountry LIKE '%" . $country . "%' AND us.gender = 'woman' AND us.createdby = 'admin' AND us.wanttobe = 'sugarbaby' AND us.created_at BETWEEN '" . $from . "' AND '" . $to . "' ");


            if (empty($users)) {
                continue;
            }

            $countryf = array([
                'country' => $country,
                'total' => count($users),
                'usersmale' => count($usersmale),
                'usersmaleSD' => count($usersmaleSD),
                'usersmaleSB' => count($usersmaleSB),
                'usersmaleSDcomplete' => count($usersmaleSDcomplete),
                'usersmaleSBcomplete' => count($usersmaleSBcomplete),
                'usersfemale' => count($usersfemale),
                'usersfemaleSD' => count($usersfemaleSD),
                'usersfemaleSB' => count($usersfemaleSB),
                'usersfemaleSDcomplete' => count($usersfemaleSDcomplete),
                'usersfemaleSBcomplete' => count($usersfemaleSBcomplete),
                'adminmale' => count($adminmale),
                'adminmaleSD' => count($adminmaleSD),
                'adminmaleSB' => count($adminmaleSB),
                'adminfemale' => count($adminfemale),
                'adminfemaleSD' => count($adminfemaleSD),
                'adminfemaleSB' => count($adminfemaleSB),
            ]);

            $countries = array_merge($countries, $countryf);
        }


        //Sort Countries by total in DESC format
        usort($countries, function ($a, $b) {
            return $b['total'] - $a['total'];
        });

        $totalman = User::orderby('created_at', 'desc')
            ->where('created_at', '>=', $fromdate)
            ->where('created_at', '<=', $todate)
            ->where('gender', '=', 'man')
            ->count();

        $totalwoman = User::orderby('created_at', 'desc')
            ->where('created_at', '>=', $fromdate)
            ->where('created_at', '<=', $todate)
            ->where('gender', '!=', 'man')
            ->count();

        //counts accounts created by admin
        $adminAccounts = User::orderBy('created_at', 'desc')
            ->where('createdby', 'admin')
            ->where('created_at', '>=', $fromdate)
            ->where('created_at', '<=', $todate)
            ->count();


        //counts accounts created by themself
        $selfAccounts = User::orderBy('created_at', 'desc')
            ->where('createdby', '!=', 'admin')
            ->where('created_at', '>=', $fromdate)
            ->where('created_at', '<=', $todate)
            ->count();

        $manAccountsAdmin = User::orderby('created_at', 'desc')
            ->where('gender', '=', 'man')
            ->where('createdby', '=', 'admin')
            ->where('created_at', '>=', $fromdate)
            ->where('created_at', '<=', $todate)
            ->count();

        $womanAccountsAdmin = User::orderby('created_at', 'desc')
            ->where('gender', '=', 'woman')
            ->where('createdby', '=', 'admin')
            ->where('created_at', '>=', $fromdate)
            ->where('created_at', '<=', $todate)
            ->count();

        $manAccountsUser = User::orderby('created_at', 'desc')
            ->where('gender', '=', 'man')
            ->where('createdby', '!=', 'admin')
            ->where('created_at', '>=', $fromdate)
            ->where('created_at', '<=', $todate)
            ->count();


        $womanAccountsUser = User::orderby('created_at', 'desc')
            ->where('gender', '=', 'woman')
            ->where('createdby', '!=', 'admin')
            ->where('created_at', '>=', $fromdate)
            ->where('created_at', '<=', $todate)
            ->count();


        //Ip address tracking
        $registererIP = RegistererIp::where('created_at', '>=', $fromdate)
            ->where('created_at', '<=', $todate)
            ->get('ip');

        $referrals = array();

        /*
        foreach ($registererIP as $registerer)
            {
                        $visitor = Visitor::where('ip', '=', $registerer)->first();
                        if($visitor)
                            {
                                $userreferreral = $visitor->reference;
                                array_push($referrals, $userreferreral);
                            }
            }


        $referrals = array_count_values($referrals);

        $referrals = array_sort($referrals, function($value){
                                    return $value;
                                });

        //END OF IP ADDRESS TRACKING    */

        return view('show-users-statistics')
            ->with([
                'users' => $users,
                'adminaccounts' => $adminAccounts,
                'selfaccounts' => $selfAccounts,
                'manaccountsadmin' => $manAccountsAdmin,
                'womanaccountsadmin' => $womanAccountsAdmin,
                'manaccountsuser' => $manAccountsUser,
                'womanaccountsuser' => $womanAccountsUser,
                'totalman' => $totalman,
                'totalwoman' => $totalwoman,
                'countusers' => $countusers,
                'countries' => $countries,
                'referrals' => $referrals,
            ]);
    }
}
