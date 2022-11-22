<style>
    .hide-scroll-bar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    .hide-scroll-bar::-webkit-scrollbar-track
    {
        -webkit-box-shadow: inset 0 0 60 rgba(0,0,0,0.3);
        border-radius: 10px;
        background-color: #F5F5F5;
    }

    .hide-scroll-bar::-webkit-scrollbar
    {
        width: 12px;
        height: 10px;
        background-color: #F5F5F5;
    }

    .hide-scroll-bar::-webkit-scrollbar-thumb
    {
        border-radius: 10px;
        -webkit-box-shadow: inset 0 0 0 rgba(0,0,0,.3);
        background-color: #cecece;
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div
                    class="flex flex-col pb-10 pt-10"
                >
                    <div
                        class="flex"
                    >
                        <div class="inline-block px-3" style="width: 50%">
                            <div
                                class="bg-green-500 rounded-lg shadow-md bg-white hover:shadow-xl transition-shadow duration-300 ease-in-out"
                            >
                                <div class="p-5 relative">
                                    <x-icon variant="solid"
                                            class="w-10 h-10 mt-3 mr-2 text-white top-0 right-0 mb-10 absolute right-0"
                                            name="user-group"/>
                                    <h5 class="text-white text-lg leading-tight font-medium mb-10">Total Pegawai Active
                                        ({{ $totalPegawai['active'] }})</h5>
                                    <a href="{{ url('/pegawai?active=1') }}"
                                       class="bg-blue-400 hover:bg-blue-500 text-white py-1 px-2 rounded-b text-center absolute inset-x-0 bottom-0">Lihat</a>
                                </div>
                            </div>
                        </div>
                        <div class="inline-block px-3" style="width: 50%">
                            <div
                                class="bg-red-500 rounded-lg shadow-md bg-white hover:shadow-xl transition-shadow duration-300 ease-in-out"
                            >
                                <div class="p-5 relative ">
                                    <x-icon variant="solid"
                                            class="w-10 h-10 mt-3 mr-2 text-white top-0 right-0 mb-10 absolute right-0"
                                            name="user-group"/>
                                    <h5 class="text-white text-lg leading-tight font-medium mb-10">Total Pegawa Inactive
                                        ({{ $totalPegawai['inactive'] }})</h5>
                                    <a href="{{ url('/pegawai?active=0') }}"
                                       class="bg-blue-400 hover:bg-blue-500 text-white py-1 px-2 rounded-b text-center absolute inset-x-0 bottom-0">Lihat</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center mb-10 font-bold">Total kolom yang belum di update</div>
                <div
                    class="flex flex-col overflow-x-scroll pb-10 pt-10 hide-scroll-bar"
                >
                    <div
                        class="flex flex-nowrap lg:ml-40 md:ml-20 ml-10 "
                    >
                        @foreach($labels as $i => $label)
                            @if($label !== 'Employee Code')
                                <div class="inline-block px-3">
                                    <div
                                        style="background-color: {{ $bg[$i] }}"
                                        class="w-64 h-59 max-w-md overflow-hidden rounded-lg shadow-md bg-white hover:shadow-xl transition-shadow duration-300 ease-in-out"
                                    >
                                        <div class="p-5 max-w-sm relative ">
                                            <x-icon variant="solid"
                                                    class="w-10 h-10 mt-3 mr-2 text-white top-0 right-0 mb-10 absolute right-0"
                                                    name="{{ $icons[$i] }}"/>
                                            <h5 class="text-white text-lg leading-tight font-medium mb-10">{{ $label }}
                                                ({{ is_null($monitoring[$i]) ? 0 : $monitoring[$i] }})</h5>
                                            <a href="{{ route('monitoring.index', [ 'diffBy' => str_replace(' ' , '_', strtolower($label)) ]) }}"
                                               class="bg-blue-400 hover:bg-blue-500 text-white py-1 px-2 rounded-b text-center absolute inset-x-0 bottom-0">Lihat</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="text-center mt-10 mb-10 font-bold">Total kolom yang belum di isi pegawai active</div>
                <div
                    class="flex flex-col overflow-x-scroll pb-10 pt-10 hide-scroll-bar"
                >
                    <div
                        class="flex flex-nowrap lg:ml-40 md:ml-20 ml-10 "
                    >
                        @foreach($labels as $i => $label)
                            <div class="inline-block px-3">
                                <div
                                    style="background-color: {{ $bg[$i] }}"
                                    class="w-64 h-59 max-w-md overflow-hidden rounded-lg shadow-md bg-white hover:shadow-xl transition-shadow duration-300 ease-in-out"
                                >
                                    <div class="p-5 max-w-sm relative ">
                                        <x-icon variant="solid"
                                                class="w-10 h-10 mt-3 mr-2 text-white top-0 right-0 mb-10 absolute right-0"
                                                name="user"/>
                                        <h5 class="text-white text-lg leading-tight font-medium mb-10">{{ $label }}
                                            ({{ is_null($data[$i]) ? 0 : $data[$i] }})</h5>
                                        <a href="{{ $url[$i] }}"
                                           class="bg-blue-400 hover:bg-blue-500 text-white py-1 px-2 rounded-b text-center absolute inset-x-0 bottom-0">Lihat</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    <canvas id="barChart" width="600" height="250"></canvas>
                    <canvas id="pieChart" width="600" height="250"></canvas>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript">

    var labels = {{ Js::from($labels) }};
    var users = {{ Js::from($data) }};
    var bg = {{ Js::from($bg) }};

    const data = {
        labels: labels,
        datasets: [{
            label: 'My First dataset',
            backgroundColor: bg,
            borderColor: bg,
            data: users,
        }],
    };

    const configBar = {
        type: 'bar',
        data: data,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false,
                    labels: {
                        color: 'rgb(255, 99, 132)'
                    }
                }
            }
        }
    };

    const barChart = new Chart(
        document.getElementById('barChart'),
        configBar
    );

    const configPie = {
        type: 'pie',
        data: data,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'right'
                }
            }
        }
    };

    const pieChart = new Chart(
        document.getElementById('pieChart'),
        configPie
    );

</script>
