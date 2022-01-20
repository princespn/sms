<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\LicenseController;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use App\Services\Statistics\TTSService;
use App\Services\Statistics\CostsService;
use App\Models\Result;
use App\Models\Voice;
use App\Models\User;
use DataTables;

class AdminTTSController extends Controller
{
    private $api;

    public function __construct()
    {
        $this->api = new LicenseController();
    }

    /**
     * Display TTS dashboard
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $verify = $this->api->verify_license();

        if($verify['status']!=true){
            die('Your license is invalid or not activated, please contact support.');
        } 

        $year = $request->input('year', date('Y'));
        $month = $request->input('month', date('m'));

        $tts = new TTSService($year, $month);

        $tts_data_yearly = [
            'total_free_chars' => $tts->getTotalFreeCharsUsageYearly(),
            'total_paid_chars' => $tts->getTotalPaidCharsUsageYearly(),
            'total_standard_chars' => $tts->getTotalStandardCharsUsageYearly(),
            'total_neural_chars' => $tts->getTotalNeuralCharsUsageYearly(),
            'total_audio_files' => $tts->getTotalAudioFilesYearly(),
            'total_listen_results' => $tts->getTotalListenResultsYearly(),
        ];

        $tts_data_monthly = [
            'free_chars' => $tts->getTotalFreeCharsUsageMonthly(),
            'paid_chars' => $tts->getTotalPaidCharsUsageMonthly(),
            'standard_chars' => $tts->getTotalStandardCharsUsageMonthly(),
            'neural_chars' => $tts->getTotalNeuralCharsUsageMonthly()
        ];

        $vendor_data = [
            'aws_month' => $tts->getAWSUsageMonthly(),
            'aws_year' => $tts->getAWSUsageYearly(),
            'azure_month' => $tts->getAzureUsageMonthly(),
            'azure_year' => $tts->getAzureUsageYearly(),
            'gcp_month' => $tts->getGCPUsageMonthly(),
            'gcp_year' => $tts->getGCPUsageYearly(),
            'ibm_month' => $tts->getIBMUsageMonthly(),
            'ibm_year' => $tts->getIBMUsageYearly()
        ];
        
        $chart_data['free_chars'] = json_encode($tts->getFreeCharsUsageYearly());
        $chart_data['paid_chars'] = json_encode($tts->getPaidCharsUsageYearly());

        $percentage['aws_year'] = json_encode($tts->getAWSUsageYearly());
        $percentage['azure_year'] = json_encode($tts->getAzureUsageYearly());
        $percentage['gcp_year'] = json_encode($tts->getGCPUsageYearly());
        $percentage['ibm_year'] = json_encode($tts->getIBMUsageYearly());
        $percentage['free_current'] = json_encode($tts->getTotalFreeCharsUsageMonthly());
        $percentage['free_past'] = json_encode($tts->getTotalFreeCharsUsagePastMonth());
        $percentage['paid_current'] = json_encode($tts->getTotalPaidCharsUsageMonthly());
        $percentage['paid_past'] = json_encode($tts->getTotalPaidCharsUsagePastMonth());
        $percentage['standard_current'] = json_encode($tts->getTotalStandardCharsUsageMonthly());
        $percentage['standard_past'] = json_encode($tts->getTotalStandardCharsUsagePastMonth());
        $percentage['neural_current'] = json_encode($tts->getTotalNeuralCharsUsageMonthly());
        $percentage['neural_past'] = json_encode($tts->getTotalNeuralCharsUsagePastMonth());

        return view('admin.tts-management.dashboard.index', compact('chart_data', 'percentage', 'tts_data_yearly', 'tts_data_monthly', 'vendor_data'));
    }


    /**
     * List all tts synthesize results
     */
    public function listResults(Request $request)
    {
        if ($request->ajax()) {
            $data = Result::all()->where('mode', 'file')->sortByDesc("created_at");
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('actions', function($row){
                        $actionBtn = '<div class="dropdown">
                                            <button class="btn table-actions" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-ellipsis-v"></i>                       
                                            </button>
                                            <div class="dropdown-menu table-actions-dropdown" role="menu" aria-labelledby="actions">
                                                <a class="dropdown-item" href="'. route("admin.tts.result.show", $row["id"] ). '"><i class="mdi mdi-audiobook"></i> View</a>
                                                <a class="dropdown-item" data-toggle="modal" id="deleteResultButton" data-target="#deleteModal" href="'. route("admin.tts.result.delete", $row["id"] ). '"><i class="fa fa-trash"></i> Delete</a>
                                            </div>
                                        </div>';
                        return $actionBtn;
                    })
                    ->addColumn('created-on', function($row){
                        $created_on = '<span>'.date_format($row["created_at"], 'Y-m-d H:i:s').'</span>';
                        return $created_on;
                    })
                    ->addColumn('custom-plan-type', function($row){
                        $custom_plan = '<span class="cell-box plan-'.strtolower($row["plan_type"]).'">'.ucfirst($row["plan_type"]).'</span>';
                        return $custom_plan;
                    })
                    ->addColumn('custom-voice-type', function($row){
                        $custom_voice = '<span class="cell-box voice-'.strtolower($row["voice_type"]).'">'.ucfirst($row["voice_type"]).'</span>';
                        return $custom_voice;
                    })
                    ->addColumn('username', function($row){
                        if ($row["user_id"]) {
                            $username = '<span>'.User::find($row["user_id"])->name.'</span>';
                            return $username;
                        } else {
                            return $row["user_id"];
                        }
                       
                    })
                    ->addColumn('download', function($row){
                        $url = ($row['storage'] == 'local') ? URL::asset($row['result_url']) : $row['result_url'];
                        $result = '<a class="" href="' . $url . '" download><i class="fa fa-cloud-download result-download fs-20"></i></a>';
                        return $result;
                    })
                    ->addColumn('single', function($row){
                        $url = ($row['storage'] == 'local') ? URL::asset($row['result_url']) : $row['result_url'];
                        $result = '<button type="button" class="result-play" onclick="resultPlay(this)" src="' . $url . '" type="'. $row['audio_type'].'" id="'. $row['id'] .'"><i class="fa fa-play"></i></button>';
                        return $result;
                    })
                    ->addColumn('result', function($row){
                        $result = ($row['storage'] == 'local') ? URL::asset($row['result_url']) : $row['result_url'];
                        return $result;
                    })
                    ->addColumn('vendor', function($row){
                        $path = URL::asset($row['vendor_img']);
                        $vendor = '<div class="vendor-image-sm overflow-hidden"><img alt="vendor" class="rounded-circle" src="' . $path . '"></div>';
                        return $vendor;
                    })
                    ->rawColumns(['actions', 'custom-plan-type', 'created-on', 'username', 'custom-voice-type', 'result', 'vendor', 'download', 'single'])
                    ->make(true);
                    
        }

        return view('admin.tts-management.results.index');
    }


