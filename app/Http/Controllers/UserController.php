<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Hash;
use App\User;
use App\Loan;
use App\Like;

class UserController extends Controller
{
    //お気に入りユーザーリストページ
    public function index()
    {
        $likes = Like::where('liking_id', Auth::id())
            ->latest()
            ->paginate(5);
        return view('', compact('likes'));
    }

    //お気に入りユーザー登録機能
    public function like(int $user)
    {
        Like::insert([
            'liking_id' => Auth::id(),
            'liked_id' => $user
        ]);
        return back();
    }

    //お気に入りユーザー解除機能
    public function unlike(int $user)
    {
        Like::where([
            'liking_id' => Auth::id(),
            'liked_id' => $user
        ])
            ->delete();
        return back();
    }

    //ユーザー検索ページ・機能
    public function search(Request $request) //product 参照
    {
        $users = User::where('name', 'LIKE', '%' . $request->keyword . '%')
            ->paginate(5);
        return view('search', compact('users'));
    }

    //他者プロフィールページ
    public function show(int $user, $tab = null)
    {
        $user = User::find($user);
        if ($tab == 1) { //借リストを表示
            $loans = Loan::where([
                ['lending_id', $user->id()],
                ['borrowed_id', Auth::id()],
                ['repaid_on', null]
            ])
                ->paginate(5);
            return view('user.show.Borrowed', compact('user', 'loans'));
        } else { //1以外なら貸リストを表示
            $loans = Loan::where([
                ['lending_id', Auth::id()],
                ['borrowed_id', $user->id()],
                ['repaid_on', null]
            ])
                ->paginate(5);
            return view('user.show.Lending', compact('user', 'loans'));
        }
    }

    //他者プロフィールページ/返済済み
    public function repaid(int $user, $tab = null)
    {
        $user = User::find($user);
        if ($tab == 1) { //借リストを表示
            $loans = Loan::where([
                ['lending_id', $user->id()],
                ['borrowed_id', Auth::id()],
                ['repaid_on', '!=', null]
            ])
                ->paginate(5);
            return view('user.repaid.Borrowed', compact('user', 'loans'));
        } else { //1以外なら貸リストを表示
            $loans = Loan::where([
                ['lending_id', Auth::id()],
                ['borrowed_id', $user->id()],
                ['repaid_on', '!=', null]
            ])
                ->paginate(5);
            return view('user.repaid.Lending', compact('user', 'loans'));
        }
    }

    //マイプロフィールページ
    public function myProfile()
    {
        $user = Auth::user();
        return view('user.myProfile', compact('user'));
    }

    //ユーザー名変更ページ
    public function nameEdit()
    {
        return view('user.nameEdit');
    }

    //ユーザー名変更機能
    public function nameUpdate(UserRequest $request)
    {
        User::where('id', Auth::id())
            ->update(['name' => $request->name]);
        return redirect()->route('my-profile')
            ->with('flash_message', '編集が完了しました');
    }

    //メールアドレス変更ページ
    public function mailEdit()
    {
        return view('user.mailEdit');
    }

    //メールアドレス変更機能
    public function mailUpdate(UserRequest $request)
    {
        User::where('id', Auth::id())
            ->update(['email' => $request->email]);
        return redirect()->route('my-profile')
        ->with('flash_message', '編集が完了しました');
    }

    //パスワード変更ページ
    public function passwordEdit()
    {
        return view('user.passwordEdit');
    }

    //パスワード変更機能
    public function passwordUpdate(UserRequest $request)
    {
        User::where('id', Auth::id())
            ->update(['password' => Hash::make($request->password)]);
        return redirect()->route('my-profile')
        ->with('flash_message', '編集が完了しました');
    }

    //プロフィール画像変更ページ
    public function imageEdit()
    {
        return view('user.nameEdit');
    }

    //プロフィール画像変更機能
    public function imageUpdate(UserRequest $request,)
    {
        Storage::delete('public/slide/' . Auth::image());
        User::where('id', Auth::id())
            ->update(['image' => $request->image]);
        return redirect()->route('my-profile')
        ->with('flash_message', '編集が完了しました');
    }
}
