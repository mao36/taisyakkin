<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>タイシャッキン</title>
  <meta name="description" content="">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="{{ asset('js/script.js') }}"></script>
  <meta name="viewport" content="width=device-width,initial-scale=1">
</head>
<body>
  <div id="app">
    <header>
      <div class="header-left">
        <a href="{{ route('home') }}" class=header-logo>
          <img src="{{ asset('images/logo.png') }}" alt="logo">
        </a>
      </div>
      <div class="header-right">

        @if (!empty(Auth::user()->image))
        <img src="{{ asset('storage/user_image/' . Auth::user()->image) }}" alt="user_image">
        @else
        <img src="{{ asset('images/default_user_image.png') }}" alt="default_icon">
        @endif
        <p class="user-name">{{ Auth::user()->name }}</p>
        <img src="images/pulldown.png" alt="pulldown">
      </div>
    </header>
    <div class="pulldown-menu">
      <a href="/logout">ログアウト</a>
      </li>
      <div id="side-bar">
          <ul>
            <li><a href="{{ route('home') }}">トップページ</a></li>
            <li><a href="{{ route('loans.create') }}">タイシャク登録</a></li>
            <li><a href="{{ route('loans.index') }}">タイシャクリスト</a></li>
            <li><a href="{{ route('likes.index') }}">お気に入りユーザー</a></li>
            <li><a href="{{ route('search') }}">ユーザー検索</a></li>
            <li><a href="{{ route('my-profile') }}">マイプロフィール</a></li>
          </ul>
      </div>
      <main>
        @if (session('flash_message'))
        <div class="flash-message">
          {{ session('flash_message') }}
        </div>
        @endif
        @yield('content')
      </main>
    </div>
  </div>
</body>
</html>
