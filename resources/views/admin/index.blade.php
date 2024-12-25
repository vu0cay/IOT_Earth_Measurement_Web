@extends('layouts.general')


@section('rightComponents')
<div class="w-full flex justify-end gap-3">
    <div class="search-container mr-10">
        <!-- <input type="text" id="search-bar" placeholder="Gõ để tìm kiếm..." class="bg-gray-100 border-transparent rounded-md"> -->
        <input type="text" id="search-bar" placeholder="Gõ để tìm kiếm..." class="bg-white border-transparent rounded-md">
        <div class="dropdown" id="dropdown"></div>
    </div>
    <!-- <select id="floor-select" class="mr-2 w-auto min-w-[100px] rounded-md font-extrabold py-2 px-3 border-transparent text-scndBlue flex-shrink-0">
        <option value="0" class="text-gray-700">Tầng 1</option>
        <option value="1" class="text-gray-700">Tầng 2</option>
    </select> -->
</div>
@endsection


@section('content')
    <div class=" justify-center ">

        <div id="side-panel" class="side-panel">
            <span id="close-btn">&times;</span>
            <div id="side-panel-content"></div>
        </div>
        <div id="popup" class="ol-popup">
            <a href="#" id="popup-closer" class="ol-popup-closer"></a>
            <div id="popup-content"></div>
          </div>
    </div>

    {{-- MAP is here --}}
    <div id="map" class="map"></div>
@endsection
