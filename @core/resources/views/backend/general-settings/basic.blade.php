@extends('backend.admin-master')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/colorpicker.css')}}">
@endsection
@section('site-title')
    {{__('Basic Settings')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                @include('backend.partials.message')
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__("Basic Settings")}}</h4>
                        <form action="{{route('admin.general.basic.settings')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    @foreach($all_languages as $key => $lang)
                                        <a class="nav-item nav-link @if($key == 0) active @endif" id="nav-home-tab" data-toggle="tab" href="#nav-home-{{$lang->slug}}" role="tab" aria-controls="nav-home" aria-selected="true">{{$lang->name}}</a>
                                    @endforeach
                                </div>
                            </nav>
                            <div class="tab-content margin-top-30" id="nav-tabContent">
                                @foreach($all_languages as $key => $lang)
                                    <div class="tab-pane fade @if($key == 0) show active @endif" id="nav-home-{{$lang->slug}}" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <div class="form-group">
                                            <label for="site_{{$lang->slug}}_title">{{__('Site Title')}}</label>
                                            <input type="text" name="site_{{$lang->slug}}_title"  class="form-control" value="{{get_static_option('site_'.$lang->slug.'_title')}}" id="site_{{$lang->slug}}_title">
                                        </div>
                                        <div class="form-group">
                                            <label for="site_{{$lang->slug}}_tag_line">{{__('Site Tag Line')}}</label>
                                            <input type="text" name="site_{{$lang->slug}}_tag_line"  class="form-control" value="{{get_static_option('site_'.$lang->slug.'_tag_line')}}" id="site_{{$lang->slug}}_tag_line">
                                        </div>
                                        <div class="form-group">
                                            <label for="site_{{$lang->slug}}_footer_copyright">{{__('Footer Copyright')}}</label>
                                            <input type="text" name="site_{{$lang->slug}}_footer_copyright"  class="form-control" value="{{get_static_option('site_'.$lang->slug.'_footer_copyright')}}" id="site_{{$lang->slug}}_footer_copyright">
                                            <small class="form-text text-muted">{copy} Will replace by &copy; and {year} will be replaced by current year.</small>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label for="site_rtl_enabled"><strong>{{__('RTL Enable/Disable')}}</strong></label>
                                <label class="switch">
                                    <input type="checkbox" name="site_rtl_enabled"  @if(!empty(get_static_option('site_rtl_enabled'))) checked @endif id="site_rtl_enabled">
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="site_admin_dark_mode"><strong>{{__('Dark Mode For Admin Dashboard')}}</strong></label>
                                <label class="switch yes">
                                    <input type="checkbox" name="site_admin_dark_mode"  @if(!empty(get_static_option('site_admin_dark_mode'))) checked @endif id="site_admin_dark_mode">
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="site_color">{{__('Site Main Color Settings')}}</label>
                                <input type="text" name="site_color" style="background-color: {{get_static_option('site_color')}};color: #fff;" class="form-control" value="{{get_static_option('site_color')}}" id="site_color">
                                <small>{{__('you change site main color from here, it will replace website main color')}}</small>
                            </div>
                            <div class="form-group">
                                <label for="site_color">{{__('Site Base Color Two Settings')}}</label>
                                <input type="text" name="site_main_color_two" style="background-color: {{get_static_option('site_main_color_two')}};color: #fff;" class="form-control" value="{{get_static_option('site_main_color_two')}}" id="site_main_color_two">
                                <small>{{__('you change site secondary color from here, it will replace website secondary color')}}</small>
                            </div>
                            <div class="form-group">
                                <label for="site_heading_color">{{__('Site Heading Color')}}</label>
                                <input type="text" name="site_heading_color" style="background-color: {{get_static_option('site_heading_color')}};color: #fff;" class="form-control" value="{{get_static_option('site_heading_color')}}" id="site_heading_color">
                                <small>{{__('you can change site heading color from there , when you chnage this color it will reflect the color in all the heading like (h1,h2,h3,h4.h5.h6)')}}</small>
                            </div>
                            <div class="form-group">
                                <label for="site_paragraph_color">{{__('Site Paragraph Color')}}</label>
                                <input type="text" name="site_paragraph_color" style="background-color: {{get_static_option('site_paragraph_color')}};color: #fff;" class="form-control" value="{{get_static_option('site_paragraph_color')}}" id="site_paragraph_color">
                                <small>{{__('you can change site paragraph color from there')}}</small>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Changes')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('assets/backend/js/colorpicker.js')}}"></script>
    <script>
        (function($){
            "use strict";
            $(document).ready(function(){
                $('#site_color').ColorPicker({
                    color: '#ff4249',
                    onShow: function (colpkr) {
                        $(colpkr).fadeIn(500);
                        return false;
                    },
                    onHide: function (colpkr) {
                        $(colpkr).fadeOut(500);
                        return false;
                    },
                    onChange: function (hsb, hex, rgb) {
                        $('#site_color').css('background-color', '#' + hex);
                        $('#site_color').val('#' + hex);
                    }
                });
                $('#site_main_color_two').ColorPicker({
                    color: '#852aff',
                    onShow: function (colpkr) {
                        $(colpkr).fadeIn(500);
                        return false;
                    },
                    onHide: function (colpkr) {
                        $(colpkr).fadeOut(500);
                        return false;
                    },
                    onChange: function (hsb, hex, rgb) {
                        $('#site_main_color_two').css('background-color', '#' + hex);
                        $('#site_main_color_two').val('#' + hex);
                    }
                });
            });
        }(jQuery));
    </script>
@endsection
