<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\StudentCertificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CertificateValidationController extends Controller
{
    public function index()
    {
        $getSeoMetas = getSeoMetas('certificate_validation');
        $pageTitle = !empty($getSeoMetas['title']) ? $getSeoMetas['title'] : trans('site.certificate_validation_page_title');
        $pageDescription = !empty($getSeoMetas['description']) ? $getSeoMetas['description'] : trans('site.certificate_validation_page_title');
        $pageRobot = getPageRobot('certificate_validation');

        $data = [
            'pageTitle' => $pageTitle,
            'pageDescription' => $pageDescription,
            'pageRobot' => $pageRobot,
        ];

        return view(getTemplate() . '.auth.certificate_validation', $data);
    }

    public function checkValidate(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'certificate_id' => 'required|numeric',
            'captcha' => 'required|captcha',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 422,
                'errors' => $validator->errors(),
            ], 422);
        }

        $certificateId = $data['certificate_id'];

        $certificate = StudentCertificate::with(['student'=>function($query){
            $query->select("id",'full_name','mobile');
        }])->with(['course'=>function($query){
            $query->select('id','title','slug','duration');
        }])->where('certificate_id', $certificateId)->first();

        if (!empty($certificate)) {
            $result = [
                'student' => $certificate->student->full_name,
                'student_mobile' => $certificate->student->mobile,
                'webinar_title' => $certificate->course->title,
                'course_duration' => $certificate->course->duration,
                'date' =>$certificate->created_at->format('j F Y'),
                'certificate_attachment' =>$certificate->attachment,

            ];

            return response()->json([
                'code' => 200,
                'certificate' => $result
            ]);
        }

        return response()->json([
            'code' => 404,
        ]);
    }
}
