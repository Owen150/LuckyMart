<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            Checkout 
        </h1>
    </x-slot>

    <form action="{{ route('getToken', $bid->id) }}" method="post">
        @csrf
    <div class="py-16 px-4 md:px-6 2xl:px-0 flex justify-center items-center 2xl:mx-auto 2xl:container">
        <div class="flex flex-col justify-start items-start w-full space-y-9">
            

            <div class="flex flex-col xl:flex-row justify-center xl:justify-between space-y-6 xl:space-y-0 xl:space-x-6 w-full">
                <div class="xl:w-3/5 flex flex-col sm:flex-row xl:flex-col justify-center items-center bg-gray-100 dark:bg-gray-800 py-7 sm:py-0 xl:py-10 px-10 xl:w-full">
                    <div class="flex flex-col justify-start items-start w-full space-y-4">
                        <p class="text-xl md:text-2xl leading-normal text-gray-800 dark:text-gray-50">{{ $bid->lot->name }}</p>
                        <h5 class="text-lg font-semibold leading-none text-gray-600 dark:text-white">Ksh {{ $bid->price }}</h5>
                    </div>
                    <div class="mt-6 sm:mt-0 xl:my-10 xl:px-20 w-52 sm:w-96 xl:w-auto">
                        <img src="{{ asset('/storage/' . $bid->lot->images[0]->path) }}" alt="headphones" />
                    </div>
                </div>

                <div class="p-8 bg-gray-100 dark:bg-gray-800 flex flex-col lg:w-full xl:w-3/5">
                    <div class="border border-transparent  bg-gray-900 dark:bg-white dark:hover:bg-gray-900 dark:hover:border-gray-900 dark:text-gray-900 dark:hover:text-white hover:bg-white text-white hover:text-gray-900 flex flex-row justify-center items-center space-x-2 py-4 rounded w-full">
                        <div>
                            <img src="{{ asset('saf.png') }}" style="height: 26px; width: 36px;" alt="" srcset="">
                        </div>
                        
                    </div>

                    <div class="flex flex-row justify-center items-center mt-6">
                        <hr class="border w-full" />
                        <p class="flex flex-shrink-0 px-4 text-base leading-4 text-gray-600 dark:text-white">mpesa paybill</p>
                        <hr class="border w-full" />
                    </div>

                    <div class="mt-8">
                        <label for="">Name</label>
                        <input class="border border-gray-300 p-4 rounded w-full text-base leading-4 placeholder-gray-600 text-gray-600" type="text" name="" id=""  required value="{{ Auth::user()->name }}" />

                         
                    </div>

                    <div class="mt-8">
                        

                        <label for="" class="mt-8">Enter Phone Number to be charged</label>
                        <input class="border border-gray-300 p-4 rounded w-full text-base leading-4 placeholder-gray-600 text-gray-600" type="text" name="phone" id="" placeholder="2547000000" required />
                    </div>

                    <input type="hidden" readonly name="bid_ia" value="{{ $bid->id }}">

                    <button class="mt-8 border border-transparent hover:border-gray-300 dark:bg-white dark:hover:bg-gray-900 dark:text-gray-900 dark:hover:text-white dark:border-transparent bg-gray-900 hover:bg-white text-white hover:text-gray-900 flex justify-center items-center py-4 rounded w-full">
                        <div>
                            <p class="text-base leading-4">Pay KSH {{ $bid->price }}</p>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
</div>

@section('js')
    <script defer>
        let closeIcon = document.getElementById("closeIcon");
        let openIcon = document.getElementById("openIcon");
        let dropdown = document.getElementById("dropdown");
        let text = document.getElementById("changetext");

        const showMenu = (flag) => {
            if (flag) {
                closeIcon.classList.toggle("hidden");
                openIcon.classList.toggle("hidden");
                dropdown.classList.toggle("hidden");
            } else {
                closeIcon.classList.toggle("hidden");
                openIcon.classList.toggle("hidden");
                dropdown.classList.toggle("hidden");
            }
        };

        const changeText = (country) => {
            text.innerHTML = country;
            closeIcon.classList.toggle("hidden");
            openIcon.classList.toggle("hidden");
            dropdown.classList.toggle("hidden");
        };

    </script>
@endsection
    
    

</x-app-layout>