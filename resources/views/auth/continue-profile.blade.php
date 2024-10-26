
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
                <div class="flex items-center">
                    <img src="{{asset('images/logo.png')}}" class="size-10 mr-3">
                    <p class="text-2xl font-bold">Agronex</p>
                </div>
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
        <form method="POST" action="{{ route('update-profile')}}" class="w-5/12 shadow-md px-7 py-7" enctype="multipart/form-data">
            @method('PUT')
            @csrf <!-- {{ csrf_field() }} -->
            <h2 class="text-3xl font-bold text-center">Profile Information</h2>
            {{-- <input name="photo" type="file" id="photo" class="mt-10"/> --}}
            <div class="grid grid-cols-2 gap-4 mt-10">
                <div class="col-span-2 justify-center flex">
                    <label for="photo" class="relative flex items-center justify-center size-56 border-2 border-gray-400 rounded-full cursor-pointer hover:bg-gray-100 transition-colors duration-300">
                      <div id="image-preview" class="absolute inset-0 flex items-center justify-center rounded-full overflow-hidden"></div>
                      <div class="flex flex-col items-center text-gray-600">
                        <span class="text-md px-3 text-center">Click Here to Upload a Profile Picture</span>
                      </div>
                      <input name="photo" type="file" id="photo" class="hidden" onchange="previewImage(event)"/>
                    </label>
                  </div>
                <div class="col-span-2 flex flex-col w-full">
                    <label for="username" class="text-sm leading-6">Username</label>
                    <input id="username" type="text" name="username" class="rounded-md" autofocus />
                </div>
                <div class="col-span-2 flex flex-col w-full">
                    <label for="address" class="text-sm leading-6">Address</label>
                    <input id="address" type="text" name="address" class="rounded-md" autofocus autocomplete="address-line1"/>
                </div>
                <div class="col-span-2 flex flex-col">
                    <label for="phone_number" class="text-sm leading-6">Phone Number</label>
                    <input id="phone_number" type="tel" name="phone_number" class="rounded-md" autofocus autocomplete="tel"/>
                </div>
                <div class="flex flex-col">
                    <label for="birthdate" class="text-sm leading-6">Birthdate</label>
                    <input id="birthdate" type="date" name="birthdate" class="rounded-md" required autofocus autocomplete="bday"/>
                </div>
                <div class="flex flex-col">
                    <label for="gender" class="text-sm leading-6">Gender</label>
                    <select id="gender" name="gender" class="rounded-md" autofocus>
                        <option value="" disabled selected>Select a gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                        <option value="Declined">Prefer not to say</option>
                    </select>
                </div>
            </div>
            <div class="mt-10 flex justify-center">
                <button class="rounded-full w-40 text-center border-[#259B00] bg-[#259B00] hover:bg-[#2FB605] transition ease-in-out duration-150 text-white border px-10 py-2">
                    Done!
                </button>
            </div>
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
            img.classList.add('w-full', 'h-full', 'object-cover');
            imagePreview.appendChild(img);
            }
            reader.readAsDataURL(file);
        } else {
            imagePreview.innerHTML = '';
        }
        }
    </script>
    <script src="js/passwordToggle.js"></script>
</body>
</html>

