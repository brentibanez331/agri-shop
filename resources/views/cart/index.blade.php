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
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                    <div class="flex">
                        <p class="text-xl font-bold">AgroShop</p>
                        <div class="border-l-2 border-neutral-600 mx-5"></div>
                        <h1 class="text-xl font-bold">Shopping Cart</h1>
                    </div>
                    <div class="relative w-5/12 flex justify-center">
                        <input type="text" placeholder="Search for Products in Your Cart"
                            class="w-full transition ease-in-out duration-300 focus:ring-0 focus:border-slate-500 border-slate-300 rounded-full">
                        <div class="absolute inset-y-0 right-0 pr-1 flex items-center">
                            <button class="text-white bg-[#259B00] px-5 py-1 rounded-full">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <hr>
                </hr>
            </div>
        </div>

        <div class="mx-64 my-7">
            <div class="grid grid-cols-[repeat(15,_minmax(0,_1fr))] bg-white shadow rounded-md p-3">
                <p class="col-span-1"></p>
                <p class="col-span-6">Product</p>
                <p class="col-span-2 text-center">Unit Price</p>
                <p class="col-span-2 text-center">Quantity</p>
                <p class="col-span-2 text-center">Total Price</p>
                <p class="col-span-2 text-center">Actions</p>
            </div>

            @forelse($cart_items as $item)
                <div class="mt-6 bg-white shadow rounded-md">
                    <div class="px-20 py-3"><i class="fa-solid fa-shop mr-3 text-neutral-600"></i><a href="{{route('view-shop', $item->product->merchant->id)}}">{{$item->product->merchant->store_name}}</a> </div>
                    <div class="border-b"></div>
                    <div class="grid grid-cols-[repeat(15,_minmax(0,_1fr))] px-3 py-10 items-center">
                        <p class="col-span-1"></p>
                        <a class="col-span-6 flex items-center" href="{{route('product', $item->product_id)}}">
                            <img class="size-16 object-cover" src="{{ asset('storage/products/' . $item->product->product_image_url) }}"/>
                            <p class="mx-6 flex text-sm"> {{$item->product->product_name}} </p>
                        </a>
                        <p class="col-span-2 text-center text-sm"> ₱{{$item->product->price}} </p>
                        <div class="col-span-2 text-center">
                            <div class="flex items-center justify-center">
                                <a href="#"
                                    class="border hover:border-neutral-700 transition ease-in-out duration-150 px-2 border-neutral-300 minus-cart" data-cart-id="{{ $item->cart_id }}" data-product-id="{{ $item->id }}">-</a>
                                <p class="border px-4"> {{$item->quantity}} </p>
                                <a href="#"
                                    class="border hover:border-neutral-700 transition ease-in-out duration-150 px-2 border-neutral-300 plus-cart" data-cart-id="{{ $item->cart_id }}" data-product-id="{{ $item->id }}">+</a>
                            </div>
                            
                            <p class="text-sm text-[#018f07]"> {{$item->product->no_of_stocks}} items left </p>
                        </div>
                        @php
                            $total_price = $item->price * $item->quantity;
                        @endphp
                        <p class="col-span-2 text-center text-sm text-[#018f07] price"> {{ $total_price }} </p>
                        <div class="col-span-2 text-center text-sm flex flex-col items-center gap-y-2">
                            <a class="text-blue-500 py-1 border-blue-500 border w-10/12 hover:bg-blue-500 hover:text-white transition ease-in-out" href="{{ route('cart-transact', $item->id) }}">Buy</a>
                            <a class="text-red-500 border-red-500 border py-1 hover:bg-red-500 hover:text-white transition ease-in-out w-10/12" href="{{route('delete-cart', $item->id)}}">Delete</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="my-20 text-center">
                    <h2 class="text-3xl">It's a bit lonely here😓</h2>
                    <p>Start adding items to your Cart!</p>
                </div>
            @endforelse
        </div>
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
    <script src="{{ asset('js/cart.js')}}"></script>
    <script>
        function previewImage(event) {
            const imagePreview = document.getElementById('image-preview');
            imagePreview.innerHTML = '';

            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function () {
                    const img = document.createElement('img');
                    img.src = reader.result;
                    img.classList.add('size-56', 'object-cover', 'mr-10', 'rounded-md');
                    imagePreview.appendChild(img);
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
</body>

</html>