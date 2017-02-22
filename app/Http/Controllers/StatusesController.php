<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Status;
use Auth;

class StatusesController extends Controller
{
    // 只允许登录用户操作
    public function __construct()
    {
        $this->middleware('auth', [
            'only' => ['store', 'destroy']
        ]);
    }

    // 创建微博
    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required|max:140'
        ]);

        Auth::user()->statuses()->create([
            'content' => $request->content
        ]);
        return redirect()->back();
    }

    // 删除微博
    public function destroy($id)
    {
        $status = Status::findOrFail($id);
        $this->authorize('destory', $status);
        $status->delete();
        session()->flash('success', '微博已成功删除！');
        return redirect()->back();
    }
}
