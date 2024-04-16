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
                    <div class="mx-64">
                        @if (Route::has('login'))
                        <nav class="-mx-3 flex flex-1 justify-end">
                            @auth
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
                <div class="my-5 mx-64 flex justify-between items-center">
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

        {{-- Product Details --}}
        <div class="mx-64 bg-white my-5 p-5 flex flex-row rounded-md shadow">
            <div class="w-5/12 pr-7">
                <img class="w-full h-96 object-cover" src="{{asset( 'products/' . $product->product_image_url)}}" />
            </div>
            <div class="flex flex-col">
                <h1 class="font-bold text-xl">{{$product->product_name}}</h1>
                <div class="flex mt-2 items-center">
                    <p>
                        {{$product->product_rating}}
                    </p>
                    <div class="flex flex-row items-center ml-2">
                        <i class="fa-regular fa-star mr-0.5"></i>
                        <i class="fa-regular fa-star mr-0.5"></i>
                        <i class="fa-regular fa-star mr-0.5"></i>
                        <i class="fa-regular fa-star mr-0.5"></i>
                        <i class="fa-regular fa-star mr-0.5"></i>

                    </div>
                    <div class="h-full w-[1px] bg-neutral-300 mx-3"></div>
                    <p class="">{{$noOfRatings}} Ratings</p>
                    <div class="h-full w-[1px] bg-neutral-300 mx-3"></div>
                    <p class="">{{$product->items_sold}} Sold</p>
                </div>
                <h2 class="mt-3 text-3xl font-semibold text-[#018f07]">₱ {{ $product->price }}</h2>
                <div class="flex flex-col mt-10">
                    <div class="flex mb-5 w-full">
                        <p class="w-3/12 text-neutral-500">Protection</p>
                        <p>Merchandise Protection</p>
                    </div>
                    <div class="flex mb-5 w-full">
                        <p class="w-3/12 text-neutral-500">Shipping</p>
                        <div class="flex flex-col w-6/12">
                            <div class="flex">
                                <p class="text-neutral-500 w-6/12">Shipping to</p>
                                
                                    @auth
                                        {{-- Display Shipping  --}}
                                        <p>User Details Here</p>
                                    @else
                                        <a class="underline hover:text-neutral-500 transition ease-in-out duration-150" href="{{route('login')}}">Login to View</a>
                                    @endauth
                            </div>
                            <div class="flex">
                                <p class="text-neutral-500 w-6/12">Shipping fee</p>
                                    @auth
                                        {{-- Display Shipping  --}}
                                        <p>Shipping Fee Here</p>
                                    @else
                                        
                                    @endauth
                            </div>

                        </div>

                    </div>
                    <div class="flex mb-5 w-full">
                        <p class="w-3/12 text-neutral-500">Options</p>
                        <p>Insert Options Here (Optional)</p>
                    </div>
                    <div class="flex mb-5 w-full items-center">
                        <p class="w-3/12 text-neutral-500">Quantity</p>
                        <div class="flex">
                            <button id="minus-btn" class="w-10 border hover:border-neutral-700 transition ease-in-out duration-150 h-8 border-neutral-300">-</button>
                            <input type="number" id="quantity-input" class="quantity-counter border-neutral-300 focus:border-neutral-700 text-center w-20 h-8" value="1" min="1"/>
                            <button id="plus-btn" class="w-10 border hover:border-neutral-700 transition ease-in-out duration-150 h-8 border-neutral-300">+</button>
                        </div>
                    </div>
                </div>
                <div class="flex mt-3">
                    {{-- Might have to check if this works with the input above, otherwise wrap in form, styling for now --}}
                    <a href="#" class="w-34 text-center border-[#018f07] border bg-[#d1edd3] hover:bg-[#e4ede4] transition ease-in-out duration-150 px-10 py-2.5 mr-3 text-[#018f07]">
                        Add to Cart
                    </a>
                    <a href="#" class="w-40 text-center border-[#259B00] bg-[#259B00] hover:bg-[#2FB605] transition ease-in-out duration-150 text-white border px-10 py-2.5">
                        Buy Now
                    </a>
                </div>

            </div>
        </div>

        {{-- Merchant Details --}}
        <div class="mx-64 bg-white my-5 p-5 rounded-md shadow">
            <div class="flex w-full">
            <div class="flex items-center">
                @if($product->merchant->image_url == null)
                    <img src="{{asset('merchants/unknown.jpg')}}" class="w-24 rounded-full border mr-5"/>
                @else
                    <img src="{{asset('merchants/' . $product->merchant->image_url)}}" class="w-24 rounded-full border mr-5"/>
                @endif
                <div>
                    <p class="font-semibold">{{$product->merchant->store_name}}</p>
                    {{-- Might need to change this for functionality --}}
                    <div class="flex mt-3">
                        {{-- Might have to check if this works with the input above, otherwise wrap in form, styling for now --}}
                        <a href="#" class="w-24 px-1.5 py-1 text-sm text-center border-[#018f07] border bg-[#d1edd3] hover:bg-[#e4ede4] transition ease-in-out duration-150 mr-3 text-[#018f07]">
                            Chat Now
                        </a>
                        <a href="#" class="w-24 px-1.5 py-1 text-sm text-center border-[#259B00] bg-white text-black hover:text-white hover:bg-[#2FB605] transition ease-in-out duration-150 text-white border">
                            View Shop
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-l mx-6"></div>
            <div class="w-7/12 py-3 grid grid-cols-3 gap-x-10 text-sm items-center">
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

        <div class="mx-64 bg-white my-3 px-5 py-7 rounded-md shadow">
            <h3 class="text-xl mb-3.5">Product Description</h3>
            <p>{{$product->description}}</p>
        </div>

        <div class="mx-64 bg-white my-3 px-5 py-7 rounded-md shadow">
            <h3 class="text-xl mb-3.5">Product Ratings</h3>
            <p>Insert total ratings here</p>
            @foreach($reviews as $review)
                @php
                    $emptyStars = 5 - $review->rating;
                @endphp
                <div class="border-b py-7 flex">
                    <img class="w-10 h-10 object-cover rounded-full mr-5" src=" {{asset('users/' . $review->user->image_url)}} "/>
                    <div>
                        <p>{{$review->user->username}}</p>
                        @for($i = 0; $i < $review->rating; $i++)
                            <i class="fa-solid fa-star text-xs" style="color: #FFD43B"></i>
                        @endfor
                        @for($i = 0; $i < $emptyStars; $i++)
                            <i class="fa-regular fa-star text-xs" style="color: #FFD43B"></i>
                        @endfor

                        <p class="mt-3"> {{$review->review_text}} </p>
                    </div>
                </div>
                
            @endforeach
        </div>

        {{-- Newsletter --}}
        <div class="items-center bg-[#E6E6E6] px-64 py-7 grid grid-cols-5">
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
        <footer class="bg-[#1A1A1A] text-white px-64">
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