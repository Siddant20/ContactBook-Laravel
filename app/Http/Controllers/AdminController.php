<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       $sort=$request->get('sort','name');
       $direction=$request->get('direction','asc');
       $admins=User::role('admin')->orderBy($sort,$direction)->get();
       $nonAdmins=User::role('user')->orderBy($sort,$direction)->get();

       return view('admin.index',compact('admins','nonAdmins'));
 
    }

    public function show(User $user)
    {
        $contacts=$user->contacts()->paginate(10);
        return view('admin.user_contacts', compact('user','contacts'));

    }
  
    public function makeAdmin(User $user)
    {
        $user->assignRole('admin');
        $user->removeRole('user');
        return redirect()->route('admin.index')->with('success',"{$user->name} is now an admin");

    }
    public function removeAdmin(User $user)
    {   
        //avoid removing own admin role
        if (auth()->id() === $user->id){
            return redirect()->route('admin.index')->with('error',"you can't remove yourself from admin!");
        }

          // Count total number of admins
    $adminCount = User::role('admin')->count();


    // If this is the last admin, prevent removal
         if ($adminCount <= 1 && $user->hasRole('admin')) {
        return redirect()->route('admin.index')->with('error', "{$user->name} is the last admin and cannot be removed!");
    }
        $user->removeRole('admin');
        $user->assignRole('user');
        return redirect()->route('admin.index')->with('success',"{$user->name} is now a user");
    }

}
