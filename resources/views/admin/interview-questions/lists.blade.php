@extends('admin.layouts.app')

@push('libraries_top')

@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ trans('admin/main.question') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/admin/">{{trans('admin/main.dashboard')}}</a>
                </div>
                <div class="breadcrumb-item">{{ trans('admin/main.interview_question') }}</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table font-14">
                                    <tr>
                                        <th>{{ trans('admin/main.title') }}</th>
                                        <th class="text-left">{{ trans('admin/main.school_level') }}</th>
                                        <th>{{ trans('admin/main.action') }}</th>
                                    </tr>
                                    @foreach($interviewQuestions as $interviewQuestion)
                                        <tr>
                                            <td>{{ $interviewQuestion->title }}</td>
                                            <td class="text-left">
                                                @if($interviewQuestion->school_level==1)
                                                    Secondary
                                                @elseif($interviewQuestion->school_level==2)
                                                    Above secondary
                                                @elseif($interviewQuestion->school_level==3)
                                                    University
                                                @else
                                                    Above University
                                                @endif
                                            </td>
                                            <td>
                                                @can('admin_filters_edit')
                                                    <a href="/admin/interview-questions/{{ $interviewQuestion->id }}/show"
                                                       class="btn-transparent btn-sm text-primary">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                @endcan
                                                @can('admin_filters_edit')
                                                    <a href="/admin/interview-questions/{{ $interviewQuestion->id }}/edit"
                                                       class="btn-transparent btn-sm text-primary">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endcan
                                                @can('admin_filters_delete')
                                                    @include('admin.includes.delete_button',['url' => '/admin/interview-questions/'.$interviewQuestion->id.'/delete'])
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
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

@endpush
