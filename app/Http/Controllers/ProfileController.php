<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\User;

class ProfileController extends Controller
{
    const LOCAL_STORAGE_FOLDER = 'public/avatars/';
    private $user;

    public function __construct(User $user){
        $this->user = $user;
    }

    public function show($id){
        $user = $this->user->findOrFail($id);
        return view('users.profile.show')->with('user', $user);
    }

    public function edit(){
        $user = $this->user->findOrFail(Auth::user()->id);
        return view('users.profile.edit')->with('user', $user);
    }

    public function update(Request $request){
        // unique:table_name,column_name,PK_value

        // 1. Add the error directives on the Edit Profile view
        // 2. update(). Update the name, email, and introduction.
        // 3. Check if the user uploaded an avatar. If yes, go to next step.
        // 4. Delete the old avatar from local storage.
        // 5. Save the new avatar in the local storage.
        // 6. Save.
        // 7. Redirect to profile.show

        $request->validate([
            'name'         => 'required|min:1|max:50',
            'email'        => 'required|email|max:50|unique:users,email,' . Auth::user()->id,
            'avatar'       => 'mimes:jpg,png,jpeg,gif|max:1048',
            'introduction' => 'max:100'          
        ]);
        
        // 2. update(). Update the name, email, and introduction.
        $user                = $this->user->findOrFail(Auth::user()->id);
        $user->name          = $request->name;
        $user->email         = $request->email;
        $user->introduction  = $request->introduction;        

        // 3. Check if the user uploaded an avatar. If yes, go to next step.
        if ($request->avatar){
            #Delete the previous avatar from the local storage
            $this->deleteAvatar($user->avatar);

            #Move the new image to the local to storage
            $user->avatar = $this->saveAvatar($request);
        }
        
        $user->save();
        return redirect()->route('profile.show', Auth::user()->id);
    }

    private function saveAvatar($request){
        # Rename the image to the CURRENT TIME to avoid overwriting
        $avatar_name = time() . ".".$request->avatar->extension();
        // $avatar_name = 1672846189.jpg;

        #Save the image inside storage/app/public/avatars/
        $request->avatar->storeAs(self::LOCAL_STORAGE_FOLDER, $avatar_name);

        return $avatar_name;
    }

    // 4. Delete the old avatar from local storage.
    private function deleteAvatar($avatar_name){
        $avatar_path = self::LOCAL_STORAGE_FOLDER . $avatar_name;

        // If the image is existing, delete.
        if (Storage::disk('local')->exists($avatar_path)){
            Storage::disk('local')->delete($avatar_path);
        }
    }

    public function followers($id){
        $user = $this->user->findOrFail($id);
        return view('users.profile.followers')->with('user',$user);
    }
   
    public function following($id){
        $user = $this->user->findOrFail($id);
        return view('users.profile.following')->with('user',$user);
    }
}
