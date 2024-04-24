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
                        <h1 class="text-xl font-bold">Checkout</h1>
                    </div>
                </div>
                <hr>
                </hr>
            </div>
        </div>

        <div class="mx-48 my-5 shadow bg-white p-7 rounded-md">
            <div class="items-center flex">
                <i class="fa-solid fa-location-dot text-2xl mr-3" style="color: #018f07"></i>
                <h2 class="text-xl text-[#018f07]">Delivery Address</h2>
            </div>
            <div class="flex mt-5">
                <div class="w-1/3">
                    <p class="text-lg font-semibold leading-4"> {{Auth::user()->first_name}}
                        {{Auth::user(0)->last_name}} </p>
                    <p class="text-lg font-semibold">{{Auth::user()->phone_number}}</p>
                </div>
                <div>
                    <p class="text-lg font-semibold leading-4">Address:</p>
                    <p class="text-lg">{{Auth::user()->address}}</p>
                </div>
            </div>
        </div>

        <div class="shadow bg-white my-5 mx-48 rounded-md">
            <form method="POST" action="{{route('store-transact', $product->id)}}">
            @csrf
            <div class="p-7 rounded-md border-b">
                <div class="grid grid-cols-12 mb-7">
                    <h2 class="text-xl col-span-6">Product Ordered</h2>
                    <p class="col-span-2 text-neutral-500 text-center">Unit Price</p>
                    <p class="col-span-2 text-neutral-500 text-center">Amount</p>
                    <p class="col-span-2 text-neutral-500 text-center">Item Subtotal</p>
                </div>
                <a href="{{route('view-shop', $product->merchant->id)}}">{{$product->merchant->store_name}}</a>
                <div class="grid grid-cols-12 items-center mt-3">
                    <img src="{{asset('storage/products/' . $product->product_image_url)}}" class="size-14">
                    <h2 class="col-span-4">{{$product->product_name}}</h2>
                    <div class="col-span-1"></div>
                    <p class="col-span-2 text-center"> ₱{{$product->price}} </p>
                    <p class="col-span-2 text-center">{{$quantity}}</p>
                    @php
                        $subtotal = $product->price * $quantity;
                    @endphp

                    @if($item)
                        <input hidden name="cart_item_id" value={{$item->id}}>
                    @endif

                    <input hidden name="quantity" value={{$quantity}}>
                    <input hidden name="total_amount" class="total_amount" value="{{ intval($subtotal) + 5 }}">
                    <p class="col-span-2 text-center"> ₱{{$subtotal}} </p>
                </div>
                <div class="flex mt-10">
                    <p class="w-3/12">Shipping Option:</p>
                    <select id="shipping_option" name="shipping_option" required autofocus class="shipping-option rounded-md focus:ring-transparent">
                        <option value="Standard Local">Standard Local</option>
                        <option value="Express Shipping">Express Shipping</option>
                    </select>
                </div>
                <div class="flex mt-3">
                    <p class="w-3/12 text-md">Get By:</p>
                    <p class="delivery-date"> {{now()->addDays(5)->translatedFormat('M j')}} - {{now()->addDays(10)->translatedFormat('M j')}}
                    </p>
                </div>
            </div>
            <div class="flex w-full justify-end px-20 py-3 mt-3">
                <div class="grid grid-cols-2 gap-x-10">
                    <p class="text-right">Delivery Fee:</p>
                    <p class="delivery-fee text-right">₱5</p>
                </div>
            </div>
            <div class="flex w-full justify-end px-20 py-5">
                <div class="grid grid-cols-2 gap-x-10 items-center">
                    <p class="mr-8">Total:</p>
                    <p class="text-2xl total-price text-right text-[#018f07] font-semibold"> ₱{{ intval($subtotal) + 5
                        }} </p>
                </div>
            </div>
            <div class="flex justify-end">
                <button
                    class="rounded-sm mx-20 px-10 mt-3 mb-10 bg-[#259B00] hover:opacity-70 transition ease-in-out py-2 text-white">Place
                    Order</button>
            </div>
        </form>
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
        const shipOption = document.querySelector('.shipping-option');
        var deliveryFee = document.querySelector('.delivery-fee');
        var totalPrice = document.querySelector('.total-price');
        var deliveryDate = document.querySelector('.delivery-date');
        const inputElement = document.querySelector('input.total_amount');

        shipOption.addEventListener('change', function () {
            const selectedValue = shipOption.value;
            const currentDate = new Date();

            if (selectedValue == "Standard Local") {
                deliveryFee.textContent = "₱5"
                totalPrice.textContent = "₱" + {{ intval($subtotal) + 5 }}
                inputElement.value = {{ intval($subtotal) + 5 }};
                const startDate = new Date(currentDate.getTime() + 5 * 24 * 60 * 60 * 1000); // Add 5 days
                const endDate = new Date(currentDate.getTime() + 10 * 24 * 60 * 60 * 1000); // Add 10 days

                deliveryDate.textContent = formatDate(startDate) + " - " + formatDate(endDate);
            }

            if (selectedValue == "Express Shipping") {
                deliveryFee.textContent = "₱10"
                totalPrice.textContent = "₱" + {{ intval($subtotal) + 10 }}
                inputElement.value = {{ intval($subtotal) + 10 }};
                const startDate = new Date(currentDate.getTime() + 2 * 24 * 60 * 60 * 1000); // Add 5 days
                const endDate = new Date(currentDate.getTime() + 4 * 24 * 60 * 60 * 1000); // Add 10 days

                deliveryDate.textContent = formatDate(startDate) + " - " + formatDate(endDate);
            }
            console.log(inputElement.value);
            // You can now use the shippingOption variable as needed
            
        });
        function formatDate(date) {
            const options = { month: 'short', day: 'numeric' };
            return date.toLocaleDateString('en-US', options);
        }

    </script>
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