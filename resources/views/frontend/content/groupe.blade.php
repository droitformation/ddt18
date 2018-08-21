@if(isset($bloc->groupe))

    <div class="row">
        <div class="col-md-9">
            <h3 style="text-align: left;">{{ $bloc->categorie->title }}</h3>
        </div>
        <div class="col-md-3 listCat">
            <img width="130" border="0" src="{{ $bloc->categorie->image }}" alt="{{ $bloc->categorie->title }}" />
        </div>
    </div>

    <!-- Bloc content-->
    @foreach($bloc->groupe as $arret)
        @include('frontend.content.partials.arret', ['arret' => $arret])
    @endforeach
@endif


