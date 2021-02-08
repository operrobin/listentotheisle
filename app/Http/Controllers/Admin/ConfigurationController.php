<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\EnvironmentMode;

use DB;

class ConfigurationController extends Controller
{
    /**
     * Configuration Index
     */
    public function index(){
        return view('admin/configuration/index', [
            "environment_mode" => EnvironmentMode::all(),
            "environment_mode_value" => EnvironmentMode
                                            ::where('status', 1)->get()->first()
        ]);
    }

    /**
     * Update Environment Mode
     */
    public function toggleEnvironmentMode(Request $request){
        $v = validator()->make($request->all(), [
            "state-name" => "required|exists:environment_mode,state_name"
        ]);

        if($v->fails()){
            Session::flash('error', 'You haven\'t choose the state name. Please check your request.');
            return back();
        }

        /**
         * Updating all EnvironmentMode to 0
         */
        DB::table('environment_mode')
            ->update([
                "status" => 0,
                "updated_at" => new \DateTime("now")
            ]);

        /**
         * Updating selected environment to 1.
         */
        EnvironmentMode
            ::where('state_name', $request->get('state-name'))
            ->update([
                "status" => 1,
                "last_trigger" => date('Y-m-d H:i:s', strtotime('now')),
                "updated_at" => new \DateTime("now")
            ]);

        return back();
    }
}
