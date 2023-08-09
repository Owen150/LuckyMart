<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            Purchases List
        </h1>
    </x-slot>

    <div class="p-6">
        <div class="container p-2 bg-white">
        
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3 rounded-l-lg">
                                Lot name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                User
                            </th>
                            <th scope="col" class="px-6 py-3 rounded-r-lg">
                                Price
                            </th>
                            <th scope="col" class="px-6 py-3 rounded-r-lg">
                                date/time
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($purchases as $purchase)
                            
                        
                        <tr class="bg-white dark:bg-gray-800">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $purchase->lot->name }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $purchase->user->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $purchase->price }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $purchase->created_at->toFormattedDateString() }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    
                </table>
            </div>
    
        </div>
    </div>
    
</x-app-layout>