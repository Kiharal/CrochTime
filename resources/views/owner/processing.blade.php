<x-layout>
    <x-slot:nav>

    </x-slot:nav>
    <div id="loading-screen">
        This is processing
    </div>
    <script>
        let id = {{ $timetable->id }}
        
        addEventListener('DOMContentLoaded', (event) => {
            window.Echo.channel(`api.timetable_set.${id}`)
            .listen('ShowTable', (event) => {
                window.location.href = event.redirect_url;
                console.log(event.message)
            })
        })
    </script>
</x-layout>
