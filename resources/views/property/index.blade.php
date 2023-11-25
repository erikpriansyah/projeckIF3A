<x-guest-layout>
    {{-- Breadcrumb --}}
    <div class="shadow-md border-2 border-gray-300 py-2 bg-white mt-28">
        <div class="container mx-auto">
            <ul class="flex items-center">
                <li><a class="text-3xl text-red-800" href="{{ url('/') }}"><i class="fa fa-home"></i></a></li>
                <li class="mx-3"><i class="fa fa-angle-right"></i></li>
                <li>{{ __('') }}</li>PROPERTI
            </ul>
        </div>
    </div>

    <!-- Title & Share -->
    <div class="bg-white py-8">
        <div class="container mx-auto">
            <h2 class="text-3xl text-gray-600">{{ __('PROPERTI') }}
                @if(request('type') == 3)
                    - {{ __('TANAH') }}
                @elseif(request('type') == 1)
                    - {{ __('RUMAH') }}
                @elseif(request('type') == 2)
                    - {{ __('KOST') }}
                @endif
            </h2>


            @if ( !empty(request('sale')) || !empty(request('location')) || !empty(request('type')) || !empty(request('price')) || !empty(request('bedrooms')) )
                <h3 class="text-sm mt-1 font-normal">

                    MENAMPILKAN
                    @if (request('sale') == '2')
                        SEWA
                    @elseif (request('sale') == '1')
                        BELI
                    @endif

                    @if (request('type') == '3')
                        TANAH
                    @elseif (request('type') == '1')
                     RUMAH
                    @elseif (request('type') == '2')
                        KOST
                    @endif

                    @if ( !empty(request('bedrooms')) )
                        DENGAN
                        {{ request('bedrooms') }}
                            @if( request('bedrooms') == 1 )
                                {{ __('KAMAR') }}
                            @else
                            {{ __('KAMAR') }}
                            @endif
                    @endif

                    @if (request('price') == 100000)
                        within 0 {{ __('Tk') }} - 1,00,000 {{ __('Tk') }} Price Range
                    @elseif (request('price') == 200000)
                        within 1,00,000 {{ __('Tk') }} - 2,00,000 {{ __('Tk') }} Price Range
                    @elseif (request('price') == 300000)
                        within 2,00,000 {{ __('Tk') }} - 3,00,000 {{ __('Tk') }} Price Range
                    @elseif (request('price') == 400000)
                        within 3,00,000 {{ __('Tk') }} - 4,00,000 {{ __('Tk') }} Price Range
                    @elseif (request('price') == 500000)
                        and More than 5,00,000 {{ __('Tk') }} Price
                    @endif
                    UNTUK
                    {{-- {{ request('location') ?? 'all Location' }} --}}
                    @if(!empty(request('location')))
                        @foreach($locations as $location)
                            @if(request('location') == $location->id)LOKASI
                                {{$location->name}}
                            @endif
                        @endforeach
                    @else
                    SEMUA LOKASI
                    @endif
                </h3>
                <h4 class="text-sm font-normal"><span class="font-bold">{{ $latest_properties->total() }}</span> PROPERTI DITEMUKAN</h4>
            @endif



        </div>
    </div>

    <!-- Content -->
    <div class="container mx-auto py-10">
        <div class="flex justify-between">

            {{-- Left Content --}}
            <div class="w-9/12">
                <div class="flex flex-wrap -mx-2 mt-10">
                    @forelse ($latest_properties as $property)
                        @include('components.single-property-card', ['property' => $property, 'width' => 'w-1/3'])
                    @empty
                        <div class="text-center">{{ __('No Property Found') }}</div>
                    @endforelse
                </div>

                {{ $latest_properties->withQueryString()->links() }}
                {{-- {{$latest_properties->links()}} --}}

            </div>{{-- Left Content End --}}



            {{-- Sidebar --}}
            <div class="w-3/12 ml-6 vertical-search-form">
                <h2 class="text-black mb-3 text-center text-lg shadow-sm pb-2">{{ __('More Filter') }}</h2>
                @include('components.property-search-form')
            </div>


        </div>

    </div>
</x-guest-layout>
