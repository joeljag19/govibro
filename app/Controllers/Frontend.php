<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Frontend extends BaseController
{
    public function index()
    {
        $data = [
            'headerStyle' => 'default',
            'activePage' => 'index',
            'excludeBootstrap' => false,
            'excludeThemeScript' => false,
            'loadSlick' => false,
            'loadSummernote' => false,
            'loadDatatable' => false,
            'loadMobileCSS' => false,
            'loadDaterangepicker' => false,
            // Variables para vendor-scripts.php
            'loadApexChart' => false,
            'loadSlickSlider' => false,
            'loadSlimscroll' => false,
            'loadMap' => false,
            'mapType' => null,
            'loadMobileInput' => false,
            'isRTL' => false
        ];

        return view('frontend/index', $data);
    }

    public function dashboard()
    {
        $data = [
            'headerStyle' => 'default',
            'activePage' => 'dashboard',
            'excludeBootstrap' => false,
            'excludeThemeScript' => false,
            'loadSlick' => false,
            'loadSummernote' => false,
            'loadDatatable' => true,
            'loadMobileCSS' => false,
            'loadDaterangepicker' => true,
            // Variables para vendor-scripts.php
            'loadApexChart' => true,
            'loadSlickSlider' => false,
            'loadSlimscroll' => false,
            'loadMap' => false,
            'mapType' => null,
            'loadMobileInput' => false,
            'isRTL' => false
        ];

        return view('frontend/dashboard', $data);
    }

    public function tourDetails()
    {
        $data = [
            'headerStyle' => 'default',
            'activePage' => 'tour-details',
            'excludeBootstrap' => false,
            'excludeThemeScript' => false,
            'loadSlick' => true,
            'loadSummernote' => false,
            'loadDatatable' => false,
            'loadMobileCSS' => false,
            'loadDaterangepicker' => false,
            // Variables para vendor-scripts.php
            'loadApexChart' => false,
            'loadSlickSlider' => true,
            'loadSlimscroll' => false,
            'loadMap' => false,
            'mapType' => null,
            'loadMobileInput' => false,
            'isRTL' => false
        ];

        return view('frontend/tour-details', $data);
    }

    public function tourMap()
    {
        $data = [
            'headerStyle' => 'default',
            'activePage' => 'tour-map',
            'excludeBootstrap' => false,
            'excludeThemeScript' => false,
            'loadSlick' => false,
            'loadSummernote' => false,
            'loadDatatable' => false,
            'loadMobileCSS' => false,
            'loadDaterangepicker' => false,
            // Variables para vendor-scripts.php
            'loadApexChart' => false,
            'loadSlickSlider' => false,
            'loadSlimscroll' => false,
            'loadMap' => true,
            'mapType' => 'tour',
            'loadMobileInput' => false,
            'isRTL' => false
        ];

        return view('frontend/tour-map', $data);
    }

    public function indexRTL()
    {
        $data = [
            'headerStyle' => 'default',
            'activePage' => 'index-rtl',
            'excludeBootstrap' => false,
            'excludeThemeScript' => false,
            'loadSlick' => false,
            'loadSummernote' => false,
            'loadDatatable' => false,
            'loadMobileCSS' => false,
            'loadDaterangepicker' => false,
            // Variables para vendor-scripts.php
            'loadApexChart' => false,
            'loadSlickSlider' => false,
            'loadSlimscroll' => false,
            'loadMap' => false,
            'mapType' => null,
            'loadMobileInput' => false,
            'isRTL' => true
        ];

        return view('frontend/index-rtl', $data);
    }
}