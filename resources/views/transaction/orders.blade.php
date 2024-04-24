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
                    <div class="flex">
                        <p class="text-xl font-bold">AgroShop</p>
                        <div class="border-l-2 border-neutral-600 mx-5"></div>
                        <h1 class="text-xl font-bold">Your Orders</h1>
                    </div>
                    <div class="relative">
                        <a href="{{route('manage-cart')}}"><i class="fa-solid fa-cart-shopping text-2xl"></i></a>
                        <p class="absolute -top-2 -right-2 bg-[#259B00] text-white text-sm leading-none size-4 text-center rounded-full">{{$shopcart->total_items}}</p>
                    </div>
                </div>
                <hr>
                </hr>
            </div>
        </div>

        <div class="mx-48 my-7">
            @if(!$transactions->isEmpty())
            <div class="grid grid-cols-[repeat(15,_minmax(0,_1fr))] bg-white shadow rounded-md p-3">
                <p class="col-span-6">Product</p>
                <p class="col-span-2 text-center">Unit Price</p>
                <p class="col-span-1 text-center">Quantity</p>
                <p class="col-span-2 text-center">Total Price</p>
                <p class="col-span-2 text-center">Est. Arrival</p>
                <p class="col-span-2 text-center">Actions</p>
            </div>
            @endif

            @forelse($transactions as $trans)
                <div class="mt-6 bg-white shadow rounded-md">
                    <div class="px-3 py-3 flex items-center">
                        <a href="{{route('view-shop', $trans->product->merchant->id)}}">{{$trans->product->merchant->store_name}}</a>
                        <div class="border-l border mx-3 h-6"></div>
                        @if($trans->status == "Pending")
                            <p class="bg-yellow-200 rounded-full text-sm py-1 px-2"> Pending </p>
                        @elseif($trans->status == "Successful")
                            <p class="bg-green-200 rounded-full text-sm py-1 px-2"> Successful </p>
                        @elseif($trans->status == "Cancelled")
                            <p class="bg-red-200 rounded-full text-sm py-1 px-2"> Cancelled </p>
                        @endif
                    </div>
                    <div class="border-b"></div>
                    <div class="grid grid-cols-[repeat(15,_minmax(0,_1fr))] px-3 py-10 items-center">
                        <div class="col-span-6 flex items-center">
                            <img class="size-16 object-cover" src="{{ asset('storage/products/' . $trans->product->product_image_url) }}"/>
                            <div>
                                <a class="mx-6 flex text-sm" href="{{route('product', $trans->product_id)}}"> {{$trans->product->product_name}} </a>
                                <div class="flex">
                                    <p class="ml-6 mr-2 flex text-sm text-neutral-500"> Ordered on: </p>
                                    <p class="text-[#018f07] text-sm">{{$trans->created_at->translatedFormat('F j, Y, h:i A')}}</p>
                                </div>
                                <div class="flex">
                                    <p class="ml-6 mr-2 flex text-sm text-neutral-500"> Order ID: </p>
                                    <p class="text-[#018f07] text-sm">{{$trans->order_ref}}</p>
                                </div>
                            </div>
                            
                        </div>
                        <p class="col-span-2 text-center text-sm"> ₱{{$trans->selling_price}} </p>
                        <div class="col-span-1 text-center">
                            <p class="px-4"> {{$trans->quantity}} </p>
                        </div>
                        <p class="col-span-2 text-center text-sm text-[#018f07] price"> ₱{{ $trans->total_amount }} </p>
                        <p class="col-span-2 text-center text-sm text-neutral-700">{{ $trans->est_arrival }} </p>
                        <div class="col-span-2 text-center text-sm flex flex-col items-center gap-y-2">
                            @if($trans->status == "Pending")
                                <a class="text-red-500 border-red-500 border py-1 hover:bg-red-500 hover:text-white transition ease-in-out w-9/12" href="{{route('cancel-order', $trans->id)}}">Cancel</a>
                            @elseif($trans->status == "Successful")
                                @if($ratings->where('product_id', $trans->product_id)->get()->isEmpty())
                                    <a class="text-blue-500 border-blue-500 border py-1 hover:bg-blue-500 hover:text-white transition ease-in-out w-9/12" href="{{route('rate', $trans->id)}}">Rate</a>
                                @else
                                    <a class="text-blue-500 border-blue-500 border py-1 hover:bg-blue-500 hover:text-white transition ease-in-out w-9/12" href="{{route('edit-review', $trans->product->id)}}">Edit Rate</a>
                                @endif
                            @elseif($trans->status == "Cancelled")
                                <a class="text-white hover:opacity-80 border-red-700 border py-1 bg-red-700 hover:text-white transition ease-in-out w-9/12" href="{{route('delete-trans', $trans->id)}}">Remove</a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="my-28 text-center">
                    <h2 class="text-3xl">We're not that broke are we?😞</h2>
                    <p>Choose from a variety of products!</p>
                </div>
            @endforelse
        </div>
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