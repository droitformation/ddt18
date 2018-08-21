<div class="widget">
    <h3 class="title"><i class="icon-envelope"></i> &nbsp;Archives</h3>
    <ul class="bra_recent_entries">

        @if(!empty($archives))
            <ul class="list-group">
                @foreach($archives as $campagne)
                    <a href="{{ url('campagne/'.$campagne->id) }}" class="list-group-item {{ Request::is('campagne/'.$campagne->id) ? 'active' : '' }}">{{ $campagne->sujet }}</a>
                @endforeach
            </ul>
        @else
            <p>Encore aucune newsletter</p>
        @endif

    </ul><!--END UL-->
</div><!--END WIDGET-->

<p class="divider-border"></p>
