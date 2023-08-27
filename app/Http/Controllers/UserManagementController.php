<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Department;
use App\Models\Position;
use App\Models\Country;
use App\Models\StatusType;
use App\Models\State;
use DB;
use Brian2694\Toastr\Facades\Toastr;
use App\DataTables\UsersDataTable;
use DataTables;
use Hash;
use URL;
use Carbon\Carbon;

class UserManagementController extends Controller
{
    // index page
    public function index(UsersDataTable $dataTable)
    {
        // $users = User::with(['statustype'])->get();
        // dd($users);
        $defaultSelection = [''=>'Please Select'];
        $department = $defaultSelection + Department::pluck('name', 'id')->toArray();
        $position = $defaultSelection + Position::pluck('name', 'id')->toArray();
        $country = $defaultSelection + Country::pluck('name', 'id')->toArray();
        $status = $defaultSelection + StatusType::pluck('type_name', 'id')->toArray();
        $user_table = User::all();
        return view ('usermanagement.usertable',compact('user_table','status','department','position','country'));
    }

    public function list(Request $request){
        // dd($request->position_id);
        if ($request->ajax()) {
            $data = User::with(['department','position','country','state','statustype']);
            if ($request->position_id) {
                $data = $data->whereHas('position', function ($q) use ($request) {
                    $q->where('position.id', $request->position_id);
                });
            }
            if ($request->department_id) {
                $data = $data->whereHas('department', function ($q) use ($request) {
                    $q->where('department.id', $request->department_id);
                });
            }
            $data = $data->where('deleted_at', 'N')
            ->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function($row){
                    $url= URL::to('images/'.$row->avatar);

                    return '<a class="lightbox" href="#dog'.$row->id.'">
                    <img width="35" class="rounded-circle" src="'.$url.'">
                    </a>
                    <div class="lightbox-target" id="dog'.$row->id.'">
                    <img src="'.$url.'" />
                    <a class="lightbox-close" href="#"></a>
                    </div>';

                })
                ->addColumn('department', function($row){
                    return $row->department->name;
                })
                ->addColumn('position', function($row){
                    return $row->position->name;
                })
                ->addColumn('country', function($row){
                    return $row->country->name;
                })
                ->addColumn('state', function($row){
                    return $row->state->name;
                })
                ->addColumn('status_name', function($row){
                    $actionBtn='<a href="#" data-id="'.$row->id.'" class="changestatus"><span class="badge light badge-info">
                    <i class="fa fa-circle text-denger me-1"></i>'.$row->statustype->type_name.'</span></a>';
                      if($row->user_type_id!=2){
                        $actionBtn='<a href="#" data-id="'.$row->id.'" class="changestatus"><span class="badge light badge-success">
                        <i class="fa fa-circle text-success me-1"></i>'.$row->statusType->type_name.'</span></a>';
                      }
                    return $actionBtn;
                })
                ->addColumn('action', function($row){
                    $actionBtn = '<a class="btn btn-primary shadow btn-xs sharp me-1 viewUser" href="#" data-toggle="modal" data-target="#view_user" data-id="'.$row->id.'"><i class="fas fa-eye"></i></a><a class="btn btn-primary shadow btn-xs sharp me-1 editUser" href="#" data-toggle="modal" data-id="'.$row->id.'"><i class="fas fa-pencil-alt"></i></a><a class="btn btn-danger shadow btn-xs sharp delete_user" href="#" data-toggle="modal" data-target="#delete_user" data-id="'.$row->id.'"><i class="fa fa-trash"></i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['name','department','position','country','state','status_name', 'action'])
                ->make();
        }

     }

     public function fetchState(Request $request)
    {
        $data['states'] = State::where("country_id",$request->country_id)->get(["name", "id"]);
        return response()->json($data);
    }

     public function storeUser(Request $request)
     {

        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255',
            'phone_number' => 'required',
            'department_id' => 'required',
            'position_id' => 'required',
            'user_type_id' => 'required',
            'country_id' => 'required',
            'state_id' => 'required',
            'upload' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        // dd($request->all());
         $message = "";

         if($request->e_user_id!=""){
            $userData = User::find($request->e_user_id);
            $userData->updated_at = new Carbon();
            $message = "Updated user successfully";
        }else{
            $userData = new User();
            $userData->created_at = new Carbon();
            $message = "Create new user successfully";
        }
        $userData->name = $request->name;
        $userData->email = $request->email;
        $userData->password = Hash::make(123456);
        $userData->phone_number = $request->phone_number;
        $userData->department_id = $request->department_id;
        $userData->position_id = $request->position_id;
        $userData->user_type_id = $request->user_type_id;
        $userData->country_id = $request->country_id;
        $userData->state_id = $request->state_id;
        if ($request->hasFile('upload')) {
            $imageName = time().'.'.$request->upload->extension();
            $request->upload->move(public_path('images'), $imageName);
            $userData->avatar = $imageName;
        }
        $userData->save();


        Toastr::success($message ,'Success');
        return redirect('user/list');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

    public function view($id)
    {
        $user = User::with(['department','position','country','state','statustype'])
        // ->whereHas('books', function (Builder $query) {
        //     $query->where('title', 'like', 'PHP%');
        // })
        ->where('id', $id)
        ->first();
        return response()->json($user);
    }

    public function changeStatus($id){
        $userData = User::find($id);
        if($userData->user_type_id==1){
            $userData->user_type_id==2;
        }else if($userData->user_type_id==2){
            $userData->user_type_id==1;
        }
        $userData->save();
        Toastr::success("Status changed" ,'Success');
        return redirect('user/list');

    }
    /** delete record */
    public function deleteRecord(Request $request)
    {
        try {
            // User::destroy($request->id);
            User::where("id", $request->id)->update(['deleted_at'=>'Y']);
            Toastr::success('User deleted successfully :)','Success');
            return redirect()->back();

        } catch(\Exception $e) {

            DB::rollback();
            Toastr::error('User delete fail :)','Error');
            return redirect()->back();
        }
    }


}
