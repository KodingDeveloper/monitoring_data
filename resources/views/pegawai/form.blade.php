<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Pegawai ' . ($isActive ? 'Active' : 'Inactive')) }}
        </h2>
    </x-slot>

    <div class="font-sans antialiased">
        <div class="flex flex-col items-center min-h-screen pt-6 bg-gray-100 sm:justify-center sm:pt-0">

            <div class="w-full px-16 py-20 mt-6 overflow-hidden bg-white rounded-lg lg:max-w-4xl">

                <div class="mb-4">
                    <h1 class="font-serif text-3xl font-bold">Create Pegawai {{ isset($pegawai) ? ($pegawai->status === 'A' ? 'Active' : 'Inactive') : 'Active' }}</h1>
                </div>

                <div class="w-full px-6 py-4 bg-white rounded shadow-md ring-1 ring-gray-900/10">
                    <form method="POST" action="{{ isset($pegawai) ? route('pegawai.update', $pegawai->employee_id) : route('pegawai.index', ['active' => (isset($pegawai) ? $pegawai->status : $isActive)]) }}">
{{--                        <input type="hidden" name="status" value="{{ isset($pegawai) ? $pegawai->status : ($isActive ? 'A' : 'Z') }}">--}}
                        @csrf
                        @if(isset($pegawai))
                            @method('PUT')
                        @endif
                        @foreach($fields as $field)
                            @php
                                $fieldName = str_replace(' ' , '_', strtolower($field));
                            @endphp
{{--                            @if(!in_array($fieldName, ['status', 'status_desc']))--}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700" for="title">
                                    {{ $field }} {{ $fieldName === 'employee_code' ? '*' : '' }}
                                </label>

                                <input
                                    {{ $fieldName === 'employee_code' ? 'required' : '' }}
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    type="text" name="{{ $fieldName }}" placeholder="{{ $field }}" value="{{ old($fieldName, isset($pegawai) ? $pegawai->$fieldName : '') }}">
                                @error('title')
                                <span class="text-red-600 text-sm">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
{{--                            @endif--}}
                        @endforeach

                        <div class="flex items-center justify-start mt-4">
                            <button type="submit"
                                    class="inline-flex items-center px-6 py-2 text-sm font-semibold rounded-md text-sky-100 bg-sky-500 hover:bg-sky-700 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
