<banner-carousel :init-banners="{{ $banners }}">
    
</banner-carousel>

@push('scripts')
<script src="{{ route('avored.banner.js') }}"></script>
@endpush
