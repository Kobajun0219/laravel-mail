@component('mail::message')

@if (!empty($user_name))
    {{ $user_name }} さん
@endif


** 以下の認証リンクをクリックしてください。 **
@component('mail::button', ['url' => $url])
メールアドレスを認証する
@endcomponent


@if (!empty($url))
###### 「ログインして本登録を完了する」ボタンをクリックできない場合は、下記のURLをコピーしてWebブラウザに貼り付けてください。
###### {{ $url }}
@endif

---

※もしこのメールに覚えが無い場合は破棄してください。

---


ご利用有難う御座います。<br>
{{ config('app.name') }}
@endcomponent
