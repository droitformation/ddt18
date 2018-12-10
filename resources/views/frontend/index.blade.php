
@extends('layouts.master')
@section('content')


<div class="row">
    <div class="col-md-12">
        <div class="page-header">
            <h1 class="title uppercase">Nouveautés dans le domaine du droit du travail</h1>
            @include('partials.soutien')
        </div>
    </div>
</div>

<div class="row">
    <div id="inner-content" class="col-md-8">

        @include('partials.message')

        <div id="about"><img width="100%" alt="Droit du travail" src="{{ asset('frontend/images/header.jpg') }}" /></div><!--END SECTION-->

        @if(!empty($homepage))
            <div class="row">
                <div class="col-md-12">
                    <h3 class="title">{{ $homepage->title }}</h3>
                    {!! $homepage->content !!}
                </div>
            </div><!-- end row -->
        @endif

        <div class="divider-border"></div>

        <div id="bloc_content">
            @if(isset($homepage) && !empty($homepage->contents))
                @foreach(collect($homepage->contents)->chunk(2) as $i => $bloc)
                    <div class="row">
                        @foreach($bloc as $index => $content)
                            <?php $nbr = $index > 1 ? 12 : 6 ; ?>
                            <div class="col-md-{{ $nbr }} col-sm-12">
                                <h4 class="title home-bloc">{{ $content->title }}</h4>
                                <p class="text-justify">{!! $content->content !!}</p>
                            </div>
                        @endforeach
                    </div><!-- end row -->
                    {!! $index > 0 ? '<div class="divider-border"></div>' : '' !!}
                @endforeach
            @endif
        </div>

    </div>

    <!-- Sidebar  -->
    <div id="sidebar" class="col-md-4 col-xs-12">
        @include('partials.subscribe')
        @include('partials.pub')
        @include('partials.latest')
    </div>
    <!-- END Sidebar  -->

</div><!--END CONTENT-->

@stop