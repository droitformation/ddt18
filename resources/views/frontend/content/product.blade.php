<div class="row">
    <div class="col-md-9">
        <div class="post">
            <div class="post-title">
                <h3 class="mainTitle" style="text-align: left;font-family: sans-serif;">{{ $bloc->product->title }}</h3>
            </div><!--END POST-TITLE-->
            <div class="post-entry">
                <p class="abstract">{!!$bloc->product->teaser !!}</p>
                <div>{!! $bloc->product->description !!}</div>
                <p><a target="_blank"
                      style="padding: 5px 15px; text-decoration: none; background: {{ $campagne->color }}; color: #fff; margin-top: 10px; display: inline-block;"
                      href="{{ url('pubdroit/product/'.$bloc->product->id) }}">Acheter</a>
                </p>
            </div>
        </div><!--END POST-->
    </div>
    <div class="col-md-3 listCat">
        <a target="_blank" href="{{ url('pubdroit/product/'.$bloc->product->id) }}">
            <img width="130" border="0" alt="{{ $bloc->product->title }}" src="{{ $bloc->product->image }}" />
        </a>
    </div>
</div>