<div class="row">
    <div class="col-md-9">
        <div class="post">
            <div class="post-title">
                <h3 class="mainTitle" style="text-align: left;font-family: sans-serif;">{{ $bloc->colloque->title }}</h3>
            </div><!--END POST-TITLE-->
            <div class="post-entry">
                <p class="abstract">{!! $bloc->colloque->date !!}</p>
                <p><strong>Lieu: </strong><cite>{{ $bloc->colloque->location }}</cite></p>
                <p><a target="_blank"
                      style="padding: 5px 10px; text-decoration: none; background: {{ $campagne->color }}; color: #fff; margin-top: 10px; display: inline-block;"
                      href="{{ $bloc->colloque->link ?? '#' }}">Informations et inscription</a></p>
            </div>
        </div><!--END POST-->
    </div>
    <div class="col-md-3 listCat">
        <a target="_blank" href="{{ $bloc->colloque->link ?? '#' }}"><img width="130" border="0" alt="{{ $bloc->colloque->title }}" src="{{ $bloc->colloque->image }}" /></a>
    </div>
</div>