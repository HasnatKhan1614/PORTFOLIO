@extends('layouts.app')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css">

@section('content')
    <style>
        .store-content {
            display: flex;
            flex-wrap: wrap;
            list-style: none;
            margin: 0 12px;
            padding: 0;
            justify-content: start;
        }

        .store-content .galad-container {
            position: relative;
            display: block;
            min-width: 300px;
            min-height: 420px;
            margin: 4px;
            border: 1px solid #d3d3d3;
            border-radius: 1px;
            background: #fff;
            transform: scale(1);
            transition: all 0.3s ease;
            cursor: pointer;
            overflow: hidden;
            box-sizing: border-box;
        }

        .store-content .galad-wrapper {
            margin: 0;
            background: 0 0;
            border: 0;
            border-color: none;
            padding: 0;
            text-align: unset;
            min-width: 300px;
            min-height: 300px;
            max-height: 395px;
            display: block;
        }

        .galad-title-container {
            padding: 12px 16px;
            position: absolute;
            z-index: 999;
            background-color: rgba(23, 23, 23, 0.6);
            width: 100%;
            transition: 0.26s all ease-in-out;
            top: 0;
        }

        .galad-info-container {
            padding: 12px 16px;
            position: absolute;
            z-index: 999;
            background-color: rgba(23, 23, 23, 0.6);
            min-width: 300px;
            width: 100%;
            transition: 0.26s all ease-in-out;
        }

        .galad-title-container {
            top: 0;
        }

        .galad-info-container {
            bottom: 0;
        }

        .galad-ymm {
            font-family: Roboto, Arial, sans-serif;
            font-size: 18px;
            font-weight: 600;
            color: white;
        }

        .galad-img-container {
            position: relative;
            height: 420px;
            width: 100%;
            background: #e3e3e3;
            overflow: hidden;
        }

        .galad-img-bg {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            filter: blur(8px);
            background-size: cover;
            transform: scale(1.1);
            overflow: hidden;
            background-position: center;
        }

        .galad-img-wrapper {
            position: absolute;
            top: 0;
            right: 0;
            left: 0;
            bottom: 10%;
        }

        .galad-img-wrapper img {
            display: block;
            position: absolute;
            margin: auto;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            max-height: 100%;
            max-width: 100%;
            transition: all 0.3s ease-in-out;
            z-index: 11;
        }

        .galad-specs-large,
        .galad-specs-small {
            display: block;
            font-family: Roboto, Arial, sans-serif;
            color: white;
        }

        .galad-specs-large {
            font-weight: 600;
            color: white;
            font-size: 16px;
        }

        .galad-specs-small {
            font-weight: 400;
            color: white;
            font-size: 14px;
        }

        .galad-info-container {
            padding: 5px 10px;
            box-sizing: border-box;
        }

        .store-content .galad-wrapper:hover .galad-img-wrapper img {
            transform: scale(1.04);
        }

        .store-content .galad-wrapper:hover .galad-info-container,
        .store-content .galad-wrapper:hover .galad-title-container {
            background-color: rgba(23, 23, 23, 1);
        }

        .galad-container a:hover {
            color: #d00;
            text-decoration: none;
        }

        @media screen and (max-width: 796px) {
            .store-content .galad-wrapper {
                margin: 0;
                background: 0 0;
                border: 0;
                border-color: none;
                padding: 0;
                text-align: unset;
            }

            .store-content .galad-container {
                border: 0;
                border-top: 1px solid #d3d3d3;
                width: 100%;
                margin: 8px 0 0 0;
            }
        }

        @media screen and (min-width: 1400px) {
            .store-content .galad-container {
                width: 24%;
            }
        }

        .dropdown-toggle {
            background: transparent;
            border: none;
            outline: none;
            border: 1px solid #C7BFBF;
            padding: .5rem;
            margin-bottom: 1rem;
            width: 100%;
            position: relative;
            text-align: left;


        }

        .dropdown-toggle::after {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            right: 14px;
        }

        .dropdown-menu {
            height: 15rem;
            overflow-y: scroll;
            width: 100%;
        }

        /* .menu{
                height: 15rem;
                overflow-y: scroll;
                width: 100%;
            }  */
    </style>

    @php
        $types = App\Models\Variation::select('type', 'name')->get();

        $formattedTypes = $types
            ->groupBy('type')
            ->map(function ($group) {
                return [
                    'type' => $group->first()->type,
                    'names' => $group->pluck('name')->toArray(),
                ];
            })
            ->values()
            ->toArray();
    @endphp

    <section class="gallery-banner mb-5">
        <div class="overlay"></div>
        <div class="container z-2 position-relative">
            <div class="row">
                <div class="col-lg-12 text-center"> <!-- Added text-center class -->
                    <h1>GALLERY</h1>
                    {{-- <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p> --}}
                    {{-- <a href="#" class="my-btn">shop now!</a> --}}
                </div>
            </div>
        </div>
    </section>

    <section id="gallery" class="mb-5">
        <div class="container">
            <div id="image-gallery">
                <div class="row mb-4">
                    <div class="col-12 text-black">
                        <h5 class="font-monsteret heading-color">GALLERY</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">

                        <div class="card">
                            <div class="card-body d-flex justify-content-center">
                                <form action="{{ route('gallery') }}" method="POST" style="width: 100%;">
                                    @csrf
                                    <div class="mb-3 text-center">
                                        <h6>FITMENT GALLERY</h6>
        
                                        @php
                                            $types = App\Models\Variation::select('type', 'name')->get();
        
                                            $formattedTypes = $types
                                                ->groupBy('type')
                                                ->map(function ($group) {
                                                    return [
                                                        'type' => $group->first()->type,
                                                        'names' => $group->pluck('name')->toArray(),
                                                    ];
                                                })
                                                ->values()
                                                ->toArray();
                                        @endphp
        
                                        <!-- Year Select Dropdown -->
                                        <div class="mb-3">
                                            <select class="form-select" id="yearSelect" name="year">
                                                @php
                                                    $currentYear = date('Y');
                                                @endphp
                                                @for ($year = $currentYear; $year >= 1923; $year--)
                                                    <option value="{{ (int) $year }}"
                                                        {{ request('year') == $year ? 'selected' : '' }}>
                                                        {{ $year }}
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>
        
                                        <!-- Make Select Dropdown -->
                                        <div class="mb-3">
                                            <select class="form-select" id="makeSelect" name="make[]">
                                                <option selected>Select Make</option>
                                            </select>
                                        </div>
        
                                        <!-- Model Select Dropdown -->
                                        <div class="mb-3">
                                            <select class="form-select" id="modelSelect" name="model[]">
                                                <option selected>Select Model</option>
                                            </select>
                                        </div>
        
                                        <!-- Suspension Select Dropdown -->
                                        <h6>FITMENT PREFERENCES</h6>
        
                                        <!-- Modification Select Dropdown -->
        
                                        <div class="mb-3">
                                            <select class="form-select" id="suspensionSelect" name="suspension[]">
                                                <option value="" {{ request('suspension') == '' ? 'selected' : '' }}>Select
                                                    Suspension</option>
                                                @foreach ($formattedTypes as $type)
                                                    @if ($type['type'] === 'Suspension')
                                                        @foreach ($type['names'] as $name)
                                                            <option value="{{ $name }}"
                                                                {{ request('suspension') == $name ? 'selected' : '' }}>
                                                                {{ $name }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
        
                                        <!-- Modification Select Dropdown -->
                                        <div class="mb-3">
                                            <select class="form-select" id="modificationSelect" name="modification[]">
                                                <option value="" {{ request('modification') == '' ? 'selected' : '' }}>Select
                                                    Modification</option>
                                                @foreach ($formattedTypes as $type)
                                                    @if ($type['type'] === 'Modification')
                                                        @foreach ($type['names'] as $name)
                                                            <option value="{{ $name }}"
                                                                {{ request('modification') == $name ? 'selected' : '' }}>
                                                                {{ $name }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
        
                                        <!-- Rubbing Select Dropdown -->
                                        <div class="mb-3">
                                            <select class="form-select" id="rubbingSelect" name="rubbing[]">
                                                <option value="" {{ request('rubbing') == '' ? 'selected' : '' }}>Select
                                                    Rubbing</option>
                                                @foreach ($formattedTypes as $type)
                                                    @if ($type['type'] === 'Rubbing')
                                                        @foreach ($type['names'] as $name)
                                                            <option value="{{ $name }}"
                                                                {{ request('rubbing') == $name ? 'selected' : '' }}>
                                                                {{ $name }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
        
                                        <h6>ACTIVE FILTERS</h6>
        
                                        <!-- Checkbox Dropdowns -->
                                        @foreach ($formattedTypes as $type)
                                        @if($type['type'] !== 'Suspension' && $type['type'] !== 'Modification' && $type['type'] !== 'Rubbing')    
                                        <div class="dropdown">
                                            <button class="dropdown-toggle" type="button" id="dropdownMenuButton{{ $loop->index }}" data-bs-toggle="dropdown" aria-expanded="false">
                                                {{ $type['type'] }}
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $loop->index }}">
                                                @foreach ($type['names'] as $name)
                                                    <li>
                                                        <div class="form-check m-2">
                                                            @php
                                                                $type = strtolower(preg_replace('/\s+/', '_', $type['type'] ?? ''));
                                                            @endphp
                                                            <input class="form-check-input" type="checkbox" value="{{ $name }}" name="{{ $type }}[]" id="checkbox{{ $loop->parent->index }}{{ $loop->index }}" {{ request()->has('preferences') && in_array($name, request()->input('preferences')) ? 'checked' : '' }}>
                                                            <label class="form-check-label checkbox-label" for="checkbox{{ $loop->parent->index }}{{ $loop->index }}">
                                                                {{ $name }}
                                                            </label>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif
                                        @endforeach
                                    </div>
        
                                    <div class="mb-3 d-flex justify-content-center">
                                        <div class="row">
                                            <div class="col">
                                                <button type="submit" class="my-btn">Search</button>
                                            </div>
                                        </div>
                                    </div>
        
                                </form>
                            </div>
                          </div>
                    </div>
                    <div class="col-9">
                        <div class="store-content">
                            @if (count($gallery) > 0)
                                @foreach ($gallery as $item)
                                    <li class="galad-container">
                                        <a href="{{ url('/gallery-detail',$item->id) }}"
                                            class="galad-wrapper" data-fancybox="group">

                                            <div class="galad-title-container">
                                                <h2 class="galad-ymm" id="galad-ymm-title">
                                                    {{ $item->year }} {{ $item->make }} <br />
                                                    {{ $item->model }}
                                                </h2>
                                            </div>

                                            <div class="galad-img-container">
                                                <div class="galad-img-hover"></div>
                                                <div class="galad-img-bg"
                                                    style="background-image: url({{ env('ASSET_URL') }}/storage/{{ $item->image }});">
                                                </div>
                                                <div class="galad-img-wrapper">
                                                    <img src="{{ asset('storage/'.$item->image1) }}" alt="" title="" />
                                                </div>
                                            </div>
                                            <div class="galad-info-container">
                                                <div class="galad-specs" id="wheel">
                                                    <h2 class="galad-specs-large">{{ $item->suspension_brand }}</h2>
                                                    <h3 class="galad-specs-small">{{ $item->wheel_diameter }}</h3>
                                                </div>
                                                <div class="galad-specs" id="tire">
                                                    <h2 class="galad-specs-large">{{ $item->tire_brand }}</h2>
                                                    <h3 class="galad-specs-small">{{ $item->tire_model }}</h3>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            @else
                                <p>No items found in the gallery.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div><!-- End image gallery -->
        </div><!-- End container -->
    </section>
@endsection

@section('script')
    {{-- <script src="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    <script>
        $('[data-fancybox]').fancybox({
            // Options will go here
            buttons: [
                'close'
            ],
            wheel: false,
            transitionEffect: "slide",
            // thumbs          : false,
            // hash            : false,
            loop: true,
            // keyboard        : true,
            toolbar: false,
            // animationEffect : false,
            // arrows          : true,
            clickContent: false
        });
    </script> --}}



    <script>
        $(document).ready(function() {
            $('#yearSelect').change(function() {
                var year = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('getMakes') }}",
                    data: {
                        year: year
                    },
                    success: function(data) {
                        var makes = data;
                        var makeSelect = $('#makeSelect');
                        makeSelect.empty();
                        makeSelect.append($('<option>', {
                            value: '',
                            text: 'Select Make'
                        }));
                        $.each(makes, function(index, value) {
                            makeSelect.append($('<option>', {
                                value: value,
                                text: value
                            }));
                        });
                        // Enable the make dropdown
                        makeSelect.prop('disabled', false);
                    }
                });
            });

            $('#makeSelect').change(function() {
                var make = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('getModels') }}",
                    data: {
                        make: make
                    },
                    success: function(data) {
                        var models = data;
                        var modelSelect = $('#modelSelect');
                        modelSelect.empty();
                        modelSelect.append($('<option>', {
                            value: '',
                            text: 'Select Model'
                        }));
                        $.each(models, function(index, value) {
                            modelSelect.append($('<option>', {
                                value: value,
                                text: value
                            }));
                        });
                        // Enable the model dropdown
                        modelSelect.prop('disabled', false);
                    }
                });
            });
        });
    </script>
@endsection
