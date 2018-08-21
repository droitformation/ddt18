@include('frontend.content.partials.arret', ['arret' => $bloc->arret])

@if(!empty($bloc->arret->analyses))
    <div class="row">
        <div class="col-md-9">

            @foreach($bloc->arret->analyses as $analyse)
                @include('frontend.content.partials.analyse', ['analyse' => $analyse, 'arret' => $bloc->arret])
            @endforeach

        </div>
        <div class="col-md-3 listCat">
            <a href="{{ url('jurisprudence') }}">
                <img style="max-width: 140px;" border="0" alt="Analyses" src="<?php echo asset('files/analyse.png') ?>">
            </a>
        </div>
    </div>
@endif
