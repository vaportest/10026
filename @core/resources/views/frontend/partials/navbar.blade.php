<div class="info-bar-area style-three">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="info-bar-inner">
                    <div class="left-content">
                        <ul class="info-items-two">
                            @foreach($all_support_item as $data)
                                <li>
                                    <div class="single-info-item">
                                        <div class="icon">
                                            <i class="{{$data->icon}}"></i>
                                        </div>
                                        <div class="content">
                                            <h5 class="title">{{$data->title}}: <span class="details">{{$data->details}}</span></h5>

                                        </div>
                                    </div>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                    <div class="right-content">
                        <ul class="social-icon">

                            <li class="title">{{__('Follow:')}}</li>
                            @foreach($all_social_item as $data)
                                <li><a href="{{$data->url}}"><i class="{{$data->icon}}"></i></a></li>
                            @endforeach
                        </ul>
                        <select id="langchange">
                            @foreach($all_language as $lang)
                                <option @if(session()->get('lang') == $lang->slug) selected @endif value="{{$lang->slug}}">{{$lang->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="header-top-style-03">
    <nav class="navbar navbar-area navbar-expand-lg nav-style-02">
        <div class="container nav-container">
            <div class="navbar-brand">
                <a href="{{url('/')}}" class="logo">
                    @if(file_exists('assets/uploads/'.get_static_option('site_white_logo')))
                        <img src="{{asset('assets/uploads/'.get_static_option('site_white_logo'))}}" alt="site logo">
                    @endif
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bizcoxx_main_menu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="bizcoxx_main_menu">
                <ul class="navbar-nav">
                    @if(!empty($primary_menu->content))
                        @php
                            $cc = 0;
                            $parent_item_count = 0;
                           $menu_content = json_decode($primary_menu->content);
                           $static_page_list = ['About','Service','Faq','Team','Work']
                        @endphp
                        @foreach($menu_content as $data)
                            @php
                                if ($cc > 0 && $cc == $parent_item_count){ print '</ul>'; $cc = 0; }
                               if (!empty($data->parent_id) && $data->depth > 0){
                                    if  ($cc == 0){
                                        print '<ul class="sub-menu">';
                                        $parent_item_count = get_child_menu_count($menu_content,$data->parent_id);
                                    }else{  print '</li>'; }
                                }else{ print '</li>'; }
                            @endphp
                            <li class="@if(request()->path() == substr($data->menuUrl,6)) current-menu-item @endif">
                                @php $link = (in_array($data->menuTitle,$static_page_list)) ? url('/').'/'.get_static_option(strtolower($data->menuTitle).'_page_'.get_user_lang().'_slug') :  str_replace('[url]',url('/'),$data->menuUrl) @endphp
                                <a href="{{$link}}">@if(in_array($data->menuTitle,$static_page_list)) {{get_static_option(strtolower($data->menuTitle).'_page_'.get_user_lang().'_name')}} @else {{__($data->menuTitle)}} @endif</a>
                            @php if (!empty($data->parent_id) && $data->depth > 0){ $cc++;} @endphp
                        @endforeach
                    @else
                        <li class="@if(request()->path() == '/') current-menu-item @endif">
                            <a  href="{{url('/')}}">{{__('Home')}}</a>
                        </li>
                    @endif
                </ul>
            </div>
            @if(!empty(get_static_option('navbar_button')))
                <div class="nav-right-content">
                    <a href="{{route('frontend.request.quote')}}" class="get-quote">{{get_static_option('navbar_'.get_user_lang().'_button_text')}}</a>
                </div>
            @endif
        </div>
    </nav>
</div>
