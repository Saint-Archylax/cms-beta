@extends('layouts.app')

@section('content')
<style>
  .soft-card{box-shadow:0 14px 24px rgba(0,0,0,.18)}
  .tab-underline{position:relative}
  .tab-underline.active:after{content:"";position:absolute;left:0;right:0;bottom:-10px;height:3px;background:#111;border-radius:999px}
</style>

<div class="min-h-screen bg-[#ECECEC] px-10 py-8">
  {{-- Header --}}
  <div class="flex items-start justify-between">
    <div>
      <h1 class="text-2xl font-bold text-[#111]">Inventory Management</h1>
    </div>

    <form method="GET" class="w-[520px] max-w-full">
      <div class="relative">
        <input name="search" value="{{ request('search') }}" placeholder="Search"
               class="w-full rounded-full border border-gray-400 bg-[#EDEDED] px-6 py-2 pr-12 text-sm outline-none">
        <div class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-600">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
            <path d="M10.5 18a7.5 7.5 0 1 1 0-15 7.5 7.5 0 0 1 0 15Z" stroke="currentColor" stroke-width="2"/>
            <path d="M16.5 16.5 21 21" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
          </svg>
        </div>
      </div>
    </form>
  </div>

  {{-- Tabs --}}
  <div class="mt-10 flex items-center gap-12 text-sm font-semibold text-gray-500">
    <a href="{{ route('inventory.index') }}" class="tab-underline active text-black">Overview</a>
    <a href="{{ route('inventory.stock-inout') }}" class="tab-underline hover:text-black">Stock-in / Stock-out</a>
    <a href="{{ route('inventory.threshold') }}" class="tab-underline hover:text-black">Set Threshold</a>
    <a href="{{ route('inventory.history') }}" class="tab-underline hover:text-black">Stock History</a>
  </div>

  {{-- Outer light frame --}}
  <div class="mt-6 rounded-2xl border border-gray-400 bg-[#E6E6E6] p-6">
    <div class="rounded-2xl border border-gray-500 bg-[#3E3E3E] overflow-hidden soft-card">
      <div class="grid grid-cols-12 px-10 py-6 text-[#F5C400] font-semibold">
        <div class="col-span-4 text-center">Material</div>
        <div class="col-span-3 text-center">Supplier</div>
        <div class="col-span-3 text-center">Remaining Stock</div>
        <div class="col-span-2 text-center">Price</div>
      </div>

      <div class="h-[1px] bg-gray-500 mx-10"></div>

      @forelse($materials as $m)
        <div class="grid grid-cols-12 items-center px-10 py-7 text-white">
          <div class="col-span-4 flex items-center gap-3">
            @if($m->is_low)
              <span class="text-[#F5C400]">
                ⚠
              </span>
            @endif
            <span class="text-lg">{{ $m->material_name }}</span>
          </div>

          <div class="col-span-3 text-center font-semibold">{{ $m->supplier ?? '—' }}</div>

          <div class="col-span-3 text-center">
            {{ rtrim(rtrim(number_format((float)$m->stock, 2, '.', ''), '0'), '.') }} {{ $m->unit }}
          </div>

          <div class="col-span-2 text-center">
            ₱{{ number_format((float)$m->unit_price, 2) }}/{{ $m->unit }}
          </div>
        </div>

        <div class="h-[1px] bg-gray-600 mx-10"></div>
      @empty
        <div class="px-10 py-12 text-center text-gray-300">No materials found.</div>
      @endforelse
    </div>
  </div>
</div>
@endsection
