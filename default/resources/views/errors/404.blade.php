@php
    \SiteMeta::setMetaTitle(__('meta.404'));

    \SiteBlade::setTitle(__('meta.404'));
    \SiteBlade::setHeadingCenter();
@endphp

@extends('layouts.app')

@section('content')
    {{-- <img src="#" alt="@lang('meta.404')" class="img-responsive" /> --}}
    {{--
        <div style="height:800px;"></div>

        <button type="button" class="btn" style="color: #fff; height: 80px; background-color: #D5080F;">D5080F</button>
        <button type="button" class="btn" style="color: #fff; height: 80px; background-color: #F7AA47;">F7AA47</button>
        <button type="button" class="btn" style="color: #fff; height: 80px; background-color: #68B828;">68B828</button>
        <button type="button" class="btn" style="color: #fff; height: 80px; background-color: #40BBEA;">40BBEA</button>
        <button type="button" class="btn" style="color: #fff; height: 80px; background-color: #0E62C7;">0E62C7</button>
        <button type="button" class="btn" style="color: #fff; height: 80px; background-color: #7C38BC;">7C38BC</button>

        <div style="height:800px;"></div>

        <button type="button" class="btn" style="color: #fff; height: 80px; background-color: #DD4B39;">DD4B39</button>
        <button type="button" class="btn" style="color: #fff; height: 80px; background-color: #F39C12;">F39C12</button>
        <button type="button" class="btn" style="color: #fff; height: 80px; background-color: #00A65A;">00A65A</button>
        <button type="button" class="btn" style="color: #fff; height: 80px; background-color: #00C0EF;">00C0EF</button>
        <button type="button" class="btn" style="color: #fff; height: 80px; background-color: #0073B7;">0073B7</button>
        <button type="button" class="btn" style="color: #fff; height: 80px; background-color: #605CA8;">605CA8</button>

        <div style="height:800px;"></div>
    --}}
@endsection