<!-- Navigation-->
<nav class="navbar navbar-expand-lg text-uppercase fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="/">{{ __('International School') }}</a>
        <button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <form id="switchLanguage" method="post" action="/switch-lang">
                    @csrf
                <button type="submit" class="border-0 lang" style="background-color: inherit;" name="lang" value="en"> English </button>|
                <button type="submit" class="text-lang border-0 lang @if(Lang::locale() == 'ar') text-lang @endif" style="background-color: inherit;" name="lang" value="ar"> {{ __('Arabic') }} </button>
                </form>
            </ul>
        </div>
    </div>
</nav>