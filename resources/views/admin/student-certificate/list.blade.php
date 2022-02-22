@extends('admin.layouts.app')

@push('libraries_top')

@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ trans('admin/main.certificate_list_page_title') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/admin/">{{trans('admin/main.dashboard')}}</a>
                </div>
                <div class="breadcrumb-item">{{ trans('admin/main.certificates') }}</div>
            </div>
        </div>

        <section class="card">
            <div class="card-body">
                <form method="get" class="mb-0">
                    <input type="hidden" name="type" value="{{ request()->get('type') }}">
                    <div class="row">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="input-label">{{trans('admin/main.search_student')}}</label>
                                <input name="student" type="text" class="form-control" value="{{ request()->get('student') }}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="input-label">{{trans('admin/main.search_webinar')}}</label>
                                <input name="course" type="text" class="form-control" value="{{ request()->get('course') }}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="input-label">{{trans('admin/main.certificate_id')}}</label>
                                <input name="certificate_id" type="text" class="form-control" value="{{ request()->get('certificate_id') }}">
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="input-label">{{trans('admin/main.status')}}</label>
                                <select name="status" data-plugin-selectTwo class="form-control populate">
                                    <option disabled selected>{{trans('admin/main.select_status')}}</option>
                                    <option value="1">{{trans('admin/main.active')}}</option>
                                    <option value="0">{{trans('admin/main.not_active')}}</option>
                                </select>
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="form-group mt-1">
                                <label class="input-label mb-4"> </label>
                                <input type="submit" class="text-center btn btn-primary w-100" value="{{trans('admin/main.show_results')}}">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>

        <div class="section-body">

            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <div id="accordion">
                                    @foreach($studentCertificates as $key=>$studentCertificate)
                                        <div class="card-header" id="heading{{$key}}">
                                            <div class="row">
                                                <div class="col-md-4 col-sm-4">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$key}}" aria-expanded="true" aria-controls="collapse{{$key}}">
                                                            {{trans('admin/main.certificates')}}
                                                        </button>
                                                    </h5>
                                                </div>
                                                <div class="col-md-8 col-sm-8">
                                                    <span>{{$studentCertificate[0]->student->full_name}}</span>
                                                    <b class="pl-5">{{$studentCertificate[0]->student->mobile}}</b>
                                                </div>
                                            </div>
                                        </div>
                                            <div class="card">
                                                <div id="collapse{{$key}}" class="collapse {{$loop->index==0?'show':''}}" aria-labelledby="heading{{$key}}" data-parent="#accordion">
                                                    <div class="card-body">
                                                        <table class="table table-striped">
                                                            <tr>
                                                                <th></th>
                                                                <th>{{trans('admin/main.course')}}</th>
                                                                <th>{{trans('admin/main.certificate_id')}}</th>
                                                                <th>{{trans('admin/main.status')}}</th>
                                                                <th>{{trans('public.created')}}</th>
                                                                <th>{{trans('admin/main.degree')}}</th>
                                                                <th>{{trans('admin/main.notes')}}</th>
                                                                <th></th>
                                                            </tr>

                                                            @foreach($studentCertificate as $certificate)
                                                                <tr>
                                                                    <td>
                                                                        @if(!empty($certificate->attachment))
                                                                            <a href="{{$certificate->attachment}}" download>{{trans('quiz.download_certificate')}}</a>
                                                                        @endif
                                                                    </td>
                                                                    <td>{{$certificate->course->title . "|".$certificate->course->slug}}</td>
                                                                    <td>{{$certificate->certificate_id}}</td>
                                                                    <td>{{$certificate->status==1?trans('admin/main.active'):trans('admin/main.not_active')}}</td>
                                                                    <td>{{$certificate->created_at->diffForHumans()}}</td>
                                                                    <td>{{$certificate->degree}}</td>
                                                                    <td>{{$certificate->notes}}</td>
                                                                    <td>
                                                                        @can('admin_certificate_template_delete')
                                                                            @include('admin.includes.delete_button',['url' => '/admin/certificates/'.$certificate->id.'/delete', 'btnClass' => 'btn-sm mt-1'])
                                                                        @endcan
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                    @endforeach
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
