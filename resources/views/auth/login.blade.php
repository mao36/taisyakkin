@extends('layouts.logout')

@section('content')
<div class="copy">
  <p>「誰に」「何で」「いくら」貸したか、借りたか</p>
  <p>記録・管理ができます</p>
</div>
<h3><a href="{{ route('register') }}">アカウントを作成する</a></h3>
<div class="form">
  <p>ログインはこちらから</p>
  <form method="post" action="{{ route('login') }}">
    @csrf
    <p>メールアドレス</p>
    <input type="email" name="email" value="{{ old('email') }}">
    <p>パスワード</p>
    <input type="password" name="password">
    <button>ログイン</button>
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
