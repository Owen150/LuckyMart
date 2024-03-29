<div class="grid lg:grid-cols-3 sm:grid-cols-2 gap-4" style="">
    @forelse($lot->images as $image)
        <div s>
            @if($deleteButton ?? '')
                <div class="hover:block">
                    <form method="post" action="{{ route('lot-images.destroy', $image->id) }}">
                        @csrf
                        @method('DELETE')
                        <div class="relative">
                            <button type="submit" class="absolute right-2 text-red-500 text-3xl" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </form>
                </div>
            @endif
            <a href="{{ asset('/store/' . $image->path) }}">
                <img
                    src="{{ asset('/store/' . $image->path) }}"
                    alt="lot image"
                    style="height: 40vh">
            </a>
        </div>
    @empty
        <x-default-lot-image/>
    @endforelse
</div>
