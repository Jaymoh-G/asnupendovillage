@php
    $record = $getRecord();
@endphp

@if (!$record || !$record->exists)
    <div class="py-4 text-center text-gray-500">
        Save the album first to manage images.
    </div>
@else
    @php
        $images = $record->images()->orderBy('created_at', 'desc')->get();
    @endphp

    @if ($images->isEmpty())
        <div class="py-4 text-center text-gray-500">
            No images in this album yet.
        </div>
    @else
        <div class="mb-4 grid grid-cols-2 gap-3 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5">
            @foreach ($images as $image)
                <div class="group relative overflow-hidden rounded-lg bg-gray-100 shadow-sm">
                    <div class="aspect-square">
                        <img src="{{ asset('storage/' . $image->path) }}"
                            alt="{{ htmlspecialchars($image->original_name) }}" class="h-full w-full object-cover"
                            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="flex h-full w-full items-center justify-center bg-gray-200" style="display: none;">
                            <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                    </div>

                    {{-- Remove button overlay --}}
                    <div class="absolute right-1 top-1 z-10 opacity-0 transition-opacity duration-200 group-hover:opacity-100"
                        style="opacity: 1;">
                        <button type="button" onclick="removeImage({{ $image->id }})"
                            class="rounded-full bg-red-500 p-2 text-white shadow-lg transition-colors duration-200 hover:bg-red-600"
                            style="background-color: #ef4444; color: white; border: none; cursor: pointer;">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    {{-- Image info overlay --}}
                    <div
                        class="absolute inset-0 flex items-end bg-black bg-opacity-0 transition-all duration-200 group-hover:bg-opacity-50">
                        <div
                            class="w-full translate-y-full transform p-2 transition-transform duration-200 group-hover:translate-y-0">
                            <div class="text-xs text-white">
                                <p class="truncate font-medium">{{ htmlspecialchars($image->original_name) }}</p>
                                <p class="opacity-75">{{ $image->created_at->format('M j, Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endif

<script>
    function removeImage(imageId) {
        if (confirm('Are you sure you want to remove this image from the album?')) {
            fetch(`/admin/images/${imageId}/remove`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Reload the page to refresh the images
                        window.location.reload();
                    } else {
                        alert('Error removing image: ' + (data.message || 'Unknown error'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error removing image. Please try again.');
                });
        }
    }
</script>
