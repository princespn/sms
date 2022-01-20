<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Setting;

class FrontendController extends Controller
{
    /**
     * Show appearance settings page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files_rows = ['css', 'js'];
        $files = [];
        $settings = Setting::all();

        foreach ($settings as $row) {
            if (in_array($row['name'], $files_rows)) {
                $files[$row['name']] = $row['value'];
            }
        }

        return view('admin.settings.frontend.index', compact('files'));
    }


    /**
     * Store appearance inputs properly in database and local storage
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'enable-redirection' => 'sometimes|required',
            'url' => 'required_if:enable-listen,on',
        ]);

        $this->storeSettings('FRONTEND_MAINTENANCE_MODE', request('maintenance'));
        $this->storeSettings('FRONTEND_FRONTEND_PAGE', request('frontend'));
        $this->storeSettings('FRONTEND_ABOUT_PAGE', request('about'));
        $this->storeSettings('FRONTEND_VOICES_PAGE', request('voices'));
        $this->storeSettings('FRONTEND_BLOG_PAGE', request('blog'));
        $this->storeSettings('FRONTEND_FAQ_PAGE', request('faq'));
        $this->storeSettings('FRONTEND_PRICING_PAGE', request('pricing'));
        $this->storeSettings('FRONTEND_CONTACT_PAGE', request('contact'));

        $this->storeSettings('FRONTEND_CUSTOM_URL_STATUS', request('enable-redirection'));
        $this->storeSettings('FRONTEND_CUSTOM_URL_LINK', request('url'));

        $this->storeSettings('FRONTEND_SOCIAL_TWITTER', request('twitter'));
        $this->storeSettings('FRONTEND_SOCIAL_FACEBOOK', request('facebook'));
        $this->storeSettings('FRONTEND_SOCIAL_LINKEDIN', request('linkedin'));
        $this->storeSettings('FRONTEND_SOCIAL_INSTAGRAM', request('instagram'));
        $this->storeSettings('FRONTEND_SOCIAL_GOOGLE', request('google'));
        $this->storeSettings('FRONTEND_SOCIAL_YOUTUBE', request('youtube'));
        $this->storeSettings('FRONTEND_SOCIAL_VIMEO', request('vimeo'));
        $this->storeSettings('FRONTEND_SOCIAL_FLICKR', request('flickr'));

        $rows = ['css', 'js'];        
        foreach ($rows as $row) {
            Setting::where('name', $row)->update(['value' => $request->input($row)]);
        }

        return redirect()->back()->with('success', 'Frontend settings successfully saved');
    }


    /**
     * Record in .env file
     */
    private function storeSettings($key, $value)
    {
        $path = base_path('.env');

        if (file_exists($path)) {

            file_put_contents($path, str_replace(
                $key . '=' . env($key), $key . '=' . $value, file_get_contents($path)
            ));

        }
    }
}
