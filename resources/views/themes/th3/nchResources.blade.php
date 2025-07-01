@extends('layouts.themes')

@section('content')
@include("../themes.th3.includes.breadcrumb")

@php
    $langid1 = session()->get('locale') ?? 1;
@endphp

<div class="container mt-4">
    <div class="bg-white rounded-lg overflow-hidden">
        <!-- Title -->
        <div class="px-3 pt-3 pb-0">
            <h5 class="font-bold text-lg m-0 text-black">
                {{ $langid1 == 1 ? 'National Consumer Helpline Resources' : 'राष्ट्रीय उपभोक्ता हेल्पलाइन दस्तावेज़' }}
            </h5>
        </div>

        <!-- Document list -->
        <div class="px-3 pt-2 pb-3">

            <!-- Item 1 -->
          <div class="px-3 pt-2 pb-3">
                @foreach($ejagrati as $story)
                    <div class="bg-white shadow-sm rounded-b-lg px-3 py-2 mb-2">
                        {{ preg_replace('/^p(.*?)\/p$/', '$1', $story->description) }}
                    </div>
                @endforeach
            </div>
            <!-- You can add more items like below -->
            
			<span class="page-updated-date px-3 text-align-right position-sticky top-100">{{get_title('lastupdate',$langid1)->title}}: {{ get_last_updated_date($title) }} </span>
        </div>
    </div>
</div>
@endsection

