@extends('voyager::master')

@section('page_title', __('voyager.generic.view').' '.$dataType->display_name_singular)

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i> {{ __('voyager.generic.viewing') }} {{ ucfirst($dataType->display_name_singular) }} &nbsp;

        @can('edit', $dataTypeContent)
            <a href="{{ route('voyager.'.$dataType->slug.'.edit', $dataTypeContent->getKey()) }}" class="btn btn-info">
                <span class="glyphicon glyphicon-pencil"></span>&nbsp;
                {{ __('voyager.generic.edit') }}
            </a>
        @endcan
        <a href="{{ route('voyager.'.$dataType->slug.'.index') }}" class="btn btn-warning">
            <span class="glyphicon glyphicon-list"></span>&nbsp;
            {{ __('voyager.generic.return_to_list') }}
        </a>
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
<div class="page-content container-fluid">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-bordered" style="padding-bottom:5px;">

                <!-- /.box-header -->
                <!-- form start -->

                @foreach($dataType->readRows as $row)
                <div class="panel-heading" style="border-bottom:0;">
                    <h3 class="panel-title">{{ $row->display_name }}</h3>
                </div>

                <div class="panel-body" style="padding-top:0;">
                    @if($row->type == "image")
                    <img style="max-width:640px"
                    src="{!! Voyager::image($dataTypeContent->{$row->field}) !!}">
                    @elseif($row->type == 'date')
                    {{ \Carbon\Carbon::parse($dataTypeContent->{$row->field})->format('d.m.Y h:i') }}
                    @elseif ($row->field === 'judet_id' && !is_null($dataTypeContent->judet_id) || strlen($dataTypeContent->judet_id) > 0)
                    {{App\Judet::find($dataTypeContent->judet_id)->nume}}
                    @else
                    <p>
                        {{ $dataTypeContent->{$row->field} }}
                    </p>
                    @endif
                </div><!-- panel-body -->
                @if(!$loop->last)
                <hr style="margin:0;">
                @endif
                @endforeach

            </div>
        </div>
    </div>
</div>
@stop

@section('javascript')

@stop
