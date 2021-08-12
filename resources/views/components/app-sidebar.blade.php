<ul class="nk-menu">
    @if(auth()->user()->hasRole('admin'))
        <!-- admin nav -->
        <x-admin.sidebar/>
        <!-- admin nav -->
    @elseif(auth()->user()->hasRole('merchant'))
        <!-- merchant nav -->
        <x-merchant.sidebar/>
        <!-- merchant nav -->
    @endif
</ul><!-- .nk-menu -->