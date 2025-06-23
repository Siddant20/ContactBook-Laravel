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
       $searchAdmin=$request->get('searchAdmin');
       $searchUser=$request->get('searchUser');

       $admins=User::role('admin')
       ->when($searchAdmin, function($query, $searchAdmin){
        $query->where(function($q) use ($searchAdmin)
        {           
            $q->where('name','like',"%{$searchAdmin}%")
            ->orWhere('email','like',"%{$searchAdmin}%");
        }
        );
       })
       
       
       ->orderBy($sort,$direction)->paginate(5);
       
       $nonAdmins=User::role('user')
       ->when($searchUser, function($query, $searchUser){
        $query->where(function($q) use ($searchUser)
        {   
            $q->where('name','like',"%$searchUser%")
              ->orWhere('email','like',"%$searchUser%");
        });
       })
       
       ->orderBy($sort,$direction)->paginate(5);

       return view('admin.index',compact('admins','nonAdmins', 'searchAdmin', 'searchUser'));
 
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
