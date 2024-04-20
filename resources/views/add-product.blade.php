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
                    <p class="text-xl font-bold">AgroShop</p>
                    
                    <a href="#"><i class="fa-solid fa-cart-shopping text-2xl"></i></a>
                </div>
                <hr>
                </hr>
            </div>
        </div>

        <div class="mx-64 mt-6 px-7 py-5 flex items-center bg-white rounded-md shadow">
            <div class="flex items-center">
                <img src="{{ asset('storage/merchants/' . $merchant->image_url)}}" class="w-10 rounded-full border mr-3"/>
                <h1 class="text-xl"> {{$merchant->store_name}}</h1>
            </div>
        </div>
        
        @if ($errors->any())
        @foreach ($errors->all() as $error)
          <div
              class="mb-3 inline-flex w-full items-center rounded-lg bg-danger-100 px-6 py-1 text-base text-danger-700 transition-opacity ease-in duration-700 opacity-100"
              role="alert">
              <span class="mr-2">
                  <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 24 24"
                  fill="currentColor"
                  class="h-5 w-5">
                  <path
                      fill-rule="evenodd"
                      d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-1.72 6.97a.75.75 0 10-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 101.06 1.06L12 13.06l1.72 1.72a.75.75 0 101.06-1.06L13.06 12l1.72-1.72a.75.75 0 10-1.06-1.06L12 10.94l-1.72-1.72z"
                      clip-rule="evenodd" />
                  </svg>
              </span>
              {{ $error }}
          </div>
          @endforeach
        @endif

        <div class="mx-64 my-7 bg-white shadow">
            <form class="w-full p-10 flex flex-col" method="POST" action="{{ route('store-product') }}" enctype="multipart/form-data">
                <h3 class="text-2xl mb-3.5"><i class="fa-solid fa-plus mr-2 text-[#259B00]"></i>Add a New Product</h3>
                @csrf
                <input type="hidden" name="merchant_id" value="{{$merchant->id}}">
                <div class="flex flex-col">
                    <label for="product_name" class="text-sm leading-6 mt-7">Product Name</label>
                    <input id="product_name" type="text" name="product_name" class="rounded-md" required autofocus/>
                </div>
                <div class="flex flex-col">
                    <label for="description" class="text-sm leading-6 mt-4">Description</label>
                    <textarea id="description" type="text" name="description" rows="8" class="rounded-md" required autofocus></textarea>
                </div>
                <div class="flex flex-col mb-5 w-full mt-4">
                    <p class="text-sm">Available Stocks</p>
                    <div class="flex">
                        <button type="button" id="minus-btn" class="w-10 border hover:border-neutral-700 transition ease-in-out duration-150 h-8 border-neutral-300">-</button>
                        <input type="number" name="no_of_stocks" id="quantity-input" class="quantity-counter border-neutral-300 focus:border-neutral-700 text-center w-20 h-8" value="1" min="1"/>
                        <button type="button" id="plus-btn" class="w-10 border hover:border-neutral-700 transition ease-in-out duration-150 h-8 border-neutral-300">+</button>
                    </div>
                </div>
                <div class="flex flex-col mb-5 w-full">
                    <p class="text-sm">Price (pesos)</p>
                    <div class="flex">
                        <button type="button" id="minus-btn2" class="w-10 border hover:border-neutral-700 transition ease-in-out duration-150 h-8 border-neutral-300">-</button>
                        <input type="number" name="price" id="quantity-input2" class="quantity-counter border-neutral-300 focus:border-neutral-700 text-center w-20 h-8" value="1" min="1"/>
                        <button type="button" id="plus-btn2" class="w-10 border hover:border-neutral-700 transition ease-in-out duration-150 h-8 border-neutral-300">+</button>
                    </div>
                </div>
                <div class="flex">
                    <div id="image-preview" class=""></div>
                    <label for="photo" class="flex items-center justify-center size-56 border-2 border-dashed border-gray-400 rounded-md cursor-pointer hover:bg-gray-100 transition-colors duration-300">
                        <div class="flex flex-col items-center text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                        </svg>
                        <span class="text-sm">Drop your image here, or browse</span>
                        </div>
                        <input name="photo" type="file" id="photo" class="hidden" onchange="previewImage(event)"/>
                    </label>
                </div>
                <div class="flex">
                    <button class="rounded-full bg-[#259B00] py-1.5 w-2/12 text-white mt-10 mr-3">Upload </button>
                    <a href="{{ route('manage-shop', $merchant->id) }}" class="rounded-full border text-center border-[#259B00] py-1.5 w-2/12 mt-10">Cancel </a>
                </div>
            </form>
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