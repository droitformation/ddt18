@if(isset($pub))
    <div class="soutiens">
        <h3 class="title soutien"><i class="glyphicon glyphicon-star-empty"></i> &nbsp;Avec le soutien de</h3>
        <div class="media soutien-media">
            <?php $soutiens = collect($pub)->where('type','soutien'); ?>
            @if(!$soutiens->isEmpty())
                @foreach($soutiens as $soutien)
                    <a target="_blank" href="{{ $soutien->url }}">
                        <img height="50px" src="{{ $soutien->image }}" alt="Soutiens" />
                    </a>
                @endforeach
            @endif
        </div>
    </div>
@endif
