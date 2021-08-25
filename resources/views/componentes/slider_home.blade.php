<div class="mdslider">
    <ul class="navigation">
        <li>
            <button id="md_slider_nav_prev"><i class="fas fa-chevron-left"></i></button>
        </li>
        <li>
            <button id="md_slider_nav_next"><i class="fas fa-chevron-right"></i></button>
        </li>
    </ul>
    @foreach ($sliders as $slider)     
    <div class="md-slider-item">
        <div class="row slider__container">
            <div class="col-md-8">
                <div class="content">
                    <div class="content_inside">
                        {!! html_entity_decode($slider->content) !!}
                    </div>
                </div>
            </div>
            <div class="col-md-4 slider_home_img">
                <img src="{{ url('/uploads/'.$slider->file_path.'/'.$slider->file_name) }}" class="img-fluid" alt="">
            </div>
        </div>
    </div>
    @endforeach
    <div class="banner__efecto" style="height: 100px; overflow: hidden;" ><svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 100%; width: 100%;"><path d="M0.00,49.98 C312.36,171.20 349.20,-49.98 538.09,132.72 L500.00,150.00 L0.00,150.00 Z" style="stroke: none; fill: #fff;"></path></svg></div>
</div>