<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$product->product_name}}</title>
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
                            <a
                                href="{{ route('show-transact') }}"
                                class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:opacity-50 focus:outline-none focus-visible:ring-[#FF2D20] dark:focus-visible:ring-white"
                            >
                                Purchases
                            </a>
                            <div class="border-l my-1.5 opacity-50"></div>
                            <a
                            href="{{ route('profile') }}"
                                class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:opacity-50 focus:outline-none focus-visible:ring-[#FF2D20] dark:focus-visible:ring-white"
                            >
                                <div class="flex items-center">
                                    <img src="{{ asset('storage/users/' . Auth::user()->image_url)}}" class="size-5 rounded-full mr-1.5">
                                    <p>{{Auth::user()->username}}</p>
                                </div>
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
                    <div class="flex items-center">
                        <img src="{{asset('images/logo.png')}}" class="size-10 mr-3">
                        <p class="text-2xl font-bold">Agronex</p>
                    </div>
                    <div class="relative w-7/12 flex justify-center">
                        <input type="text" placeholder="Search for Products"
                            class="w-full transition ease-in-out duration-300 focus:ring-0 focus:border-slate-500 rounded-sm border-slate-300">
                        <div class="absolute inset-y-0 right-0 pr-1 flex items-center">
                            <button class="text-white bg-[#259B00] px-5 py-1 rounded-sm">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </div>
                    <div class="relative">
                        <a href="{{route('manage-cart')}}"><i class="fa-solid fa-cart-shopping text-2xl"></i></a>
                        @if(Auth::user())
                        <p class="absolute -top-2 -right-2 bg-[#259B00] text-white text-sm leading-none size-4 text-center rounded-full">{{$shopcart->total_items}}</p>
                        @endif
                    </div>
                </div>
                <hr>
                </hr>

            </div>
        </div>

        {{-- Product Details --}}
        <div class="mx-48 bg-white my-5 p-5 flex flex-row rounded-md shadow">
            <div class="w-5/12 pr-7">
                <img class="w-full h-96 object-cover rounded-md"
                    src="{{asset('storage/products/' . $product->product_image_url)}}" />
            </div>
            <div class="flex flex-col pl-5 w-7/12">
                <form method="POST" action="{{route('store-cart', $product->id)}}">
                    @csrf
                    <h1 class="font-bold text-xl">{{ $product->product_name }}</h1>
                    <div class="flex mt-2 items-center h-7">
                        <p>
                            {{$product->product_rating}}
                        </p>
                        <div class="star-outer relative mx-1.5 text-2xl">
                            <div class="star-inner absolute top-0 overflow-hidden"></div>
                        </div>
                        <div class="h-full w-[1px] bg-neutral-300 mx-3"></div>
                        <p class="">{{$no_of_ratings}} Ratings</p>
                        <div class="h-full w-[1px] bg-neutral-300 mx-3"></div>
                        <p class="">{{$product->items_sold}} Sold</p>
                    </div>
                    <h2 class="mt-3 text-3xl font-semibold text-[#018f07]">₱ {{ $product->price }}</h2>
                    <div class="flex flex-col mt-10">
                        <div class="flex mb-5 w-full">
                            <p class="w-1/6 text-neutral-500">Protection</p>
                            <p>Merchandise Protection</p>
                        </div>
                        <div class="flex mb-5 w-full">
                            <p class="w-1/6 text-neutral-500">Shipping</p>
                            <div class="flex flex-col w-6/12">
                                <div class="flex mb-2">
                                    <p class="text-neutral-500 w-4/12">To</p>

                                    @auth
                                    {{-- Display Shipping --}}
                                    <p class="w-1/2">{{Auth::user()->address}}</p>
                                    @else
                                    <a class="underline hover:text-neutral-500 transition ease-in-out duration-150"
                                        href="{{route('login')}}">Login to View</a>
                                    @endauth
                                </div>
                                <div class="flex">
                                    <p class="text-neutral-500 w-4/12">From</p>
                                    @auth
                                    {{-- Display Shipping --}}
                                    <p> {{$product->merchant->city}}, {{$product->merchant->country}} </p>
                                    @else

                                    @endauth
                                </div>

                            </div>

                        </div>
                        <div class="flex mb-5 w-full">
                            <p class="w-1/6 text-neutral-500">Category</p>
                            <p> {{$product->tag->tag_name}} </p>
                        </div>
                        <div class="flex mb-5 w-full items-center">
                            <p class="w-1/6 text-neutral-500">Quantity</p>
                            @auth
                                @if($product->merchant->user_id != Auth::user()->id)
                                <div class="flex items-center mr-5">
                                @else
                                <div class="flex items-center mr-5 hidden">
                                @endif
                            @else
                                <div class="flex items-center mr-5">
                            @endauth
                            
                                <button id="minus-btn" type="button"
                                    class="w-10 border hover:border-neutral-700 transition ease-in-out duration-150 h-8 border-neutral-300">-</button>
                                <input type="number" name="quantity" id="quantity-input"
                                    class="quantity-counter border-neutral-300 focus:border-neutral-700 text-center w-20 h-8"
                                    value="1" min="1" max="{{$product->no_of_stocks}}"
                                    oninput="validateQuantity(this)" />
                                <button id="plus-btn" type="button"
                                    class="size-10 border hover:border-neutral-700 transition ease-in-out duration-150 h-8 border-neutral-300">+</button>
                            </div>
                            <p class="text-neutral-500">{{$product->no_of_stocks}} pieces available</p>
                        </div>
                    </div>
                    <div class="flex mt-3">
                        {{-- Might have to check if this works with the input above, otherwise wrap in form, styling for
                        now --}}
                        @auth
                        @if($product->merchant->user_id != Auth::user()->id)
                        <button value="add_to_cart" type="submit" name="action"
                            class="w-34 text-center border-[#018f07] border bg-[#d1edd3] hover:bg-[#e4ede4] transition ease-in-out duration-150 px-10 py-2.5 mr-3 text-[#018f07]">
                            Add to Cart
                        </button>
                        <button value="buy_now" type="submit" name="action"
                            class="w-40 text-center border-[#259B00] bg-[#259B00] hover:bg-[#2FB605] transition ease-in-out duration-150 text-white border px-10 py-2.5">
                            Buy Now
                        </button>
                        @else

                        <a href="{{route('edit-product', [$product->id, $product->merchant->id])}}"
                            class="w-34 text-center border-[#018f07] border bg-[#d1edd3] hover:bg-[#e4ede4] transition ease-in-out duration-150 px-10 py-2.5 mr-3 text-[#018f07]">
                            <i class="fa-regular fa-pen-to-square text-lg mr-2.5"></i>Edit Product
                        </a>
                        @endif
                        @else
                        <a href="{{route('login')}}"
                            class="w-34 text-center border-[#018f07] border bg-[#d1edd3] hover:bg-[#e4ede4] transition ease-in-out duration-150 px-10 py-2.5 mr-3 text-[#018f07]">
                            Add to Cart
                        </a>
                        <a href="{{route('login')}}"
                            class="w-40 text-center border-[#259B00] bg-[#259B00] hover:bg-[#2FB605] transition ease-in-out duration-150 text-white border px-10 py-2.5">
                            Buy Now
                        </a>
                        @endauth
                        
                    </div>
                    @if (session('message'))
                        <div
                            class="inline-flex w-full items-center rounded-lg bg-success-100 py-5 text-base text-green-700"
                            role="alert">
                            <span class="mr-2">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                fill="currentColor"
                                class="h-5 w-5">
                                <path
                                fill-rule="evenodd"
                                d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z"
                                clip-rule="evenodd" />
                            </svg>
                            </span>
                            {{ session('message') }}
                        </div>
                        @endif
                </form>
            </div>
        </div>

        {{-- Merchant Details --}}
        <div class="mx-48 bg-white my-5 p-5 rounded-md shadow">
            <div class="flex w-full">
                <div class="flex items-center">
                    @if($product->merchant->image_url == null)
                    <img src="{{asset('storage/merchants/unknown.jpg')}}" class="size-24 rounded-full object-cover border mr-5" />
                    @else
                    <img src="{{asset('storage/merchants/' . $product->merchant->image_url)}}"
                        class="size-24 rounded-full border mr-5 object-cover" />
                    @endif
                    <div>
                        <p class="font-semibold">{{$product->merchant->store_name}}</p>
                        {{-- Might need to change this for functionality --}}
                        <div class="flex mt-3">
                            {{-- Might have to check if this works with the input above, otherwise wrap in form, styling
                            for now --}}
                            @auth
                            @if($product->merchant->user_id != Auth::user()->id)
                            <a href="#"
                                class="w-24 px-1.5 py-1 text-sm text-center border-[#018f07] border bg-[#d1edd3] hover:bg-[#e4ede4] transition ease-in-out duration-150 mr-3 text-[#018f07]">
                                Chat Now
                            </a>
                            <a href="{{route('view-shop', $product->merchant->id)}}"
                                class="w-24 px-1.5 py-1 text-sm text-center border-[#259B00] bg-white hover:text-white hover:bg-[#2FB605] transition ease-in-out duration-150 text-black border">
                                View Shop
                            </a>
                            @else
                            <a href="{{route('manage-shop', $product->merchant->id)}}"
                                class="w-36 px-1.5 py-1 text-sm text-center border-[#018f07] border bg-[#d1edd3] hover:bg-[#e4ede4] transition ease-in-out duration-150 mr-3 text-[#018f07]">
                                Manage Shop
                            </a>
                            @endif
                            @else
                            <a href="#"
                                class="w-24 px-1.5 py-1 text-sm text-center border-[#018f07] border bg-[#d1edd3] hover:bg-[#e4ede4] transition ease-in-out duration-150 mr-3 text-[#018f07]">
                                Chat Now
                            </a>
                            <a href="{{route('view-shop', $product->merchant->id)}}"
                                class="w-24 px-1.5 py-1 text-sm text-center border-[#259B00] bg-white hover:text-white hover:bg-[#2FB605] transition ease-in-out duration-150 text-black border">
                                View Shop
                            </a>
                            @endauth
                        </div>
                    </div>
                </div>
                <div class="border-l mx-6"></div>
                <div class="w-7/12 py-3 grid grid-cols-3 gap-x-12 text-sm items-center">
                    <div class="col-span-1 flex justify-between">
                        <p>Rating</p>
                        <p class="text-[#018f07]">{{$product->merchant->merchant_rating}}</p>
                    </div>
                    <div class="col-span-1 flex justify-between">
                        <p>City</p>
                        <p class="text-[#018f07]">{{$product->merchant->city}}</p>
                    </div>
                    <div class="col-span-1 flex justify-between">
                        <p>State</p>
                        <p class="text-[#018f07]">Neg Occ</p>
                    </div>
                    <div class="col-span-1 flex justify-between">
                        <p>Products</p>
                        <p class="text-[#018f07]">{{$product->merchant->no_of_products}}</p>
                    </div>
                    <div class="col-span-1 flex justify-between">
                        <p>Country</p>
                        <p class="text-[#018f07]">{{$product->merchant->country}}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mx-48 bg-white my-3 px-5 py-7 rounded-md shadow">
            <h3 class="text-xl mb-3.5">Product Description</h3>
            <p>@nl2br($product->description)</p>
        </div>

        <div class="mx-48 bg-white my-3 px-5 py-7 rounded-md shadow">
            <h3 class="text-xl mb-3.5">Product Ratings</h3>
            <div class="flex">
                <div
                    class="w-1/6 bg-neutral-100 py-5 rounded-md text-center justify-center items-center flex flex-col mr-5">
                    <h1 class="text-4xl rating-average" data-rating="{{$product->product_rating}}"></h1>    
                    <div class="star-outer relative text-2xl">
                        <div class="star-inner absolute top-0 overflow-hidden"></div>
                    </div>
                    <p>{{$no_of_ratings}}</p>
                </div>
                <div class="rating-progress w-2/6">

                </div>
            </div>

            @forelse($reviews as $review)
            @php
            $emptyStars = 5 - $review->rating;
            @endphp
            <div class="border-b py-7 flex">
                <img class="w-10 h-10 object-cover rounded-full mr-5"
                    src=" {{asset('storage/users/' . $review->user->image_url)}} " />
                <div class="w-full">
                    @auth
                        @if($review->user->id == Auth::user()->id)
                            <div class="flex justify-between items-center w-full">
                                <div>
                                    <p>You</p>
                                    <p class="text-sm text-neutral-600">{{$review->created_at->translatedFormat('m/d/Y, h:i A')}}</p>
                                </div>
                                <div>
                                    <a href="{{route('edit-review', $product->id)}}"><i class="transition ease-in-out fa-solid fa-pen-to-square text-xl mr-5 hover:opacity-80" style="color:rgb(87, 87, 87)"></i></a>
                                    <a href="{{route('delete-review', $review->id)}}"><i class="fa-solid fa-trash pr-5 text-xl hover:opacity-80 transition ease-in-out" style="color:rgb(87, 87, 87)"></i></a>
                                </div>
                                
                            </div>
                            
                        @else
                            <p>{{$review->user->username}}</p>
                        @endif
                    @else
                        <p>{{$review->user->username}}</p>
                    @endauth
                    
                    @for($i = 0; $i < $review->rating; $i++)
                        <i class="fa-solid fa-star text-xs" style="color: #FFD43B"></i>
                        @endfor
                        @for($i = 0; $i < $emptyStars; $i++) <i class="fa-regular fa-star text-xs"
                            style="color: #FFD43B"></i>
                            @endfor

                            <p class="mt-3"> {{$review->review_text}} </p>
                </div>
            </div>
            @empty
            <p class="mt-10">No reviews available. Purchase this product to review!</p>
            @endforelse
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
    @if($ratings->has(5))
        @php
        $five_stars = $ratings->get(5)->count;
        @endphp
    @else
        @php
        $five_stars = 0;
        @endphp
    @endif
    @if($ratings->has(4))
        @php
        $four_stars = $ratings->get(4)->count;
        @endphp
    @else
        @php
        $four_stars = 0;
        @endphp
    @endif
    @if($ratings->has(3))
        @php
        $three_stars = $ratings->get(3)->count;
        @endphp
    @else
        @php
        $three_stars = 0;
        @endphp
    @endif
    @if($ratings->has(2))
        @php
        $two_stars = $ratings->get(2)->count;
        @endphp
    @else
        @php
        $two_stars = 0;
        @endphp
    @endif
    @if($ratings->has(1))
        @php
        $one_stars = $ratings->get(1)->count;
        @endphp
    @else
        @php
        $one_stars = 0;
        @endphp
    @endif

    <script>
        let avg_rating = {{ $product->product_rating }};

        let data = [
            {
                'star': 5,
                'count': {{ $five_stars }} 
            },
            {
                'star': 4,
                'count': {{ $four_stars }}
            },
            {
                'star': 3,
                'count': {{ $three_stars }}
            },
            {
                'star': 2,
                'count': {{ $two_stars }}
            },
            {
                'star': 1,
                'count': {{ $one_stars }}
            },   
        ];

        const totalCount = data.reduce((sum, rating) => sum + rating.count, 0);

        data.forEach(rating => {
            const barWidth = (rating.count / totalCount) * 100; // Calculate the bar width as a percentage
            let barWidthValue = barWidth;

            if (rating.count == 0) {
                barWidthValue = 0
            }


            let ratingProgress = `
                <div class="rating-progress-value gap-x-4 grid grid-cols-6 items-center justify-between">
                    <p class="text-lg">${rating.star} <span class="star text-2xl text-[#FFD43B]">&#9733;</span></p>
                    <div class="progress col-span-4 h-2.5 bg-neutral-400 rounded-full">
                        <div class="bar h-full bg-[#FFD43B] rounded-full" style="width: ${barWidthValue}%;"></div>
                    </div>
                    <p>${rating.count.toLocaleString()}</p>
                </div>
            `;
            document.querySelector('.rating-progress').innerHTML += ratingProgress;
        });
        const ratingElement = document.querySelector('.rating-average');
        const rating = Number(ratingElement.dataset.rating);
        const formattedRating = rating.toFixed(1);
        ratingElement.innerHTML = formattedRating.toLocaleString();
        const starInners = document.querySelectorAll('.star-inner');
        starInners.forEach(starInner => {
            starInner.style.width = (avg_rating / 5) * 100 + "%";
        });
    </script>
    <script src="{{ asset('js/quantityCounter.js')}}"></script>
</body>

</html>