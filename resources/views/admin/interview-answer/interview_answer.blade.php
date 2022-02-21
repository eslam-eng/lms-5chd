@extends('admin.layouts.app')

@push('libraries_top')


@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ trans('admin/main.student_details') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/admin/">{{ trans('admin/main.dashboard') }}</a>
                </div>
                <div class="breadcrumb-item active"><a href="/admin/installment">{{ trans('admin/main.student_details') }}</a>
                </div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="section-title after-line">{{ trans('admin/main.general_info') }}</h2>
                            <br>
                            <div class="row">
                                {{--                                sudent details--}}
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-group mt-15">
                                        <h6>{{trans('admin/main.student_details')}}</h6>
                                        <label class="input-label"><span class="font-weight-bold font-16 p-1">{{trans('admin/main.student_name')}}:</span>{{ $student->full_name}}</label>
                                        <br>
                                        <label class="input-label"><span class="font-weight-bold font-16 p-1">{{trans('admin/main.mobile')}}:</span>{{$student->mobile}}</label>
                                        <br>
                                        <label class="input-label"><span class="font-weight-bold font-16 p-1">{{trans('admin/main.email')}}:</span>{{$student->email}}</label>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <h2 class="section-title after-line">{{ trans('admin/main.interview_detail') }}</h2>
                                <br>
                                <table class="table table-striped table-bordered font-14">
                                    <thead>
                                    <tr>
                                        <th class="text-left">#</th>
                                        <th class="text-left">{{ trans('admin/main.question') }}</th>
                                        <th>{{ trans('admin/main.an_answer') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($student->interViewAnswer as $key=>$interview)
                                        <tr>
                                            <td class="text-left">{{ $key+1 }}</td>
                                            <td>{{ $interview->question->question }}</td>
                                            <td>{{ $interview->answer }}</td>
                                        </tr>
                                    @endforeach
                                    @if($student->status!='active')
                                        <tr>
                                            <td colspan="2">
                                                <button id="acceptInterview" class="btn btn-primary">approve & send mail</button>
                                            </td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>

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
            $("#acceptInterview").click(function(){
                let student_id = {{$student->id}}
                setTimeout(function () {
                    $.ajax({
                        url: "/admin/students/accept/interview",
                        data:{
                            "student_id":student_id
                        },
                        type: 'post',
                        success: function (data) {
                            $.toast({
                                    heading: "message",
                                    text: data.message,
                                    bgColor: '#3d8152',
                                    textColor: 'white',
                                    hideAfter: 10000,
                                    position: 'bottom-right',
                                    icon: 'success'
                                });
                                window.location.href="/admin/students";
                        },
                        error: function (data) {
                            $.toast({
                                heading: {{trans('public.fail')}},
                                text: {{trans('quiz.failed')}},
                                bgColor: '#d73b3b',
                                textColor: 'white',
                                hideAfter: 10000,
                                position: 'bottom-right',
                                icon: 'error'
                            });
                        }
                    });
                }, 300);
            })
        })
    </script>
@endpush
