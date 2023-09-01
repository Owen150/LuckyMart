<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Search Results for {{ $term }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" overflow-hidden sm:rounded-lg">
                <div class="p-6">
                    @if($lots->isNotEmpty())
                        <div class="container mx-auto">
                            @include('layouts.errors-message')
                            
                            <div class="mb-4">                            
                                <div class="grid  grid-cols-2 lg:grid-cols-3 gap-4">                            
                                        @foreach($lots as $lot)
                                            <div class="bg-white justify-between  p-3 rounded-md shadow-lg border border-slate-700 border-solid">                                            
                                                <div class="">
                                                    <div class="px-1">
                                                        @if($lot->images->isNotEmpty())
                                                            <img class="max-h-24 max-w-24 p-1"
                                                                src="{{ asset('/store/' . $lot->images[0]->path) }}">
                                                        @else
                                                            <x-default-lot-image/>
                                                        @endif
                                                    </div>
                                                    <div class="">
                                                        <div class="p-2">
                                                            <a class="hover:border-yellow-500 "
                                                            href="{{route('lots.show', $lot->id)}}">
                                                                <strong>{{ $lot->short_name }}</strong>
                                                            </a>
                                                        </div>
                                                        <div class="p-2">
                                                            <a href="{{route('lots.show', $lot->id)}}">
                                                            <button class="p-1 w-full lg:w-24 rounded-sm" style="background: #f59e0b">Bid</button>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>                                
                                            </div>
                                        @endforeach
                                </div>
                            </div>
                                                
                            <div>{{$lots->links()}}</div>
                                                    
                        </div>
                    @else
                        <p>You have not uploaded any lot.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
