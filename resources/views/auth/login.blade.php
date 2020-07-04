<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Translation Manager</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
              integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <script src="https://kit.fontawesome.com/8c4a80dd98.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="/css/app.css">
    </head>
    <body id="login">
        <form id="login-form" action="/login" method="POST">
            <h1 class="text-center">Translation manager</h1>
            <h2 class="text-center">{{ trans('system.login') }}</h2>
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    {{ trans('system.login_failed') }}
                </div>
            @endif
            <div class="form-group">
                <label for="email">{{ trans('system.username') }}</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="far fa-envelope"></i>
                        </span>
                    </div>
                    <input id="email" class="form-control" name="email" type="text">
                </div>
                <label for="password">{{ trans('system.password') }}</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fas fa-lock"></i>
                        </span>
                    </div>
                    <input id="password" class="form-control" name="password" type="password">
                </div>
            </div>
            {{ csrf_field() }}
            <button type="submit" class="btn btn-green">{{ trans('system.login') }}</button>
        </form>
    </body>
</html>