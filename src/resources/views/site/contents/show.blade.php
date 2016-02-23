@extends('simple-cms::layouts.site')

@section('header')
    @include('simple-cms::site.partials.navigation', ['content' => $content])
@stop

@section('content')
    @if(empty($content->banner) == false)
        <div class="banner"
             style="background: url('{{ $content->getBannerUrl()  }}') center / cover;"></div>
    @endif
    <div class="content-wrapper">
        <h1>{{ $content->title }}</h1>
        <p>{!! $content->body !!}</p>
    </div>

@endsection
