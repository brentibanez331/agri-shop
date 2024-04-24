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
                        <h1 class="text-xl font-bold">Product Rating</h1>
                    </div>
                </div>
                <hr>
                </hr>
            </div>
        </div>

        <div class="mx-64 mt-6 px-7 py-5 flex items-center bg-white rounded-md shadow">
            <div class="flex items-center">
                @if($trans->merchant->image_url == null)
                    <img src="{{ asset('storage/merchants/unknown.jpg')}}" class="size-8 object-cover rounded-full border mr-3"/>
                @else
                    <img src="{{ asset('storage/merchants/' . $trans->merchant->image_url)}}" class="size-8 object-cover rounded-full border mr-3"/>
                @endif
                <h1 class="text-xl"> {{$trans->merchant->store_name}}</h1>
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

        <div class="mx-64 mt-7 mb-14 rounded-md bg-white shadow">
            <form class="w-full p-10 flex flex-col" method="POST" action="{{route('store-review', $trans->product->id)}}">
                @csrf
                <h3 class="text-2xl mb-3.5"><i class="fa-solid fa-pen-nib mr-3 text-[#259B00]"></i>Rate this Product</h3>
                <input type="hidden" name="product_id" value="{{ $trans->product->id }}">
                <div class="flex items-center mt-4">
                    <label for="review_text" class="text-xl leading-6 mr-5">How was the product?</label>
                    <div class="rating">
                        <input type="radio" name="rating" id="star5" value="5">
                        <label for="star5"></label>
                        <input type="radio" name="rating" id="star4" value="4">
                        <label for="star4"></label>
                        <input type="radio" name="rating" id="star3" value="3">
                        <label for="star3"></label>
                        <input type="radio" name="rating" id="star2" value="2">
                        <label for="star2"></label>
                        <input type="radio" name="rating" id="star1" value="1">
                        <label for="star1"></label>
                    </div>
                    <input hidden name="star_rating" class="score" value="">
                </div>
                <div class="flex flex-col">
                    <label for="review_text" class="text-md leading-6 mt-4">Describe your experience (optional)</label>
                    <textarea id="review_text" name="review_text" rows="8" class="rounded-md" required autofocus></textarea>
                </div>
                <div class="flex">
                    <button type="submit" class="rounded-full bg-[#259B00] py-1.5 w-2/12 text-white mt-10 mr-3">Submit</button>
                    <a href="{{ route('show-transact') }}" class="rounded-full border text-center border-[#259B00] py-1.5 w-2/12 mt-10">Cancel</a>
                </div>
            </form>
        </div>
    </div>
    <script>
        const score = document.querySelector('.score');
        const ratings = document.querySelectorAll('.rating input');

        ratings.forEach(rating => {
            rating.addEventListener('change', () => {
                const selectedRating = rating.value;

                const text = selectedRating == 1 ? 'star' : 'stars';

                score.value = `${selectedRating}`;
            });
        })
    </script>
</body>

</html>