<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="https://openlayers.org/favicon.ico" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    @vite('resources/css/scrollbar.css')
    @once
        @vite('resources/js/main.js')
    @endonce
    <title>CICT Indoor</title>
</head>

<body>
    {{-- an overlay on the entire screen when an edit form appears --}}
    <div id="overlay" class="flex bg-darken2 h-screen w-screen fixed z-40 items-center justify-center hidden">
        @yield('insideOverlay')
    </div>


    {{-- PAGE --}}
    <div class="p-0 m-0 w-full" id="pageBody" style="background-color: #f5f5f4">
        <div class="relative z-10 flex min-h-screen w-full">
            <!-- <div id="sidebar" class="bg-scndBlue fixed z-20 -->
            <div id="sidebar" style="background-color: #f5f5f4;overflow-y: auto; " class="fixed z-20
                {{-- hidden --}}
                w-64
                space-y-6 
                px-2
               py-6 
               {{-- absolute  --}}
               inset-y-0 
               left-0
               {{-- md:relative --}}
               md:-translate-x-0 
               {{-- transform --}}
               
               {{-- -translate-x-full --}}
               transition duration-200 ease-in-out
               shadow-md
               
               h-screen fixed
               ">
                {{-- sidebar title --}}
                <a href="" class="flex flex-col items-center">
                    <!-- <img src="{{ asset('images/ctu.png') }}" alt="" class="w-24"> -->
                    <!-- <img src="{{ asset('images/agrivision_logo.svg') }}" alt="" class="w-24"> -->
                    <img src="{{ asset('images/agrivision_logo.svg') }}" alt="" class="w-36 ">
                    <!-- <span class="text-2xl font-extrabold text-white mt-3">CICT Indoor</span> -->
                    <!-- <span class="text-2xl font-extrabold text-black mt-3">Earth Measurement</span> -->
                </a>
                <nav>
                    <a href="/admin"
                        class="flex items-center py-3 px-4 hover:bg-blue-300 group transition duration-200 rounded-md gap-3">
                        <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" stroke-width="1.5"
                            stroke="#1f5ca9" class="size-8 ">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 6.75V15m6-6v8.25m.503 3.498 4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 0 0-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0Z" />
                        </svg> -->
                        <img src="{{ asset('images/map.png') }}" alt="" class="w-8 ">
                        <span class="font-normal text-xl" style="color: #0D0D0D">Bản đồ</span>
                    </a>

                    {{-- <h1 class="text-2xl font-extrabold text-white">Explore</h1> --}}
                    {{-- sensor tab --}}
                    <a href="/sensors"
                        class="flex items-center py-3 px-4 hover:bg-blue-300 group transition duration-200 rounded-md gap-3">
                        <!-- <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="#1f5ca9" class="size-8 ">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg> -->
                        <img src="{{ asset('images/notepad.png') }}" alt="" class="w-8 ">
                        <span class="font-normal text-xl" style="color: #0D0D0D">Sổ tay</span>
                    </a>

                    <a href="/history_measurement"
                        class="flex items-center py-3 px-4 hover:bg-blue-300 group transition duration-200 rounded-md gap-3">
                        <!-- <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="#1f5ca9" class="size-8 ">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg> -->
                        <img src="{{ asset('images/chronological-line.png') }}" alt="" class="w-8 ">
                        <span class="font-normal text-xl" style="color: #0D0D0D">Lịch sử đo</span>
                    </a>

                    <!-- <a href="/features"
                        class="flex items-center py-3 px-4 hover:bg-thirdBlue group transition duration-200 rounded-md gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="#1f5ca9" class="size-8 ">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                        <span class="text-white text-xl">Feature</span>
                    </a> -->

                    
                    <!-- <a href="/handlefeature"
                        class="flex items-center py-3 px-4 hover:bg-thirdBlue group transition duration-200 rounded-md gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="#1f5ca9" class="size-8 ">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                        <span class="text-white text-xl">Thêm đối tượng</span>
                    </a> -->
                </nav>
            </div>

            <div id="sidebar2" class="bg-scndBlue fixed
                {{-- hidden --}}
                w-64
                space-y-6 
                px-2
               py-6 
               {{-- absolute  --}}
               inset-y-0 
               left-0
               md:relative
               md:-translate-x-0 
               {{-- transform --}}
               {{-- -translate-x-full --}}
               transition duration-200 ease-in-out
               shadow-md
               rounded-tr-2xl
               rounded-br-2xl
               h-screen fixed
               "></div>

            {{-- title pane --}}
            <div class="flex-1 relative w-full" 
            {{-- style="background-color: #F3F6FF" --}}
            >
                <div id="titlePane" class="px-1 py-3 flex justify-between relative z-10"
                    {{-- style="background-color: #F3F6FF" --}}
                    >
                    <div class="flex flex-row items-center gap-3">
                        <button id="toggleSidebar" class="rounded-md text-scndBlue py-2 px-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 6.75h16.5M3.75 12H12m-8.25 5.25h16.5" />
                            </svg>
                        </button>
                        @yield('pageTitle')

                    </div>

                    {{-- other components on the right --}}
                    @yield('rightComponents')
                </div>
                @yield('content')
            </div>
        </div>
    </div>
    <script>
        document.getElementById('toggleSidebar').addEventListener('click', function () {
            const sidebar = document.getElementById('sidebar')
            const sidebar2 = document.getElementById('sidebar2')
            const button = this
            sidebar.classList.toggle('hidden')
            sidebar2.classList.toggle('hidden')

            if (sidebar.classList.contains('hidden')) {
                button.classList.remove('text-scndBlue')
                button.classList.add('bg-scndBlue', 'text-white')
            } else {
                button.classList.remove('bg-scndBlue', 'text-white')
                button.classList.add('text-scndBlue')
            }
        })
    </script>

</body>

</html>