    /**
     * Display selected result details
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Result $id)
    {   
        $name = User::find($id->user_id)->name;
        $email = User::find($id->user_id)->email;

        $cost = new CostsService();

        $json_data['cost'] = json_encode($cost->getCostPerText($id->id));

        return view('admin.tts-management.results.show', compact('id', 'email', 'json_data'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Result::where('id', $id)->firstOrFail();  

        $result->delete();

        return redirect()->route('admin.tts.results')->with('success', 'Synthesize record was deleted successfully');       
    }

    public function delete($id)
    {   
        $result = Result::where('id', $id)->firstOrFail();

        return view('admin.tts-management.results.delete', compact('result'));     
    }


    /**
     * List all tts synthesize results
     */
    public function voices(Request $request)
    {
        if ($request->ajax()) {
            $data = Voice::all()->where('effect', 'standard');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('actions', function($row){
                        $actionBtn = '<div>               
                                            <a data-toggle="modal" id="changeVoiceNameButton" data-target="#changeNameModal" href="'. route("admin.tts.voices.edit", $row["id"] ). '"><i class="fa fa-edit voice-action-buttons rename-voice" title="Rename Voice"></i></a>
                                            <a data-toggle="modal" id="activateVoiceButton" data-target="#activateModal" href="'. route("admin.tts.voices.activate.show", $row["id"] ). '"><i class="fa fa-check voice-action-buttons activate-voice" title="Activate Voice"></i></a>
                                            <a data-toggle="modal" id="deactivateVoiceButton" data-target="#deactivateModal" href="'. route("admin.tts.voices.deactivate.show", $row["id"] ). '"><i class="voice-action-buttons fa fa-close deactivate-voice" title="Deactivate Voice"></i></a>  
                                        </div>';
                        return $actionBtn;
                    })
                    ->addColumn('created-on', function($row){
                        $created_on = '<span>'.date_format($row["updated_at"], 'Y-m-d H:i:s').'</span>';
                        return $created_on;
                    })
                    ->addColumn('custom-voice-type', function($row){
                        $custom_voice = '<span class="cell-box voice-'.strtolower($row["voice_type"]).'">'.ucfirst($row["voice_type"]).'</span>';
                        return $custom_voice;
                    })
                    ->addColumn('custom-status', function($row){
                        $custom_voice = '<span class="cell-box status-'.strtolower($row["status"]).'">'.ucfirst($row["status"]).'</span>';
                        return $custom_voice;
                    })
                    ->addColumn('single', function($row){
                        $url = ($row['storage'] == 'local') ? URL::asset($row['sample_url']) : $row['sample_url'];
                        $result = '<button type="button" class="result-play" onclick="resultPlay(this)" src="' . $url . '" type="'. $row['audio_type'].'" id="'. $row['id'] .'"><i class="fa fa-play"></i></button>';
                        return $result;
                    })
                    ->addColumn('vendor', function($row){
                        $path = URL::asset($row['vendor_img']);
                        $vendor = '<div class="vendor-image-sm overflow-hidden"><img alt="vendor" class="rounded-circle" src="' . $path . '"></div>';
                        return $vendor;
                    })
                    ->rawColumns(['actions', 'created-on', 'custom-voice-type', 'vendor', 'single', 'custom-status'])
                    ->make(true);
                    
        }

        return view('admin.tts-management.voices.index');
    }


