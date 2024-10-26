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
                            <a href="{{ route('welcome') }}"
                                class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:opacity-50 focus:outline-none focus-visible:ring-[#FF2D20] dark:focus-visible:ring-white">
                                Home
                            </a>
                            <div class="border-l my-1.5 opacity-50"></div>
                            <a href="{{ route('your-shop') }}"
                                class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:opacity-50 focus:outline-none focus-visible:ring-[#FF2D20] dark:focus-visible:ring-white">
                                My Stores
                            </a>
                            <div class="border-l my-1.5 opacity-50"></div>
                            <a href="{{ route('show-transact') }}"
                                class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:opacity-50 focus:outline-none focus-visible:ring-[#FF2D20] dark:focus-visible:ring-white">
                                Purchases
                            </a>
                            <div class="border-l my-1.5 opacity-50"></div>
                            <a href="{{ route('profile') }}"
                                class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:opacity-50 focus:outline-none focus-visible:ring-[#FF2D20] dark:focus-visible:ring-white">
                                <div class="flex items-center">
                                    <img src="{{ asset('storage/users/' . Auth::user()->image_url)}}"
                                        class="size-5 rounded-full mr-1.5">
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
                    <div class="flex items-center">
                        <div class="flex items-center">
                            <img src="{{asset('images/logo.png')}}" class="size-10 mr-3">
                            <p class="text-2xl font-bold">Agronex</p>
                        </div>
                        <div class="border-l-2 h-10 border-neutral-600 mx-5"></div>
                        <h1 class="text-xl font-bold">My Profile</h1>
                    </div>
                    <form action="{{route('logout')}}" method="POST">
                        @csrf
                        <button type="submit" class="hover:opacity-50 transition ease-in-out">Logout</button>
                    </form>
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

        <div class="mx-64 mt-7 mb-14 rounded-md bg-white shadow">
            <form class="w-full p-7 flex flex-col" method="POST" action="{{ route('update-account') }}"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf <!-- {{ csrf_field() }} -->
                <div class="border-b border-neutral-400 pb-3">
                    <h2 class="text-xl font-bold">My Profile</h2>
                    <p>Manage and protect your account</p>
                </div>
                <div class="flex">
                    <div class="grid-cols-2 grid gap-x-10 gap-y-6 w-7/12 border-r pr-3">
                        <p class="text-right text-neutral-600 mt-7">Username</p>
                        <p class="mt-7">{{Auth::user()->username}}</p>

                        <label for="first_name" class="text-right text-neutral-600">First Name</label>
                        <input type="text" class="rounded-md" name="first_name" id="first_name"
                            value="{{Auth::user()->first_name}}" required autofocus>

                        <label for="last_name" class="text-right text-neutral-600">Last Name</label>
                        <input type="text" class="rounded-md" name="last_name" id="last_name"
                            value="{{Auth::user()->last_name}}" required autofocus>

                        <label for="email" class="text-right text-neutral-600">Email</label>
                        <input type="text" class="rounded-md" name="email" id="email" value="{{Auth::user()->email}}"
                            required autofocus>

                        <label for="phone_number" class="text-right text-neutral-600">Phone Number</label>
                        <input type="text" class="rounded-md" name="phone_number" id="phone_number"
                            value="{{Auth::user()->phone_number}}" required autofocus>

                        <label for="gender" class="text-right text-neutral-600">Gender</label>
                        <select id="gender" name="gender" class="rounded-md" autofocus>
                            <option value="" disabled selected>Select a gender</option>
                            <option value="Male" @if(Auth::user()->gender == "Male") selected @endif>Male</option>
                            <option value="Female" @if(Auth::user()->gender == "Female") selected @endif>Female</option>
                            <option value="Other" @if(Auth::user()->gender == "Other") selected @endif>Other</option>
                            <option value="Declined" @if(Auth::user()->gender == "Declined") selected @endif>Prefer not
                                to say</option>
                        </select>

                        <label for="birthdate" class="text-right text-neutral-600">Birthdate</label>
                        <input id="birthdate" type="date" name="birthdate" class="rounded-md"
                            value={{Auth::user()->birthdate}} required autofocus autocomplete="bday"/>

                        <label for="address" class="text-right text-neutral-600">Address</label>
                        <textarea type="text" class="rounded-md" name="address" id="address" rows="6" required
                            autofocus>{{Auth::user()->address}}</textarea>

                        <div></div>
                        <button class="w-5/12 bg-[#259B00] py-2 rounded-sm text-white">Save</button>
                    </div>
                    <div class="mt-20 w-5/12">
                        <div class="justify-center items-center flex flex-col">
                            <img src="{{ asset('storage/users/' . Auth::user()->image_url) }}" id="curr-image"
                                class="size-48 object-cover rounded-full border shadow">
                            <div id="image-preview" class=""></div>
                            <label for="photo"
                                class="flex items-center justify-center py-2 bg-white shadow mt-6 px-3 border border-gray-400 rounded-md cursor-pointer hover:bg-gray-100 transition-colors duration-300">
                                <div class="flex flex-col items-center text-gray-600">
                                    <span class="text-md">Select Image</span>
                                </div>
                                <input name="photo" type="file" id="photo" class="hidden"
                                    onchange="previewImage(event)" />
                            </label>
                            <p class="mt-3 text-neutral-500">File Size: maximum 2 MB</p>
                            <p class="text-neutral-500">File Extension: jpg, png, jpeg</p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="mx-64 mb-10 p-10 flex flex-col bg-white shadow rounded-md">
            <h3 class="text-xl mb-3.5">Delete Account</h3>
            <p class="w-7/12">
                Once your account is deleted, all of its resources and data will be permanently deleted. 
                Before deleting your account, please download any data or information that you wish to retain.
            </p>
            <a href="{{route('delete-user')}}" class="rounded-full text-center bg-red-700 hover:opacity-80 transition ease-in-out text-white py-1.5 w-2/12 mt-6">Delete Account </a>
        </div>


    </div>
    <script>
        function previewImage(event) {
            const imagePreview = document.getElementById('image-preview');
            const currImage = document.getElementById('curr-image');
            imagePreview.innerHTML = '';

            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function () {
                    const img = document.createElement('img');
                    img.src = reader.result;
                    img.classList.add('size-48', 'object-cover', 'rounded-full');
                    imagePreview.appendChild(img);

                    currImage.style.display = 'none';
                }
                reader.readAsDataURL(file);
            } else {
                currImage.style.display = 'block';
            }
        }
    </script>
</body>

</html>