

@php 
$footer = json_decode($footer->translate()->setting_value, true);
@endphp
<section class="section">
    <div class="container">
        <div class="columns">
         
            <div class="column is-three-fifths is-offset-one-fifth">
                <div class="column-footer-header has-text-centered">
                    <h4 class="is-size-4 is-uppercase">@lang('footer.titleContact')</h4>
                    <hr class="is-divider">
                </div>
                <div class="column-footer-content has-text-centered">
                   {!! $footer['content']  !!}
                  
                </div>
            </div>
        </div>
    </div>
</section>
<div class="absolute-footer">
    <div class="container">
        <div class="wrap-content">
            <p class="content mb-0 mr-5 is-size-7">© 2016 AFG Vietnam. All rights reserved.</p>
            <p class="f-image mb-0"><img src="{{ asset('images/ssl-valid-en-M.gif') }} " width="40"/></p>
        </div>
       
    </div>

</div>