    /**
     * Edit the specified voice.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function voicesEdit($id)
    {   
        $result = Voice::where('id', $id)->firstOrFail();

        return view('admin.tts-management.voices.edit', compact('result'));     
    }


    /**
     * Update the specified voice.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function voicesUpdate($id)
    {   

        $result = Voice::where('id', $id)->firstOrFail();

        $result->update(['voice' => request('voice-name')]);

        return redirect()->route('admin.tts.voices')->with('success', 'Voice name was successfully updated');   
    }


    /**
     * Enable the specified voice.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function voicesActivate($id)
    {
        $result = Voice::where('id', $id)->firstOrFail();  

        if ($result->status == 'active') {
            return redirect()->route('admin.tts.voices')->with('error', 'Voice is already activated'); 
        }

        $result->update(['status' => 'active']);

        return redirect()->route('admin.tts.voices')->with('success', 'Voice was successfully activated');       
    }

    public function voicesShowActivate($id)
    {   
        $result = Voice::where('id', $id)->firstOrFail();

        return view('admin.tts-management.voices.activate', compact('result'));     
    }


    /**
     * Enable all voices.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function voicesActivateAll()
    {
        Voice::query()->update(['status' => 'active']); 

        return redirect()->route('admin.tts.voices')->with('success', 'All voice were successfully activated');         
    }


    /**
     * Disable the specified voice.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function voicesDeactivate($id)
    {
        $result = Voice::where('id', $id)->firstOrFail();  

        if ($result->status == 'deactive') {
            return redirect()->route('admin.tts.voices')->with('error', 'Voice is already deactivated'); 
        }

        $result->update(['status' => 'deactive']);

        return redirect()->route('admin.tts.voices')->with('success', 'Voice was successfully deactivated');       
    }

    public function voicesShowDeactivate($id)
    {   
        $result = Voice::where('id', $id)->firstOrFail();

        return view('admin.tts-management.voices.deactivate', compact('result'));     
    }


    /**
     * Disable all voices.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function voicesDeactivateAll()
    {
        Voice::query()->update(['status' => 'deactive']); 

        return redirect()->route('admin.tts.voices')->with('success', 'All voice were successfully deactivated');       
    }
}
