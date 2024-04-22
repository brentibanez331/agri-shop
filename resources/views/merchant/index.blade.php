<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Shops</title>
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/7fd7203ef6.js" crossorigin="anonymous"></script>
</head>

<body class="bg-[#f5f5f5]">
    <div class="">
        <div class="relative flex flex-col items-center">
            <div class="relative w-full">
                <header class="bg-gradient-to-b from-[#259B00] from-90% to-[#2FB605]">
                    <div class="mx-48">
                        @if (Route::has('login'))
                        <nav class="-mx-3 flex flex-1 justify-end">
                            @auth
                            <a
                                        href="{{ route('welcome') }}"
                                        class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:opacity-50 focus:outline-none focus-visible:ring-[#FF2D20] dark:focus-visible:ring-white"
                                    >
                                        Home
                                    </a>
                                    <div class="border-l my-1.5 opacity-50"></div>
                            <a
                                        href="{{ route('your-shop') }}"
                                        class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:opacity-50 focus:outline-none focus-visible:ring-[#FF2D20] dark:focus-visible:ring-white"
                                    >
                                        My Stores
                                    </a>
                                    <div class="border-l my-1.5 opacity-50"></div>
                            <a href="{{ url('/dashboard') }}"
                                class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:opacity-50 focus:outline-none focus-visible:ring-[#FF2D20] dark:focus-visible:ring-white">
                                Dashboard
                            </a>
                            @else
                            @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="rounded-md text-sm px-5 py-2 text-white ring-1 ring-transparent transition hover:opacity-50 focus:outline-none focus-visible:ring-[#FF2D20] dark:focus-visible:ring-white">
                                Signup
                            </a>
                            @endif
                            <a href="{{ route('login') }}"
                                class="rounded-md text-sm px-3 py-2 text-white ring-1 ring-transparent transition hover:opacity-50 focus:outline-none focus-visible:ring-[#FF2D20] dark:focus-visible:ring-white">
                                Login
                            </a>


                            @endauth
                        </nav>
                        @endif
                    </div>
                </header>
                <div class="my-5 mx-48 flex justify-between items-center">
                    <p class="text-xl font-bold">AgroShop</p>
                    <div class="relative w-7/12 flex justify-center">
                        <input type="text" placeholder="Search for Products"
                            class="w-full transition ease-in-out duration-300 focus:ring-0 focus:border-slate-500 rounded-sm border-slate-300">
                        <div class="absolute inset-y-0 right-0 pr-1 flex items-center">
                            <button class="text-white bg-[#259B00] px-5 py-1 rounded-sm">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </div>
                    <a href="#"><i class="fa-solid fa-cart-shopping text-2xl"></i></a>
                </div>
                <hr>
                </hr>
            </div>
        </div>

        <div class="mx-48 my-5 flex justify-end"><a href="{{route('add-shop')}}" class="bg-[#259B00] px-4 py-1 rounded-full hover:opacity-70 transition ease-in-out text-white">+ Create E-Shop</a></div>
        {{-- Shops --}}
        <div class="mx-48 my-7 grid grid-cols-3 gap-10">
            @foreach ($shops as $shop)
            <div class="border flex flex-col justify-center items-center py-7 rounded-md bg-white shadow hover:-translate-y-0.5 transition ease-in-out duration-150">
                @if($shop->image_url == null)
                    <img src="{{ asset('storage/merchants/unknown.jpg') }}" class="rounded-full size-40 object-cover shadow" />
                @else
                    <img src="{{ asset('storage/merchants/' . $shop->image_url) }}" class="rounded-full size-40 object-cover shadow" />
                @endif
                
                <div class="flex flex-col items-center pt-5">
                    <h2 class="font-semibold text-2xl">{{ $shop->store_name }}</h2>
                    <p>{{ $shop->merchant_rating }}</p>
                    @php
                    $emptyStars = 5 - $shop->merchant_rating;
                    @endphp
                    <div class="flex">
                        @for($i = 0; $i < $shop->merchant_rating; $i++)
                            <i class="fa-solid fa-star text-sm" style="color: #FFD43B"></i>
                            @endfor
                            @for($i = 0; $i < $emptyStars; $i++) <i class="fa-regular fa-star text-sm"
                                style="color: #000"></i>
                                @endfor
                    </div>
                    <a href="{{ route('manage-shop', $shop->id) }}" class="mt-5 bg-[#00B207] hover:opacity-70 text-white w-40 transition ease-in-out duration-150 text-center px-7 py-1.5 rounded-full">Manage</a>
                    <a href="{{ route('edit-shop', $shop->id) }}" class="mt-2 border border-[#00B207] text-[#00B207] w-40 transition ease-in-out duration-150 hover:bg-[#e9f2e9] text-center px-7 py-1.5 rounded-full">Edit Shop</a>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Newsletter --}}
        <div class="items-center bg-[#E6E6E6] px-48 py-7 grid grid-cols-5">
            <div class="col-span-2">
                <h3 class="font-bold text-2xl">Subscribe to our Newsletter</h3>
                <p class="text-sm">Pellentesque eu nibh eget mauris congue mattis mattis nec tellus. Phasellus imperdiet
                    elit eu magna.</p>
            </div>
            <div class="col-span-3 flex justify-end items-center">
                <div class="w-full flex justify-end relative">
                    <input placeholder="Your email address" class="rounded-full border-neutral-300 w-11/12" />
                    <button
                        class="absolute text-white bg-[#00B207] px-7 rounded-full text-sm right-0 inset-y-0 flex items-center">Subscribe</button>
                </div>
                <div class="flex text-neutral-700">
                    <a href="#"
                        class="ml-6 hover:bg-[#00B207] hover:text-white w-8 h-8 flex justify-center items-center rounded-full text-lg transition ease-in-out duration-150"><i
                            class="fa-brands fa-facebook-f"></i></a>
                    <a href="#"
                        class="ml-2 hover:bg-[#00B207] hover:text-white w-8 h-8 flex justify-center items-center rounded-full text-lg transition ease-in-out duration-150"><i
                            class="fa-brands fa-x-twitter"></i></a>
                    <a href="#"
                        class="ml-2 hover:bg-[#00B207] hover:text-white w-8 h-8 flex justify-center items-center rounded-full text-lg transition ease-in-out duration-150"><i
                            class="fa-brands fa-threads"></i></a>
                    <a href="#"
                        class="ml-2 hover:bg-[#00B207] hover:text-white w-8 h-8 flex justify-center items-center rounded-full text-lg transition ease-in-out duration-150"><i
                            class="fa-brands fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <footer class="bg-[#1A1A1A] text-white px-48">
            <div class="grid grid-cols-7 py-10">
                <div class="col-span-2">
                    <h3 class="text-3xl mb-5">AgroShop</h3>
                    <p class="text-sm mb-5">Morbi cursus porttitor enim lobortis molestie. Duis gravida turpis dui, eget
                        bibendum magna congue nec.</p>

                    <div class="flex">
                        <p class="border-b-2 w-auto border-[#20B526] mr-3 py-2 text-sm">(219) 555-0114</p>
                        <p class="mr-3 py-2">or</p>
                        <p class="border-b-2 w-auto border-[#20B526] py-2 text-sm">agroshop@gmail.com</p>
                    </div>
                </div>
                <div class="col-span-1"></div>
                <div class="col-span-1 flex flex-col">
                    <h4 class="mb-3">My Account</h4>
                    <a href="#"
                        class="text-sm text-neutral-300 hover:text-white leading-7 transition ease-in-out duration-150">Profile</a>
                    <a href="#"
                        class="text-sm text-neutral-300 hover:text-white leading-7 transition ease-in-out duration-150">Order
                        History</a>
                    <a href="#"
                        class="text-sm text-neutral-300 hover:text-white leading-7 transition ease-in-out duration-150">Shopping
                        Cart</a>
                    <a href="#"
                        class="text-sm text-neutral-300 hover:text-white leading-7 transition ease-in-out duration-150">Your
                        Shops</a>
                </div>
                <div class="col-span-1 flex flex-col">
                    <h4 class="mb-3">Support</h4>
                    <a href="#"
                        class="text-sm text-neutral-300 hover:text-white leading-7 transition ease-in-out duration-150">Contact
                        Us</a>
                    <a href="#"
                        class="text-sm text-neutral-300 hover:text-white leading-7 transition ease-in-out duration-150">FAQs</a>
                    <a href="#"
                        class="text-sm text-neutral-300 hover:text-white leading-7 transition ease-in-out duration-150">Terms
                        & Condition</a>
                    <a href="#"
                        class="text-sm text-neutral-300 hover:text-white leading-7 transition ease-in-out duration-150">Privacy
                        Policy</a>
                </div>
                <div class="col-span-1 flex flex-col">
                    <h4 class="mb-3">Proxy</h4>
                    <a href="#"
                        class="text-sm text-neutral-300 hover:text-white leading-7 transition ease-in-out duration-150">About</a>
                    <a href="#"
                        class="text-sm text-neutral-300 hover:text-white leading-7 transition ease-in-out duration-150">Shop</a>
                    <a href="#"
                        class="text-sm text-neutral-300 hover:text-white leading-7 transition ease-in-out duration-150">Product</a>
                    <a href="#"
                        class="text-sm text-neutral-300 hover:text-white leading-7 transition ease-in-out duration-150">Track
                        Order</a>
                </div>
                <div class="col-span-1 flex flex-col">
                    <h4 class="mb-3">Categories</h4>
                    <a href="#"
                        class="text-sm text-neutral-300 hover:text-white leading-7 transition ease-in-out duration-150">Farm
                        Equipments</a>
                    <a href="#"
                        class="text-sm text-neutral-300 hover:text-white leading-7 transition ease-in-out duration-150">Fresh
                        Produce</a>
                    <a href="#"
                        class="text-sm text-neutral-300 hover:text-white leading-7 transition ease-in-out duration-150">Livestock</a>
                    <a href="#"
                        class="text-sm text-neutral-300 hover:text-white leading-7 transition ease-in-out duration-150">Plants
                        and Seeds</a>
                </div>
            </div>
            <hr class="border-neutral-700">
            </hr>
            <div class="py-3 flex justify-between items-center">
                <p class="text-sm text-neutral-500">Ibañez eCommerce © 2024 All Rights Reserved</p>
                <img src="{{asset('images/footer-cards.png')}}" />
            </div>
        </footer>

    </div>
    <script src="{{ asset('js/quantityCounter.js')}}"></script>
</body>

</html>