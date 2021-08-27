<ul class="nk-menu">
    @if(auth()->user()->hasRole('admin'))
        <!-- admin nav -->
        <x-admin.sidebar/>
        <!-- admin nav -->
    @elseif(auth()->user()->hasRole('merchant'))
        <!-- merchant nav -->
        <x-merchant.sidebar/>
        <!-- merchant nav -->
    @elseif(auth()->user()->hasRole('agent'))
        <!-- agent nav -->
        <x-agent.sidebar/>
        <!-- agent nav -->
    @endif
</ul><!-- .nk-menu -->