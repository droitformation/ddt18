<div class="post">
    <div class="post-title">
        <a class="anchor_top" name="analyse_{{ $analyse->id }}"></a>
        <h2 class="title">Analyse de l'arrêt {{ $arret->reference }}</h2>

        @if(!empty($analyse->authors))
            @foreach($analyse->authors as $author)
                <div class="row">
                    <div class="col-md-2">
                        <img width="85" class="media-object" src="{{ $author->photo }}" alt="{{ $author->name }}">
                    </div>
                    <div class="col-md-10">
                        <h3 style="text-align: left;font-family: sans-serif; color:#000; font-size: 13px; font-weight: bold;">{{ $author->name }}</h3>
                        <p style="font-family: sans-serif;">{{  $author->occupation }}</p>
                    </div>
                </div>
            @endforeach
        @endif

        <p class="italic">{!! $analyse->abstract !!}</p>
    </div><!--END POST-TITLE-->
    <div class="post-entry" style="padding-top: 5px;">
        @if($analyse->file)
            <p><a target="_blank" href="{{ $analyse->file }}">Télécharger cette analyse en PDF &nbsp;&nbsp;<i class="fa fa-file-pdf-o"></i></a></p>
        @endif
    </div>
</div>