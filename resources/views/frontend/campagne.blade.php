@extends('layouts.master')
@section('content')

    <div class="page-header text-align-left">
        <div class="row">
            <div class="col-md-8">
                <h1 class="title uppercase">{{ $campagne->sujet }}</h1>
                <h2 class="subtitle">{{ $campagne->auteurs }}</h2>
            </div>
            <div class="col-md-4 text-right">
                @include('partials.soutien')
            </div>
        </div>
    </div><!--END PAGE-HEADER-->

    <div class="row">
        <div id="inner-content" class="col-md-8 col-xs-12">
            @if(!empty($blocs))
                @foreach($blocs as $bloc)

                    <div class="bloc-newsletter">
                        @if($bloc->partial == 'arret')
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="post">
                                        <div class="post-title">
                                            <h3 class="title">{{ $bloc->arret->reference }} du {{ $bloc->arret->pub_date }}</h3>
                                            <p class="italic">{{ $bloc->arret->abstract }}</p>
                                        </div><!--END POST-TITLE-->
                                        <div class="post-entry">
                                            <a class="anchor" name="{{ $bloc->arret->reference }}"></a>
                                            {!! $bloc->arret->pub_text !!}
                                            @if($bloc->arret->file)
                                                <p><a target="_blank" href="{{ $bloc->arret->file }}">Télécharger en pdf &nbsp;&nbsp;<i class="fa fa-file-pdf-o"></i></a></p>
                                            @endif
                                        </div>
                                    </div><!--END POST-->
                                </div>
                                <div class="col-md-3 listCat">
                                    @if(!empty($bloc->arret->categories))
                                        @foreach($bloc->arret->categories as $categorie)
                                            <img style="max-width: 140px;" border="0" alt="{{ $categorie->title }}" src="{{ $categorie->image }}">
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            @if(!empty($bloc->arret->analyses))
                                <div class="row">
                                    <div class="col-md-9">
                                        @foreach($bloc->arret->analyses as $analyse)
                                            @include('frontend.content.partials.analyse', ['analyse' => $analyse, 'arret' => $bloc->arret])
                                        @endforeach
                                    </div>
                                    <div class="col-md-3 listCat">
                                        <a href="{{ url('jurisprudence') }}"><img style="max-width: 140px;" border="0" alt="Analyses" src="<?php echo asset('files/analyse.png') ?>"></a>
                                    </div>
                                </div>
                            @endif
                        @else
                            @include('frontend.content.'.$bloc->partial, ['bloc' => $bloc , 'campagne' => $campagne])
                        @endif
                    </div>

                @endforeach
            @endif
        </div>

        <!-- Sidebar  -->
        <div id="sidebar" class="col-md-4 col-xs-12">
            <div class="widget">
                <h5><a class="text-primary" href="{{ url('archive') }}"><i class="icon-envelope"></i>  Archives</a></h5>
            </div><!--END WIDGET-->

            <p class="divider-border"></p>

            @include('partials.subscribe')
            @include('partials.pub')
        </div>
        <!-- END Sidebar  -->

    </div><!--END CONTENT-->

@stop
