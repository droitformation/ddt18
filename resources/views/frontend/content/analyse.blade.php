<div class="analyses">
    <div class="row">
        <div class="col-md-9 col-sm-8">
            @if(!empty($analyses))
            <h4 class="title-section"><i class="fa fa-file-text"></i> &nbsp;&nbsp;Analyses</h4>

                @foreach($analyses as $analyse)
                    <div class="analyse arret {{ $analyse->filter }} y{{ $analyse->year }} clear">
                        <div class="post">
                            <div class="post-title">
                                <a class="anchor_top" name="analyse_{{ $analyse->id }}"></a>
                                <h3 class="title">Analyse de {{ $analyse->authors_list }}</h3>
                                <p class="italic">{!! $analyse->remarque ?? $analyse->abstract !!}</p>
                                @if(!empty($analyse->arrets))
                                    <ul>
                                        @foreach($analyse->arrets as $reference => $arret)
                                            <a class="anchor_top" name="analyse_{{ $reference }}"></a>
                                            <li><a href="#{{ $reference }}">{{ $arret }}</a></li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div><!--END POST-TITLE-->
                            <div class="post-entry">
                                @if($analyse->file)
                                    <p><a target="_blank" href="{{ $analyse->file }}">Télécharger cette analyse en PDF &nbsp;&nbsp;<i class="fa fa-file-pdf-o"></i></a></p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
            <p>&nbsp;</p>
            @endif

        </div>

        <div class="col-md-3 col-sm-4 last listCat listAnalyse">
            <img style="max-width: 140px;" border="0" alt="Analyses" src="<?php echo asset('files/pictos/analyse.png') ?>">
        </div>
    </div>
    <div class="divider-border-nofloat"></div>
</div>
