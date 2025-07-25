<div>
    <div class="container space-top space-extra-bottom">
        <div class="row gy-4 gx-4 justify-content-center">
            @forelse($news as $item)
            <div class="col-md-4">
                <div
                    class="service-card h-100 d-flex flex-column justify-content-between p-2"
                >
                    @if($item->featured_image_url)
                    <img
                        src="{{ $item->featured_image_url }}"
                        alt="{{ $item->title }}"
                        class="img-fluid mb-2"
                        style="
                            max-height: 180px;
                            object-fit: cover;
                            width: 100%;
                        "
                    />
                    @endif
                    <div class="box-content">
                        <div class="small text-muted mb-1">
                            {{ $item->updated_at->format('M d, Y') }}
                        </div>
                        <h3 class="box-title">{{ $item->title }}</h3>
                        <p class="box-text">
                            {{ \Illuminate\Support\Str::limit($item->excerpt ?? $item->description ?? $item->content ?? '', 120) }}
                        </p>
                        <a
                            href="{{ route('news.detail', $item->slug) }}"
                            class="th-btn btn-sm mt-2"
                            >Read More</a
                        >
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">No news found.</div>
            @endforelse
        </div>
        <div class="mt-5 d-flex justify-content-center">
            {{ $news->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>
