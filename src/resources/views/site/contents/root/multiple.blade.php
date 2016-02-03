<?php
// 2 columns
$bootstrapGridNumber = 6;
$contentSize = $contents->count();
if (($contentSize % 3) == 0) {
    // 3 columns
    $bootstrapGridNumber = 4;
} else if (($contentSize % 4) == 0) {
    // 4 columns
    $bootstrapGridNumber = 3;
}
?>

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ URL::route('root') }}">
                <img src="{{ asset('images/logo.png') }}" id="logo"/>
            </a>
        </div>
    </div>
</nav>


<main class="container multiple-root">
    <div class="row">
        @foreach ($contents as $content)
            <div class="col-md-{{ $bootstrapGridNumber }}">
                <a href="{{ $content->getUrl() }}" class="thumbnail">
                    <div class="box" style="background: url('{{ $content->getBannerUrl()  }}') center / cover;">
                        <div class="box-title">
                            <span>{{ $content->title }}</span>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</main>
