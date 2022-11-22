<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pegawai ' . ($isActive ? 'Active' : 'Inactive') ) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @auth
                    <div class="flex flex-row justify-between">
                        <div class="basis-1/2">
                            @if($isActive)
                            <form action="{{ route('pegawai.importTmp') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="flex">
                                    <label class="block">
                                        <span class="sr-only">Pilih File Perbandingan</span>
                                        <input name="file" type="file" required class="block w-full text-sm text-slate-500
                                  file:mr-4 file:py-2 file:px-4
                                  file:rounded-full file:border-0
                                  file:text-sm file:font-semibold
                                  file:bg-violet-50 file:text-violet-700
                                  hover:file:bg-violet-100
                                "/>
                                    </label>
                                    <button type="submit" class="ml-3 focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-blue-500 hover:bg-blue-600 hover:shadow-lg">Bandingkan Data</button>
                                </div>
                            </form>
                            <br>
                            <form action="{{ route('pegawai.import') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="flex">
                                    <label class="block">
                                        <span class="sr-only">Pilih File Import</span>
                                        <input name="file" type="file" required class="block w-full text-sm text-slate-500
                                      file:mr-4 file:py-2 file:px-4
                                      file:rounded-full file:border-0
                                      file:text-sm file:font-semibold
                                      file:bg-violet-50 file:text-violet-700
                                      hover:file:bg-violet-100
                                    "/>
                                    </label>
                                    <button type="submit" class="ml-3 focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-blue-500 hover:bg-blue-600 hover:shadow-lg">Import</button>
                                </div>
                            </form>
                            @endif
                        </div>
                        <div class="flex basis-1/4 justify-end">
                            <a href="{{ route('pegawai.create', ['isActive' => $isActive])}}"
                               class="h-10 focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-green-500 hover:bg-green-600 hover:shadow-lg">Create</a>
                        </div>
                    </div>
                    @else
                    <a href="/">
                        <x-icon class="w-5 h-5 text-blue-600" name="arrow-left" />
                    </a>
                    @endauth

                    <div class="flex justify-end">
                            <form action="{{ route('pegawai.index') }}" method="GET" class="mt-6" >
                                @csrf
                                <input name="active" type="hidden" value="{{ $isActive }}">
                                <div class="flex">
                                    <label class="block">
                                        <input name="keyword" type="text" value="{{ $keyword }}" placeholder="Cari ..." class="block w-full text-sm text-slate-500"/>
                                    </label>
                                    <button type="submit" class="ml-3 focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-blue-500 hover:bg-blue-600 hover:shadow-lg">Cari</button>
                                </div>
                            </form>
                        <div class="flex items-center pt-6">
                            <a class="ml-5 focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-green-500 hover:bg-green-600 hover:shadow-lg" href="{{ route('pegawai.export') }}">Export</a>
                        </div>
                    </div>
                    <div
                        class="flex overflow-x-scroll pb-10 pt-5 hide-scroll-bar">
                        <table class="table-auto overflow-scroll w-full">
                            <thead>
                            <tr class="bg-gray-50 text-xs px-6 py-4">
                                @foreach($fields as $field)
                                    <th scope='col' class="w-20 px-4 py-2">{{ $field === 'Updated At' ? 'Last Mode Date' : $field }}</th>
                                @endforeach
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($pegawai as $employee)
                                <tr class="text-xs bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                                    @foreach($fields as $field)
                                        @php
                                            $field = str_replace(' ' , '_', strtolower($field));
                                        @endphp
                                        <td class="text-center pr-3 pl-3">{{ $employee->$field }}</td>
                                    @endforeach
                                    @auth
                                    <td class="text-center pr-3 pl-3">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('pegawai.destroy', $employee->employee_id) }}" method="POST">
                                            <a href="{{ route('pegawai.edit', $employee->employee_id) }}" class="btn btn-sm btn-primary">
                                                <x-icon class="w-5 h-5 text-yellow-600" name="pencil" />
                                            </a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <x-icon class="w-5 h-5 text-red-600" name="trash" />
                                            </button>
                                        </form>
                                    </td>
                                    @endauth
                                </tr>
                            @empty
                                <tr class="text-xs bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                                    <td colspan="{{ count($fields) }}" class="text-center font-bold p-5">Data belum Tersedia.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $pegawai->appends(['active' => $isActive, 'nullBy' => $nullBy])->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
