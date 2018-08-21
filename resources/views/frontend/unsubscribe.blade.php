@extends('layouts.master')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="page-header text-align-left">

            <div class="row">
                <div class="col-md-8">
                    <h1 class="title uppercase">Désinscription</h1>
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

        @include('partials.message')

        <p>Désinscription de la newsletter en droit du travail.</p>

        <form action="{{ url('unsubscribe') }}" method="POST" class="form">
            {!! csrf_field() !!}
            <div class="form-group">
                <label class="control-label">Votre email</label>
                <div class="input-group col-md-7">
                    <input type="text" class="form-control" name="email" value="{{ old('email') }}">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit">Se désinscrire!</button>
                    </span>
                </div><!-- /input-group -->
            </div>
            <input type="hidden" name="newsletter_id" value="{{ $id or 1 }}">
        </form>

    </div>

    <!-- Sidebar  -->
    <div id="sidebar" class="col-md-4 col-xs-12">
        @include('partials.pub')
    </div>
    <!-- END Sidebar  -->
</div><!--END CONTENT-->

@stop

