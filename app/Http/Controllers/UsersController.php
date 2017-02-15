<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\User;

use Auth;

class UsersController extends Controller
{
    public function __construct()
    {
        //只允许游客访问
        $this->middleware('guest', [
            'only' => ['create']
        ]);

        //只允许用户访问
        $this->middleware('auth', [
            'only' => ['edit', 'update', 'destroy']
        ]);
    }

    //用户列表
    public function index()
    {
        $users = User::paginate(30);
        return view('users.index', compact('users'));
    }

    //个人中心
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    //注册页面
    public function create()
    {
        return view('users.create');
    }

    //注册提交逻辑
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        Auth::login($user);
        session()->flash('success', '欢迎，您将在这里开启一段新的旅程～');
        return redirect()->route('users.show', [$user]);
    }

    //编辑页面
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }

    //编辑提交逻辑
    public function update($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
            'password' => 'confirmed|min:6'
        ]);

        $user = User::findOrFail($id);
        $this->authorize('update', $user);

        $data = [];
        $data['name'] = $request->name;
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }
        $user->update($data);

        session()->flash('success', '个人资料更新成功！');
        return redirect()->route('users.show', $id);
    }

    //删除用户
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $this->authorize('destroy', $user);

        $user->delete();
        session()->flash('success', '成功删除用户！');
        return back();
    }
}
