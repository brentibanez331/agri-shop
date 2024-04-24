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
                        <h1 class="text-xl font-bold">Product Management</h1>
                    </div>
                </div>
                <hr>
                </hr>
            </div>
        </div>

        <div class="mx-64 mt-6 px-7 py-5 flex items-center bg-white rounded-md shadow">
            <div class="flex items-center">
                @if($merchant->image_url == null)
                    <img src="{{ asset('storage/merchants/unknown.jpg')}}" class="size-10 object-cover rounded-full border mr-3"/>
                @else
                    <img src="{{ asset('storage/merchants/' . $merchant->image_url)}}" class="size-10 object-cover rounded-full border mr-3"/>
                @endif
                
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

        <div class="mx-64 my-7 bg-white shadow rounded-md">
            
            <form class="w-full p-10 flex flex-col" method="POST" action="{{ route('update-product', $product->id) }}" enctype="multipart/form-data">
                <h3 class="text-2xl mb-3.5"><i class="fa-regular fa-pen-to-square mr-2 text-[#259B00]"></i>Update Product Information</h3>
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
                @method('PUT')
                @csrf <!-- {{ csrf_field() }} -->
                <input type="hidden" name="merchant_id" value="{{$merchant->id}}">
                <div class="flex flex-col">
                    <label for="product_name" class="text-md leading-6 mt-7">Product Name</label>
                    <input id="product_name" type="text" name="product_name" class="rounded-md" value="{{$product->product_name}}" autofocus/>
                </div>
                <div class="flex flex-col">
                    <label for="description" class="text-md leading-6 mt-4">Description</label>
                    <textarea id="description" type="text" name="description" rows="8" class="rounded-md" autofocus>{{ $product->description }}</textarea>
                </div>
                <div class="flex flex-col mb-5 w-1/4 mt-7">
                    <p class="text-md">Category</p>
                    <select id="tag_id" name="tag_id" autofocus class="shipping-option rounded-md focus:ring-transparent">
                        @foreach ($tags as $tag)
                            <option value="{{$tag->id}}" @if($tag->id == $product->tag_id) selected @endif>{{$tag->tag_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-col mb-5 w-full mt-4">
                    <p class="text-md">Available Stocks</p>
                    <div class="flex">
                        <button type="button" id="minus-btn" class="w-10 border hover:border-neutral-700 transition ease-in-out duration-150 h-8 border-neutral-300">-</button>
                        <input type="number" name="no_of_stocks" value = "{{$product->no_of_stocks}}" id="quantity-input" class="quantity-counter border-neutral-300 focus:border-neutral-700 text-center w-20 h-8" value="1" min="1"/>
                        <button type="button" id="plus-btn" class="w-10 border hover:border-neutral-700 transition ease-in-out duration-150 h-8 border-neutral-300">+</button>
                    </div>
                </div>
                <div class="flex flex-col mb-5 w-full">
                    <p class="text-md">Price (pesos)</p>
                    <div class="flex">
                        <button type="button" id="minus-btn2" class="w-10 border hover:border-neutral-700 transition ease-in-out duration-150 h-8 border-neutral-300">-</button>
                        <input type="number" name="price" value={{$product->price}} id="quantity-input2" class="quantity-counter border-neutral-300 focus:border-neutral-700 text-center w-20 h-8" value="1" min="1"/>
                        <button type="button" id="plus-btn2" class="w-10 border hover:border-neutral-700 transition ease-in-out duration-150 h-8 border-neutral-300">+</button>
                    </div>
                </div>
                <p class="text-md leading-6 mt-7 mb-2">Upload an Image of the Product <em>(e.g. jpg, jpeg, png, max: 2 MB)</em></p>
                <div class="flex">
                    <img src="{{ asset('storage/products/' . $product->product_image_url) }}" id="curr-image" class="size-56 object-cover mr-10 rounded-md border shadow">
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
                    <button class="rounded-full bg-[#259B00] py-1.5 w-2/12 text-white mt-10 mr-3">Update </button>
                    <a href="{{ route('manage-shop', $merchant->id) }}" class="rounded-full border text-center border-[#259B00] py-1.5 w-2/12 mt-10">Cancel </a>
                </div>
            </form>
        </div>
        <div class="mx-64 my-10 p-10 flex flex-col bg-white shadow rounded-md">
            <h3 class="text-xl mb-3.5">Delete Product</h3>
            <p class="w-7/12">
                Once your product is deleted, all of its reviews and transactions will be permanently removed from the system. 
                Before deleting this product, please download any data or information that you wish to retain.
            </p>
            <a href="{{ route('delete-product', ['productId' => $product->id, 'merchantId' => $merchant->id]) }}" class="rounded-full text-center bg-red-700 hover:opacity-80 transition ease-in-out text-white py-1.5 w-2/12 mt-6">Delete Product </a>
        </div>
    </div>
    <script src="{{ asset('js/quantityCounter.js')}}"></script>
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
              img.classList.add('size-56', 'object-cover', 'mr-10', 'rounded-md');
              imagePreview.appendChild(img);

              currImage.style.display = 'none';
            }
            reader.readAsDataURL(file);
          }else{
            currImage.style.display = 'block';
          }
        }
        </script>
</body>

</html>