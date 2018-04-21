@extends('voyager::master')

@section('page_title', __('voyager.generic.viewing').' '.$dataType->display_name_plural)

@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            <i class="{{ $dataType->icon }}"></i> {{ $dataType->display_name_plural }}
        </h1>
        @can('add',app($dataType->model_name))
            <a href="{{ route('voyager.'.$dataType->slug.'.create') }}" class="btn btn-success btn-add-new">
                <i class="voyager-plus"></i> <span>{{ __('voyager.generic.add_new') }}</span>
            </a>
        @endcan
        @can('delete',app($dataType->model_name))
            @include('voyager::partials.bulk-delete')
        @endcan
        @include('voyager::multilingual.language-selector')
    </div>
@stop

@section('content')
<div class="page-content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-bordered">
                <div class="panel-body">
                    <table id="dataTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nume</th>
                                <th>Email</th>
                                <th>Telefon</th>
                                <th>Adresa</th>
                                <th>Unitate</th>
                                <th>Date</th>
                                <th>Avatar</th>
                                <th>Rol</th>
                                <th>Activ</th>
                                <th class="actions">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dataTypeContent as $data)
                            <tr>
                                <td>{{ucwords('&nbsp;' . $data->prenume . '&nbsp;' . $data->nume)}}</td>
                                <td>{{$data->email}}</td>
                                <td>S:&nbsp;{{$data->telefon_s}}<br />P:&nbsp;{{$data->telefon_p}}</td>
                                <td>{{$data->adresa}}<br />{{$data->cod_postal}}&nbsp;{{$data->localitate}}<br />{{$data->judet}}</td>
                                <td>@if(!is_null($data->unitate_id) && strlen($data->unitate_id) > 0) U:&nbsp;{{App\Unitate::find($data->unitate_id)->nume}}&nbsp;<a href="{{ route('voyager.unitati.show', $data->unitate_id) }}" class="btn-sm btn-warning pull-right"> <i class="voyager-eye"></i> Vezi </a><br />D:&nbsp;<?php $unitateModel = App\Unitate::find($data->unitate_id); ?>{{App\Departament::find($unitateModel->departament_id)->nume}}@endif</td>
                                <td>C:&nbsp;{{ \Carbon\Carbon::parse($data->created_at)->format('d.m.Y h:i') }}@if(!is_null($data->deleted_at))<br />D:{{ \Carbon\Carbon::parse($data->deleted_at)->format('d.m.Y h:i') }}@endif</td>
                                <td><img src="@if( strpos($data->avatar, 'http://') === false && strpos($data->avatar, 'https://') === false){{ Voyager::image( $data->avatar ) }}@else{{ $data->avatar }}@endif" style="width:100px"></td>
                                <td>{{ $data->role ? $data->role->display_name : '' }}</td>
                                <td>{{ $data->active == 0 ? 'inactiv' : 'activ' }}</td>
                                <td class="no-sort no-click"> @if (Voyager::can('delete_'.$dataType->name))
                                    <div class="btn-sm btn-danger pull-right delete" data-id="{{ $data->id }}" id="delete-{{ $data->id }}"><i class="voyager-trash"></i> Sterge</div> @endif
                                    @if (Voyager::can('edit_'.$dataType->name)) <a href="{{ route('voyager.'.$dataType->slug.'.edit', $data->id) }}" class="btn-sm btn-primary pull-right edit"> <i class="voyager-edit"></i> Editeaza </a> @endif
                                    @if (Voyager::can('read_'.$dataType->name)) <a href="{{ route('voyager.'.$dataType->slug.'.show', $data->id) }}" class="btn-sm btn-warning pull-right"> <i class="voyager-eye"></i> Vezi </a> @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if (isset($dataType->server_side) && $dataType->server_side)
                    <div class="pull-left">
                        <div role="status" class="show-res" aria-live="polite">
                            Showing {{ $dataTypeContent->firstItem() }} to {{ $dataTypeContent->lastItem() }} of {{ $dataTypeContent->total() }} entries
                        </div>
                    </div>
                    <div class="pull-right">
                        {{ $dataTypeContent->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span
                    aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title"><i class="voyager-trash"></i> Are you sure you want to delete
                this {{ $dataType->display_name_singular }}?</h4>
            </div>
            <div class="modal-footer">
                <form action="{{ route('voyager.'.$dataType->slug.'.index') }}" id="delete_form" method="POST">
                    {{ method_field("DELETE") }}
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-danger pull-right delete-confirm"
                    value="Yes, Delete This {{ $dataType->display_name_singular }}">
                </form>
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">
                    Cancel
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@stop

@section('javascript')
<!-- DataTables -->
<script>
    @if (!$dataType->server_side)
    $(document).ready(function () {
    $('#dataTable').DataTable({ "order": [] });
    });
    @endif

    $('td').on('click', '.delete', function (e) {
    var form = $('#delete_form')[0];

    form.action = parseActionUrl(form.action, $(this).data('id'));

    $('#delete_modal').modal('show');
    });

    function parseActionUrl(action, id) {
    return action.match(/\/[0-9]+$/)
    ? action.replace(/([0-9]+$)/, id)
    : action + '/' + id;
    }
</script>
@stop
