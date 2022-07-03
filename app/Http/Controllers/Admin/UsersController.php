<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class UsersController extends Controller
{
    private $user;

    public function __construct(User $user){
        $this->user = $user;
    }

    public function index(){
        $all_users = $this->user->withTrashed()->orderBy('deleted_at','asc')->paginate(10);
        return view('admin.users.index')->with('all_users', $all_users);
    }

    public function deactivate($id){
        $this->user->destroy($id);
        return redirect()->back();
    }

    public function activate($id){
        $this->user->onlyTrashed()->findOrFail($id)->restore();
        return redirect()->back();
        // onlyTrashed() - retrieves soft deleted models only.
        // restore() - "un-delete" a soft deleted modal. This will set
        // the "deleted_at" column to NULL.
    }
}
