<ul class="nk-menu">
    @if(auth()->user()->hasRole('admin'))
        <!-- admin nav -->
        <x-admin.sidebar/>
        <!-- admin nav -->
    @endif
</ul><!-- .nk-menu -->