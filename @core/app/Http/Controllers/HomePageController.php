<?php

namespace App\Http\Controllers;

use App\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class HomePageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function home_01_counterup(){
        return view('backend.pages.home.home-01.counterup');
    }
    public function home_01_update_counterup(Request $request){

        $this->validate($request ,[
            'home_01_counterup_bg_image' => 'mimes:jpg,jpeg,png|max:10064',
            'home_02_counterup_bg_image' => 'mimes:jpg,jpeg,png|max:10064'
        ]);

        if ($request->hasFile('home_01_counterup_bg_image')) {
            $image = $request->home_01_counterup_bg_image;
            $image_extenstion = $image->getClientOriginalExtension();
            $image_name = 'home-page-01-counterup-bg-image-'  .rand(999,9999999).'.'. $image_extenstion;
            if (check_image_extension($image)) {
                $image->move('assets/uploads/', $image_name);
                update_static_option('home_01_counterup_bg_image', $image_name);
            }
        }
        if ($request->hasFile('home_02_counterup_bg_image')) {
            $image = $request->home_02_counterup_bg_image;
            $image_extenstion = $image->getClientOriginalExtension();
            $image_name = 'home-page-02-counterup-bg-image-'  .rand(999,9999999).'.'. $image_extenstion;
            if (check_image_extension($image)) {
                $image->move('assets/uploads/', $image_name);
                update_static_option('home_02_counterup_bg_image', $image_name);
            }
        }


        return redirect()->back()->with([
            'msg' => 'Settings Updated ...',
            'type' => 'success'
        ]);
    }
    public function home_01_about_us(){
        return view('backend.pages.home.home-01.about-us');
    }

    public function home_01_update_about_us(Request $request){

        $all_language = Language::all();

        foreach ($all_language as $lang){
            $this->validate($request,[
                'home_page_01_'.$lang->slug.'_about_us_title' => 'nullable|string|max:191',
                'home_page_01_'.$lang->slug.'_about_us_description' => 'nullable|string',
                'home_page_01_'.$lang->slug.'_about_us_button_title' => 'nullable|string|max:191',
                'home_page_01_'.$lang->slug.'_about_us_button_url' => 'nullable|string|max:191',
                'home_page_01_'.$lang->slug.'_about_us_signature_text' => 'nullable|string|max:191',
                'home_page_01_'.$lang->slug.'_about_us_quote_box_title' => 'nullable|string|max:191',
                'home_page_01_'.$lang->slug.'_about_us_quote_box_description' => 'nullable|string|max:191',
                'home_page_01_'.$lang->slug.'_about_us_experience_title' => 'nullable|string|max:191',
                'home_page_01_'.$lang->slug.'_about_us_experience_year' => 'nullable|string|max:191',
                'home_page_01_'.$lang->slug.'_about_us_experience_background_image' => 'mimes:jpg,jpeg,png|max:10064',
                'home_page_01_'.$lang->slug.'_about_us_right_image' => 'mimes:jpg,jpeg,png|max:10064',
                'home_page_01_'.$lang->slug.'_about_us_background_image' => 'mimes:jpg,jpeg,png|max:10064',
                'home_page_02_'.$lang->slug.'_about_us_background_image' => 'mimes:jpg,jpeg,png|max:10064',
                'home_page_01_'.$lang->slug.'_about_us_signature_image' => 'mimes:jpg,jpeg,png|max:10064',
            ]);
            $save_data = [
                'home_page_01_'.$lang->slug.'_about_us_title',
                'home_page_01_'.$lang->slug.'_about_us_description',
                'home_page_01_'.$lang->slug.'_about_us_button_title',
                'home_page_01_'.$lang->slug.'_about_us_button_url',
                'home_page_01_'.$lang->slug.'_about_us_signature_text',
                'home_page_01_'.$lang->slug.'_about_us_quote_box_description',
                'home_page_01_'.$lang->slug.'_about_us_experience_title',
                'home_page_01_'.$lang->slug.'_about_us_experience_year',
                'home_page_01_'.$lang->slug.'_about_us_quote_box_title'
            ];
            foreach ($save_data as $item){
                if (empty($request->$item)){continue;}
                update_static_option($item,$request->$item);
            }

            $_about_us_signature_image = 'home_page_01_'.$lang->slug.'_about_us_signature_image';
            $_about_us_background_image = 'home_page_01_'.$lang->slug.'_about_us_background_image';
            $_about_us_background_image_two = 'home_page_02_'.$lang->slug.'_about_us_background_image';
            $_about_us_right_image = 'home_page_01_'.$lang->slug.'_about_us_right_image';
            $_about_us_experience_background_image = 'home_page_01_'.$lang->slug.'_about_us_experience_background_image';

            if ($request->hasFile('home_page_01_'.$lang->slug.'_about_us_signature_image')) {
                $image = $request->$_about_us_signature_image;
                $image_extenstion = $image->getClientOriginalExtension();
                $image_name = 'home-page-01-'.$lang->slug.'-about-us-singnature-' .rand(999,9999999).'.'. $image_extenstion;

                if (check_image_extension($image)) {
                    if (file_exists('assets/uploads/'.get_static_option($_about_us_signature_image)) && !empty(get_static_option($_about_us_signature_image))){
                        unlink('assets/uploads/'.get_static_option($_about_us_signature_image));
                    }
                    $image->move('assets/uploads/', $image_name);
                    update_static_option($_about_us_signature_image, $image_name);
                }
            }

            if ($request->hasFile('home_page_02_'.$lang->slug.'_about_us_background_image')) {
                $image = $request->$_about_us_background_image_two;
                $image_extenstion = $image->getClientOriginalExtension();
                $image_name = 'home-page-02-'.$lang->slug.'-about-us-background-image-' .rand(999,9999999).'.'. $image_extenstion;

                if (check_image_extension($image)) {
                    if (file_exists('assets/uploads/'.get_static_option($_about_us_background_image_two) && !empty(get_static_option($_about_us_background_image_two)))){
                        unlink('assets/uploads/'.get_static_option($_about_us_background_image_two));
                    }
                    $image->move('assets/uploads/', $image_name);
                    update_static_option($_about_us_background_image_two, $image_name);
                }
            }
            if ($request->hasFile('home_page_01_'.$lang->slug.'_about_us_background_image')) {
                $image = $request->$_about_us_background_image;
                $image_extenstion = $image->getClientOriginalExtension();
                $image_name = 'home-page-01-'.$lang->slug.'-about-us-background-image-' .rand(999,9999999).'.'. $image_extenstion;

                if (check_image_extension($image)) {
                    if (file_exists('assets/uploads/'.get_static_option($_about_us_background_image)) && !empty(get_static_option($_about_us_background_image))){
                        unlink('assets/uploads/'.get_static_option($_about_us_background_image));
                    }
                    $image->move('assets/uploads/', $image_name);
                    update_static_option($_about_us_background_image, $image_name);
                }
            }
            if ($request->hasFile('home_page_01_'.$lang->slug.'_about_us_right_image')) {
                $image = $request->$_about_us_right_image;
                $image_extenstion = $image->getClientOriginalExtension();
                $image_name = 'home-page-01-'.$lang->slug.'-about-us-right-image-' .rand(999,9999999).'.'. $image_extenstion;

                if (check_image_extension($image)) {
                    if (file_exists('assets/uploads/'.get_static_option($_about_us_right_image)) && !empty(get_static_option($_about_us_right_image))){
                        unlink('assets/uploads/'.get_static_option($_about_us_right_image));
                    }
                    $image->move('assets/uploads/', $image_name);
                    update_static_option($_about_us_right_image, $image_name);
                }
            }
            if ($request->hasFile('home_page_01_'.$lang->slug.'_about_us_experience_background_image')) {
                $image = $request->$_about_us_experience_background_image;
                $image_extenstion = $image->getClientOriginalExtension();
                $image_name = 'home-page-01-'.$lang->slug.'-about-us-experience-background-image-' .rand(999,9999999).'.'. $image_extenstion;

                if (check_image_extension($image)) {
                    if (file_exists('assets/uploads/'.get_static_option($_about_us_experience_background_image)) && !empty(get_static_option($_about_us_experience_background_image))){
                        unlink('assets/uploads/'.get_static_option($_about_us_experience_background_image));
                    }
                    $image->move('assets/uploads/', $image_name);
                    update_static_option($_about_us_experience_background_image, $image_name);
                }
            }

            $_about_us_button_status = 'home_page_01_'.$lang->slug.'_about_us_button_status';

            update_static_option('home_page_01_'.$lang->slug.'_about_us_button_status',$request->$_about_us_button_status);

        }

        return redirect()->back()->with([
            'msg' => 'Settings Updated ...',
            'type' => 'success'
        ]);
    }

    public function home_01_testimonial(){
        return view('backend.pages.home.home-01.testimonial');
    }
    public function home_01_update_testimonial(Request $request){

        $this->validate($request,[
           'home_01_testimonial_bg' => 'required|mimes:jpg,jpeg,png|max:10064'
        ]);

        if ($request->hasFile('home_01_testimonial_bg')){
            $image = $request->home_01_testimonial_bg;
            $image_extenstion = $image->getClientOriginalExtension();
            $image_name = 'home-page-01-testimonial-background-image-' .rand(999,9999999).'.'. $image_extenstion;

            if (check_image_extension($image)) {
                if (file_exists('assets/uploads/'.get_static_option('home_01_testimonial_bg') && !empty(get_static_option('home_01_testimonial_bg')))){
                    unlink('assets/uploads/'.get_static_option('home_01_testimonial_bg'));
                }
                $image->move('assets/uploads/', $image_name);
                update_static_option('home_01_testimonial_bg', $image_name);
            }
        }

        return redirect()->back()->with([
            'msg' => 'Settings Updated ...',
            'type' => 'success'
        ]);
    }
    public function home_01_latest_news(){
        $all_language = Language::all();
        return view('backend.pages.home.home-01.latest-news')->with(['all_languages' => $all_language]);
    }
    public function home_01_update_latest_news(Request $request){

        $all_language = Language::all();
        foreach ($all_language as $lang){
            $this->validate($request,[
                'home_page_01_'.$lang->slug.'_latest_news_title' => 'nullable|string',
                'home_page_01_'.$lang->slug.'_latest_news_description' => 'nullable|string',
            ]);
            $field_name = 'home_page_01_'.$lang->slug.'_latest_news_title';
            $field_two = 'home_page_01_'.$lang->slug.'_latest_news_description';
            update_static_option($field_name,$request->$field_name);
            update_static_option($field_two,$request->$field_two);
        }

        return redirect()->back()->with([
            'msg' => 'Settings Updated ...',
            'type' => 'success'
        ]);
    }


    public function home_01_service_area(){
        return view('backend.pages.home.home-01.service-area');
    }
    public function home_01_update_service_area(Request $request){
        $this->validate($request,[
            'home_page_01_service_area_items' => 'required|string',
            'home_page_01_service_area_background_image' => 'nullable|mimes:jpg,jpeg,png|max:6064',
        ]);

        $all_language = Language::all();
        foreach ($all_language as $lang){
            $this->validate($request,[
                'home_page_01_'.$lang->slug.'_service_area_title' => 'nullable|string',
                'home_page_01_'.$lang->slug.'_service_area_description' => 'nullable|string'
            ]);
            $field_name = 'home_page_01_'.$lang->slug.'_service_area_title';
            $field_name_two = 'home_page_01_'.$lang->slug.'_service_area_description';
            update_static_option($field_name,$request->$field_name);
            update_static_option($field_name_two,$request->$field_name_two);
        }
        update_static_option('home_page_01_service_area_items', $request->home_page_01_service_area_items);

        if ($request->hasFile('home_page_01_service_area_background_image')){
            $image = $request->home_page_01_service_area_background_image;
            $image_extenstion = $image->getClientOriginalExtension();
            $image_name = 'home-page-01-service-background-image-' .rand(999,9999999).'.'. $image_extenstion;

            if (check_image_extension($image)) {
                if (file_exists('assets/uploads/'.get_static_option('home_page_01_service_area_background_image') && !empty(get_static_option('home_page_01_service_area_background_image')))){
                    unlink('assets/uploads/'.get_static_option('home_page_01_service_area_background_image'));
                }
                $image->move('assets/uploads/', $image_name);
                update_static_option('home_page_01_service_area_background_image', $image_name);
            }
        }

        return redirect()->back()->with([
            'msg' => 'Settings Updated ...',
            'type' => 'success'
        ]);
    }

    public function home_01_recent_work(){
        return view('backend.pages.home.home-01.recent-work');
    }
    public function home_01_update_recent_work(Request $request){

        $all_language = Language::all();
        foreach ($all_language as $lang){
            $this->validate($request,[
                'home_page_01_'.$lang->slug.'_recent_work_title' => 'nullable|string',
                'home_page_01_'.$lang->slug.'_recent_work_description' => 'nullable|string',
            ]);
            $field_name = 'home_page_01_'.$lang->slug.'_recent_work_title';
            $field_name_two = 'home_page_01_'.$lang->slug.'_recent_work_description';
            update_static_option($field_name,$request->$field_name);
            update_static_option($field_name_two,$request->$field_name_two);
        }

        return redirect()->back()->with([
            'msg' => 'Settings Updated ...',
            'type' => 'success'
        ]);
    }


    
    public function home_01_section_manage(){
        return view('backend.pages.section-manage');
    }
    public function home_01_update_section_manage(Request $request){

        $this->validate($request,[
            'home_page_key_feature_section_status' => 'nullable|string',
            'home_page_about_us_section_status' => 'nullable|string',
            'home_page_counterup_section_status' => 'nullable|string',
            'home_page_service_section_status' => 'nullable|string',
            'home_page_recent_work_section_status' => 'nullable|string',
            'home_page_testimonial_section_status' => 'nullable|string',
            'home_page_latest_news_section_status' => 'nullable|string',
            'home_page_brand_logo_section_status' => 'nullable|string',
            'home_page_support_bar_section_status' => 'nullable|string',
            'home_page_price_plan_section_status' => 'nullable|string',
            'home_page_team_member_section_status' => 'nullable|string',
            'home_page_call_to_action_section_status' => 'nullable|string',
            'home_page_newsletter_section_status' => 'nullable|string',
            'home_page_faq_section_status' => 'nullable|string',
            ]);

            update_static_option('home_page_call_to_action_section_status',$request->home_page_call_to_action_section_status);
            update_static_option('home_page_newsletter_section_status',$request->home_page_newsletter_section_status);
            update_static_option('home_page_about_us_section_status',$request->home_page_about_us_section_status);
            update_static_option('home_page_service_section_status',$request->home_page_service_section_status);
            update_static_option('home_page_key_feature_section_status',$request->home_page_key_feature_section_status);
            update_static_option('home_page_counterup_section_status',$request->home_page_counterup_section_status);
            update_static_option('home_page_recent_work_section_status',$request->home_page_recent_work_section_status);
            update_static_option('home_page_testimonial_section_status',$request->home_page_testimonial_section_status);
            update_static_option('home_page_latest_news_section_status',$request->home_page_latest_news_section_status);
            update_static_option('home_page_brand_logo_section_status',$request->home_page_brand_logo_section_status);
            update_static_option('home_page_support_bar_section_status',$request->home_page_support_bar_section_status);
            update_static_option('home_page_price_plan_section_status',$request->home_page_price_plan_section_status);
            update_static_option('home_page_team_member_section_status',$request->home_page_team_member_section_status);
            update_static_option('home_page_faq_section_status',$request->home_page_faq_section_status);

        Artisan::call('route:clear');
        Artisan::call('view:clear');
        Artisan::call('config:clear');
        Artisan::call('cache:clear');

        return redirect()->back()->with([
            'msg' => 'Settings Updated ...',
            'type' => 'success'
        ]);
    }
    public function home_01_price_plan(){
        return view('backend.pages.home.home-01.price-plan');
    }
    public function home_01_update_price_plan(Request $request){

        $this->validate($request,[
            'home_page_01_price_plan_section_items' => 'required|string',
        ]);

        $all_language = Language::all();
        foreach ($all_language as $lang){
            $this->validate($request,[
                'home_page_01_'.$lang->slug.'_price_plan_section_title' => 'nullable|string',
                'home_page_01_'.$lang->slug.'_price_plan_section_description' => 'nullable|string',
            ]);
            $field_name = 'home_page_01_'.$lang->slug.'_price_plan_section_title';
            $_price_plan_section_description = 'home_page_01_'.$lang->slug.'_price_plan_section_description';
            update_static_option($field_name,$request->$field_name);
            update_static_option($_price_plan_section_description,$request->$_price_plan_section_description);
        }

        update_static_option('home_page_01_price_plan_section_items',$request->home_page_01_price_plan_section_items);

        return redirect()->back()->with([
            'msg' => 'Settings Updated ...',
            'type' => 'success'
        ]);
    }

    public function home_01_team_member(){
        return view('backend.pages.home.home-01.team-member');
    }
    public function home_01_update_team_member(Request $request){

        $all_language = Language::all();
        foreach ($all_language as $lang){
            $this->validate($request,[
                'home_page_01_'.$lang->slug.'_team_member_section_title' => 'nullable|string',
                'home_page_01_'.$lang->slug.'_team_member_section_description' => 'nullable|string',
            ]);
            $field_name = 'home_page_01_'.$lang->slug.'_team_member_section_title';
            $field_name_two = 'home_page_01_'.$lang->slug.'_team_member_section_description';
            update_static_option($field_name,$request->$field_name);
            update_static_option($field_name_two,$request->$field_name_two);
        }

        return redirect()->back()->with([
            'msg' => 'Settings Updated ...',
            'type' => 'success'
        ]);
    }

    public function home_01_newsletter()
    {
        return view('backend.pages.home.home-01.newsletter');
    }

    public function home_01_update_newsletter(Request $request){
        $all_language = Language::all();
        foreach ($all_language as $lang){
            $this->validate($request,[
                'home_page_01_'.$lang->slug.'_newsletter_area_title' => 'nullable|string',
                'home_page_01_'.$lang->slug.'_newsletter_area_description' => 'nullable|string',
            ]);
            $field_name = 'home_page_01_'.$lang->slug.'_newsletter_area_title';
            $field_name_two = 'home_page_01_'.$lang->slug.'_newsletter_area_description';
            update_static_option($field_name,$request->$field_name);
            update_static_option($field_name_two,$request->$field_name_two);
        }

        return redirect()->back()->with([
            'msg' => 'Settings Updated ...',
            'type' => 'success'
        ]);
    }

    public function home_01_cta_area(){
        return view('backend.pages.home.home-01.cta-area');
    }
    public function home_01_update_cta_area(Request $request){
        $all_language = Language::all();
        foreach ($all_language as $lang){
            $this->validate($request,[
                'home_page_01_'.$lang->slug.'_cta_area_title' => 'nullable|string',
                'home_page_01_'.$lang->slug.'_cta_area_description' => 'nullable|string',
                'home_page_01_'.$lang->slug.'_cta_area_description' => 'nullable|string',
                'home_page_01_'.$lang->slug.'_cta_area_button_title' => 'nullable|string',
                'home_page_01_'.$lang->slug.'_cta_area_button_url' => 'nullable|string',
                'home_page_01_'.$lang->slug.'_cta_background_image' => 'mimes:jpg,jpeg,png|max:10064',
            ]);

            $_cta_area_title = 'home_page_01_'.$lang->slug.'_cta_area_title';
            $_cta_area_description = 'home_page_01_'.$lang->slug.'_cta_area_description';
            $_cta_area_button_status = 'home_page_01_'.$lang->slug.'_cta_area_button_status';
            $_cta_area_button_title = 'home_page_01_'.$lang->slug.'_cta_area_button_title';
            $_cta_area_button_url = 'home_page_01_'.$lang->slug.'_cta_area_button_url';
            $_cta_background_image = 'home_page_01_'.$lang->slug.'_cta_background_image';

            update_static_option($_cta_area_button_url,$request->$_cta_area_button_url);
            update_static_option($_cta_area_button_title,$request->$_cta_area_button_title);
            update_static_option($_cta_area_title,$request->$_cta_area_title);
            update_static_option($_cta_area_description,$request->$_cta_area_description);
            update_static_option($_cta_area_button_status,$request->$_cta_area_button_status);

            if ($request->hasFile($_cta_background_image)) {
                $image = $request->$_cta_background_image;
                $image_extenstion = $image->getClientOriginalExtension();
                $image_name = 'home-page-01-'.$lang->slug.'-cta-background-image-' .rand(999,9999999).'.'. $image_extenstion;

                if (check_image_extension($image)) {
                    if (file_exists('assets/uploads/'.get_static_option($_cta_background_image)) && !empty(get_static_option($_cta_background_image))){
                        unlink('assets/uploads/'.get_static_option($_cta_background_image));
                    }
                    $image->move('assets/uploads/', $image_name);
                    update_static_option($_cta_background_image, $image_name);
                }
            }
        }

        return redirect()->back()->with([
            'msg' => 'Settings Updated ...',
            'type' => 'success'
        ]);
    }

    public function home_01_faq_area(){
        return view('backend.pages.home.home-01.faq-area');
    }
    public function home_01_update_faq_area(Request $request){

        $this->validate($request,[
            'home_page_01_faq_area_items' => 'required|string|max:191',
            'home_page_01_faq_area_form_mail' => 'required|email|max:191',
            'home_page_01_faq_area_background_image' => 'mimes:jpg,jpeg,png|max:6064',
        ]);

        $all_language = Language::all();
        foreach ($all_language as $lang){
            $this->validate($request,[
                'home_page_01_'.$lang->slug.'_faq_area_title' => 'nullable|string',
                'home_page_01_'.$lang->slug.'_faq_area_description' => 'nullable|string',
                'home_page_01_'.$lang->slug.'_faq_area_form_title' => 'nullable|string',
                'home_page_01_'.$lang->slug.'_faq_area_form_description' => 'nullable|string'
            ]);

            $_faq_area_title = 'home_page_01_'.$lang->slug.'_faq_area_title';
            $_faq_area_description = 'home_page_01_'.$lang->slug.'_faq_area_description';
            $_faq_area_form_title = 'home_page_01_'.$lang->slug.'_faq_area_form_title';
            $_faq_area_form_description = 'home_page_01_'.$lang->slug.'_faq_area_form_description';

            update_static_option($_faq_area_title,$request->$_faq_area_title);
            update_static_option($_faq_area_description,$request->$_faq_area_description);
            update_static_option($_faq_area_form_title,$request->$_faq_area_form_title);
            update_static_option($_faq_area_form_description,$request->$_faq_area_form_description);
        }

        update_static_option('home_page_01_faq_area_items', $request->home_page_01_faq_area_items);
        update_static_option('home_page_01_faq_area_form_mail', $request->home_page_01_faq_area_form_mail);

        if ($request->hasFile('home_page_01_faq_area_background_image')) {
            $image = $request->home_page_01_faq_area_background_image;
            $image_extenstion = $image->getClientOriginalExtension();
            $image_name = 'home-page-01-'.$lang->slug.'-faq-background-image-' .rand(999,9999999).'.'. $image_extenstion;

            if (check_image_extension($image)) {
                if (file_exists('assets/uploads/'.get_static_option('home_page_01_faq_area_background_image')) && !empty(get_static_option('home_page_01_faq_area_background_image'))){
                    unlink('assets/uploads/'.get_static_option('home_page_01_faq_area_background_image'));
                }
                $image->move('assets/uploads/', $image_name);
                update_static_option('home_page_01_faq_area_background_image', $image_name);
            }
        }

        return redirect()->back()->with([
            'msg' => 'Settings Updated ...',
            'type' => 'success'
        ]);
    }
}
