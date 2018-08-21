<div class="row">
    <div class="col-md-9">
        <div class="post">
            <div class="post-title">
                <h3 class="title">{{ $arret->reference }} du {{ $arret->pub_date }}</h3>
                <p class="italic">{{ $arret->abstract }}</p>
            </div><!--END POST-TITLE-->
            <div class="post-entry">
                <a class="anchor" name="{{ $arret->reference }}"></a>
                {!! $arret->pub_text !!}

                @if($arret->file)
                    <p><a target="_blank" href="{{ $arret->file }}">Télécharger en pdf &nbsp;&nbsp;<i class="fa fa-file-pdf-o"></i></a></p>
                @endif
            </div>
        </div><!--END POST-->
    </div>
    <div class="col-md-3 listCat">
        @if(!empty($arret->categories))
            @foreach($arret->categories as $categorie)
                <img style="max-width: 140px;" border="0" alt="{{ $categorie->title }}" src="{{ $categorie->image }}">
            @endforeach
        @endif
    </div>
</div>