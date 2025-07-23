<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    <div
        x-data="{
        selectedImages: @entangle($getStatePath()),
        existingImages: @js($getExistingImages()),
        showModal: false,
        searchTerm: '',
        selectedCount: 0,

        init() {
            this.updateSelectedCount();
        },

        get filteredImages() {
            if (!this.searchTerm) return this.existingImages;
            return this.existingImages.filter(image =>
                image.name.toLowerCase().includes(this.searchTerm.toLowerCase())
            );
        },

        toggleImage(imagePath) {
            const index = this.selectedImages.indexOf(imagePath);
            if (index > -1) {
                this.selectedImages.splice(index, 1);
            } else {
                if (this.selectedImages.length < {{ $getMaxFiles() }}) {
                    this.selectedImages.push(imagePath);
                }
            }
            this.updateSelectedCount();
        },

        isSelected(imagePath) {
            return this.selectedImages.includes(imagePath);
        },

        updateSelectedCount() {
            this.selectedCount = this.selectedImages.length;
        },

        openModal() {
            this.showModal = true;
        },

        closeModal() {
            this.showModal = false;
        },

        formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        },

        formatDate(timestamp) {
            return new Date(timestamp * 1000).toLocaleDateString();
        }
    }"
    >
        <!-- Selected Images Display -->
        <div class="mb-4">
            <div class="flex items-center justify-between mb-2">
                <label class="text-sm font-medium text-gray-700">
                    Selected Images ({{ $getMaxFiles() }} max)
                </label>
                <span
                    class="text-sm text-gray-500"
                    x-text="`${selectedCount} selected`"
                ></span>
            </div>

            <!-- Selected Images Grid -->
            <div
                class="grid grid-cols-2 gap-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5"
                x-show="selectedImages.length > 0"
            >
                <template x-for="imagePath in selectedImages" :key="imagePath">
                    <div class="relative group">
                        <div
                            class="aspect-square rounded-lg overflow-hidden bg-gray-100"
                        >
                            <img
                                :src="existingImages.find(img => img.path === imagePath)?.url"
                                :alt="existingImages.find(img => img.path === imagePath)?.name"
                                class="w-full h-full object-cover"
                                @error="$el.style.display='none'"
                            />
                        </div>
                        <button
                            type="button"
                            @click="toggleImage(imagePath)"
                            class="absolute top-1 right-1 bg-red-500 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition-opacity"
                        >
                            <svg
                                class="w-3 h-3"
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
                </template>
            </div>

            <!-- No Images Selected -->
            <div
                x-show="selectedImages.length === 0"
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
                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2 2v12a2 2 0 002 2z"
                    ></path>
                </svg>
                <p class="mt-2 text-sm">No images selected</p>
            </div>
        </div>

        <!-- Select Images Button -->
        <button
            type="button"
            @click="openModal"
            class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
        >
            <svg
                class="inline-block w-4 h-4 mr-2"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"
                ></path>
            </svg>
            {{ $getPlaceholder() }}
        </button>

        <!-- Modal -->
        <div
            x-show="showModal"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 overflow-y-auto"
            style="display: none"
        >
            <div
                class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0"
            >
                <div
                    class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                    @click="closeModal"
                ></div>

                <div
                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full"
                >
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="w-full">
                                <div
                                    class="flex items-center justify-between mb-4"
                                >
                                    <h3
                                        class="text-lg leading-6 font-medium text-gray-900"
                                    >
                                        Select from Existing Images
                                    </h3>
                                    <button
                                        type="button"
                                        @click="closeModal"
                                        class="text-gray-400 hover:text-gray-600"
                                    >
                                        <svg
                                            class="w-6 h-6"
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

                                <!-- Search -->
                                <div class="mb-4">
                                    <input
                                        type="text"
                                        x-model="searchTerm"
                                        placeholder="Search images..."
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                    />
                                </div>

                                <!-- Images Grid -->
                                <div class="max-h-96 overflow-y-auto">
                                    <div
                                        class="grid grid-cols-2 gap-3 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5"
                                    >
                                        <template
                                            x-for="image in filteredImages"
                                            :key="image.path"
                                        >
                                            <div
                                                class="relative group cursor-pointer"
                                                @click="toggleImage(image.path)"
                                            >
                                                <div
                                                    class="aspect-square rounded-lg overflow-hidden bg-gray-100 border-2 transition-colors"
                                                    :class="isSelected(image.path) ? 'border-indigo-500' : 'border-gray-200 hover:border-gray-300'"
                                                >
                                                    <img
                                                        :src="image.url"
                                                        :alt="image.name"
                                                        class="w-full h-full object-cover"
                                                        @error="$el.style.display='none'"
                                                    />

                                                    <!-- Selection Indicator -->
                                                    <div
                                                        x-show="isSelected(image.path)"
                                                        class="absolute inset-0 bg-indigo-500 bg-opacity-20 flex items-center justify-center"
                                                    >
                                                        <div
                                                            class="bg-indigo-500 text-white rounded-full p-1"
                                                        >
                                                            <svg
                                                                class="w-4 h-4"
                                                                fill="currentColor"
                                                                viewBox="0 0 20 20"
                                                            >
                                                                <path
                                                                    fill-rule="evenodd"
                                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                                    clip-rule="evenodd"
                                                                ></path>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Image Info -->
                                                <div
                                                    class="mt-1 text-xs text-gray-500"
                                                >
                                                    <p
                                                        class="truncate"
                                                        x-text="image.name"
                                                    ></p>
                                                    <p
                                                        x-text="formatFileSize(image.size)"
                                                    ></p>
                                                    <p
                                                        x-text="formatDate(image.last_modified)"
                                                    ></p>
                                                </div>
                                            </div>
                                        </template>
                                    </div>

                                    <!-- No Images Found -->
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
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2 2v12a2 2 0 002 2z"
                                            ></path>
                                        </svg>
                                        <p
                                            class="mt-2 text-sm"
                                            x-text="searchTerm ? 'No images found matching your search' : 'No images available'"
                                        ></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div
                        class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse"
                    >
                        <button
                            type="button"
                            @click="closeModal"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm"
                        >
                            Done
                        </button>
                        <button
                            type="button"
                            @click="selectedImages = []; updateSelectedCount()"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                        >
                            Clear All
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dynamic-component>
