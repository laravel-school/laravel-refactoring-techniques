<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100">
    <header class="bg-gray-800">
        <nav class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8 text-white" aria-label="Global">
            <div class="flex flex-1">
                <div class="hidden lg:flex lg:gap-x-12">
                    <a href="#" class="text-lx font-bold leading-6">Admin Section</a>
                </div>
            </div>
            <div class="flex flex-1 justify-end">
                <a href="#" class="text-sm font-semibold leading-6 flex items-center gap-x-4">
                    <img src="https://unavatar.io/github/tisuchi" alt=""
                        class="h-14 w-14 rounded-full bg-gray-5">
                </a>
            </div>
        </nav>
    </header>

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 my-16">
        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <div class="my-12">
                        <h2 class="text-xl text-gray-500">At a blance</h2>
                        <dl class="mt-5 grid grid-cols-1 divide-y divide-gray-200 overflow-hidden rounded-lg bg-white shadow md:grid-cols-4 md:divide-x md:divide-y-0">
                            <div class="px-4 py-5 sm:p-6">
                                <dt class="text-base font-normal text-gray-900">Total Mesagess</dt>
                                <dd class="mt-1 flex items-baseline justify-between md:block lg:flex">
                                    <div class="flex items-baseline text-2xl font-semibold text-indigo-600">
                                        {{ $totalmessages->count() }}
                                    </div>
                                </dd>
                            </div>
                            <div class="px-4 py-5 sm:p-6">
                                <dt class="text-base font-normal text-gray-900">Message to admin users</dt>
                                <dd class="mt-1 flex items-baseline justify-between md:block lg:flex">
                                    <div class="flex items-baseline text-2xl font-semibold text-indigo-600">
                                        {{ $messagestoadminaccounts->count() }}
                                    </div>
                                </dd>
                            </div>
                            <div class="px-4 py-5 sm:p-6">
                                <dt class="text-base font-normal text-gray-900">Total Potential Messages</dt>
                                <dd class="mt-1 flex items-baseline justify-between md:block lg:flex">
                                    <div class="flex items-baseline text-2xl font-semibold text-indigo-600">
                                        {{ $potentialmessages->count() }}
                                    </div>
                                </dd>
                            </div>
                            <div class="px-4 py-5 sm:p-6">
                                <dt class="text-base font-normal text-gray-900">Total Flagged Messages</dt>
                                <dd class="mt-1 flex items-baseline justify-between md:block lg:flex">
                                    <div class="flex items-baseline text-2xl font-semibold text-indigo-600">
                                        {{ $flagedmessages->count() }}
                                    </div>
                                </dd>
                            </div>
                        </dl>
                    </div>

                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                        User 1</th>
                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                        User 2</th>
                                    <th scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Total Messages
                                    </th>
                                    <th scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Last Message
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @foreach ($messages as $message)
                                    <tr>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                            {{ $message->conversations->userone->fullname }}
                                        </td>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                            {{ $message->conversations->usertwo->fullname }}
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            {{ $message->user->messages->count() }}
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-800">
                                            <div class="">
                                                {{ $message->user->messages()->orderByDesc('created_at')->first()->created_at->format('d F Y') }}
                                            </div>
                                            <span class="text-sm text-blue-500" title="Send by">
                                                {{ $message->user->fullname }} :
                                            </span>
                                            <span class="text-sm text-gray-400">
                                                {{ Str::limit($message->user->messages()->orderByDesc('created_at')->first()->message,50) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach

                                <!-- More people... -->
                            </tbody>
                        </table>
                    </div>
                    <div class="my-8">
                        {{ $messages->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>





</body>

</html>
