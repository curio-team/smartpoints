<x-layout>
    <x-layout>
        
        @if(Auth::user()->type == "teacher")
            <div class="position-absolute w-100 shadow bg-body-secondary p-3">
                <form action="{{ route('student') }}" method="POST">
                    @csrf
                    <input type="text" name="nummer" placeholder="123456" value="{{ $nummer ?? '' }}">
                    <input type="submit" value="Opzoeken" />
                </form>
            </div>
        @endif

        <div class=" d-flex justify-content-center align-items-center overflow-hidden" style="height: 100vh">
            <div class="card m-1 w-50 shadow " style="height: 60%">
                <div class="card-body overflow-auto p-3 text-center">
                    <h1>Studiepunten niet gevonden.</h1>
                </div>
            </div>
        </div>
    </x-layout>


</x-layout>
