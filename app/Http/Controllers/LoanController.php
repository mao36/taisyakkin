<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\LoanRequest;


class LoanController extends Controller
{
    //トップページ
    public function top()
    {
        $user = Auth::user();
        return view('top', compact('user'));
    }

    //タイシャクリストページ
    public function index($tab = null)
    {
        if ($tab == 1) { //借リストを表示
            $loans = Loan::where([
                ['lending_id', Auth::id()],
                ['repaid_on', null]
            ])
                ->paginate(5);
            return view('index.Borrowed', compact('loans'));
        } else { //1以外なら貸リストを表示
            $loans = Loan::where([
                ['borrowed_id', Auth::id()],
                ['repaid_on', null]
            ])
                ->paginate(5);
            return view('index.Lending', compact('loans'));
        }
    }

    //返済済みページ
    public function rapaid($tab = null)
    {
        if ($tab == 1) { //借リストを表示
            $loans = Loan::where([
                ['lending_id', 'lending_id'],
                ['repaid_on', '!=', null]
            ])
                ->paginate(5);
            return view('rapaid.Borrowed', compact('loans'));
        } else { //1以外なら貸リストを表示
            $loans = Loan::where([
                ['borrowed_id', Auth::id()],
                ['repaid_on', '!=', null]
            ])
                ->paginate(5);
            return view('rapaid.Lending', compact('loans'));
        }
    }

    //タイシャク登録画面
    public function create()
    {
        return view('loans.create');
    }
    //タイシャク相手選択画面
    public function user(Request $request)
    {
        $users = User::where('name', 'LIKE', '%' . $request->keyword . '%')
            ->paginate(5);
        return view('search', compact('users'));
    }

    //タイシャク相手選択機能
    public function select(int $user)
    {
        return view('loans.create', compact('$user'));
    }

    //タイシャク登録機能
    public function store(Loan $loan, LoanRequest $request)
    {
        $loan->fill($request->all())
            ->save();
        return redirect()->route('top')
            ->with('flash_message', 'タイシャク登録が完了しました');
    }
    //貸借編集ページ
    public function edit(Loan $loan)
    {
        return view('loans.edit', compact('loan'));
    }
    //貸借編集機能
    public function update(LoanRequest $request)
    {
        Loan::where('id', $request->id)
            ->fill($request->all())
            ->update(); //エラーになると思う
        return redirect()->route('top')
            ->with('flash_message', 'タイシャク編集が完了しました');
    }
    //タイシャク記録削除機能
    public function delete(Loan $loan)
    {
        $loan->delete();
        return redirect()->route('top')
            ->with('flash_message', 'タイシャク削除が完了しました');
    }
    //タイシャク返済登録機能
    public function repay(Loan $loan)
    {
        $loan->update(['repaid_on' => now()]);
        return redirect()->route('top')
            ->with('flash_message', '返済登録が完了しました');
    }
}
