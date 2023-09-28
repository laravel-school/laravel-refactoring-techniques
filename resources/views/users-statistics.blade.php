<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

    <div class="container mx-auto">
        <div class="container mx-auto px-4">

            <div class="flex mt-6">
                <div class="flex-1 lg:pr-4">
                    <h1 class="text-xl font-bold">Statistics</h1>
                </div>
            </div>

            <div class="mt-6" id="app">
                <div class="border-t-2 border-gray-300 bg-gray-100 p-4 mb-4">
                    <h1 class="text-center text-xl mb-4">Totals</h1>

                    <div class="grid grid-cols-1 md:grid-cols-5 gap-4">

                        <div class="bg-red-500 text-white p-4 rounded-xl">
                            <div class="text-center">
                                <h6 class="mb-2">total accounts</h6>
                                <h1 class="text-3xl">@if(empty($countusers)) {{ count(App\Models\User::get()) }} @else {{$countusers}} @endif</h1>
                                <h6>admin + user created</h6>
                            </div>
                        </div>

                        <div class="bg-red-500 text-white p-4 rounded-xl">
                            <div class="text-center">
                                <h6 class="mb-2">Total Man</h6>
                                <h1 class="text-3xl">{{ $totalman }}</h1>
                            </div>
                        </div>

                        <div class="bg-red-500 text-white p-4 rounded-xl">
                            <div class="text-center">
                                <h6 class="mb-2">Total Woman</h6>
                                <h1 class="text-3xl">{{ $totalwoman }}</h1>
                            </div>
                        </div>

                        <div class="bg-red-500 text-white p-4 rounded-xl">
                            <div class="text-center">
                                <h6 class="mb-2">Total Admin Accounts: {{ $adminaccounts }}</h6>
                                <h1 class="text-3xl">
                                    <p>Man: {{ $manaccountsadmin }}</p>
                                    <p>Woman: {{ $womanaccountsadmin }}</p>
                                </h1>
                            </div>
                        </div>

                        <div class="bg-red-500 text-white p-4 rounded-xl">
                            <div class="text-center">
                                <h6 class="mb-2">Total Self Accounts: {{ $selfaccounts }}</h6>
                                <h1 class="text-3xl">
                                    <p>Man: {{ $manaccountsuser }}</p>
                                    <p>Woman: {{ $womanaccountsuser }}</p>
                                </h1>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- By Country -->
                <h1 class="text-center text-xl mb-4">By Country</h1>
                <div class="border-t-2 border-gray-300 bg-gray-100 p-4 overflow-x-auto whitespace-nowrap">

                    @if($countries)
                        @foreach($countries as $country)
                            <div class="inline-block bg-blue-500 text-white p-4 rounded-xl mx-2 mb-4 w-48">
                                <div class="text-center mb-2">
                                    <h6>{{ $country['country'] }}</h6>
                                    <img class="w-12 h-auto mx-auto mb-2" src="{{ url('/') }}/admin-assets/country_flags/Flag_of_{{ $country['currentcountry'] }}.png">
                                    <h1 class="text-3xl">{{ $country['total'] }}</h1>
                                </div>
                                <!-- More content here -->
                            </div>
                        @endforeach
                    @endif
                </div>

                <!-- Links/ Referrals -->
                @if($referrals)
                    <div class="mt-6 bg-blue-100 p-4">
                        <strong class="block mb-2">Links</strong>
                        @foreach($referrals as $key => $value)
                            <div>{{ $value }}: <a href="{{ $key }}" class="text-blue-600" target="_blank">{{ $key }}</a></div>
                        @endforeach
                    </div>
                @endif

            </div>
        </div>
    </div>

</body>
</html>
