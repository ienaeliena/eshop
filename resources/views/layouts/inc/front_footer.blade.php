@php
    use Carbon\Carbon;

@endphp
<footer class="p-1 bg-dark text-white text-center position fixed-bottom">
    <div class="container">
        <span class="small">Copyright &copy; {{ Carbon::now()->format('Y') }}  {{ url('/') }}</span>
    </div>
</footer>
