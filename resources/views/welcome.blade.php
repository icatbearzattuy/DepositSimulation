<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Landing Page</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        main {
    position: absolute;
    inset: 0;
    height: 200%;
    width: 100%;
    background-image: linear-gradient(to right, #80808012 1px, transparent 1px),
        linear-gradient(to bottom, #80808012 1px, transparent 1px);
    background-size: 48px 48px;
}
    </style>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-black">

    <nav class="bg-white fixed w-full z-20 top-0 start-0 border-b border-gray-200">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <!-- Logo Section -->
            <a href="/" class="flex items-center">
                <img src="{{ asset('images/Logo.svg') }}" alt="Logo" class="w-12 h-12">
                <span class="text-black font-semibold text-2xl pl-2">UrDeposite</span>
            </a>

            <!-- Button Section -->
            <div class="flex md:order-2 space-x-3">
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-4 py-2">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-[#129661] hover:text-[#1296618f] font-medium rounded-lg text-sm px-4 py-2">
                        Log in
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-white bg-[#129661] hover:bg-[#1296618f] font-medium rounded-lg text-sm px-4 py-2">
                            Register
                        </a>
                    @endif
                @endauth
                
                <!-- Mobile menu button -->
                <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-gray-500 rounded-lg md:hidden hover:bg-gray-100" aria-controls="navbar-default" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                    </svg>
                </button>
            </div>

            <!-- Menu Items -->
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-default">
                <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white">
                    <li>
                        <a href="#" class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-[#129661] md:p-0" aria-current="page">Home</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-[#129661] md:p-0">About</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-[#129661] md:p-0">Services</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-[#129661] md:p-0">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-24 mx-24">
    <div class="min-h-screen mx-24 max-w-2xl text-left pt-20">
        <h1 class="mb-4 text-4xl font-bold tracking-tight text-heading md:text-5xl lg:text-6xl leading-tight md:leading-snug lg:leading-normal lg:tracking-normal">
            Make Smarter <span class="text-[#047b4c]">Deposit</span> Decisions.
        </h1>
        <p class="mb-8 text-lg text-gray-500 font-normal text-body lg:text-xl leading-relaxed lg:leading-relaxed">
            Here at UrDeposite we focus on markets where technology, innovation, and capital can unlock long-term value and drive economic growth.
        </p>
        <button onclick="window.location.href = '/dashboard'" class=" text-red rounded-xl hover:before:bg-redborder-red-500 relative h-[50px] w-40 overflow-hidden border border-[#129661] bg-white px-3 text-[#129661] shadow-2xl transition-all before:absolute before:bottom-0 before:left-0 before:top-0 before:z-0 before:h-full before:w-0 before:bg-[#129661] before:transition-all before:duration-500 hover:text-white hover:shadow-[#129661] hover:before:left-0 hover:before:w-full"><span class="relative z-10">Lets Start!</span></button>
    </div>
    <section class="flex justify-center">
        <div class="max-w-4xl pt-16 text-center">
            <h1 class="text-6xl font-bold leading-tight">
            Why Choose <span class="text-[#047b4c]">UrDeposite</span> ?
            </h1>
            <p class="mt-6 max-w-3xl text-gray-500">
                Accurately predict your deposit returns. Plan your financial future with the best simulation tools.
            </p>
        </div>
    </section>
</main>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
</body>
</html>