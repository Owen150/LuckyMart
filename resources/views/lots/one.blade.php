<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $lot->name }}
        </h1>
    </x-slot>

    <div class="py-12">
        <div class="lg:max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    @include('layouts.errors-message')
                    <div class="flex justify-between mb-3 mr-3">
                        
                        <lot-status-badge class="px-2 py-1 text-xs h-5 font-bold leading-none rounded-full"
                                    status="{{ $lot->status }}"></lot-status-badge>
                        <div class="text-green-500 text-5xl">
                            <new-bid :lot="{{ $lot->id }}" :bid="{{ $lot->start_price }}" ></new-bid>
                        </div>
                    </div>
                    <div class="flex justify-between items-center mb-7 mr-3">
                        <div>
                            <div class="flex">
                                <svg class="w-4 mr-1"
                                     xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                     fill="currentColor">
                                    <path fill-rule="evenodd"
                                          d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                          clip-rule="evenodd"/>
                                </svg>
                                {{ $lot->user->name }}
                            </div>
                            <div class="flex">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 mr-1" viewBox="0 0 20 20"
                                     fill="currentColor">
                                    <path fill-rule="evenodd"
                                          d="M2 5a2 2 0 012-2h12a2 2 0 012 2v2a2 2 0 01-2 2H4a2 2 0 01-2-2V5zm14 1a1 1 0 11-2 0 1 1 0 012 0zM2 13a2 2 0 012-2h12a2 2 0 012 2v2a2 2 0 01-2 2H4a2 2 0 01-2-2v-2zm14 1a1 1 0 11-2 0 1 1 0 012 0z"
                                          clip-rule="evenodd"/>
                                </svg>
                                {{ $lot->category->name }}
                            </div>

                            <div class="flex">
                                <img src="https://img.icons8.com/material-rounded/24/null/shipping-product.png" class="w-4 h-4 mr-1" />
                                {{ $lot->qty }} products remaining
                            </div>
                            
                        </div>
                        <div class="text-2xl text-yellow-600">
                            <unique-bids :lot="{{ $lot->id }}" :bid="{{ $lot->start_price }}" :unique="{{ $lot->number_of_unique_bids }}"></unique-bids>
                        </div>
                    </div>
                    <div class="mb-7">{!! $lot->description !!}</div>
                    
                    @include('layouts.lot-images')

                    
                    @if($lot->user_id === Auth::id())
                        <div class="flex">
                            <a
                                href="{{ route('lots.edit', $lot->id) }}"
                                type="submit"
                                class="flex justify-center items-center h-10 w-28 px-5 mt-3 mr-5 text-gray-100 transition-colors duration-200
                    bg-yellow-500 rounded-lg focus:shadow-outline hover:bg-yellow-600">
                                Edit
                            </a>
                            <form action="{{ route('lots.destroy', $lot->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="flex justify-center items-center h-10 w-28 px-5 mt-3 mr-5 text-gray-100 transition-colors duration-200
                    bg-red-500 rounded-lg focus:shadow-outline hover:bg-red-600"
                                        type="submit">Delete
                                </button>
                            </form>


                        </div>
                    @elseif($lot->status === 'On sale')
                        <div class="mt-5">
                            @include('layouts.bid-form')
                        </div>
                        
                    @endif
                    <div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (Auth::user()->hasRole('admin'))
        
    
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h5 class="text-center font-bold mb-3 " style="font-size: 17px;">Bidders</h5>
                        <table class="min-w-full divide-y divide-gray-200 bg-">
                            <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left font-medium text-gray-500">
                                    Name
                                </th>
                                
                                <th class="px-6 py-3 text-left font-medium text-gray-500">
                                    Email
                                </th>
                                <th class="px-6 py-3 text-left font-medium text-gray-500">
                                    Phone
                                </th>
                                <th class="px-6 py-3 text-left text-gray-500">
                                    Amount
                                </th>
                                <th class="px-6 py-3 text-left text-gray-500">
                                    action
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @php
                                    $bids = App\Models\Bid::where('lot_id', '=', $lot->id)->orderBy('created_at', 'DESC')->get();
                                @endphp
                            @forelse($bids as $bid)
                                <tr>
                                    <td class="px-6 py-3">
                                        @php
                                            
                                            $user = App\Models\User::where('id', '=', $bid->user_id)->first();
                                        @endphp
                                        {{ $user->name }}
                                    </td>
                                   
                                    <td class="px-6 py-3">
                                        {{ $user->email }}
                                    </td>
                                    <td class="px-6 py-3">
                                        {{ $user->phone_num }}
                                        
                                    </td>
                                    <td class="px-6 py-3">
                                        KSH {{ number_format($bid->price, 2) }}
                                    </td>
                                    <td>
                                        <form action="{{ route('winner') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="user_id" id="" value="{{ $user->id }}">
                                            <input type="hidden" name="lot_id" id="" value="{{ $lot->id }}">
                                            <input type="hidden" name="bid_id" id="" value="{{ $bid->id }}">
                                            
                                            <button type="submit" href="{{ route('winner') }}" class="h-10 w-28 p-2 bg-yellow-500 rounded-lg focus:shadow-outline hover:bg-yellow-600">Send Mail</button>

                                        </form>
                                    </td>
                                </tr>
                                    
                                @endforeach
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
    @endif
</x-app-layout>
