<?php

namespace App\Http\Controllers\AppSettings;

use App\Http\Controllers\Controller;
use App\Model\AppSettings;
use App\Model\BankCodesModel;
use App\Model\CurrencyRatesModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Validator;

class AppSettingsController extends Controller
{
    //
    function __construct(AppSettings $appSettings, CurrencyRatesModel $currencyRatesModel, BankCodesModel $bankCodesModel)
    {
        $this->middleware('auth');
        $this->appSettings = $appSettings;
        $this->currencyRatesModel = $currencyRatesModel;
        $this->bankCodesModel = $bankCodesModel;
    }

    public function mainSettings()
    {

        $user = Auth::user();

        $currencyRatesModel = $this->currencyRatesModel->getAllCurrency();

        $condition = [
            ['type_of_gateway', 'flutterwave'],
            ['is_deleted', 'no']
        ];

        $bankCodesModel = $this->bankCodesModel->getAllBankCodes($condition);

        $data = ['currencyRatesModel' => $currencyRatesModel, 'user' => $user, 'bankCodesModel' => $bankCodesModel];

        return view('dashboard.setting', $data);
    }

    public function appSettings()
    {

        $condition = [
            ['unique_id', 'ozV4GtwTx6AMa0yiIQk4ef025573572a01ea']
        ];

        $appSettings = $this->appSettings->getSingleAppSettings($condition);


        return view('dashboard.app_setting', ['appSettings' => $appSettings]);
    }

    protected function Validator($request)
    {

        $this->validator = Validator::make($request->all(), [
            'company_name' => 'required',
            'company_url' => 'required',
        ]);
    }

    public function updateAppSettings(Request $request, $unique_id)
    {

        $data = $request->all();

        try {
            $this->Validator($request); //validate fields

            $condition = [
                ['unique_id', $unique_id]
            ];

            $appSettings = $this->appSettings->getSingleAppSettings($condition);

            $appSettings->company_name = $data['company_name'];
            $appSettings->company_url = $data['company_url'];
            $appSettings->company_email_1 = $data['company_email_1'];
            $appSettings->company_email_2 = $data['company_email_2'];
            $appSettings->company_phone_1 = $data['company_phone'];
            $appSettings->company_address = $data['company_address'];
            $appSettings->facebook_url = $data['facebook_url'];
            $appSettings->twitter_url = $data['twitter_url'];
            $appSettings->youtube_url = $data['youtube_url'];
            $appSettings->whatsApp_phone = $data['whatsApp'];
            $appSettings->instagram_url = $data['instagram_url'];

            if ($appSettings->save()) {
                return redirect('/app_settings_page')->with('success_message', 'AppSettings Was Successfully Updated');
            } else {
                return redirect('/app_settings_page')->with('error_message', 'An Error occurred, Please try Again Later');
            }
        } catch (Exception $exception) {

            $errorsArray = $exception->getMessage();
            return  redirect('app_settings_page')->with('error_message', $errorsArray);
        }
    }

    public function update_enrollment_percentage(Request $request)
    {
        // return 'man';
        try {
            if (!$request->isMethod('POST')) {
                throw new Exception('This is not a valid request.');
            }

            $validator = Validator::make($request->all(), [
                'percentage' => 'required|numeric',
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors(), 'status' => false]);
            }


            $condition = [
                ['unique_id', 'ozV4GtwTx6AMa0yiIQk4ef025573572a01ea']
            ];
            $appSettings = $this->appSettings->getSingleAppSettings($condition);
            $appSettings->enrollment_percentage = $request->input('percentage');
            $updated = $appSettings->save();


            if (!$updated) {
                throw new Exception($this->errorMsgs(14)['msg']);
            } else {
                $error = 'Course Enrollment Percentage is set!';
                return response()->json(["message" => $error, 'status' => true]);
            }
        } catch (Exception $e) {

            $error = $e->getMessage();
            $error = [
                'errors' => [$error],
            ];
            return response()->json(["errors" => $error, 'status' => false]);
        }
    }

    public function updateSiteLogo(Request $request): \Illuminate\Http\JsonResponse
    {
        $site_logos = null;
        $app_settings = $this->appSettings->getSingleModel();
        try {
            $validator = Validator::make($request->all(), [
                'site_logo' => 'required|file|image|mimes:jpeg,png,gif|max:4048',
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors(), 'status' => false]);
            }

            //code for remove old file
            if ($app_settings->site_logo !== null) {
                if(file_exists(storage_path('app/public/site_logo/') . $app_settings->site_logo)){
                    $file_old = storage_path('app/public/site_logo/') . $app_settings->site_logo;
                    unlink($file_old);
                }
            }
            if ($request->hasFile('site_logo')) {
                $file = $request->file('site_logo');
                $site_logos = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->storeAs('public/site_logo', $site_logos);
            }
            $app_settings->site_logo = $site_logos;

            if ($app_settings->save()) {
                $error = 'Site Logo Updated Successfully!';
                return response()->json(["message" => $error, 'status' => true]);
            } else {
                throw new Exception($this->errorMsgs(14)['msg']);
            }

        } catch (Exception $e) {

            $error = $e->getMessage();
            $error = [
                'errors' => [$error],
            ];
            return response()->json(["errors" => $error, 'status' => false]);
        }
    }
}
