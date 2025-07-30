<x-filament-widgets::widget>
    <x-filament::section>
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-gray-900">
                    {{ $greeting }}, {{ $user->name ?? 'Administrator' }}! 👋
                </h1>
                <p class="mt-1 text-sm text-gray-600">
                    Welcome to ASN Upendo Village Dashboard. Here's what's
                    happening today.
                </p>
            </div>
            <div class="hidden sm:block">
                <div class="flex items-center space-x-2">
                    <div
                        class="w-2 h-2 bg-green-400 rounded-full animate-pulse"
                    ></div>
                    <span class="text-sm text-gray-500">System Online</span>
                </div>
            </div>
        </div>

        <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
            <div
                class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg p-4 text-white"
            >
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="heroicon-o-heart h-8 w-8"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium">Community Impact</p>
                        <p class="text-lg font-semibold">Making a Difference</p>
                    </div>
                </div>
            </div>

            <div
                class="bg-gradient-to-r from-green-500 to-green-600 rounded-lg p-4 text-white"
            >
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="heroicon-o-users h-8 w-8"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium">Team Collaboration</p>
                        <p class="text-lg font-semibold">Working Together</p>
                    </div>
                </div>
            </div>

            <div
                class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg p-4 text-white"
            >
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="heroicon-o-star h-8 w-8"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium">Excellence</p>
                        <p class="text-lg font-semibold">Quality Service</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 p-4 bg-gray-50 rounded-lg">
            <div class="flex items-center">
                <i
                    class="heroicon-o-information-circle h-5 w-5 text-blue-500 mr-2"
                ></i>
                <p class="text-sm text-gray-600">
                    <strong>Quick Tip:</strong> Use the Quick Actions below to
                    quickly add new content or manage existing items. The
                    dashboard provides real-time insights into your
                    organization's activities and content health.
                </p>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
