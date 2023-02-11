@extends('layouts.logout')

@section('content')
<div class="added-copy">
  <p class="welcome">ようこそ{{ session('name') }}さん</p>
  <p>アカウント作成が完了しました</p>
  <p>さそっく記録を行いましょう</p>
  <a href="{{ route('login') }}">ログインページへ戻る</a>
</div>

@endsection
