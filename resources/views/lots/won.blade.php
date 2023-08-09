<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            Bids Won
        </h1>
    </x-slot>

    <div class="container sm:grid sm:grid-cols-1 sm:gap-0 p-4 lg:grid lg:gap-4 lg:grid-cols-4 lg:p-10">
        @foreach ($winner as $win)
           
            <div class="max-w-sm rounded overflow-hidden shadow-lg bg-white">
                <img class="w-full h-42" src="{{ asset('/store/' . $win->lot->images[0]->path) }}" alt="Sunset in the mountains">
                <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2">{{ $win->lot->name }}</div>
                <p class="text-gray-700 text-base">
                    Amount to pay Ksh: {{ $win->price }}
                </p>
                </div>
                <div class="px-6 pt-4 pb-2 mb-5">
                    <a href="{{ route('checkoutpage', $win->id) }}" class="hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded bg-yellow-500">
                        Pay
                    </a>
                
                </div>
            </div>

        @endforeach
        
    </div>

</x-app-layout>