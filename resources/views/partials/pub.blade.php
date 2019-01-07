@if(isset($pub) && !empty($pub))

    <div class="widget">
        <h3 class="title"><i class="glyphicon glyphicon-pushpin"></i> &nbsp;New</h3>

        <?php $pub = collect($pub)->whereNotIn('type','soutien'); ?>
        @foreach($pub as $ad)
            @if( !empty($ad->title) && !empty($ad->url) && !empty($ad->image))
                <div class="media">
                    <div class="media-body">
	                    <div class="row">
		                    <div class="col-md-4 col-sm-5">
			                     <a class="media-left" style="margin-bottom: 5px;" target="_blank" href="{{ $ad->url }}">
		                            <img style="max-width: 130px;" src="{{ $ad->image }}" alt="{{ $ad->title or 'image' }}" />
		                        </a>
		                    </div>
		                    <div class="col-md-8  col-sm-7">
			                    <h4 class="media-heading">{{ $ad->title }}</h4>
			                     <div style="text-align: left; margin-bottom: 5px;">{!! $ad->content ?? '' !!}</div>
			                     <a class="button small grey" target="_blank" href="{{ $ad->url }}">En savoir plus</a>
			                </div>
	                    </div>

                    </div>
                </div>
            @elseif(!empty($ad->url) && !empty($ad->image))
                <div class="media">
                    <a class="pub-image-simple" target="_blank" href="{{ $ad->url }}">
                        <img style="width:130px;" src="{{ $ad->image }}" alt="{{ $ad->title or 'image' }}" />
                    </a>
                </div>
            @elseif(!empty($ad->image))
                <div class="media">
                    <img style="width:130px;" src="{{ $ad->image }}" alt="{{ $ad->title or 'image' }}" />
                </div>
            @endif

        @endforeach

    </div><!--END WIDGET-->

    <p class="divider-border"></p>
@endif