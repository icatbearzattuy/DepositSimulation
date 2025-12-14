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
  min-height: 200vh;
  width: 100%;
  background-image: 
    linear-gradient(to right, #80808012 1px, transparent 1px),
    linear-gradient(to bottom, #80808012 1px, transparent 1px);
  background-size: 48px 48px;
}
    </style>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-black">

    <nav id="navbar" class="bg-white fixed w-full z-20 top-0 start-0 border-b border-gray-200">
        <div id="navbarContent" class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
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
                <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-neutral-primary md:flex-row md:space-x-8 md:mt-0 md:border-0">
                    <li>
                        <a href="#" class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-[#129661] md:p-0" aria-current="page">Home</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-[#129661] md:p-0">About</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-[#129661] md:p-0">Deposit</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-[#129661] md:p-0">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-24 px-24 smooth-scroll">
    <div class="min-h-screen px-24 max-w-3xl text-left pt-24">
        <h1 class="reveal mb-4 text-4xl font-bold tracking-tight text-heading md:text-5xl lg:text-6xl leading-tight md:leading-snug lg:leading-normal lg:tracking-normal">
            Make Smarter <span class="text-[#047b4c]">Deposit</span> Decisions.
        </h1>
        <p class="reveal mb-8 text-lg text-gray-500 font-normal text-body lg:text-xl leading-relaxed lg:leading-relaxed">
            Here at UrDeposite we focus on markets where technology, innovation, and capital can unlock long-term value and drive economic growth.
        </p>
        <button onclick="window.location.href = '/dashboard'" class=" hover:scale-105 text-red rounded-xl hover:before:bg-redborder-red-500 relative h-[50px] w-40 overflow-hidden border border-[#129661] bg-white px-3 text-[#129661] shadow-2xl transition-all before:absolute before:bottom-0 before:left-0 before:top-0 before:z-0 before:h-full before:w-0 before:bg-[#129661] before:transition-all before:duration-500 hover:text-white hover:shadow-[#129661] hover:before:left-0 hover:before:w-full"><span class="relative z-10">Lets Start!</span></button>
    </div>
    <section class="flex justify-center">
        <div class="max-w-4xl pt-10 text-center">
            <h1 class="reveal text-6xl font-bold leading-tight">
            Why Choose <span class="text-[#047b4c]">UrDeposite</span> ?
            </h1>
            <p class="reveal mt-6 max-w-3xl text-gray-500">
                Accurately predict your deposit returns. Plan your financial future with the best simulation tools.
            </p>
        </div>
    </section>
    <section class="mx-24 mt-16 flex gap-16 justify-center">
    <div class="bg-white block max-w-sm p-6 border border-default rounded-base shadow-md hover:shadow-lg hover:shadow-green-500 transition-all duration-500 ease-out hover:scale-105 hover:border-green-500">
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-bank w-16 h-16 mb-3 text-[#047b4c]" viewBox="0 0 16 16">
            <path d="m8 0 6.61 3h.89a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H15v7a.5.5 0 0 1 .485.38l.5 2a.498.498 0 0 1-.485.62H.5a.498.498 0 0 1-.485-.62l.5-2A.5.5 0 0 1 1 13V6H.5a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 .5 3h.89zM3.777 3h8.447L8 1zM2 6v7h1V6zm2 0v7h2.5V6zm3.5 0v7h1V6zm2 0v7H12V6zM13 6v7h1V6zm2-1V4H1v1zm-.39 9H1.39l-.25 1h13.72z"/>
        </svg>
        <a href="#">
            <h5 class="mb-2 text-2xl font-semibold tracking-tight text-heading">Direct Comparison of 3 Banks</h5>
        </a>
        <p class="mb-3 text-body">Your app directly fulfills the client's need by showing a side-by-side comparison of 3 different banks with varying interest rates in one place.</p>
    </div>
    <div class="bg-white block max-w-sm p-6 border border-default rounded-base shadow-md hover:shadow-lg hover:shadow-green-500 transition-all duration-500 ease-out hover:scale-105 hover:border-green-500">
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-bank w-16 h-16 mb-3 text-[#047b4c]" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M6 2a.5.5 0 0 1 .47.33L10 12.036l1.53-4.208A.5.5 0 0 1 12 7.5h3.5a.5.5 0 0 1 0 1h-3.15l-1.88 5.17a.5.5 0 0 1-.94 0L6 3.964 4.47 8.171A.5.5 0 0 1 4 8.5H.5a.5.5 0 0 1 0-1h3.15l1.88-5.17A.5.5 0 0 1 6 2"/>
        </svg>
        <a href="#">
            <h5 class="mb-2 text-2xl font-semibold tracking-tight text-heading">Accurate Calculation Logic</h5>
        </a>
        <p class="mb-3 text-body">We use industry-standard calculation logic that is validated and executed securely on the server (backend), ensuring every simulation result is reliable.</p>
    </div>
    <div class="bg-white block max-w-sm p-6 border border-default rounded-base shadow-md hover:shadow-xl hover:shadow-green-500 transition-all duration-500 ease-out hover:scale-105 hover:border-green-500">
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-bank w-16 h-16 mb-3 text-[#047b4c]" viewBox="0 0 16 16">
            <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
        </svg>
        <a href="#">
            <h5 class="mb-2 text-2xl font-semibold tracking-tight text-heading">Full Support for Users (User-Centric)   </h5>
        </a>
        <p class="mb-3 text-body">Users can easily enter the desired nominal and tenor, select a bank, and see the comparison results instantly, making the simulation experience very easy.</p>
    </div>
</section>

</main>
<!-- component -->

<footer class="bg-neutral-primary-soft mt-24 border-t border-default">
    <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">
        <div class="md:flex md:justify-between">
          <div class="mb-6 md:mb-0">
              <a href="#" class="flex items-center">
                  <img src="{{ asset('images/logo.svg') }}" class="h-7 me-3" alt="FlowBite Logo" />
                  <span class="text-heading self-center text-2xl font-semibold whitespace-nowrap">UrDeposite</span>
              </a>
          </div>
          <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">
              <div>
                  <h2 class="mb-6 text-sm font-semibold text-heading uppercase">Resources</h2>
                  <ul class="text-body font-medium">
                      <li class="mb-4">
                          <a href="{{ asset('images/logo.svg') }}" class="hover:underline">Flowbite</a>
                      </li>
                      <li>
                          <a href="https://tailwindcss.com/" class="hover:underline">Tailwind CSS</a>
                      </li>
                  </ul>
              </div>
              <div>
                  <h2 class="mb-6 text-sm font-semibold text-heading uppercase">Follow us</h2>
                  <ul class="text-body font-medium">
                      <li class="mb-4">
                          <a href="https://github.com/themesberg/flowbite" class="hover:underline ">Github</a>
                      </li>
                      <li>
                          <a href="https://github.com/icatbearzattuy/DepositSimulation" class="hover:underline">Discord</a>
                      </li>
                  </ul>
              </div>
              <div>
                  <h2 class="mb-6 text-sm font-semibold text-heading uppercase">Legal</h2>
                  <ul class="text-body font-medium">
                      <li class="mb-4">
                          <a href="#" class="hover:underline">Privacy Policy</a>
                      </li>
                      <li>
                          <a href="#" class="hover:underline">Terms &amp; Conditions</a>
                      </li>
                  </ul>
              </div>
          </div>
      </div>
      <hr class="my-6 border-default sm:mx-auto lg:my-8" />
      <div class="sm:flex sm:items-center sm:justify-between">
          <span class="text-sm text-body sm:text-center">© 2023 <a href="" class="hover:underline">UrDeposite™</a>. All Rights Reserved.
          </span>
          <div class="flex mt-4 sm:justify-center sm:mt-0">
            <a href="#" class="text-body hover:text-heading">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M13.135 6H15V3h-1.865a4.147 4.147 0 0 0-4.142 4.142V9H7v3h2v9.938h3V12h2.021l.592-3H12V6.591A.6.6 0 0 1 12.592 6h.543Z" clip-rule="evenodd"/></svg>
                <span class="sr-only">Facebook page</span>
            </a>
            <a href="#" class="text-body hover:text-heading ms-5">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path d="M18.942 5.556a16.3 16.3 0 0 0-4.126-1.3 12.04 12.04 0 0 0-.529 1.1 15.175 15.175 0 0 0-4.573 0 11.586 11.586 0 0 0-.535-1.1 16.274 16.274 0 0 0-4.129 1.3 17.392 17.392 0 0 0-2.868 11.662 15.785 15.785 0 0 0 4.963 2.521c.41-.564.773-1.16 1.084-1.785a10.638 10.638 0 0 1-1.706-.83c.143-.106.283-.217.418-.331a11.664 11.664 0 0 0 10.118 0c.137.114.277.225.418.331-.544.328-1.116.606-1.71.832a12.58 12.58 0 0 0 1.084 1.785 16.46 16.46 0 0 0 5.064-2.595 17.286 17.286 0 0 0-2.973-11.59ZM8.678 14.813a1.94 1.94 0 0 1-1.8-2.045 1.93 1.93 0 0 1 1.8-2.047 1.918 1.918 0 0 1 1.8 2.047 1.929 1.929 0 0 1-1.8 2.045Zm6.644 0a1.94 1.94 0 0 1-1.8-2.045 1.93 1.93 0 0 1 1.8-2.047 1.919 1.919 0 0 1 1.8 2.047 1.93 1.93 0 0 1-1.8 2.045Z"/></svg>
                <span class="sr-only">Discord community</span>
            </a>
            <a href="#" class="text-body hover:text-heading ms-5">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path d="M13.795 10.533 20.68 2h-3.073l-5.255 6.517L7.69 2H1l7.806 10.91L1.47 22h3.074l5.705-7.07L15.31 22H22l-8.205-11.467Zm-2.38 2.95L9.97 11.464 4.36 3.627h2.31l4.528 6.317 1.443 2.02 6.018 8.409h-2.31l-4.934-6.89Z"/></svg>
            <span class="sr-only">Twitter page</span>
            </a>
            <a href="#" class="text-body hover:text-heading ms-5">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12.006 2a9.847 9.847 0 0 0-6.484 2.44 10.32 10.32 0 0 0-3.393 6.17 10.48 10.48 0 0 0 1.317 6.955 10.045 10.045 0 0 0 5.4 4.418c.504.095.683-.223.683-.494 0-.245-.01-1.052-.014-1.908-2.78.62-3.366-1.21-3.366-1.21a2.711 2.711 0 0 0-1.11-1.5c-.907-.637.07-.621.07-.621.317.044.62.163.885.346.266.183.487.426.647.71.135.253.318.476.538.655a2.079 2.079 0 0 0 2.37.196c.045-.52.27-1.006.635-1.37-2.219-.259-4.554-1.138-4.554-5.07a4.022 4.022 0 0 1 1.031-2.75 3.77 3.77 0 0 1 .096-2.713s.839-.275 2.749 1.05a9.26 9.26 0 0 1 5.004 0c1.906-1.325 2.74-1.05 2.74-1.05.37.858.406 1.828.101 2.713a4.017 4.017 0 0 1 1.029 2.75c0 3.939-2.339 4.805-4.564 5.058a2.471 2.471 0 0 1 .679 1.897c0 1.372-.012 2.477-.012 2.814 0 .272.18.592.687.492a10.05 10.05 0 0 0 5.388-4.421 10.473 10.473 0 0 0 1.313-6.948 10.32 10.32 0 0 0-3.39-6.165A9.847 9.847 0 0 0 12.007 2Z" clip-rule="evenodd"/></svg>
                <span class="sr-only">GitHub account</span>
            </a>
            <a href="#" class="text-body hover:text-heading ms-5">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12 2a10 10 0 1 0 10 10A10.009 10.009 0 0 0 12 2Zm6.613 4.614a8.523 8.523 0 0 1 1.93 5.32 20.093 20.093 0 0 0-5.949-.274c-.059-.149-.122-.292-.184-.441a23.879 23.879 0 0 0-.566-1.239 11.41 11.41 0 0 0 4.769-3.366ZM10 3.707a8.82 8.82 0 0 1 2-.238 8.5 8.5 0 0 1 5.664 2.152 9.608 9.608 0 0 1-4.476 3.087A45.755 45.755 0 0 0 10 3.707Zm-6.358 6.555a8.57 8.57 0 0 1 4.73-5.981 53.99 53.99 0 0 1 3.168 4.941 32.078 32.078 0 0 1-7.9 1.04h.002Zm2.01 7.46a8.51 8.51 0 0 1-2.2-5.707v-.262a31.641 31.641 0 0 0 8.777-1.219c.243.477.477.964.692 1.449-.114.032-.227.067-.336.1a13.569 13.569 0 0 0-6.942 5.636l.009.003ZM12 20.556a8.508 8.508 0 0 1-5.243-1.8 11.717 11.717 0 0 1 6.7-5.332.509.509 0 0 1 .055-.02 35.65 35.65 0 0 1 1.819 6.476 8.476 8.476 0 0 1-3.331.676Zm4.772-1.462A37.232 37.232 0 0 0 15.113 13a12.513 12.513 0 0 1 5.321.364 8.56 8.56 0 0 1-3.66 5.73h-.002Z" clip-rule="evenodd"/></svg>
                <span class="sr-only">UrDeposito Acount</span>
            </a>
          </div>
      </div>
    </div>
</footer>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
    <script src="https://unpkg.com/scrollreveal"></script>
    <script>
        ScrollReveal({distance: '30px', duration: 800, easing: 'ease-out',});
        ScrollReveal().reveal('.reveal', { origin: 'bottom' });
    </script>
<script>
document.addEventListener("DOMContentLoaded", () => {
    const navbar = document.querySelector("nav");

    window.addEventListener("scroll", () => {
        if (window.scrollY > 0) {
            navbar.classList.remove("bg-transparent");
            navbar.classList.add("bg-[#f5f5f5]/80", "backdrop-blur");
        } else {
            navbar.classList.remove("bg-[#f5f5f5]/80", "backdrop-blur");
            navbar.classList.add("bg-transparent");
        }
    });
});
</script>
<script>
    const navbar = document.getElementById("navbar");
    const navbarContent = document.getElementById("navbarContent");

    window.addEventListener("scroll", function () {
    if (window.scrollY === 0) {
        // Posisi paling atas → padding besar
        navbarContent.classList.remove("");
        navbarContent.classList.add("");
    } else {
        // Posisi scroll → padding lebih kecil
        navbarContent.classList.remove("");
        navbarContent.classList.add("");
    }
});

let lastScrollTop = 0;
const scrollThreshold = 200;

window.addEventListener("scroll", function () {
    let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

    if (scrollTop > scrollThreshold) {
        if (scrollTop > lastScrollTop) {
            // Scroll Down
            navbar.style.top = "-100px";
            navbar.style.transition = "top 0.4s ease";
        } else {
            // Scroll Up
            navbar.style.top = "0";
            navbar.style.transition = "top 0.4s ease";
        }
    } else {
        // Dalam threshold, navbar tetap visible
        navbar.style.top = "0";
    }
    lastScrollTop = scrollTop;
});
</script>
</body>
</html>