<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Settings;
use App\Http\Controllers\Controller;
use App\Models\Setting;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use Intervention\Image\Facades\Image;

class SettingController extends Controller
{
    /**
     * @param $name
     * @return mixed
     */
    public function get_setting($name)
    {
        $get_settings = Setting::get();
        return $get_settings->whereIn('name', $name)->first()->value;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function setting()
    {
        $this->authorize('read-settings');
        $arraySettings = [
            'company_name' => $this->get_setting('company_name'),
            'sitename' => $this->get_setting('sitename'),
            'siteurl' => $this->get_setting('siteurl'),
            'siteemail' => $this->get_setting('siteemail'),
            'sitephone' => $this->get_setting('sitephone'),
            'street' => $this->get_setting('street'),
            'city' => $this->get_setting('city'),
            'postal_code' => $this->get_setting('postal_code'),
            'state' => $this->get_setting('state'),
            'country' => $this->get_setting('country'),
            'fulladdress' => $this->get_setting('fulladdress'),
            'sitedescription' => $this->get_setting('sitedescription'),
            'contactdescription' => $this->get_setting('contactdescription'),
            'metakeyword' => $this->get_setting('metakeyword'),
            'maintenance' => $this->get_setting('maintenance'),
            'register' => $this->get_setting('register'),
            'favicon' => $this->get_setting('favicon'),
            'logowebsite' => $this->get_setting('logowebsite'),
            'logowebsite_footer' => $this->get_setting('logowebsite_footer'),
            'ogimage' => $this->get_setting('ogimage'),
            'facebook' => $this->get_setting('facebook'),
            'twitter' => $this->get_setting('twitter'),
            'youtube' => $this->get_setting('youtube'),
            'instagram' => $this->get_setting('instagram'),
            'linkedin' => $this->get_setting('linkedin'),
            'telegram' => $this->get_setting('telegram'),
            'whatsapp' => $this->get_setting('whatsapp'),
            'googleanalyticsid' => $this->get_setting('googleanalyticsid'),
            'googlemapcode' => $this->get_setting('googlemapcode'),
            'publisherid' => $this->get_setting('publisherid'),
            'disqusshortname' => $this->get_setting('disqusshortname'),
            'mailchimp' => $this->get_setting('mailchimp'),
            'permalink_type' => $this->get_setting('permalink_type'),
            'permalink' => $this->get_setting('permalink'),
            'newsletter_status' => $this->get_setting('newsletter_status')
        ];

        $dir = Settings::get('current_theme_dir');
        $credit_footer = File::get(resource_path('views/frontend/'.$dir.'/inc/_credit-footer.blade.php'));

        $settings = (object) $arraySettings;

        $check = $settings->maintenance === 'y' ? 'checked' : '';
        $register = $settings->register === 'y' ? 'checked' : '';

        return view('admin.setting.index', compact('settings', 'check', 'register', 'credit_footer'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function updateSettings(Request $request)
    {
        $this->authorize('update-settings');
        if($request->name == "") {
            return response()->json(['failed' => 'Field cannot be empty!']);
        } else {
            Setting::where('name', $request->name)
                ->update(['value' => $request->value]);
            return response()->json(['success' => 'Saving']);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function changeMaintenance(Request $request)
    {
        $this->authorize('update-settings');
        Setting::where('name', 'maintenance')
        ->update(['value' => $request->active]);
        if($request->active === 'y') {
            $msg = 'Mode Maintenance Enabled!';
        } else {
            $msg = 'Mode Maintenance Disabled!';
        }

        return response()->json(['success' => $msg]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function changeRegisterMember(Request $request)
    {
        $this->authorize('update-settings');
        if(!Auth::User()->hasRole(['superadmin', 'admin'])) {
            return response()->json(['abort' => 'Unauthorized action!']);
        }
        Setting::where('name', 'register')
        ->update(['value' => $request->active]);
        if($request->active === 'y') {
            $msg = 'Register Member Enabled!';
        } else {
            $msg = 'Register Member Disabled!';
        }
        Setting::where('name', 'register')
        ->update(['value' => $request->active]);
        if($request->active === 'y') {
            $msg = 'Register Member Enabled!';
        } else {
            $msg = 'Register Member Disabled!';
        }

        return response()->json(['success' => $msg]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function settingUpdate(Request $request)
    {
        $this->authorize('update-settings');
        $validator = Validator::make($request->all(), [
            'company_name' => Rule::requiredIf(request()->has('web_information')),
            'sitename' => Rule::requiredIf(request()->has('web_information')),
            'siteurl' => Rule::requiredIf(request()->has('web_information')),
            'favicon' => 'dimensions:max_width=256,max_height=256|mimes:jpeg,png,ico',
            'logowebsite' => 'dimensions:max_width=800,max_height=800|image|mimes:jpeg,png',
            'ogimage' => 'dimensions:max_width=1484,max_height=1200|image|mimes:jpeg,png'
        ]);

        if (request()->has('site_logo')) {
            if ($validator->fails()) {
                return redirect()->route('settings.index')->with('error', $validator->errors()->first());
            }
        } else {
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()->all()]);
            }
        }

        if (request()->has('web_information')) {

            if ($request->credit_footer) {
                $dir = Settings::get('current_theme_dir');
                File::put(resource_path('views/frontend/'.$dir.'/inc/_credit-footer.blade.php'), $request->credit_footer);
            }

            $arrayValues = [
                ['name' => 'company_name', 'value' => $request->company_name],
                ['name' => 'sitename', 'value' => $request->sitename],
                ['name' => 'siteurl', 'value' => $request->siteurl],
                ['name' => 'sitedescription', 'value' => $request->sitedescription],
                ['name' => 'metakeyword', 'value' => $request->metakeyword],
            ];
            foreach ($arrayValues as $value) {
                Setting::where('name', $value['name'])->update(['value' => $value['value']]);
            }
            return response()->json(['success' => 'Saving successfully!']);
        }

        if (request()->has('web_contact')) {
            $arrayValues = [
                ['name' => 'street', 'value' => $request->street],
                ['name' => 'city', 'value' => $request->city],
                ['name' => 'postal_code', 'value' => $request->postal_code],
                ['name' => 'state', 'value' => $request->state],
                ['name' => 'country', 'value' => $request->country],
                ['name' => 'sitephone', 'value' => $request->sitephone],
                ['name' => 'fulladdress', 'value' => $request->fulladdress],
                ['name' => 'siteemail', 'value' => $request->siteemail],
                ['name' => 'contactdescription', 'value' => $request->contactdescription],
                ['name' => 'facebook', 'value' => $request->facebook],
                ['name' => 'twitter', 'value' => $request->twitter],
                ['name' => 'linkedin', 'value' => $request->linkedin],
                ['name' => 'youtube', 'value' => $request->youtube],
                ['name' => 'instagram', 'value' => $request->instagram],
            ];
            foreach ($arrayValues as $value) {
                Setting::where('name', $value['name'])->update(['value' => $value['value']]);
            }
            return response()->json(['success' => 'Saving successfully!']);
        }

        if (request()->has('site_logo')) {

            if ($request->hasFile('favicon')) {
                $getFileName = pathinfo($request->favicon->getClientOriginalName(), PATHINFO_FILENAME);
                $getFileExtension = pathinfo($request->favicon->getClientOriginalExtension(), PATHINFO_FILENAME);

                $fileName = $getFileName . '-' . \Str::random(10) . '.' . $getFileExtension;
                $img = Image::make($request->favicon);
                $resizeImage = $img->resize(32, 32);
                $img->insert($resizeImage, 'center');

                if (!File::exists(storage_path('app/public/icon'))) {
                    File::makeDirectory(storage_path('app/public/icon'));
                }

                $img->save(storage_path('app/public/icon') . '/' . $fileName);
                Setting::where('name', 'favicon')->update(['value' => $fileName]);
            }

            if ($request->hasFile('logowebsite')) {
                $filename = $request->logowebsite->getClientOriginalName();
                if (!File::exists(storage_path('app/public/logo'))) {
                    File::makeDirectory(storage_path('app/public/logo'));
                }
                $request->logowebsite->storeAs('logo', $filename, 'public');
                Setting::where('name', 'logowebsite')->update(['value' => $filename]);
            }

            if ($request->hasFile('logowebsite_footer')) {
                $filename = $request->logowebsite_footer->getClientOriginalName();
                if (!File::exists(storage_path('app/public/logo'))) {
                    File::makeDirectory(storage_path('app/public/logo'));
                }
                $request->logowebsite_footer->storeAs('logo', $filename, 'public');
                Setting::where('name', 'logowebsite_footer')->update(['value' => $filename]);
            }

            if ($request->hasFile('ogimage')) {
                $filename = $request->ogimage->getClientOriginalName();
                if (!File::exists(storage_path('app/public/images'))) {
                    File::makeDirectory(storage_path('app/public/images'));
                }
                $request->ogimage->storeAs('images', $filename, 'public');
                Setting::where('name', 'ogimage')->update(['value' => $filename]);
            }

            return redirect()->route('settings.index')->withSuccess('Saving successfully!');
        }

        if (request()->has('web_config')) {
            $arrayValues = [
                ['name' => 'googleanalyticsid', 'value' => $request->googleanalyticsid],
                ['name' => 'googlemapcode', 'value' => $request->googlemapcode],
                ['name' => 'publisherid', 'value' => $request->publisherid],
                ['name' => 'disqusshortname', 'value' => $request->disqusshortname],
            ];
            foreach ($arrayValues as $value) {
                Setting::where('name', $value['name'])->update(['value' => $value['value']]);
            }
            return response()->json(['success' => 'Saving successfully!']);
        }

        if (request()->has('web_permalinks')) {
            if($request->permalink == 'custom'){
                $permalink = $request->custom_input;
                $permalink_type = $request->permalink;
                $permalink_old_custom = $request->custom_input;
            }else{
                $permalink = $request->permalink;
                $permalink_type = $request->permalink;
                $permalink_old_custom = Settings::get('permalink_old_custom');
            }
            $arrayValues = [
                ['name' => 'permalink_type', 'value' => $permalink_type ],
                ['name' => 'permalink', 'value' => $permalink],
                ['name' => 'permalink_old_custom', 'value' => $permalink_old_custom],
            ];
            foreach ($arrayValues as $value) {
                Setting::where('name', $value['name'])->update(['value' => $value['value']]);
            }
            return response()->json(['success' => 'Saving successfully!']);
        }

        if (request()->has('newsletters')) {
            $arrayValues = [
                ['name' => 'newsletter_status', 'value' => $request->newsletter_status],
            ];
            foreach ($arrayValues as $value) {
                Setting::where('name', $value['name'])->update(['value' => $value['value']]);
            }
            return response()->json(['success' => 'Saving successfully!']);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize('read-settings');
        return view('admin.setting.index');
    }

}
