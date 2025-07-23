<div class="p-6">
    <div class="mb-6">
        <h3 class="text-lg font-semibold text-gray-900">
            {{ $slider->title }}
        </h3>
        <p class="text-sm text-gray-600">{{ $slider->subtitle }}</p>
    </div>

    @php $images = $slider->images()->orderBy('created_at', 'desc')->get();
    @endphp @if ($images->isEmpty())
    <div class="text-center py-8">
        <svg
            class="mx-auto h-12 w-12 text-gray-400"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2 2v12a2 2 0 002 2z"
            ></path>
        </svg>
        <h3 class="mt-2 text-sm font-medium text-gray-900">No images</h3>
        <p class="mt-1 text-sm text-gray-500">
            No images have been uploaded for this slider yet.
        </p>
    </div>
    @else
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
        @foreach ($images as $image)
        <div
            class="group relative overflow-hidden rounded-lg bg-gray-100 shadow-sm"
        >
            <div class="aspect-video">
                <img
                    src="{{ asset('storage/' . $image->path) }}"
                    alt="{{ htmlspecialchars($image->original_name) }}"
                    class="h-full w-full object-cover"
                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                />
                <div
                    class="flex h-full w-full items-center justify-center bg-gray-200"
                    style="display: none"
                >
                    <svg
                        class="h-6 w-6 text-gray-400"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2 2v12a2 2 0 002 2z"
                        ></path>
                    </svg>
                </div>
            </div>

            {{-- Image info overlay --}}
            <div
                class="absolute inset-0 flex items-end bg-black bg-opacity-0 transition-all duration-200 group-hover:bg-opacity-50"
            >
                <div
                    class="w-full translate-y-full transform p-3 transition-transform duration-200 group-hover:translate-y-0"
                >
                    <div class="text-sm text-white">
                        <p class="font-medium">
                            {{ htmlspecialchars($image->original_name) }}
                        </p>
                        <p class="opacity-75 text-xs">
                            {{ $image->created_at->format('M j, Y g:i A') }}
                        </p>
                        @if ($image->alt_text)
                        <p class="opacity-75 text-xs mt-1">
                            {{ $image->alt_text }}
                        </p>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Actions overlay --}}
            <div
                class="absolute right-2 top-2 z-10 opacity-0 transition-opacity duration-200 group-hover:opacity-100"
            >
                <div class="flex space-x-1">
                    <a
                        href="{{ asset('storage/' . $image->path) }}"
                        target="_blank"
                        class="rounded-full bg-blue-500 p-2 text-white shadow-lg transition-colors duration-200 hover:bg-blue-600"
                    >
                        <svg
                            class="h-4 w-4"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"
                            ></path>
                        </svg>
                    </a>
                    <button
                        type="button"
                        onclick="removeImage({{ $image->id }})"
                        class="rounded-full bg-red-500 p-2 text-white shadow-lg transition-colors duration-200 hover:bg-red-600"
                    >
                        <svg
                            class="h-4 w-4"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"
                            ></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-6 text-center">
        <p class="text-sm text-gray-600">
            Total:
            {{ $images->count() }} image{{ $images->count() !== 1 ? 's' : '' }}
        </p>
    </div>
    @endif
</div>

<script>
    function removeImage(imageId) {
        if (
            confirm(
                "Are you sure you want to remove this image from the slider?"
            )
        ) {
            fetch(`/admin/images/${imageId}/remove`, {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                    Accept: "application/json",
                    "Content-Type": "application/json",
                },
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        // Reload the page to refresh the images
                        window.location.reload();
                    } else {
                        alert(
                            "Error removing image: " +
                                (data.message || "Unknown error")
                        );
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    alert("Error removing image. Please try again.");
                });
        }
    }
</script>
