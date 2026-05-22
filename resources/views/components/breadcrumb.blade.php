{{--
    Breadcrumb Component
    Usage: <x-breadcrumb :items="[['label'=>'Dashboard','url'=>url('/')], ['label'=>'Documents','url'=>route('documents.index')], ['label'=>'Detail']]" />
    Last item = current page (no URL needed).
--}}
@props(['items' => []])

<nav class="flex items-center gap-1.5 text-xs font-medium text-slate-400 mb-5 flex-wrap">
    <i class="bi bi-house-fill text-slate-300 text-sm"></i>
    @foreach($items as $index => $item)
        @if(!$loop->last)
            <a href="{{ $item['url'] }}" class="hover:text-blue-600 transition-colors truncate max-w-[160px]">
                {{ $item['label'] }}
            </a>
            <i class="bi bi-chevron-right text-[9px] text-slate-300 shrink-0"></i>
        @else
            <span class="text-slate-600 font-semibold truncate max-w-[200px]">{{ $item['label'] }}</span>
        @endif
    @endforeach
</nav>
