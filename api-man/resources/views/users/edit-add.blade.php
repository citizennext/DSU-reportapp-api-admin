@extends('voyager::master')

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_header')
<h1 class="page-title"><i class="{{ $dataType->icon }}"></i> @if(isset($dataTypeContent->id)){{ 'Edit' }}@else{{ 'New' }}@endif {{ $dataType->display_name_singular }} </h1>
@stop

@section('content')
<div class="page-content container-fluid">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-bordered">

                <div class="panel-heading">
                    <h3 class="panel-title">@if(isset($dataTypeContent->id)){{ 'Edit' }}@else{{ 'Add New' }}@endif {{ $dataType->display_name_singular }}</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-edit-add" role="form"
                action="@if(isset($dataTypeContent->id)){{ route('voyager.'.$dataType->slug.'.update', $dataTypeContent->id) }}@else{{ route('voyager.'.$dataType->slug.'.store') }}@endif"
                method="POST" enctype="multipart/form-data">
                    <!-- PUT Method if we are editing -->
                    @if(isset($dataTypeContent->id))
                    {{ method_field("PUT") }}
                    @endif

                    <!-- CSRF TOKEN -->
                    {{ csrf_field() }}

                    <div class="panel-body">
                        <fieldset class="fieldset-border">
                            <legend class="fieldset-border">Account Data</legend>

                            <div class="form-group">
                                <label for="name">Email</label>
                                <input type="text" class="form-control" name="email"
                                placeholder="Email" id="email"
                                value="@if(isset($dataTypeContent->email)){{ old('email', $dataTypeContent->email) }}@else{{old('email')}}@endif">
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                @if(isset($dataTypeContent->password))
                                <br>
                                <small>Leave empty to keep the same</small>
                                @endif
                                <input type="password" class="form-control" name="password"
                                placeholder="Password" id="password"
                                value="">
                            </div>

                            <div class="form-group">
                                <label for="password">Avatar</label>
                                @if(isset($dataTypeContent->avatar))
                                <img src="{{ Voyager::image( $dataTypeContent->avatar ) }}"
                                style="width:200px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                                @endif
                                <input type="file" name="avatar">
                            </div>

                            <div class="form-group">
                                <label for="role">User Role</label>
                                <select name="role_id" id="role" class="form-control">
                                    <?php $roles = TCG\Voyager\Models\Role::all(); ?>
                                    @foreach($roles as $role)
                                    <option value="{{$role->id}}" @if(isset($dataTypeContent) && $dataTypeContent->role_id == $role->id) selected @endif>{{$role->display_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </fieldset>

                        <fieldset class="fieldset-border">
                            <legend class="fieldset-border">Personal Data</legend>
                            
                            <div class="form-group">
                                <label for="salutation">Salutation</label>
                                <select name="salutation_id" id="salutation" class="form-control">
                                    <?php $salutations = App\Salutation::all(); ?>
                                    @foreach($salutations as $salutation)
                                    <option value="{{$salutation->id}}" @if(isset($dataTypeContent) && $dataTypeContent->salutation_id == $salutation->id) selected @endif>{{$salutation->value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="first-name">First Name</label>
                                <input type="text" class="form-control" name="first_name"
                                placeholder="First Name" id="first-name"
                                value="@if(isset($dataTypeContent->first_name)){{ old('first_name', $dataTypeContent->first_name) }}@else{{old('first_name')}}@endif">
                            </div>
                            
                            <div class="form-group">
                                <label for="last-name">Last Name</label>
                                <input type="text" class="form-control" name="last_name"
                                placeholder="Last Name" id="last-name"
                                value="@if(isset($dataTypeContent->last_name)){{ old('last_name', $dataTypeContent->last_name) }}@else{{old('last_name')}}@endif">
                            </div>
                            
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" name="address"
                                placeholder="Address" id="address"
                                value="@if(isset($dataTypeContent->address)){{ old('address', $dataTypeContent->address) }}@else{{old('address')}}@endif">
                            </div>
                            
                            <div class="form-group">
                                <label for="plz">PLZ</label>
                                <input type="text" class="form-control" name="plz"
                                placeholder="PLZ" id="plz"
                                value="@if(isset($dataTypeContent->plz)){{ old('plz', $dataTypeContent->plz) }}@else{{old('plz')}}@endif">
                            </div>
                            
                            <div class="form-group">
                                <label for="city">City</label>
                                <input type="text" class="form-control" name="city"
                                placeholder="City" id="city"
                                value="@if(isset($dataTypeContent->city)){{ old('city', $dataTypeContent->city) }}@else{{old('city')}}@endif">
                            </div>
                            
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" name="phone"
                                placeholder="Phone" id="phone"
                                value="@if(isset($dataTypeContent->phone)){{ old('phone', $dataTypeContent->phone) }}@else{{old('phone')}}@endif">
                            </div>
                            
                        </fieldset>
                        
                        <fieldset class="fieldset-border">
                            <legend class="fieldset-border">Organisation Data</legend>

                            <div class="form-group">
                                <label for="organization">Organization</label>
                                <input type="text" class="form-control" name="organization"
                                placeholder="Organization" id="organization"
                                value="@if(isset($dataTypeContent->organization)){{ old('organization', $dataTypeContent->organization) }}@else{{old('organization')}}@endif">
                            </div>

                            <div class="form-group">
                                <label for="org_size">Organization Size</label>
                                <select name="org_size_id" id="org_size" class="form-control">
                                    <?php $orgSizes = App\Size::all(); ?>
                                    @foreach($orgSizes as $size)
                                    <option value="{{$size->id}}" @if(isset($dataTypeContent) && $dataTypeContent->org_size_id == $size->id) selected @endif>{{$size->value}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="industry">Industry</label>
                                <input type="text" class="form-control" name="industry"
                                placeholder="Industry" id="industry"
                                value="@if(isset($dataTypeContent->industry)){{ old('industry', $dataTypeContent->industry) }}@else{{old('industry')}}@endif">
                            </div>

                            <div class="form-group">
                                <label for="org_address">Address</label>
                                <input type="text" class="form-control" name="org_address"
                                placeholder="Address" id="org_address"
                                value="@if(isset($dataTypeContent->org_address)){{ old('org_address', $dataTypeContent->org_address) }}@else{{old('org_address')}}@endif">
                            </div>

                            <div class="form-group">
                                <label for="org_plz">PLZ</label>
                                <input type="text" class="form-control" name="org_plz"
                                placeholder="PLZ" id="org_plz"
                                value="@if(isset($dataTypeContent->org_plz)){{ old('org_plz', $dataTypeContent->org_plz) }}@else{{old('org_plz')}}@endif">
                            </div>

                            <div class="form-group">
                                <label for="org_city">City</label>
                                <input type="text" class="form-control" name="org_city"
                                placeholder="City" id="org_city"
                                value="@if(isset($dataTypeContent->org_city)){{ old('org_city', $dataTypeContent->org_city) }}@else{{old('org_city')}}@endif">
                            </div>

                            <div class="form-group">
                                <label for="org_phone">Phone</label>
                                <input type="text" class="form-control" name="org_phone"
                                placeholder="Phone" id="org_phone"
                                value="@if(isset($dataTypeContent->org_phone)){{ old('org_phone', $dataTypeContent->org_phone) }}@else{{old('org_phone')}}@endif">
                            </div>

                        </fieldset>

                    </div><!-- panel-body -->

                    <div class="panel-footer">
                        <button type="submit" class="btn btn-primary">
                            Submit
                        </button>
                    </div>
                </form>

                <iframe id="form_target" name="form_target" style="display:none"></iframe>
                <form id="my_form" action="{{ route('voyager.upload') }}" target="form_target" method="post"
                enctype="multipart/form-data" style="width:0;height:0;overflow:hidden">
                    <input name="image" id="upload_file" type="file"
                    onchange="$('#my_form').submit();this.value='';">
                    <input type="hidden" name="type_slug" id="type_slug" value="{{ $dataType->slug }}">
                    {{ csrf_field() }}
                </form>

            </div>
        </div>
    </div>
</div>
@stop

@section('javascript')
<script>
    $('document').ready(function() {
        $('.toggleswitch').bootstrapToggle();
    }); 
</script>
<script src="{{ voyager_asset('lib/js/tinymce/tinymce.min.js') }}"></script>
<script src="{{ voyager_asset('js/voyager_tinymce.js') }}"></script>
@stop
