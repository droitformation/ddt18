<div class="row">
    <div class="col-md-9">
        <div class="bloc-content">
            <h2>{{ $bloc->titre }}</h2>
            {!! $bloc->contenu !!}
        </div><!--END POST-->
    </div>
    <div class="col-md-3">
        <a target="_blank" href="{{ $bloc->lien }}">
            <img width="130px" style="max-width: 130px; max-height: 220px;" alt="{{ $bloc->titre or '' }}" src="{{ $bloc->image }}" />
        </a>
    </div>
</div>
