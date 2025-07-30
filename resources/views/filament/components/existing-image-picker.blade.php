<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    @php
        $maxFiles = method_exists($field, 'getMaxFiles') ? $field->getMaxFiles() : 5;
    @endphp

    <div
        x-data="{
            selectedImages: [],
            maxFiles: {{ $maxFiles }},
            init() {
                this.$refs.input.addEventListener('change', (event) => {
                    const files = Array.from(event.target.files);
                    for (const file of files) {
                        if (this.selectedImages.length < this.maxFiles) {
                            const reader = new FileReader();
                            reader.onload = (e) => {
                                this.selectedImages.push({
                                    name: file.name,
                                    url: e.target.result,
                                });
                            };
                            reader.readAsDataURL(file);
                        }
                    }
                });
            },
            removeImage(index) {
                this.selectedImages.splice(index, 1);
            },
            selectedCount() {
                return this.selectedImages.length;
            }
        }"
        class="space-y-2"
    >
        <label class="block text-sm font-medium text-gray-700">
            Upload Images
        </label>

        <input
            type="file"
            {{ $applyStateBindingModifiers('wire:model') }}="{{ $getStatePath() }}"
            multiple
            x-ref="input"
            accept="image/*"
            id="{{ $getId() }}"
            dusk="filament.forms.file-upload.{{ $getStatePath() }}"
            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                   file:rounded-full file:border-0 file:text-sm file:font-semibold
                   file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
        />

        <template x-if="selectedImages.length > 0">
            <div>
                <label class="block text-sm font-medium text-gray-700">
                    Selected Images (<span x-text="selectedCount()"></span> of {{ $maxFiles }} max)
                </label>

                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-2 mt-2">
                    <template x-for="(image, index) in selectedImages" :key="index">
                        <div class="relative border rounded overflow-hidden group">
                            <img :src="image.url" class="w-full h-32 object-cover" />

                            <button type="button"
                                @click="removeImage(index)"
                                class="absolute top-0 right-0 mt-1 mr-1 bg-white rounded-full p-1 shadow text-red-600 hover:bg-red-100">
                                &times;
                            </button>
                        </div>
                    </template>
                </div>
            </div>
        </template>
    </div>

    @if ($errors->has($getStatePath()))
        <p class="text-sm text-red-600 mt-2">
            {{ $errors->first($getStatePath()) }}
        </p>
    @endif
</x-dynamic-component>
