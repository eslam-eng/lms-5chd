@extends('admin.layouts.app')

@push('styles_top')
    <link href="/assets/default/vendors/sortable/jquery-ui.min.css"/>
@endpush

@section('content')
    @if ($errors->any())
        <br>
        <section class="section">

            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>

    </section>
    @endif
    <section class="section">
        <div class="section-header">
            <h1>{{!empty($interview) ?trans('/admin/main.edit'): trans('admin/main.new') }} {{ trans('admin/main.interview_question') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/admin/">{{ trans('admin/main.dashboard') }}</a>
                </div>
                <div class="breadcrumb-item active"><a href="/admin/interview-questions">{{ trans('admin/main.interview_question') }}</a>
                </div>
                <div class="breadcrumb-item">{{!empty($interview) ?trans('/admin/main.edit'): trans('admin/main.new') }}</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-10 col-lg-10">
                    <div class="card">
                        <div class="card-body">
                            <form action="/admin/interview-questions/{{ !empty($interview) ? $interview->id.'/update' : 'store' }}"
                                  method="Post">
                                {{ csrf_field() }}

                                <div class="form-group">
                                    <label>{{ trans('/admin/main.school_level') }}</label>
                                    <select class="form-control @error('school_level') is-invalid @enderror" name="school_level">
                                        <option disabled selected>{{ trans('admin/main.select_school_level') }}</option>
                                        <option value="1" {{!empty($interview) ?$interview->school_level==1?'selected':'':''}}>Secondary</option>
                                        <option value="2" {{!empty($interview) ?$interview->school_level==2?'selected':'':''}}>Above secondary</option>
                                        <option value="3" {{!empty($interview) ?$interview->school_level==3?'selected':'':''}}>University</option>
                                        <option value="4" {{!empty($interview) ?$interview->school_level==4?'selected':'':''}}>Above university</option>
                                    </select>
                                    @error('school_level')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label>{{ trans('admin/main.title') }}</label>
                                    <input type="text" name="title"
                                           class="form-control  @error('title') is-invalid @enderror"
                                           value="{{ !empty($interview) ? $interview->title : old('title') }}"
                                           placeholder="{{ trans('admin/main.choose_title') }}" required/>

                                    @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div id="filterOptions" class="ml-1">
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <button type="button" class="btn btn-success add-btn "><i class="fa fa-plus"></i> {{ trans('admin/main.add_question') }}</button>
                                    </div>

                                    <ul class="draggable-lists list-group">
                                        @if(!empty($interviewQuestions))
                                            @foreach($interviewQuestions as $key => $interviewQuestion)

                                                <li class="form-group list-group">

                                                    <div class="input-group">
                                                        <input type="text" name="questions[]"
                                                               class="form-control w-auto flex-grow-1"
                                                               value="{{ $interviewQuestion->question }}"/>
                                                        <div class="input-group-append">
                                                            <button type="button" class="btn remove-btn btn-danger"><i class="fa fa-times"></i></button>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>

                                </div>


{{--                                <li class="form-group main-row list-group {{!empty($interview)?'d-none':''}}">--}}
{{--                                    <div class="input-group">--}}
{{--                                        <input type="text" name="questions[]"--}}
{{--                                               class="form-control w-auto flex-grow-1"--}}
{{--                                               placeholder="{{ trans('admin/main.question') }}"/>--}}
{{--                                    </div>--}}
{{--                                    @error('questions')--}}
{{--                                    <div class="invalid-feedback">--}}
{{--                                        {{ $message }}--}}
{{--                                    </div>--}}
{{--                                    @enderror--}}
{{--                                </li>--}}
                                <li class="form-group main-row list-group d-none">
                                    <div class="input-group">
                                        <input type="text" required name="questions[]"
                                               class="form-control w-auto flex-grow-1"
                                               placeholder="{{ trans('admin/main.question') }}"/>

                                        <div class="input-group-append">
                                            <button type="button" class="btn remove-btn btn-danger"><i class="fa fa-times"></i></button>
                                        </div>
                                    </div>
                                </li>
                                <div class="row">
                                    @error('questions[]')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="text-right mt-4">
                                    <button class="btn btn-primary">{{ trans('admin/main.submit') }}</button>
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
    <script src="/assets/default/vendors/sortable/jquery-ui.min.js"></script>

    <script>
        $(document).ready(function () {
            $('.main-row').removeClass('d-none')
            $('body').on('click', '.add-btn', function (e) {
                e.preventDefault();
                var mainRow = $('.main-row');

                var copy = mainRow.clone();
                copy.removeClass('main-row');
                copy.removeClass('d-none');
                var copyHtml = copy.prop('innerHTML');
                copyHtml = copyHtml.replace(/\[record\]/g, '[' + randomString() + ']');
                copy.html(copyHtml);
                $('.draggable-lists').append(copy);
            });

            $('body').on('click', '.remove-btn', function (e) {
                e.preventDefault();
                $(this).closest('.form-group').remove();
            });

            function randomString() {
                var text = "";
                var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";

                for (var i = 0; i < 16; i++)
                    text += possible.charAt(Math.floor(Math.random() * possible.length));

                return text;
            }

        })
    </script>
@endpush
