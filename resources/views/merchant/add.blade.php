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
                    <div class="flex">
                        <p class="text-xl font-bold">AgroShop</p>
                        <div class="border-l-2 border-neutral-600 mx-5"></div>
                        <h1 class="text-xl font-bold">Seller Registration</h1>
                    </div>
                    <a href="#"><i class="fa-solid fa-cart-shopping text-2xl"></i></a>
                </div>
                <hr>
                </hr>
            </div>
        </div>

        @if ($errors->any())
        @foreach ($errors->all() as $error)
        <div class="mb-3 inline-flex w-full items-center rounded-lg bg-danger-100 px-6 py-1 text-base text-danger-700 transition-opacity ease-in duration-700 opacity-100"
            role="alert">
            <span class="mr-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5">
                    <path fill-rule="evenodd"
                        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-1.72 6.97a.75.75 0 10-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 101.06 1.06L12 13.06l1.72 1.72a.75.75 0 101.06-1.06L13.06 12l1.72-1.72a.75.75 0 10-1.06-1.06L12 10.94l-1.72-1.72z"
                        clip-rule="evenodd" />
                </svg>
            </span>
            {{ $error }}
        </div>
        @endforeach
        @endif

        <div class="mx-64 my-7">
            <form class="" method="POST" action="{{ route('store-shop') }}" enctype="multipart/form-data">
                @csrf
                <div class="p-10 flex flex-col bg-white shadow rounded-md w-full">
                    <h3 class="text-2xl mb-3.5">Shop Information<span class="font-semibold ml-2">[1/2]</span></h3>

                    <input type="hidden" name="merchant_id" value="">
                    <div class="flex flex-col w-7/12">
                        <label for="store_name" class="text-md leading-6 mt-7">Shop Name</label>
                        <input id="store_name" type="text" name="store_name" class="rounded-md" required autofocus
                            autocomplete="off" />
                    </div>
                    <div class="flex flex-col">
                        <label for="pickup_address" class="text-md leading-6 mt-4">Pickup Address</label>
                        <p class="text-sm"><em>Please enter your full detailed address for courier pickup</em></p>
                        <textarea id="pickup_address" type="text" name="pickup_address" rows="8" class="rounded-md"
                            required autofocus></textarea>
                    </div>
                    <div class="flex flex-col">
                        <label for="email" class="text-md leading-6 mt-7">Email</label>
                        <input id="email" type="text" name="email" class="rounded-md text-neutral-500 bg-neutral-300"
                            value="{{Auth::user()->email}}" disabled autofocus />
                    </div>

                    <div class="flex flex-col">
                        <label for="phone_number" class="text-md leading-6 mt-7">Phone Number</label>
                        <input id="phone_number" type="text" name="phone_number"
                            class="rounded-md text-neutral-500 bg-neutral-300" value="{{Auth::user()->phone_number}}"
                            disabled autofocus />
                    </div>

                    <p class="text-md leading-6 mt-7 mb-2">Choose a Profile Image</p>
                    <div class="flex">
                        <div id="image-preview" class=""></div>

                        <label for="photo"
                            class="flex items-center justify-center size-56 border-2 border-dashed border-gray-400 rounded-md cursor-pointer hover:bg-gray-100 transition-colors duration-300">
                            <div class="flex flex-col items-center text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mb-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                <span class="text-sm">Drop your image here, or browse</span>
                            </div>
                            <input name="photo" type="file" id="photo" class="hidden" onchange="previewImage(event)" />
                        </label>
                    </div>
                </div>
                <div class="mt-10 p-10 flex flex-col bg-white shadow rounded-md w-full">
                    <h3 class="text-2xl mb-3.5">Business Information<span class="font-semibold ml-2">[2/2]</span></h3>

                    <input type="hidden" name="merchant_id" value="">
                    <div class="grid-cols-3 grid mt-7" style="column-gap:1.75rem; row-gap:1.25rem">
                        <div class="flex flex-col col-span-1">
                            <label for="city" class="text-md leading-6">City</label>
                            <input id="city" type="text" name="city" class="rounded-md" required autofocus
                                autocomplete="address-level2" />
                        </div>
                        <div class="flex flex-col col-span-1">
                            <label for="country" class="text-md leading-6">Country</label>
                            <input id="country" type="text" name="country" class="rounded-md" required autofocus
                                autocomplete="off" />
                        </div>
                        <div class="flex flex-col col-span-1">
                            <label for="state" class="text-md leading-6">State</label>
                            <input id="state" type="text" name="state" class="rounded-md" required autofocus
                                autocomplete="off" />
                        </div>
                        <div class="flex flex-col col-span-2">
                            <label for="reg_address" class="text-md leading-6">Registered Address</label>
                            <input id="reg_address" type="text" name="reg_address" class="rounded-md"
                                placeholder="Detail Address (Unit No., Building, Street, and etc.)" required autofocus
                                autocomplete="street-address" />
                        </div>
                        <div class="flex flex-col col-span-1">
                            <label for="postal_code" class="text-md leading-6">Postal Code</label>
                            <input id="postal_code" type="text" name="postal_code" class="rounded-md" required autofocus
                                autocomplete="street-address" />
                        </div>
                        <div class="flex flex-col col-span-3">
                            <label for="tin" class="text-md leading-6">Taxpayer Identification Number</label>
                            <p class="text-sm text-neutral-600">Your 9-digit TIN and 3 to 5 digit branch code. Please
                                use “000” as your branch code if you don’t have one (e.g. 999-999-999-000)</p>
                            <input id="tin" type="text" name="tin" class="rounded-md" required autofocus
                                autocomplete="off" />
                        </div>
                        <div class="flex items-center mt-4 col-span-2">
                            <input id="agree_terms" type="checkbox" name="agree_terms"
                                class="rounded border-gray-400 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                required>
                            <label for="agree_terms" class="ml-2 text-sm text-gray-700">I agree to these <a href="#"
                                    class="text-indigo-600 underline">Terms and Conditions</a> and <a href="#"
                                    class="text-indigo-600 underline">Data Privacy Policy</a></label>
                        </div>
                    </div>
                    <div class="flex">
                        <button class="rounded-full bg-[#259B00] py-1.5 w-2/12 text-white mt-10 mr-3">Submit</button>
                        <a href="{{ route('your-shop') }}" class="rounded-full border text-center border-[#259B00] py-1.5 w-2/12 mt-10">Cancel </a>
                    </div>
                </div>
            </form>
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
    <script src="{{ asset('js/quantityCounter.js')}}"></script>
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