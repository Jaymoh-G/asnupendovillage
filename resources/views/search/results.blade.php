@extends('components.layouts.app') @section('content')
<div class="container space-top space-extra-bottom">
    <div class="row">
        <div class="col-12">
            <div class="search-header text-center mb-5">
                <h1 class="search-title">Search Results</h1>
                <div class="search-stats">
                    <p class="text-muted">
                        Found <strong>{{ $totalResults }}</strong> results for
                        "<strong>{{ $query }}</strong
                        >"
                    </p>
                </div>

                <!-- Search Form -->
                <div class="search-form-wrapper mt-4">
                    <form
                        action="{{ route('search') }}"
                        method="GET"
                        class="search-form"
                    >
                        <div class="input-group">
                            <input
                                type="text"
                                name="q"
                                value="{{ $query }}"
                                class="form-control search-input"
                                placeholder="Search for anything on our website..."
                                required
                            />
                            <button
                                type="submit"
                                class="btn btn-primary search-btn"
                            >
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            @if($results->count() > 0)
            <div class="search-results">
                @foreach($results as $result)
                <div class="search-result-item">
                    <div class="result-content">
                        <div class="result-header">
                            <div class="result-type">
                                <span
                                    class="badge badge-{{ strtolower(str_replace(' ', '-', $result->type)) }}"
                                >
                                    {{ $result->type }}
                                </span>
                            </div>
                            <h3 class="result-title">
                                <a
                                    href="{{ $result->url }}"
                                    class="result-link"
                                >
                                    {{ $result->title ?? $result->name }}
                                </a>
                            </h3>
                        </div>

                        @if(!empty($result->searchable_content))
                        <div class="result-excerpt">
                            <p>{{ $result->searchable_content }}</p>
                        </div>
                        @endif

                        <div class="result-meta">
                            <a
                                href="{{ $result->url }}"
                                class="btn btn-sm btn-outline-primary"
                            >
                                View {{ $result->type }}
                                <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="search-pagination mt-5">
                {{ $results->appends(['q' => $query])->links('pagination::bootstrap-4') }}
            </div>
            @else
            <div class="no-results text-center py-5">
                <i class="fas fa-search fa-3x text-muted mb-3"></i>
                <h3 class="text-muted">No results found</h3>
                <p class="text-muted">
                    We couldn't find any results for "{{ $query }}". Try
                    different keywords or check your spelling.
                </p>
                <div class="search-suggestions mt-3">
                    <h5>Search suggestions:</h5>
                    <ul class="list-unstyled">
                        <li>• Try using different keywords</li>
                        <li>• Check your spelling</li>
                        <li>• Use more general terms</li>
                        <li>• Try searching for related topics</li>
                    </ul>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
    .search-header {
        padding: 2rem 0;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 15px;
        margin-bottom: 2rem;
    }

    .search-title {
        color: var(--title-color);
        margin-bottom: 1rem;
        font-size: 2.5rem;
        font-weight: 700;
    }

    .search-stats {
        font-size: 1.1rem;
    }

    .search-form-wrapper {
        max-width: 600px;
        margin: 0 auto;
    }

    .search-form .input-group {
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        border-radius: 50px;
        overflow: hidden;
    }

    .search-input {
        border: none;
        padding: 1rem 1.5rem;
        font-size: 1.1rem;
        border-radius: 50px 0 0 50px;
    }

    .search-input:focus {
        box-shadow: none;
        border-color: var(--theme-color);
    }

    .search-btn {
        border: none;
        padding: 1rem 1.5rem;
        border-radius: 0 50px 50px 0;
        background: var(--theme-color);
        color: white;
        font-size: 1.1rem;
    }

    .search-btn:hover {
        background: var(--theme-color2);
        color: white;
    }

    .search-result-item {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        border: 1px solid rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .search-result-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .result-header {
        margin-bottom: 1rem;
    }

    .result-type {
        margin-bottom: 0.5rem;
    }

    .badge {
        padding: 0.5rem 1rem;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .badge-news {
        background: #007bff;
        color: white;
    }
    .badge-event {
        background: #28a745;
        color: white;
    }
    .badge-program {
        background: #ffc107;
        color: #212529;
    }
    .badge-project {
        background: #17a2b8;
        color: white;
    }
    .badge-facility {
        background: #6f42c1;
        color: white;
    }
    .badge-career {
        background: #fd7e14;
        color: white;
    }
    .badge-team-member {
        background: #e83e8c;
        color: white;
    }
    .badge-page {
        background: #6c757d;
        color: white;
    }
    .badge-album {
        background: #20c997;
        color: white;
    }
    .badge-video {
        background: #dc3545;
        color: white;
    }

    .result-title {
        font-size: 1.4rem;
        margin-bottom: 0.5rem;
    }

    .result-title a {
        color: var(--title-color);
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .result-title a:hover {
        color: var(--theme-color);
    }

    .result-excerpt {
        margin-bottom: 1rem;
    }

    .result-excerpt p {
        color: var(--body-color);
        line-height: 1.6;
        margin-bottom: 0;
    }

    .result-meta {
        display: flex;
        justify-content: flex-end;
    }

    .btn-outline-primary {
        border-color: var(--theme-color);
        color: var(--theme-color);
    }

    .btn-outline-primary:hover {
        background: var(--theme-color);
        border-color: var(--theme-color);
        color: white;
    }

    .no-results {
        background: white;
        border-radius: 15px;
        padding: 3rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .search-suggestions {
        text-align: left;
        max-width: 400px;
        margin: 0 auto;
    }

    .search-suggestions ul li {
        margin-bottom: 0.5rem;
        color: var(--body-color);
    }

    .search-pagination {
        display: flex;
        justify-content: center;
        margin-top: 3rem;
    }

    .search-pagination .pagination {
        margin-bottom: 0;
        gap: 0.25rem;
    }

    .search-pagination .page-link {
        border-radius: 8px;
        margin: 0;
        border: 1px solid #e9ecef;
        color: var(--theme-color);
        background-color: #f8f9fa;
        padding: 0.75rem 1rem;
        font-weight: 500;
        transition: all 0.3s ease;
        min-width: 45px;
        text-align: center;
    }

    .search-pagination .page-link:hover {
        background: var(--theme-color);
        border-color: var(--theme-color);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .search-pagination .page-item.active .page-link {
        background: var(--theme-color);
        border-color: var(--theme-color);
        color: white;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .search-pagination .page-item.disabled .page-link {
        color: #6c757d;
        background-color: #f8f9fa;
        border-color: #e9ecef;
        cursor: not-allowed;
    }

    .search-pagination .page-item.disabled .page-link:hover {
        transform: none;
        box-shadow: none;
        background-color: #f8f9fa;
        color: #6c757d;
    }

    @media (max-width: 768px) {
        .search-title {
            font-size: 2rem;
        }

        .search-form-wrapper {
            max-width: 100%;
            padding: 0 1rem;
        }

        .search-result-item {
            padding: 1rem;
        }

        .result-title {
            font-size: 1.2rem;
        }

        .search-pagination .page-link {
            padding: 0.5rem 0.75rem;
            min-width: 40px;
            font-size: 0.9rem;
        }

        .search-pagination .pagination {
            gap: 0.15rem;
        }
    }
</style>
@endsection
