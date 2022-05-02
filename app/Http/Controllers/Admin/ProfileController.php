<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// 以下を追記することでProfile Modelが扱えるようになる
use App\Profile;

class ProfileController extends Controller
{
  //
  public function add()
    {
        return view('admin.profile.create');
    }
    
    public function edit()
    {
        return view('admin.profile.edit');
    }

    public function update(Request $request)
    {
        // admin/profile/createにリダイレクトする
        return redirect('admin/profile/edit');
    }
    
        // 以下を追記
    public function create(Request $request)
    {
      // Varidationを行う
      $this->validate($request, Profile::$rules);
      
      $profile = new Profile;
      $form = $request->all();
      

      
      // フォームから送信されてきた_tokenを削除する
      unset($form['_token']);
      // フォームから送信されてきたimageを削除する
      unset($form['image']);
      
      // データベースに保存する
      $profile->fill($form);
      $profile->save();
      
      // admin/news/createにリダイレクトする
      return redirect('admin/profile/create');
    }  
}
