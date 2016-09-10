<!DOCTYPE html>
<html lang="en">
<head>
    <meta property="og:type" content="article" />
    <meta property="og:image" content="{{ env('APP_Api_Image').'/n1/'.$data['main_image_url'] }}">
    <meta property="og:title" content="{{$data['main_title']}}">
    <title>{{$data['main_title']}}</title>
    @include('head')
    <link rel="stylesheet" href="{{env('CDN_Static')}}/styles/shoppingDetail.css{{'?v='.config('app.version')}}">
</head>
<body>
</body>
</html>
