<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>404</title>
</head>
<body>
  <div id="app">
    <page-not-found></page-not-found>
  </div>
  @vite('resources/js/app.js')
</body>
</html>
