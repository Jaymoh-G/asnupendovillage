<x-filament-widgets::widget>
    <x-filament::section>
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-bold tracking-tight">
                System Health & Analytics
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Content Health Score -->
            <div class="bg-white p-6 rounded-lg border border-gray-200">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div
                            class="w-8 h-8 rounded-full flex items-center justify-center {{
                                $metrics['health_score'] >= 80
                                    ? 'bg-green-100'
                                    : $metrics['health_score'] >= 60
                                    ? 'bg-yellow-100'
                                    : 'bg-red-100'
                            }}"
                        >
                            <i
                                class="heroicon-o-heart {{
                                    $metrics['health_score'] >= 80
                                        ? 'text-green-600'
                                        : $metrics['health_score'] >= 60
                                        ? 'text-yellow-600'
                                        : 'text-red-600'
                                }} h-5 w-5"
                            ></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-900">
                            Content Health
                        </p>
                        <p
                            class="text-2xl font-semibold {{
                                $metrics['health_score'] >= 80
                                    ? 'text-green-600'
                                    : $metrics['health_score'] >= 60
                                    ? 'text-yellow-600'
                                    : 'text-red-600'
                            }}"
                        >
                            {{ $metrics["health_score"] }}%
                        </p>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white p-6 rounded-lg border border-gray-200">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div
                            class="w-8 h-8 rounded-full flex items-center justify-center bg-blue-100"
                        >
                            <i
                                class="heroicon-o-clock text-blue-600 h-5 w-5"
                            ></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-900">
                            Recent Activity
                        </p>
                        <p class="text-2xl font-semibold text-blue-600">
                            {{
                                $metrics["recent_news"] +
                                    $metrics["recent_events"] +
                                    $metrics["recent_projects"]
                            }}
                        </p>
                        <p class="text-xs text-gray-500">Last 7 days</p>
                    </div>
                </div>
            </div>

            <!-- Upcoming Events -->
            <div class="bg-white p-6 rounded-lg border border-gray-200">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div
                            class="w-8 h-8 rounded-full flex items-center justify-center bg-purple-100"
                        >
                            <i
                                class="heroicon-o-calendar text-purple-600 h-5 w-5"
                            ></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-900">
                            Upcoming Events
                        </p>
                        <p class="text-2xl font-semibold text-purple-600">
                            {{ $metrics["upcoming_events"] }}
                        </p>
                        <p class="text-xs text-gray-500">Scheduled</p>
                    </div>
                </div>
            </div>

            <!-- Storage Usage -->
            <div class="bg-white p-6 rounded-lg border border-gray-200">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div
                            class="w-8 h-8 rounded-full flex items-center justify-center bg-orange-100"
                        >
                            <i
                                class="heroicon-o-server text-orange-600 h-5 w-5"
                            ></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-900">
                            Media Files
                        </p>
                        <p class="text-2xl font-semibold text-orange-600">
                            {{
                                $metrics["total_images"] +
                                    $metrics["total_downloads"]
                            }}
                        </p>
                        <p class="text-xs text-gray-500">Total files</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detailed Metrics -->
        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Recent Content -->
            <div class="bg-white p-6 rounded-lg border border-gray-200">
                <h3 class="text-lg font-medium text-gray-900 mb-4">
                    Recent Content (7 days)
                </h3>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">News Articles</span>
                        <span class="text-sm font-medium text-gray-900">{{
                            $metrics["recent_news"]
                        }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Events</span>
                        <span class="text-sm font-medium text-gray-900">{{
                            $metrics["recent_events"]
                        }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Projects</span>
                        <span class="text-sm font-medium text-gray-900">{{
                            $metrics["recent_projects"]
                        }}</span>
                    </div>
                </div>
            </div>

            <!-- Inactive Content -->
            <div class="bg-white p-6 rounded-lg border border-gray-200">
                <h3 class="text-lg font-medium text-gray-900 mb-4">
                    Inactive Content
                </h3>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">News Articles</span>
                        <span
                            class="text-sm font-medium {{
                                $metrics['inactive_news'] > 0
                                    ? 'text-red-600'
                                    : 'text-green-600'
                            }}"
                            >{{ $metrics["inactive_news"] }}</span
                        >
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Events</span>
                        <span
                            class="text-sm font-medium {{
                                $metrics['inactive_events'] > 0
                                    ? 'text-red-600'
                                    : 'text-green-600'
                            }}"
                            >{{ $metrics["inactive_events"] }}</span
                        >
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Projects</span>
                        <span
                            class="text-sm font-medium {{
                                $metrics['inactive_projects'] > 0
                                    ? 'text-red-600'
                                    : 'text-green-600'
                            }}"
                            >{{ $metrics["inactive_projects"] }}</span
                        >
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Team Members</span>
                        <span
                            class="text-sm font-medium {{
                                $metrics['inactive_team'] > 0
                                    ? 'text-red-600'
                                    : 'text-green-600'
                            }}"
                            >{{ $metrics["inactive_team"] }}</span
                        >
                    </div>
                </div>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
