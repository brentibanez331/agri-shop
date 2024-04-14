
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/7fd7203ef6.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite('resources/css/app.css')
    <title>Document</title>
</head>
<body>
    <div class="relative flex flex-col items-center">
        <div class="relative w-full">
            <header class="bg-gradient-to-b from-[#259B00] from-90% to-[#2FB605]">
                <div class="mx-64">
                @if (Route::has('login'))
                    <nav class="-mx-3 flex flex-1 justify-end">
                        @auth
                            <a
                                href="{{ url('/dashboard') }}"
                                class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:opacity-50 focus:outline-none focus-visible:ring-[#FF2D20] dark:focus-visible:ring-white"
                            >
                                Dashboard
                            </a>
                        @else
                        @if (Route::has('register'))
                                <a
                                    href="{{ route('register') }}"
                                    class="rounded-md text-sm px-5 py-2 text-white ring-1 ring-transparent transition hover:opacity-50 focus:outline-none focus-visible:ring-[#FF2D20] dark:focus-visible:ring-white"
                                >
                                    Signup
                                </a>
                            @endif
                            <a
                                href="{{ route('login') }}"
                                class="rounded-md text-sm px-3 py-2 text-white ring-1 ring-transparent transition hover:opacity-50 focus:outline-none focus-visible:ring-[#FF2D20] dark:focus-visible:ring-white"
                            >
                                Login
                            </a>
                        @endauth
                    </nav>
                @endif
            </div>
            </header>
            <div class="my-5 mx-64 flex justify-between items-center">
                <p class="text-xl font-bold">AgroShop</p>
                <div class="relative w-7/12 flex justify-center">
                    <input type="text" placeholder="Search for Products" class="w-full transition ease-in-out duration-300 focus:ring-0 focus:border-slate-500 rounded-sm border-slate-300" >
                    <div class="absolute inset-y-0 right-0 pr-1 flex items-center">
                        <button class="text-white bg-[#259B00] px-5 py-1 rounded-sm">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </div>
                <a href="#"><i class="fa-solid fa-cart-shopping text-2xl"></i></a>
            </div>
            <hr></hr>
            
        </div>
    </div>

    {{-- Banner --}}
    <div class="w-full relative">
        <img src="images/header-101.png"/>
        <div class="mx-64 absolute text-neutral-300 text-sm left-0 inset-y-0 flex items-center">
            <a href="/" class="mr-2.5"><i class="fa-solid fa-house"></i></a>
            <p class="mr-2.5">></p>
            <p class="mr-2.5">Account</p>
            <p class="mr-2.5">></p>
            <p class="mr-2.5">Signin</p>
        </div>
    </div>

    <div class="flex justify-center w-full my-20">
        {{-- <x-auth-session-status class="mb-4" :status="session('status')" /> --}}
    <form method="POST" action="{{ route('login') }}" class="w-4/12 shadow-md px-7 py-4">
        @csrf
        <h2 class="text-3xl font-bold text-center mb-3.5">Welcome Back!</h2>
        <div class="grid gap-y-3">
            <div class="flex flex-col">
                <label for="email" class="text-sm leading-6">Email</label>
                <input id="email" type="email" name="email" class="rounded-md" required autofocus autocomplete="email"/>
            </div>

            <div class="flex flex-col">
                <label for="password" class="text-sm leading-6">Password</label>
                <div class="relative">
                    <input id="password" type="password" name="password" class="rounded-md w-full" required autocomplete="new-password"/>
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                        <button type="button" class="toggle-password" aria-label="Toggle Password Visibility">
                            <svg class="h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-between">
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>
            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>
        </div>
        <div class="flex items-center justify-center mt-6">
            <button class="bg-[#00B207] text-white w-full py-2 rounded-full hover:opacity-70 transition ease-in-out duration-150">Login</button>
        </div>
        <div class="flex items-center justify-center mt-4">
            <p class="text-gray-600 text-sm mr-2">Don't have an account?</p>
            <a class="underline font-bold text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('register') }}">
                {{ __('Sign Up') }}
            </a>
        </div>

        <!-- Remember Me -->
        

        
    </form>
    </div>

    {{-- Newsletter --}}
    <div class="flex justify-between items-center bg-[#E6E6E6] px-64 py-7 grid grid-cols-5">
        <div class="col-span-2">
            <h3 class="font-bold text-2xl">Subscribe to our Newsletter</h3>
            <p class="text-sm">Pellentesque eu nibh eget mauris congue mattis mattis nec tellus. Phasellus imperdiet elit eu magna.</p>
        </div>
        <div class="col-span-3 flex justify-end items-center">
            <div class="w-full flex justify-end relative">
                <input placeholder="Your email address" class="rounded-full border-neutral-300 w-11/12"/>
                <button class="absolute text-white bg-[#00B207] px-7 rounded-full text-sm right-0 inset-y-0 flex items-center">Subscribe</button>
            </div>
            <ul class="flex text-neutral-700">
                <a href="#"><i class="ml-6 fa-brands fa-facebook-f hover:bg-[#00B207] hover:text-white w-8 h-8 flex justify-center items-center rounded-full text-lg transition ease-in-out duration-150"></i></a>
                <a href="#"><i class="ml-2 fa-brands fa-x-twitter hover:bg-[#00B207] hover:text-white w-8 h-8 flex justify-center items-center rounded-full text-lg transition ease-in-out duration-150"></i></a>
                <a href="#"><i class="ml-2 fa-brands fa-threads hover:bg-[#00B207] hover:text-white w-8 h-8 flex justify-center items-center rounded-full text-lg transition ease-in-out duration-150"></i></a>
                <a href="#"><i class="ml-2 fa-brands fa-instagram hover:bg-[#00B207] hover:text-white w-8 h-8 flex justify-center items-center rounded-full text-lg transition ease-in-out duration-150"></i></a>
            </ul>
        </div>
    </div>
    <footer class="bg-[#1A1A1A] text-white px-64">
        <div class="grid grid-cols-7 py-10">
            <div class="col-span-2">
                <h3 class="text-3xl mb-5">AgroShop</h3>
                <p class="text-sm mb-5">Morbi cursus porttitor enim lobortis molestie. Duis gravida turpis dui, eget bibendum magna congue nec.</p>
                
                <div class="flex">
                    <p class="border-b-2 w-auto border-[#20B526] mr-3 py-2 text-sm">(219) 555-0114</p>
                    <p class="mr-3 py-2">or</p>
                    <p class="border-b-2 w-auto border-[#20B526] py-2 text-sm">agroshop@gmail.com</p>
                </div>
            </div>
            <div class="col-span-1"></div>
            <div class="col-span-1 flex flex-col">
                <h4 class="mb-3">My Account</h4>
                <a href="#" class="text-sm text-neutral-300 hover:text-white leading-7 transition ease-in-out duration-150">Profile</a>
                <a href="#" class="text-sm text-neutral-300 hover:text-white leading-7 transition ease-in-out duration-150">Order History</a>
                <a href="#" class="text-sm text-neutral-300 hover:text-white leading-7 transition ease-in-out duration-150">Shopping Cart</a>
                <a href="#" class="text-sm text-neutral-300 hover:text-white leading-7 transition ease-in-out duration-150">Your Shops</a>
            </div>
            <div class="col-span-1 flex flex-col">
                <h4 class="mb-3">Support</h4>
                <a href="#" class="text-sm text-neutral-300 hover:text-white leading-7 transition ease-in-out duration-150">Contact Us</a>
                <a href="#" class="text-sm text-neutral-300 hover:text-white leading-7 transition ease-in-out duration-150">FAQs</a>
                <a href="#" class="text-sm text-neutral-300 hover:text-white leading-7 transition ease-in-out duration-150">Terms & Condition</a>
                <a href="#" class="text-sm text-neutral-300 hover:text-white leading-7 transition ease-in-out duration-150">Privacy Policy</a>
            </div>
            <div class="col-span-1 flex flex-col">
                <h4 class="mb-3">Proxy</h4>
                <a href="#" class="text-sm text-neutral-300 hover:text-white leading-7 transition ease-in-out duration-150">About</a>
                <a href="#" class="text-sm text-neutral-300 hover:text-white leading-7 transition ease-in-out duration-150">Shop</a>
                <a href="#" class="text-sm text-neutral-300 hover:text-white leading-7 transition ease-in-out duration-150">Product</a>
                <a href="#" class="text-sm text-neutral-300 hover:text-white leading-7 transition ease-in-out duration-150">Track Order</a>
            </div>
            <div class="col-span-1 flex flex-col">
                <h4 class="mb-3">Categories</h4>
                <a href="#" class="text-sm text-neutral-300 hover:text-white leading-7 transition ease-in-out duration-150">Farm Equipments</a>
                <a href="#" class="text-sm text-neutral-300 hover:text-white leading-7 transition ease-in-out duration-150">Fresh Produce</a>
                <a href="#" class="text-sm text-neutral-300 hover:text-white leading-7 transition ease-in-out duration-150">Livestock</a>
                <a href="#" class="text-sm text-neutral-300 hover:text-white leading-7 transition ease-in-out duration-150">Plants and Seeds</a>
            </div>
        </div>
        <hr class="border-neutral-700"></hr>
        <div class="py-3 flex justify-between items-center">
            <p class="text-sm text-neutral-500">Ibañez eCommerce © 2024 All Rights Reserved</p>
            <img src="images/footer-cards.png"/>
        </div>
    </footer>
    <script src="js/passwordToggle.js"></script>
</body>
</html>