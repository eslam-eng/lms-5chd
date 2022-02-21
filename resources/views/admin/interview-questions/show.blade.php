@extends('admin.layouts.app')

@push('styles_top')
    <link href="/assets/default/vendors/sortable/jquery-ui.min.css"/>
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ trans('admin/main.interview_question_show') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/admin/">{{ trans('admin/main.dashboard') }}</a>
                </div>
                <div class="breadcrumb-item active"><a href="/admin/interview-questions">{{ trans('admin/main.interview_question') }}</a>
                </div>
                <div class="breadcrumb-item">{{ trans('admin/main.interview_question_show') }}</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-10 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h2 class="section-title after-line">{{ trans('admin/main.basic') }}</h2>
                            </div>
                            <div calss="row">
                                <div class="col-md-6">
                                    @if(!empty($interview))
                                        <p>
                                            <label class="font-weight-bold pl-3">{{ trans('admin/main.school_level') }}</label>

                                                @if($interview->school_level==1)
                                                    Secondary
                                                @elseif($interview->school_level==2)
                                                    Above secondary
                                                @elseif($interview->school_level==3)
                                                    University
                                                @else
                                                    Above University
                                                @endif
                                            <br>
                                            <label  class="font-weight-bold pl-3">{{ trans('admin/main.title') }}</label>
                                            {{ $interview->title}}
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <h2 class="section-title after-line">{{ trans('admin/main.question') }}</h2>
                                <br>
                            </div>
                            <div class="row">

                                <div class="col-md-8">
                                    @if(!empty($interviewQuestions))
                                        @foreach($interviewQuestions as $key => $interviewQuestion)

                                            <p class="form-control">
                                                {{$interviewQuestion->question }}
                                            </p>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts_bottom')

@endpush
