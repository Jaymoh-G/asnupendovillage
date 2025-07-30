<x-filament-widgets::widget>
    <x-filament::section>
        <div class="flex items-center justify-between">
            <h2 class="text-lg font-bold tracking-tight">Recent Activities</h2>
            <a
                href="#"
                class="text-sm font-medium text-primary-600 hover:text-primary-500"
            >
                View all
            </a>
        </div>

        <div class="mt-6 flow-root">
            <ul role="list" class="-mb-8">
                @forelse($activities as $index => $activity)
                <li>
                    <div class="relative pb-8">
                        @if($index !== $activities->count() - 1)
                        <span
                            class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200"
                            aria-hidden="true"
                        ></span>
                        @endif
                        <div class="relative flex space-x-3">
                            <div>
                                <span
                                    class="h-8 w-8 rounded-full flex items-center justify-center ring-8 ring-white {{
                                        $activity['color']
                                    }} bg-gray-50"
                                >
                                    <i
                                        class="{{ $activity['icon'] }} h-4 w-4"
                                    ></i>
                                </span>
                            </div>
                            <div
                                class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5"
                            >
                                <div>
                                    <p class="text-sm text-gray-500">
                                        <a
                                            href="{{ $activity['url'] }}"
                                            class="font-medium text-gray-900 hover:text-primary-600"
                                        >
                                            {{ $activity["title"] }}
                                        </a>
                                        <span class="ml-1">{{
                                            $activity["description"]
                                        }}</span>
                                    </p>
                                </div>
                                <div
                                    class="whitespace-nowrap text-right text-sm text-gray-500"
                                >
                                    <time
                                        datetime="{{ $activity['date']->format('Y-m-d') }}"
                                    >
                                        {{ $activity['date']->diffForHumans() }}
                                    </time>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                @empty
                <li class="text-center py-8">
                    <div class="text-gray-500">
                        <i
                            class="heroicon-o-information-circle h-8 w-8 mx-auto mb-2"
                        ></i>
                        <p>No recent activities</p>
                    </div>
                </li>
                @endforelse
            </ul>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
