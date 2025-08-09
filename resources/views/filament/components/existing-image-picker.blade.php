<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    @php $maxFiles = method_exists($field, 'getMaxFiles') ?
    $field->getMaxFiles() : 5; $directory = method_exists($field,
    'getDirectory') ? $field->getDirectory() : 'images'; $existingImages =
    method_exists($field, 'getExistingImages') ? $field->getExistingImages() :
    []; @endphp

    <div
        x-data="{
            selectedImages: [],
            maxFiles: {{ $maxFiles }},
            searchTerm: '',
            filteredImages: @js($existingImages),
            init() {
                // Initialize selectedImages from the field value
                this.selectedImages = @entangle($getStatePath()).live || [];

                // Ensure selectedImages is always an array
                if (!Array.isArray(this.selectedImages)) {
                    this.selectedImages = [];
                }

                // Filter out any non-string items and ensure all items are strings
                this.selectedImages = this.selectedImages.filter(item => typeof item === 'string');

                // Debug logging
                console.log('ExistingImagePicker initialized:', {
                    selectedImages: this.selectedImages,
                    filteredImages: this.filteredImages,
                    maxFiles: this.maxFiles
                });

                this.filterImages();

                // Watch for changes and sync with Livewire
                this.$watch('selectedImages', (value) => {
                    // Ensure we're always working with an array of strings
                    if (Array.isArray(value)) {
                        const cleanValue = value.filter(item => typeof item === 'string');
                        if (JSON.stringify(cleanValue) !== JSON.stringify(value)) {
                            this.selectedImages = cleanValue;
                        }
                    }
                });
            },
            filterImages() {
                if (!this.searchTerm) {
                    this.filteredImages = @js($existingImages);
                } else {
                    this.filteredImages = @js($existingImages).filter(img =>
                        img.name.toLowerCase().includes(this.searchTerm.toLowerCase())
                    );
                }
            },
            toggleImageSelection(imagePath) {
                // Ensure we're working with the path string
                const path = typeof imagePath === 'string' ? imagePath : imagePath.path;

                if (this.selectedImages.includes(path)) {
                    this.selectedImages = this.selectedImages.filter(item => {
                        const itemPath = typeof item === 'string' ? item : item.path;
                        return itemPath !== path;
                    });
                } else if (this.selectedImages.length < this.maxFiles) {
                    this.selectedImages.push(path);
                }
            },
            isSelected(imagePath) {
                const path = typeof imagePath === 'string' ? imagePath : imagePath.path;
                return this.selectedImages.some(item => {
                    const itemPath = typeof item === 'string' ? item : item.path;
                    return itemPath === path;
                });
            },
            selectedCount() {
                return this.selectedImages.length;
            }
        }"
        class="space-y-4"
    >
        <div class="flex items-center justify-between">
            <label class="block text-sm font-medium text-gray-700">
                Select from Existing Images
            </label>
            <span class="text-sm text-gray-500">
                <span x-text="selectedCount()"></span> of
                {{ $maxFiles }} selected
            </span>
        </div>

        <!-- Search input -->
        <div class="relative">
            <input
                type="text"
                x-model="searchTerm"
                @input="filterImages()"
                placeholder="Search images by filename..."
                class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
            />
            <div
                class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
            >
                <svg
                    class="h-5 w-5 text-gray-400"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                    ></path>
                </svg>
            </div>
        </div>

        <!-- Hidden input for form submission -->
        <input
            type="hidden"
            name="{{ $getStatePath() }}"
            x-model="selectedImages"
        />

        <!-- Images grid -->
        <div
            class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3"
        >
            <template x-for="image in filteredImages" :key="image.path">
                <div
                    class="relative border-2 rounded-lg overflow-hidden cursor-pointer transition-all duration-200 hover:shadow-md"
                    :class="isSelected(image.path) ? 'border-blue-500 ring-2 ring-blue-200' : 'border-gray-200 hover:border-gray-300'"
                    @click="toggleImageSelection(image.path)"
                >
                    <img
                        :src="image.url"
                        :alt="image.name"
                        class="w-full h-24 object-cover"
                        loading="lazy"
                    />

                    <!-- Selection indicator -->
                    <div
                        x-show="isSelected(image.path)"
                        class="absolute top-2 right-2 bg-blue-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold"
                    >
                        ✓
                    </div>

                    <!-- Image info overlay -->
                    <div
                        class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-50 text-white text-xs p-1"
                    >
                        <div class="truncate" x-text="image.name"></div>
                        <div
                            class="text-gray-300"
                            x-text="(image.size / 1024).toFixed(1) + ' KB'"
                        ></div>
                    </div>
                </div>
            </template>
        </div>

        <!-- No images message -->
        <div
            x-show="filteredImages.length === 0"
            class="text-center py-8 text-gray-500"
        >
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
                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                ></path>
            </svg>
            <p
                class="mt-2"
                x-text="searchTerm ? 'No images found matching your search.' : 'No images found in this directory.'"
            ></p>
        </div>

        <!-- Selected images summary -->
        <div x-show="selectedImages.length > 0" class="border-t pt-4">
            <h4 class="text-sm font-medium text-gray-700 mb-2">
                Selected Images:
            </h4>

            <!-- Debug info (remove in production) -->
            <div
                x-show="false"
                class="mb-2 p-2 bg-gray-100 text-xs text-gray-600 rounded"
            >
                <strong>Debug:</strong>
                <span
                    x-text="'Type: ' + typeof selectedImages + ', Length: ' + selectedImages.length"
                ></span>
                <br />
                <span x-text="'Data: ' + JSON.stringify(selectedImages)"></span>
            </div>

            <div class="flex flex-wrap gap-2">
                <template x-for="imagePath in selectedImages" :key="imagePath">
                    <div
                        class="flex items-center space-x-2 bg-blue-50 border border-blue-200 rounded-full px-3 py-1"
                    >
                        <span
                            class="text-sm text-blue-700"
                            x-text="(() => {
                                try {
                                    if (typeof imagePath === 'string') {
                                        return imagePath.split('/').pop() || 'Unknown';
                                    } else if (imagePath && typeof imagePath === 'object' && imagePath.name) {
                                        return imagePath.name;
                                    } else {
                                        return 'Unknown';
                                    }
                                } catch (e) {
                                    console.error('Error processing imagePath:', imagePath, e);
                                    return 'Error';
                                }
                            })()"
                        ></span>
                        <button
                            type="button"
                            @click="toggleImageSelection(imagePath)"
                            class="text-blue-500 hover:text-blue-700"
                        >
                            ×
                        </button>
                    </div>
                </template>
            </div>
        </div>
    </div>

    @if ($errors->has($getStatePath()))
    <p class="text-sm text-red-600 mt-2">
        {{ $errors->first($getStatePath()) }}
    </p>
    @endif
</x-dynamic-component>
