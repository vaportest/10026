@extends('backend.admin-master')
@section('site-title')
    {{__('About Widget Settings')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                @include('backend/partials/message')
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="col-lg-12 mt-t">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('About Widget Settings')}}</h4>
                        <form action="{{route('admin.footer.about')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    @foreach($all_languages as $key => $lang)
                                    <a class="nav-item nav-link @if($key == 0) active @endif" data-toggle="tab" href="#nav-home-{{$lang->slug}}" role="tab"  aria-selected="true">{{$lang->name}}</a>
                                    @endforeach
                                </div>
                            </nav>
                            <div class="tab-content margin-top-30" id="nav-tabContent">
                                @foreach($all_languages as $key => $lang)
                                <div class="tab-pane fade @if($key == 0) show active @endif" id="nav-home-{{$lang->slug}}" role="tabpanel" >
                                    <div class="form-group">
                                        <label for="about_widget_{{$lang->slug}}_description">{{__('Widget Description')}}</label>
                                        <textarea class="form-control"  id="about_widget_{{$lang->slug}}_description" name="about_widget_{{$lang->slug}}_description" >{{get_static_option('about_widget_'.$lang->slug.'_description')}}</textarea>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <div class="img-wrapper" style="margin: 20px">
                                @if(file_exists('assets/uploads/'.get_static_option('about_widget_logo')))
                                    <img src="{{asset('assets/uploads/'.get_static_option('about_widget_logo'))}}">
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="about_widget_logo">{{__('Widget Logo')}}</label>
                                <input type="file" class="form-control"  id="about_widget_logo"  name="about_widget_logo" >
                                <small>{{__('Recommended image size 160x50 png image')}}</small>
                            </div>
                            <div class="form-group">
                                <label for="about_widget_social_icon_one" class="d-block">{{__('Icon')}}</label>
                                <div class="btn-group about_widget_social_icon_one">
                                    <button type="button" class="btn btn-primary iconpicker-component">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </button>
                                    <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle"
                                            data-selected="fas fa-exclamation-triangle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu"></div>
                                </div>
                                <input type="hidden" class="form-control"  id="about_widget_social_icon_one" value="{{get_static_option('about_widget_social_icon_one')}}" name="about_widget_social_icon_one">
                            </div>
                            <div class="form-group">
                                <label for="about_widget_social_icon_one_url">{{__('Social Icon One Url')}}</label>
                                <input type="text" class="form-control"  id="about_widget_social_icon_one_url" value="{{get_static_option('about_widget_social_icon_one_url')}}" name="about_widget_social_icon_one_url" >
                            </div>
                            <div class="form-group">
                                <label for="about_widget_social_icon_two" class="d-block">{{__('Icon')}}</label>
                                <div class="btn-group about_widget_social_icon_two">
                                    <button type="button" class="btn btn-primary iconpicker-component">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </button>
                                    <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle"
                                            data-selected="fas fa-exclamation-triangle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu"></div>
                                </div>
                                <input type="hidden" class="form-control"  id="about_widget_social_icon_two" value="{{get_static_option('about_widget_social_icon_two')}}" name="about_widget_social_icon_two">
                            </div>
                            <div class="form-group">
                                <label for="about_widget_social_icon_two_url">{{__('Social Icon Two Url')}}</label>
                                <input type="text" class="form-control"  id="about_widget_social_icon_two_url" value="{{get_static_option('about_widget_social_icon_two_url')}}"  name="about_widget_social_icon_two_url" >
                            </div>
                            <div class="form-group">
                                <label for="about_widget_social_icon_three" class="d-block">{{__('Icon')}}</label>
                                <div class="btn-group about_widget_social_icon_three">
                                    <button type="button" class="btn btn-primary iconpicker-component">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </button>
                                    <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle"
                                            data-selected="fas fa-exclamation-triangle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu"></div>
                                </div>
                                <input type="hidden" class="form-control"  id="about_widget_social_icon_three" value="{{get_static_option('about_widget_social_icon_three')}}" name="about_widget_social_icon_three">
                            </div>
                            <div class="form-group">
                                <label for="about_widget_social_icon_three_url">{{__('Social Icon Three Url')}}</label>
                                <input type="text" class="form-control"  id="about_widget_social_icon_three_url" value="{{get_static_option('about_widget_social_icon_three_url')}}" name="about_widget_social_icon_three_url" >
                            </div>
                            <div class="form-group">
                                <label for="about_widget_social_icon_three" class="d-block">{{__('Icon')}}</label>
                                <div class="btn-group about_widget_social_icon_four">
                                    <button type="button" class="btn btn-primary iconpicker-component">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </button>
                                    <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle"
                                            data-selected="fas fa-exclamation-triangle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu"></div>
                                </div>
                                <input type="hidden" class="form-control"  id="about_widget_social_icon_four" value="{{get_static_option('about_widget_social_icon_four')}}" name="about_widget_social_icon_four">
                            </div>
                            <div class="form-group">
                                <label for="about_widget_social_icon_four_url">{{__('Social Icon Four Url')}}</label>
                                <input type="text" class="form-control"  id="about_widget_social_icon_four_url" value="{{get_static_option('about_widget_social_icon_four_url')}}" name="about_widget_social_icon_four_url" >
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Settings')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')

    <script>
        $(document).ready(function () {

            $('.about_widget_social_icon_one').find('.icp-dd').attr('data-selected',$('#about_widget_social_icon_one').val());
            $('.about_widget_social_icon_two').find('.icp-dd').attr('data-selected',$('#about_widget_social_icon_two').val());
            $('.about_widget_social_icon_three').find('.icp-dd').attr('data-selected',$('#about_widget_social_icon_three').val());
            $('.about_widget_social_icon_four').find('.icp-dd').attr('data-selected',$('#about_widget_social_icon_four').val());

            $('.icp-dd').iconpicker();
            $('.icp-dd').on('iconpickerSelected', function (e) {
                var selectedIcon = e.iconpickerValue;
                $(this).parent().parent().children('input').val(selectedIcon);
            });

        });
    </script>
@endsection