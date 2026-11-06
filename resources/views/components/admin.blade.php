<div class="admin-panel">
    <div class="admin-nav">
        <x-navlink href="/register">Diák felvétele</x-navlink>
        <x-navlink href="/hirfolyam/letrehozas">Hír létrehozása</x-navlink>
        <x-navlink href="/jegyek" match="jegyek*">Jegyek beírása</x-navlink>
        <x-navlink href="/hianyzas" match="hianyzas*">Hiányzások</x-navlink>
    </div>
    <div class="admin-content">
        {{$slot}}
    </div>
</div>