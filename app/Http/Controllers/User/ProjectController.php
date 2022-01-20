<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Project;
use App\Models\Result;
use App\Models\User;
use App\Models\Music;
use Yajra\DataTables\DataTables;
use DB;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        # Today's TTS Results for Datatable
        if ($request->ajax()) {
            $data = Result::where('project', Auth::user()->project)->where('mode', 'file')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('actions', function($row){
                        $actionBtn = '<div class="dropdown">
                                            <button class="btn table-actions" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-ellipsis-v"></i>                       
                                            </button>
                                            <div class="dropdown-menu table-actions-dropdown" role="menu" aria-labelledby="actions">
                                                <a class="dropdown-item" href="'. route("user.tts.show", $row["id"] ). '"><i class="mdi mdi-audiobook"></i> View</a>
                                                <a class="dropdown-item" data-toggle="modal" id="deleteResultButton" data-target="#deleteModal" href="'. route("user.tts.delete", $row["id"] ). '"><i class="fa fa-trash"></i> Delete</a>
                                            </div>
                                        </div>';
                        return $actionBtn;
                    })
                    ->addColumn('created-on', function($row){
                        $created_on = '<span>'.date_format($row["created_at"], 'Y-m-d H:i:s').'</span>';
                        return $created_on;
                    })
                    ->addColumn('custom-voice-type', function($row){
                        $custom_voice = '<span class="cell-box voice-'.strtolower($row["voice_type"]).'">'.ucfirst($row["voice_type"]).'</span>';
                        return $custom_voice;
                    })
                    ->addColumn('vendor', function($row){
                        $path = URL::asset($row['vendor_img']);
                        $vendor = '<div class="vendor-image-sm overflow-hidden"><img alt="vendor" src="' . $path . '"></div>';
                        return $vendor;
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
                    ->rawColumns(['actions', 'created-on', 'custom-voice-type', 'result', 'vendor', 'download', 'single'])
                    ->make(true);
                    
        }

        $projects = Project::where('user_id', auth()->user()->id)->get();
        $musics = Music::where('user_id', auth()->user()->id)->get();

        $data = DB::table('results')->where('project', auth()->user()->project)
                        ->select(DB::raw('sum(results.characters) as chars'), DB::raw('count(results.id) as results'))
                        ->get();
        $data = get_object_vars($data[0]); 

        return view('user.projects.index', compact('projects', 'musics', 'data'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function change(Request $request)
    {
        if ($request->group == 'all') {
            if ($request->ajax()) {
                $data = Result::where('user_id', auth()->user()->id)->where('mode', 'file')->get();
                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('actions', function($row){
                            $actionBtn = '<div class="dropdown">
                                                <button class="btn table-actions" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v"></i>                       
                                                </button>
                                                <div class="dropdown-menu table-actions-dropdown" role="menu" aria-labelledby="actions">
                                                    <a class="dropdown-item" href="'. route("user.tts.show", $row["id"] ). '"><i class="mdi mdi-audiobook"></i> View</a>
                                                    <a class="dropdown-item" data-toggle="modal" id="deleteResultButton" data-target="#deleteModal" href="'. route("user.tts.delete", $row["id"] ). '"><i class="fa fa-trash"></i> Delete</a>
                                                </div>
                                            </div>';
                            return $actionBtn;
                        })
                        ->addColumn('created-on', function($row){
                            $created_on = '<span>'.date_format($row["created_at"], 'Y-m-d H:i:s').'</span>';
                            return $created_on;
                        })
                        ->addColumn('custom-voice-type', function($row){
                            $custom_voice = '<span class="cell-box voice-'.strtolower($row["voice_type"]).'">'.ucfirst($row["voice_type"]).'</span>';
                            return $custom_voice;
                        })
                        ->addColumn('vendor', function($row){
                            $path = URL::asset($row['vendor_img']);
                            $vendor = '<div class="vendor-image-sm overflow-hidden"><img alt="vendor" src="' . $path . '"></div>';
                            return $vendor;
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
                        ->rawColumns(['actions', 'created-on', 'custom-voice-type', 'result', 'vendor', 'download', 'single'])
                        ->make(true);          
            }

        } else {

            if ($request->ajax()) {
                $data = Result::where('project', $request->group)->where('user_id', auth()->user()->id)->where('mode', 'file')->get();
                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('actions', function($row){
                            $actionBtn = '<div class="dropdown">
                                                <button class="btn table-actions" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v"></i>                       
                                                </button>
                                                <div class="dropdown-menu table-actions-dropdown" role="menu" aria-labelledby="actions">
                                                    <a class="dropdown-item" href="'. route("user.tts.show", $row["id"] ). '"><i class="mdi mdi-audiobook"></i> View</a>
                                                    <a class="dropdown-item" data-toggle="modal" id="deleteResultButton" data-target="#deleteModal" href="'. route("user.tts.delete", $row["id"] ). '"><i class="fa fa-trash"></i> Delete</a>
                                                </div>
                                            </div>';
                            return $actionBtn;
                        })
                        ->addColumn('created-on', function($row){
                            $created_on = '<span>'.date_format($row["created_at"], 'Y-m-d H:i:s').'</span>';
                            return $created_on;
                        })
                        ->addColumn('custom-voice-type', function($row){
                            $custom_voice = '<span class="cell-box voice-'.strtolower($row["voice_type"]).'">'.ucfirst($row["voice_type"]).'</span>';
                            return $custom_voice;
                        })
                        ->addColumn('vendor', function($row){
                            $path = URL::asset($row['vendor_img']);
                            $vendor = '<div class="vendor-image-sm overflow-hidden"><img alt="vendor" src="' . $path . '"></div>';
                            return $vendor;
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
                        ->rawColumns(['actions', 'created-on', 'custom-voice-type', 'result', 'vendor', 'download', 'single'])
                        ->make(true);          
            }
        }

        
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Request $request)
    {

        if ($request->project == 'all') {
            $data_results = DB::table('results')->where('user_id', auth()->user()->id)
                        ->where('mode', 'file')
                        ->select(DB::raw('count(id) as total'))
                        ->get();
            $data_results = get_object_vars($data_results[0]); 

            $data_chars = DB::table('results')->where('user_id', auth()->user()->id)
                            ->where('mode', 'file')
                            ->select(DB::raw('sum(characters) as total'))
                            ->get();
            $data_chars = get_object_vars($data_chars[0]); 

        } else {
            $data_results = DB::table('results')->where('project', $request->project)->where('user_id', auth()->user()->id)
                        ->where('mode', 'file')
                        ->select(DB::raw('count(id) as total'))
                        ->get();
            $data_results = get_object_vars($data_results[0]); 

            $data_chars = DB::table('results')->where('project', $request->project)->where('user_id', auth()->user()->id)
                            ->where('mode', 'file')
                            ->select(DB::raw('sum(characters) as total'))
                            ->get();
            $data_chars = get_object_vars($data_chars[0]); 
        }

        


        if ($request->ajax()) {
            $data['results'] = $data_results;
            $data['chars'] = $data_chars;
            return $data;
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'new-project' => 'required'
        ]);

        if (strtolower(request('new-project') == 'all')) {
            return redirect()->back()->with('error', 'Project Name is reserved and is already created, please create another one');
        }

        $check = Project::where('user_id', auth()->user()->id)->where('name', request('new-project'))->first();

        if (!isset($check)) {
            $project = new Project([
                'user_id' => auth()->user()->id,
                'name' => request('new-project')
            ]);
    
            $project->save();
            
            return redirect()->back()->with('success', 'Project has been successfully created');
        
        } else {
            return redirect()->back()->with('error', 'Project name already exists');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        request()->validate([
            'project' => 'required'
        ]);

        $check = Project::where('user_id', auth()->user()->id)->where('name', request('project'))->first();

        if (isset($check)) {
            $user = User::where('id', auth()->user()->id)->first();
            $user->project = request('project');
            $user->save();    

            return redirect()->back()->with('success', 'Default Project has been successfully updated');
        
        } else {
            return redirect()->back()->with('error', 'Default Project has not been updated. Please try again.');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        request()->validate([
            'project' => 'required'
        ]);

        $project = Project::where('user_id', auth()->user()->id)->where('name', request('project'))->first();
        

        if (isset($project)) {

            $project->delete();

            $user = User::where('id', auth()->user()->id)->first();
            $user->project = ($user->project == request('project'))? '' : $user->project;
            $user->save();    

            return redirect()->back()->with('success', 'Selected Project was deleted successfully.');
        
        } else {
            return redirect()->back()->with('error', 'Selected Project was not deleted properly. Please try again.');
        }
    }


    public function settings(Request $request)
    {
        if ($request->ajax()) {
            $data['size'] = config('tts.background_audio_size');
            return $data;
        }
    }

    
    public function upload(Request $request)
    {
        $status = false;

        if (request()->hasFile('audiofile')) {
                
            $file = request()->file('audiofile');
            $extension = $file->getClientOriginalExtension();
            $name = $file->getClientOriginalName();
            $size = $file->getSize();

            $audio_length = (request('audiolength') / 60);    
            $audio_length = number_format((float)$audio_length, 3, '.', ''); 

            $folder = '/uploads/music/';
            $file_name = Str::random(10) . '.' . $extension;
            $url = $folder . $file_name;

            $file->storeAs($folder, $file_name, 'public');

            $result = new Music([
                'user_id' => Auth::user()->id,
                'url' => $url,
                'type' => $extension,
                'size' => $size,
                'duration' => $audio_length,
                'name' => $name,
            ]); 

            $result->save();

            $status = true;
        }

        if ($request->ajax()) {
            $data = ($status) ? true : false;
            return $data;
        }
    }


    public function list(Request $request) 
    {
        # Today's TTS Results for Datatable
        if ($request->ajax()) {
            $data = Music::where('user_id', Auth::user()->id)->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('actions', function($row){
                        $actionBtn = '<div class="dropdown">
                                            <button class="btn table-actions" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-ellipsis-v"></i>                       
                                            </button>
                                            <div class="dropdown-menu table-actions-dropdown" role="menu" aria-labelledby="actions">
                                                <a class="dropdown-item" data-toggle="modal" id="deleteMusicButton" data-target="#deleteMusicModal" href="'. route("user.music.delete", $row["id"] ). '"><i class="fa fa-trash"></i> Delete</a>
                                            </div>
                                        </div>';
                        return $actionBtn;
                    })
                    ->addColumn('created-on', function($row){
                        $created_on = '<span>'.date_format($row["created_at"], 'Y-m-d H:i:s').'</span>';
                        return $created_on;
                    })
                    ->addColumn('custom-size', function($row){
                        $size = $this->formatBytes((int)$row['size']);
                        return $size;
                    })
                    ->addColumn('download', function($row){
                        $url = URL::asset($row['url']);
                        $result = '<a class="" href="' . $url . '" download><i class="fa fa-cloud-download result-download fs-20"></i></a>';
                        return $result;
                    })
                    ->addColumn('play', function($row){
                        $type = ($row['type'] == 'mp3') ? 'audio/mpeg' : 'audio/ogg';
                        $url = URL::asset($row['url']);
                        $result = '<button type="button" class="result-play" onclick="resultPlay(this)" src="' . $url . '" type="'. $type.'" id="'. $row['id'] .'"><i class="fa fa-play"></i></button>';
                        return $result;
                    })
                    ->rawColumns(['actions', 'created-on', 'download', 'play', 'custom-size'])
                    ->make(true);
                    
        }


        return view('user.projects.list');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function musicDestroy($id)
    {
        $result = Music::where('id', $id)->firstOrFail();  

        if ($result->user_id == Auth::user()->id){

            Storage::disk('public')->delete($result->url);

            $result->delete();

            return redirect()->route('user.music.list')->with('success', 'Selected background audio file was deleted successfully');
        
        } else{
            return redirect()->route('user.music.list');
        }               
    }


    public function musicDelete($id)
    {   
        $result = Music::where('id', $id)->firstOrFail();

        if ($result->user_id == Auth::user()->id){

            return view('user.projects.delete-music', compact('result'));     

        } else{
            return redirect()->route('user.music.list');
        }    
    }


    private function formatBytes($bytes, $precision = 2) { 
        $units = array('B', 'KB', 'MB', 'GB', 'TB'); 
    
        $bytes = max($bytes, 0); 
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
        $pow = min($pow, count($units) - 1); 
        
        $bytes /= pow(1024, $pow);

        return round($bytes, $precision) . ' ' . $units[$pow]; 
    }
}
