@php $programId = $programId ?? null; @endphp @extends('components.layouts.app')
@section('content')
<livewire:frontend.downloads :program-id="$programId" />
@endsection
