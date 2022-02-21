@extends('admin.layouts.app')

@push('libraries_top')


@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{!empty($user) ?trans('/admin/main.edit'): trans('admin/main.new') }} {{ trans('admin/main.user') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/admin/">{{ trans('admin/main.dashboard') }}</a>
                </div>
                <div class="breadcrumb-item"><a>{{ trans('admin/main.users') }}</a>
                </div>
                <div class="breadcrumb-item">{{!empty($user) ?trans('/admin/main.edit'): trans('admin/main.new') }}</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 ">
                    <div class="card">
                        <div class="card-body">
                            <form action="/admin/users/store" method="Post">
                                <div class="row">
                                        {{ csrf_field() }}

                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>{{ trans('/admin/main.full_name') }}</label>
                                                <input type="text" name="full_name"
                                                       class="form-control  @error('full_name') is-invalid @enderror"
                                                       value="{{ old('full_name') }}"
                                                       placeholder="{{ trans('admin/main.create_field_full_name_placeholder') }}"/>
                                                @error('full_name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="username">{{ trans('auth.email_or_mobile') }}:</label>
                                                <input name="username" type="text" class="form-control @error('email') is-invalid @enderror @error('mobile') is-invalid @enderror" id="username" value="{{ old('email') }}" aria-describedby="emailHelp">
                                                @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                @error('mobile')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="input-label">{{ trans('admin/main.password') }}</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span type="button" class="input-group-text">
                                                        <i class="fa fa-lock"></i>
                                                    </span>
                                                    </div>
                                                    <input type="password" name="password"
                                                           class="form-control @error('password') is-invalid @enderror"/>
                                                    @error('password')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>{{ trans('/admin/main.role_name') }}</label>
                                                <select class="form-control select2 @error('role_id') is-invalid @enderror" id="roleId" name="role_id">
                                                    <option disabled selected>{{ trans('admin/main.select_role') }}</option>
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->id }}" {{ old('role_id') === $role->id ? 'selected' :''}}>{{ $role->name }} - {{ $role->caption }}</option>
                                                    @endforeach
                                                </select>
                                                @error('role_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-sm-12" id="instructor_type">
                                        <div class="form-group">
                                            <label>{{ trans('admin/main.type') }}</label>
                                            <select class="form-control @error('instructor_type') is-invalid @enderror" name="instructor_type">
                                                <option disabled selected>{{ trans('admin/main.select_role') }}</option>
                                                <option value="1" {{ old('instructor_type') === 1 ? 'selected' :''}}>مجلس الاداره</option>
                                                <option value="2" {{ old('instructor_type') === 2 ? 'selected' :''}}>مجلس الامناء</option>
                                                <option value="3" {{ old('instructor_type') === 3 ? 'selected' :''}}>الخبراء</option>
                                                <option value="4" {{ old('instructor_type') === 4 ? 'selected' :''}}>الاعضاء</option>
                                            </select>
                                            @error('instructor_type')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group" id="groupSelect">
                                                <label class="input-label d-block">{{ trans('admin/main.group') }}</label>
                                                <select name="group_id" class="form-control select2 @error('group_id') is-invalid @enderror">
                                                    <option value="" selected disabled></option>

                                                    @foreach($userGroups as $userGroup)
                                                        <option value="{{ $userGroup->id }}" @if(!empty($notification) and !empty($notification->group) and $notification->group->id == $userGroup->id) selected @endif>{{ $userGroup->name }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback">@error('group_id') {{ $message }} @enderror</div>
                                            </div>

                                        </div>

                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>{{ trans('/admin/main.status') }}</label>
                                                <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                                                    <option disabled selected>{{ trans('admin/main.select_status') }}</option>
                                                    @foreach (\App\User::$statuses as $status)
                                                        <option
                                                            value="{{ $status }}" {{ old('status') === $status ? 'selected' :''}}>{{  $status }}</option>
                                                    @endforeach
                                                </select>
                                                @error('status')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                        </div>

                                        <div class="col-md-6 col-sm-12 student-inputs" id="school_level">
                                            <div class="form-group">
                                                <label>{{ trans('admin/main.school_level') }}</label>
                                                <select class="form-control @error('school_level') is-invalid @enderror" name="school_level">
                                                    <option disabled selected>{{ trans('admin/main.study_lang') }}</option>
                                                    <option value="1">{{trans('admin/main.secondary')}}</option>
                                                    <option value="2">{{trans('admin/main.above_secondary')}}</option>
                                                    <option value="3">{{trans('admin/main.university')}}</option>
                                                    <option value="4">{{trans('admin/main.above_university')}}</option>
                                                </select>
                                                @error('school_level')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-sm-12 student-inputs">
                                            <div class="form-group">
                                                <label>{{ trans('admin/main.address') }}</label>
                                                <input type="text" name="address"
                                                       class="form-control  @error('address') is-invalid @enderror"
                                                       value="{{ old('address') }}"
                                                       placeholder="{{ trans('admin/main.create_field_address_placeholder') }}"/>
                                                @error('address')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="text-right mt-4">
                                            <button class="btn btn-primary">{{ trans('admin/main.submit') }}</button>
                                        </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts_bottom')
    <script >
        (function ($) {
            $(document).ready(function (){
                $(".student-inputs").css('display','none');
                $("#instructor_type").css('display','none');
                $("#roleId").change(function (){
                    var selectedRole = $("#roleId option:selected").val();
                    if (selectedRole==1)
                        $(".student-inputs").css('display','block');
                    else if(selectedRole==4)
                        $("#instructor_type").css('display','block');
                    else
                    {
                        $(".student-inputs").css('display','none');
                        $("#instructor_type").css('display','none');
                    }

                });
            });
        })(jQuery)
    </script>
@endpush
