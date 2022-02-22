@extends(getTemplate().'.layouts.app')

@push('styles_top')
<style>
    .site-top-banner {
        height: 400px !important;
    }

    .steps-container .content {
        padding: 20px;
        background-color: white;
        position: relative;
        border-radius: 0px 0px 80px 0px;
        box-shadow: 0px 16px 27px rgb(0 11 30 / 10%);
        height: 280px;
    }
    .steps-container .accredited {
        padding: 15px;
        margin-bottom: 10px;
        background-color: white;
        border-left: 4px solid #000;
        position: relative;
        box-shadow: 0px 16px 27px rgb(0 11 30 / 10%);
    }
    .values
    {
        text-align: center;
        font-size: 45px;
        text-decoration-line: underline;
        margin-bottom: 25px;
    }
    .star
    {
        font-weight: bold;
        font-size: 18px;

    }
    .vission
    {
        font-size: 40px;
        border-left: 3px solid;
        padding-left: 20px;
    }
</style>

@endpush


@section('content')
    <section class="site-top-banner search-top-banner opacity-04 position-relative">
        <img src="{{ getPageBackgroundSettings('blog') }}" class="img-cover" alt=""/>

        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center text-center">
                <div class="col-12 col-md-9 col-lg-7">
                    <div class="top-search-categories-form">
                        <h1 class="text-white font-30 mb-15">{{trans('public.about')}}</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="container mt-10 ">
        <div class="row">
            <div class="col-md-4 col-sm-8 head">
                <h1 class="vission">{{trans('about.vision_mission')}}</h1>
            </div>
            <div class="col-md-4 col-sm-8">
                <p>
                    {{trans('about.vision_mission_content_1')}}
                </p>

            </div>
            <div class="col-md-4 col-sm-8">
                <p>
                    {{trans('about.vision_mission_content_2')}}
                </p>
            </div>
        </div>
        <hr>
        <h1 class="values">{{trans('about.values')}}</h1>
        <div class="row">
            <div class="col-md-4 col-sm-6">
               <div class="steps-container">
                   <div class="content">
                       <h1>01</h1>
                       <h3>{{trans('about.ambition')}}</h3>
                       <p>
                           {{trans('about.ambition_content')}}
                       </p>
                   </div>
               </div>
           </div>
            <div class="col-md-4 col-sm-6">
                <div class="steps-container">
                    <div class="content">
                        <h1>02</h1>
                        <h3>{{trans('about.respect')}}</h3>
                        <p>
                            {{trans('about.respect_content')}}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="steps-container">
                    <div class="content">
                        <h1>03</h1>
                        <h3>{{trans('about.responsible')}}</h3>
                        <p>
                            {{trans('about.responsible_content')}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <br><br>
        <div class="row">
            <div class="col-md-4 col-sm-6">
                <div class="steps-container">
                    <div class="content">
                        <h1>04</h1>
                        <h3>{{trans('about.professionalism')}}</h3>
                        <p>
                            {{trans('about.professionalism_content')}}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="steps-container">
                    <div class="content">
                        <h1>05</h1>
                        <h3>{{trans('about.cleverness')}}</h3>
                        <p>
                            {{trans('about.cleverness_content')}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <hr style="color: #0c5460">
    <section class="site-top-banner search-top-banner opacity-04 position-relative">
        <img src="{{ getPageBackgroundSettings('blog') }}" class="img-cover" alt=""/>

        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center text-center">
                <div class="col-12 col-md-9 col-lg-7">
                    <div class="top-search-categories-form">
                        <h1 class="text-white font-30 mb-15 text-capitalize">{{trans('about.our_vision')}}</h1>
                        <h2 class="text-white font-30 mb-15">“{{trans('about.our_vision_content')}}”</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container mt-10 ">
        <h1 class="values">{{trans('about.accredited_by')}}</h1>
        <div class="row">
            <div class="col-md-7">
               <img src="{{asset('assets/default/img/about_section.png')}}" class="img-fluid rounded mx-auto d-block float-left">
            </div>
            <div class="col-md-5 mt-auto">
                <div class="steps-container">
                        <div class="accredited">
                            <h3>{{trans('about.accredited_content1')}}</h3>
                            <p>
                                <a href="www.utec-arab.org">www.utec-arab.org</a>
                            </p>
                        </div>
                    </div>
                <div class="steps-container">
                    <div class="accredited">
                        <h3>{{trans('about.accredited_content2')}}</h3>
                        <p>
                            <a href="www.mhd.gov.sd">www.mhd.gov.sd</a>
                        </p>
                    </div>
                </div>
                <div class="steps-container">
                    <div class="accredited">
                        <h3>{{trans('about.accredited_content3')}}</h3>
                        <p>
                            <a href="www.nctte.gov.sd">www.nctte.gov.sd</a>

                        </p>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-7">
                <h1 class="m-4">{{trans('about.legal_approvals')}}</h1>
                <p>{{trans('about.legal_approvals_content1')}}</p>
                <br>
                <div>
                    <h3>
                        {{trans('about.legal_approvals_content2')}}
                    </h3>
                    <br>
                    <h3>
                        {{trans('about.legal_approvals_content3')}}

                    </h3>

                </div>
            </div>
            <div class="col-md-5">
                <div class="steps-container">
                    <div class="accredited">
                        <h3>{{trans('about.accredited_content4')}}</h3>
                        <p>
                            <a href="WWW.UCTA-EDU.ORG">WWW.UCTA-EDU.ORG</a>
                        </p>
                    </div>
                </div>
                <div class="steps-container">
                    <div class="accredited">
                        <h3>{{trans('about.accredited_content5')}}</h3>
                        <p>
                            <a href="WWW.AMERICAN-COUNCIL.ORG">WWW.AMERICAN-COUNCIL.ORG</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container mt-10 ">
        <h1 class="values">{{trans('about.accreditation')}}</h1>
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="steps-container">
                    <div class="content">
                        <h1>01</h1>
                        <h3>{{trans('about.accreditation_content1')}}</h3>
                        <br>
                        <p>{{trans('about.accreditation_content2')}}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="steps-container">
                    <div class="content">
                        <h1>02</h1>
                        <h3>
                            {{trans('about.study_in_america')}}
                        </h3>
                        <br>
                        <p>
                            {{trans('about.study_in_america_content')}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
