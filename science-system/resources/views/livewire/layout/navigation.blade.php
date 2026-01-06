<x-nav-link :href="route('publications.index')" :active="request()->routeIs('publications.*')">
    📚 {{ __('Publications') }}
</x-nav-link>