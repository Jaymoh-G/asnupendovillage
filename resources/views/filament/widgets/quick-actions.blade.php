<x-filament-widgets::widget>
    <x-filament::section>
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-bold tracking-tight">Quick Actions</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach($actions as $action)
            <a
                href="{{ $action['url'] }}"
                class="group relative bg-white p-6 focus-within:ring-2 focus-within:ring-inset focus-within:ring-primary-500 rounded-lg border border-gray-200 hover:border-gray-300 transition-all duration-200 hover:shadow-md"
            >
                <div>
                    <span
                        class="rounded-lg inline-flex p-3 {{
                            $action['color'] === 'primary'
                                ? 'bg-primary-50 text-primary-600'
                                : ''
                        }}{{
                            $action['color'] === 'success'
                                ? 'bg-success-50 text-success-600'
                                : ''
                        }}{{
                            $action['color'] === 'warning'
                                ? 'bg-warning-50 text-warning-600'
                                : ''
                        }}{{
                            $action['color'] === 'info'
                                ? 'bg-info-50 text-info-600'
                                : ''
                        }}{{
                            $action['color'] === 'danger'
                                ? 'bg-danger-50 text-danger-600'
                                : ''
                        }}"
                    >
                        <i
                            class="{{ $action['icon'] }} h-6 w-6"
                            aria-hidden="true"
                        ></i>
                    </span>
                </div>
                <div class="mt-4">
                    <h3
                        class="text-sm font-medium text-gray-900 group-hover:text-primary-600"
                    >
                        {{ $action["title"] }}
                    </h3>
                    <p class="mt-1 text-sm text-gray-500">
                        {{ $action["description"] }}
                    </p>
                </div>
                <span
                    class="pointer-events-none absolute top-6 right-6 text-gray-300 group-hover:text-gray-400"
                    aria-hidden="true"
                >
                    <i class="heroicon-o-arrow-up-right h-4 w-4"></i>
                </span>
            </a>
            @endforeach
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
