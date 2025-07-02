<div class="space-y-4">
    <!-- Album Info -->
    <div class="flex items-center space-x-4 rounded-lg bg-gray-50 p-4">
        @if ($album->cover_image)
            <div class="h-16 w-16 overflow-hidden rounded-lg">
                <img src="{{ asset('storage/' . $album->cover_image) }}" alt="{{ $album->name }}"
                    class="h-full w-full object-cover">
            </div>
        @else
            <div class="flex h-16 w-16 items-center justify-center rounded-lg bg-gray-200">
                <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                    </path>
                </svg>
            </div>
        @endif
        <div>
            <h3 class="text-lg font-semibold text-gray-900">{{ $album->name }}</h3>
            @if ($album->description)
                <p class="text-sm text-gray-600">{{ $album->description }}</p>
            @endif
            <p class="text-xs text-gray-500">{{ $album->images()->count() }} images</p>
        </div>
    </div>

    <!-- Images Grid -->
    @php
        $images = $album->images()->orderBy('created_at', 'desc')->get();
    @endphp

    @if ($images->count() > 0)
        <div class="grid max-h-96 grid-cols-2 gap-3 overflow-y-auto sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5">
            @foreach ($images as $image)
                <div
                    class="group relative overflow-hidden rounded-lg bg-gray-100 shadow-sm transition-shadow duration-200 hover:shadow-md">
                    <div class="aspect-square">
                        <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $image->original_name }}"
                            class="h-full w-full object-cover transition-transform duration-200 group-hover:scale-105"
                            onclick="openImageModal('{{ asset('storage/' . $image->path) }}', '{{ $image->original_name }}')"
                            style="cursor: pointer;"
                            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="flex h-full w-full items-center justify-center bg-gray-200" style="display: none;">
                            <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                    </div>

                    <!-- Image Info Overlay -->
                    <div
                        class="absolute inset-0 flex items-end bg-black bg-opacity-0 transition-all duration-200 group-hover:bg-opacity-50">
                        <div
                            class="w-full translate-y-full transform p-2 transition-transform duration-200 group-hover:translate-y-0">
                            <div class="text-xs text-white">
                                <p class="truncate font-medium">{{ $image->original_name }}</p>
                                <p class="opacity-75">{{ $image->created_at->format('M j, Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="py-8 text-center">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                </path>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">No images</h3>
            <p class="mt-1 text-sm text-gray-500">
                This album doesn't have any images yet.
            </p>
        </div>
    @endif
</div>

<!-- Image Modal -->
<div id="imageModal" class="fixed inset-0 z-50 flex hidden items-center justify-center bg-black bg-opacity-75 p-4"
    style="position: fixed; top: 0; left: 0; right: 0; bottom: 0;">
    <div class="relative max-h-full max-w-4xl">
        <button onclick="closeImageModal()"
            class="absolute -top-10 right-0 text-white transition-colors duration-200 hover:text-gray-300">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        <img id="modalImage" src="" alt="" class="max-h-full max-w-full rounded-lg object-contain">
        <div class="absolute bottom-4 left-4 right-4 rounded-lg bg-black bg-opacity-50 p-3 text-white">
            <p id="modalImageName" class="font-medium"></p>
        </div>
    </div>
</div>

<script>
    function openImageModal(imageSrc, imageName) {
        document.getElementById('modalImage').src = imageSrc;
        document.getElementById('modalImageName').textContent = imageName;
        document.getElementById('imageModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeImageModal() {
        document.getElementById('imageModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Close modal when clicking outside
    document.getElementById('imageModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeImageModal();
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeImageModal();
        }
    });
</script>
