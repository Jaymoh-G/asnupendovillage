<div>
    <div class="container space-top space-extra-bottom">
        <div class="row gy-4 gx-4 justify-content-center">
            @forelse($careers as $careerItem)
            <div class="col-md-4">
                <div class="service-card">
                    <div class="box-content">
                        <h3 class="box-title">
                            {{ $careerItem->title ?? 'Career' }}
                        </h3>
                        <p class="box-text">
                            {{ \Illuminate\Support\Str::limit($careerItem->description ?? '', 100) }}
                        </p>
                        <a
                            href="{{ route('careers.detail', $careerItem->slug) }}"
                            class="th-btn btn-sm mt-2"
                            >View Details</a
                        >
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                No career opportunities available at the moment.
            </div>
            @endforelse
        </div>
    </div>
</div>
