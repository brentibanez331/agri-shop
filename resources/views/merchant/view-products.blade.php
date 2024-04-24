<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        @vite('resources/css/app.css')
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <script src="https://kit.fontawesome.com/7fd7203ef6.js" crossorigin="anonymous"></script>
    </head>
    <body class="font-sans antialiased">
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
                                <a
                                    href="{{ route('show-transact') }}"
                                    class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:opacity-50 focus:outline-none focus-visible:ring-[#FF2D20] dark:focus-visible:ring-white"
                                >
                                    Purchases
                                </a>
                                <div class="border-l my-1.5 opacity-50"></div>
                                <a
                                href="{{ url('/dashboard') }}"
                                class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:opacity-50 focus:outline-none focus-visible:ring-[#FF2D20] dark:focus-visible:ring-white"
                            >
                                <div class="flex items-center">
                                    <img src="{{ asset('storage/users/' . Auth::user()->image_url)}}" class="size-5 rounded-full mr-1.5">
                                    <p>{{Auth::user()->username}}</p>
                                </div>
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
                    <div class="my-5 mx-48 flex justify-between items-center">
                        <p class="text-xl font-bold">AgroShop</p>
                        <div class="relative w-7/12 flex justify-center">
                            <input type="text" placeholder="Search for Products" class="w-full transition ease-in-out duration-300 focus:ring-0 focus:border-slate-500 rounded-sm border-slate-300" >
                            <div class="absolute inset-y-0 right-0 pr-1 flex items-center">
                                <button class="text-white bg-[#259B00] px-5 py-1 rounded-sm">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                        </div>
                        <div class="relative">
                            <a href="{{route('manage-cart')}}"><i class="fa-solid fa-cart-shopping text-2xl"></i></a>
                            @auth
                                <p class="absolute -top-2 -right-2 bg-[#259B00] text-white text-sm leading-none size-4 text-center rounded-full">{{$shopcart->total_items}}</p>    
                            @endauth
                            
                        </div>
                    </div>
                    <hr></hr>
                    
                </div>
            </div>

            <div class="px-48 py-10 w-full bg-white">
                <div class="grid grid-cols-7">
                    <div class="flex items-center col-span-3">
                        <img src="{{ asset('storage/merchants/' . $merchant->image_url) }}" class="mr-7 size-20 rounded-full object-cover border shadow">
                        <div>
                        <p class="text-2xl mb-4 font-semibold"> {{$merchant->store_name}} </p>
                        <a href="#"
                                    class="px-10 py-2 text-center border-[#018f07] border bg-[#d1edd3] hover:bg-[#e4ede4] transition ease-in-out duration-150 mr-3 text-[#018f07]">
                                    Chat Now
                                </a>
                            </div>
                    </div>
                    <div class="grid grid-rows-3 gap-3 col-span-2">
                        <p>Products: <span class="text-[#018f07]">{{$merchant->no_of_products}}</span></p>
                        <p>Rating: <span class="text-[#018f07]">{{$merchant->merchant_rating}} out of 5</span></p>
                        <p>Reviews: <span class="text-[#018f07]">{{$no_of_ratings}}</span></p>
                    </div>
                    <div class="grid grid-rows-3 gap-3 col-span-2">
                        <p>Location: <span class="text-[#018f07]"> {{$merchant->city}}, {{$merchant->country}}</span></p>
                        <p>State: <span class="text-[#018f07]">{{$merchant->state}}</span></p>
                        <p>Joined: <span class="text-[#018f07]">{{$merchant->created_at->format('m/d/Y')}}</span></p>
                    </div>
                </div>
                
            </div>

            {{-- Product Contents --}}
            <div class="bg-[#f5f5f5] py-10">
            <div class="grid grid-cols-6 mx-48 gap-4 my-7 ">
                @foreach ($products as $product)
                    <a href="{{ route("product", $product->id) }}">
                        <div class="border bg-white hover:border-[#00B207] hover:-translate-y-px transition ease-in-out duration-150">
                            <img src="{{ asset('storage/products/' . $product->product_image_url) }}" alt="{{ $product->product_name }}" class="h-48 w-full object-cover">
                            <div class="p-3">
                                <p class="text-sm h-10">{{ truncateString($product->product_name) }}</p>
                                <p class="text-sm mt-2 text-[#018f07]">₱ <span class="text-lg">{{ $product->price }}</span></p>
                                <div class="flex flex-row items-center">
                                    <div class="star-outer relative mr-1.5">
                                        <div class="star-inner-{{$product->id}} absolute h-full top-0 overflow-hidden" style=""></div>
                                    </div>
                                    <p class="text-sm ml-2">{{$product->items_sold}} Sold</p>
                                </div>
                                <div class="flex items-center mt-1.5">
                                    <i class="fa-solid fa-location-dot mr-1.5" style="color: #797979;"></i>
                                    <p class="text-xs text-[#797979]">{{ $product->merchant->city }}, {{ $product->merchant->country }}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                    <style>
                        .star-inner-{{$product->id}}::before{
                            content: "\2605 \2605 \2605 \2605 \2605";
                            color: #FFD43B;
                        }
                    </style>
                    <script>
                        function setStarRating(avgRating, starInnerElement) {
                            const width = (avgRating / 5) * 100 + "%";
                            starInnerElement.style.width = width;
                        }
                        
                        setStarRating({{ $product->product_rating }}, document.querySelector('.star-inner-{{$product->id}}'));
                    </script>
                @endforeach
            </div>
        </div>

            {{-- Newsletter --}}
            <div class="items-center bg-[#E6E6E6] px-48 py-7 grid grid-cols-5">
                <div class="col-span-2">
                    <h3 class="font-bold text-2xl">Subscribe to our Newsletter</h3>
                    <p class="text-sm">Pellentesque eu nibh eget mauris congue mattis mattis nec tellus. Phasellus imperdiet elit eu magna.</p>
                </div>
                <div class="col-span-3 flex justify-end items-center">
                    <div class="w-full flex justify-end relative">
                        <input placeholder="Your email address" class="rounded-full border-neutral-300 w-11/12"/>
                        <button class="absolute text-white bg-[#00B207] px-7 rounded-full text-sm right-0 inset-y-0 flex items-center">Subscribe</button>
                    </div>
                    <div class="flex text-neutral-700">
                        <a href="#" class="ml-6 hover:bg-[#00B207] hover:text-white w-8 h-8 flex justify-center items-center rounded-full text-lg transition ease-in-out duration-150"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#" class="ml-2 hover:bg-[#00B207] hover:text-white w-8 h-8 flex justify-center items-center rounded-full text-lg transition ease-in-out duration-150"><i class="fa-brands fa-x-twitter"></i></a>
                        <a href="#" class="ml-2 hover:bg-[#00B207] hover:text-white w-8 h-8 flex justify-center items-center rounded-full text-lg transition ease-in-out duration-150"><i class="fa-brands fa-threads"></i></a>
                        <a href="#" class="ml-2 hover:bg-[#00B207] hover:text-white w-8 h-8 flex justify-center items-center rounded-full text-lg transition ease-in-out duration-150"><i class="fa-brands fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <footer class="bg-[#1A1A1A] text-white px-48">
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
            
        </div>
    </body>
</html>
