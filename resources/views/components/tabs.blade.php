<div x-data="{ currentTab: '{{ $tabs[0]['id'] }}' }">
    <div class="border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                @foreach($tabs as $tab)
                    <a href="{{ $tab['href'] }}"
                       class="{{ $tab['id'] === $id ? 'border-primary-500 text-primary-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        {{ $tab['title'] }}
                    </a>
                @endforeach
            </nav>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{ $slot }}
    </div>
</div>

<script>
    function currentTabIs(tab) {
        return window.location.href.includes(tab);
    }
</script>
