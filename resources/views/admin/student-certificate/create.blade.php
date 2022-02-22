@extends('admin.layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ $pageTitle }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/admin/">{{trans('admin/main.dashboard')}}</a>
                </div>
                <div class="breadcrumb-item">{{ $pageTitle}}</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="/admin/certificates/store" method="Post">
                                <div class="row">
                                    {{ csrf_field() }}

                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>{{ trans('/admin/main.student_name') }}</label>
                                            <select class="form-control select2 @error('student_id') is-invalid @enderror" id="student_id" name="student_id">
                                                <option selected>{{ trans('admin/main.select_student') }}</option>
                                                @foreach ($students as $student)
                                                    <option value="{{ $student->id }}" {{ old('student_id') === $student->id ? 'selected' :''}}>{{ $student->full_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('student_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>{{ trans('admin/main.select_course') }}</label>
                                            <select class="form-control select2 @error('course_id') is-invalid @enderror" id="course_id" name="course_id">
                                                <option selected>{{ trans('admin/main.select_webinar') }}</option>
                                                @foreach ($courses as $course)
                                                    <option value="{{ $course->id }}" {{ old('course_id') === $course->id ? 'selected' :''}}>{{ $course->title."|".$course->slug }}</option>
                                                @endforeach
                                            </select>
                                            @error('course_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>{{ trans('/admin/main.status') }}</label>
                                            <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                                                <option selected>{{ trans('admin/main.select_status') }}</option>
                                                <option value="1">{{trans('admin/main.active')}}</option>
                                                <option value="0">{{trans('admin/main.not_active')}}</option>

                                            </select>
                                            @error('status')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="col-md-6 col-sm-12 student-inputs">
                                        <div class="form-group">
                                            <label>{{ trans('admin/main.degree') }}</label>
                                            <input type="text" name="degree"
                                                   class="form-control  @error('degree') is-invalid @enderror"
                                                   value="{{ old('degree') }}"/>
                                            @error('degree')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-12 student-inputs">
                                        <div class="form-group">
                                            <label class="input-label">{{ trans('admin/main.file') }}</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <button type="button" class="input-group-text admin-file-manager " data-input="icon" data-preview="holder">
                                                        <i class="fa fa-upload"></i>
                                                    </button>
                                                </div>
                                                <input type="text" name="attachment" id="icon" class="form-control @error('attachment') is-invalid @enderror"/>
                                                <div class="invalid-feedback">@error('attachment') {{ $message }} @enderror</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-12 student-inputs">
                                        <div class="form-group">
                                            <label>{{ trans('admin/main.notes') }}</label>
                                            <input type="text" name="notes"
                                                   class="form-control  @error('notes') is-invalid @enderror"
                                                   value="{{ old('notes') }}"/>
                                            @error('degree')
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

@endpush
