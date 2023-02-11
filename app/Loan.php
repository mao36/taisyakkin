<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Loan extends Model
{
    protected $fillable = [
        'lending_id', 'borrowed_id', 'title', 'money', 'lending_on', 'due_on',
    ];

    public function getLendingLoans()
    {
        return $this->where([
            ['lending_id', Auth::id()],
            ['repaid_on', null]
        ])
            ->get();
    }

    public function getLendingMoney()
    {
        return $this->getLendingLoans()->sum('money');
    }

    public function getLendingCount()
    {
        return $this->getLendingLoans()->count();
    }

    public function getLendingOverdueCount()
    {
        return $this->getLendingLoans()->where('due_on', '<', now())->count();
    }


    public function getBorrowedLoans()
    {
        return $this->where([
            ['borrowed_id', Auth::id()],
            ['repaid_on', null]
        ])
            ->get();
    }

    public function getBorrowedMoney()
    {
        return $this->getBorrowedLoans()->sum('money');
    }

    public function getBorrowedCount()
    {
        return $this->getBorrowedLoans()->count();
    }

    public function getBorrowedOverdueCount()
    {
        return $this->getBorrowedLoans()->where('due_on', '<', now())->count();
    }


    public function getLendingRpaidLoans()
    {
        return $this->where([
            ['lending_id', Auth::id()],
            ['repaid_on', '!=', null]
        ])
            ->get();
    }

    public function getLendingRpaidCount()
    {
        return $this->getLendingRpaidLoans()->count();
    }


    public function getBorrowedRpaidLoans()
    {
        return $this->where([
            ['lending_id', Auth::id()],
            ['repaid_on', '!=', null]
        ])
            ->get();
    }

    public function getBorrowedRepaidCount()
    {
        return $this->getBorrowedRpaidLoans()->count();
    }
}
