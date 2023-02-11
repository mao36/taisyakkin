@extends('layouts.logout')

@section('content')

<div class="form">
  <p>アカウント作成</p>
  <form method="post" action="{{ route('register') }}">
    @csrf
    <p>ユーザー名</p>
    <input type="name" name="name" value="{{ old('name') }}">
    <p>メールアドレス</p>
    <input type="email" name="email" value="{{ old('email') }}">
    <p>パスワード</p>
    <input type="password" name="password">
    <p>パスワード確認</p>
    <input type="password" name="password_confirmation">
    <button>作成</button>
  </form>
  @if(!empty($errors->any()))
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
  @endif
</div>

@endsection
