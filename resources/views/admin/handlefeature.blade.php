@extends('layouts.general')
@section('pageTitle')
    <h1 class="text-scndBlue font-extrabold text-2xl">Thêm đối tượng vào bản đồ</h1>
@endsection

@section('content')
    {{-- feature selector pane --}}
    <div class="w-full flex items-center justify-center mt-2 relative">
        <div class="m-2 w-[95%] h-fit rounded-xl">
            @foreach ($featureList as $feature)
                <button id="ft{{ $feature }}"
                    class="p-3 border-gray-200 border-2 rounded-xl m-1 featureBtn active:bg-primaryBlue"
                    data-content="{{ $feature }}">{{ $feature }}</button>
            @endforeach
        </div>
    </div>
    {{-- feature form --}}
    <div class="w-full">
        <div id="formArea" class="p-10 w-full">
            @include('admin.featureForms.Amenity')
        </div>
    </div>
@endsection
{{-- @vite('resources/js/features/featureIndex.js') --}}

<script type="module">
    import {initComboSearch, initForm} from "/b-utils/featureFunctions.js";

    document.addEventListener('DOMContentLoaded', function() {

        console.log('DOM loaded')
        const $ = document.querySelector.bind(document)
        const $$ = document.querySelectorAll.bind(document)

        const btns = $$('.featureBtn')
        // console.log(btns)
        btns.forEach(btn => {
            btn.addEventListener('click', function() {
                const theForm = this.getAttribute('data-content')
                changeContent(theForm)
            })
        })

        async function changeContent(theForm) {
            const formArea = document.getElementById('formArea')
            fetch(`/getform/${theForm}`)
                .then(response => {
                    // console.log('hehe',response)
                    return response.json()
                    // return response.text()
                })
                .then(data => {
                    // console.log(data)
                    formArea.innerHTML = data.html

                    const scripts = formArea.querySelectorAll('script');

                    // thêm lại script
                    scripts.forEach(script => {
                        const newScript = document.createElement('script');
                        newScript.type = 'module';
                        newScript.textContent = script.textContent;
                        if (script.src) {
                            newScript.src = script.src;
                        }
                        document.body.appendChild(newScript);
                        script.remove();
                    });

                    //chạy lại script
                    initForm(theForm)

                }).catch(e => {
                    console.log(e)
                })
        }
    })
</script>
