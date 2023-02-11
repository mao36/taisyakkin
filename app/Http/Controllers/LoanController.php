<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\LoanRequest;
use App\Loan;


class LoanController extends Controller
{
    //トップページ
    public function home(Loan $loan)
    {
        $user = Auth::user();
        return view('loan.home', compact('user', 'loan'));
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
            return view('loan.indexBorrowed', compact('loans'));
        } else { //1以外なら貸リストを表示
            $loans = Loan::where([
                ['borrowed_id', Auth::id()],
                ['repaid_on', null]
            ])
                ->paginate(5);
            return view('loan.indexLending', compact('loans'));
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
            return view('loan.repaidBorrowed', compact('loans'));
        } else { //1以外なら貸リストを表示
            $loans = Loan::where([
                ['borrowed_id', Auth::id()],
                ['repaid_on', '!=', null]
            ])
                ->paginate(5);
            return view('loan.repaidLending', compact('loans'));
        }
    }

    //タイシャク登録画面
    public function create(int $user)
    {
        return view('loan.create', compact('$user'));
    }
    //タイシャク相手選択画面
    public function user(Request $request)
    {
        $users = User::where('name', 'LIKE', '%' . $request->keyword . '%')
            ->paginate(5);
        return view('Loan.user', compact('users'));
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
        return view('loan.edit', compact('loan'));
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
