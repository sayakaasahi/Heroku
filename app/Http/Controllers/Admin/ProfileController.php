<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Profiles;

class ProfileController extends Controller
{
  
  public function add()
    {
      return view('admin.profile.create');
    }
    
  public function create(Request $request)
    {
      $this->validate($request, Profiles::$rules);
      $profiles = new Profiles;
      $form = $request->all();
      $profiles->fill($form);
      $profiles->save();
      
      return redirect('admin/profile/create');
    }
    
  public function index(Request $request)
  {
    $cond_title=$request->cond_title;
    if($cond_title !='') {
      $posts=Profiles::where('title',$cond_title)->get();
    }else{
      $posts=Profiles::all();
    }
    return view('admin.profile.index',['posts'=>$posts,'cond_title'=>$cond_title]);
  }
  
  public function edit()
    {
      return view('admin.profile.edit');
    }
    
  public function update(Request $request)
    {
      $this->validate($request, Profiles::$rules);
      $profiles=Profiles::find($request->id);
      $profiles_form = $request->all();
      unset($profiles_form['_token']);
      $profiles->fill($profiles_form)->save();
      return redirect('admin/profile');
    }
    
  public function delete(Request $request)
  {
   $profiles=Profiles::find($request->id);
   $profiles->delete();
   return redirect('admin/profiles/');
  }
}
