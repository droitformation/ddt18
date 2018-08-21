@extends('layouts.master')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="page-header text-align-left">

            <div class="row">
                <div class="col-md-8">
                    <h1 class="title uppercase">Auteurs et contributeurs</h1>
                </div>
                <div class="col-md-4 text-right">
                    @include('partials.soutien')
                </div>
            </div>
        </div><!--END PAGE-HEADER-->
    </div>
</div>

<div class="row">
    <div id="inner-content" class="col-md-8 col-xs-12">
        @if(!$auteurs->isEmpty())
            @foreach($auteurs as $auteur)
                <div class="media">
                    <div class="media-left pull-left">
                        <img width="100" class="media-object media-author" src="{{ $auteur->photo }}" alt="{{ $auteur->name }}">
                    </div>
                    <div class="media-body bio-body">
                        <h3 class="media-heading">{{ $auteur->name }}</h3>
                        <h5>{{ $auteur->occupation }}</h5>
                        <div class="bio_auteur">{!! $auteur->bio !!}</div>

                        <!-- Analyses from author -->
                        @if(!empty($auteur->analyses))
                            <h5><strong>{{ ($auteur->count > 1 ? 'Analyses des arrêts' : 'Analyse de l\'arrêt') }}:</strong></h5>
                            <ul class="analyse_auteur">
                                @foreach($auteur->analyses as $analyse)
                                    <li>
                                        <h5><a href="{{ url('jurisprudence#analyse_'.$analyse->id) }}">{{ $analyse->reference }}</a></h5>
                                        <p><i>{!! $analyse->abstract !!}</i></p>
                                    </li>
                                @endforeach
                            </ul>
                        @endif

                    </div>
                </div>
            @endforeach
        @endif

    </div><!--END CONTENT-->
    <!-- Sidebar  -->
    <div id="sidebar" class="col-md-4 col-xs-12">
        @include('partials.subscribe')
        @include('partials.pub')
        @include('partials.latest')
    </div>
    <!-- END Sidebar  -->
</div>

@stop

