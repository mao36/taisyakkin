@extends('layouts.login')

@section('content')
<div class="user-name">
  @if (!empty(Auth::user()->image))
  <img src="{{ asset('storage/user_image/' . Auth::user()->image) }}" alt="user_image">
  @else
  <img src="{{ asset('images/default_user_image.png') }}" alt="default_icon">
  @endif
  <h3>{{ Auth::user()->name}}</h3>
</div>
<div class="loan-list">
  <h3>タイシャク金額合計</h3>
  <ul class="money-list">
    <table>
      <tr>
        <th>貸している金額</th>
        <td class="money">{{ $loan->getLendingMoney() }}<span>円</span></td>
      </tr>
      <ul>
        <th>借りている金額</th>
        <td class="money">{{ $loan->getBorrowedMoney() }}<span>円</span></td>
      </ul>
    </table>
    <table>

    </table>
  </ul>
</div>

@endsection
