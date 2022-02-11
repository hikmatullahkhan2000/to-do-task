<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Task;

class TaskController extends Controller
{
	public function index(Request $request){
		$tasks = Task::where("iscompleted", false)->orderBy("id", "DEC")->get();
		$completed_tasks = Task::where("iscompleted", true)->get();
       // India
        //1.187.255.255
        //pakistan
        //101.50.127.255

//        dd($this->getIp());
        $ipdat = @json_decode(file_get_contents(
            "http://www.geoplugin.net/json.gp?ip=" . $this->getIp()));

        $country =  $ipdat->geoplugin_countryName;
        $zone =  $ipdat->geoplugin_timezone;

        return view("list", compact("tasks", "completed_tasks",'country','zone'));
	}

    public function getIp(){
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
        }
        return request()->ip(); // it will return server ip when no client ip found
    }
    public function create(){
        return view("form");
    }
	public function store(Request $request)
	{
        $this->validate($request, [
            "task" => "required",
        ]);

		$task=Task::create($request->all());
		$task->save();
		return Redirect::back()->with("message", "Task has been added");
    }
	public function complete($id)
	{
		$task = Task::find($id);
		$task->iscompleted = true;
		$task->save();
		return Redirect::back()->with("message", "Task has been added to completed list");
	}
	public function destroy($id)
	{
		$task = Task::find($id);
		$task->delete();
		return Redirect::back()->with('message', "Task has been deleted");
	}
}
