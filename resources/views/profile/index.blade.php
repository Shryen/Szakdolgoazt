<x-layout>
    <div class="profile">
        <div class="profile-avatar">{{ mb_substr($user->first_name, 0, 1) }}{{ mb_substr($user->last_name, 0, 1) }}</div>

        <h1 class="profile-name">{{ $user->first_name }} {{ $user->last_name }}</h1>

        <span class="profile-role">
            {{ match($user->role) { 'teacher' => 'Tanár', 'admin' => 'Admin', default => 'Diák' } }}
        </span>

        <div class="profile-links">
            @if($user->role->value === 'student')
                @if($user->school_class_id)
                    <a href="/jegyek/{{ $user->school_class_id }}/{{ $user->id }}" class="profile-link">Jegyeim</a>
                @endif
                <a href="/profil/orarend" class="profile-link">Órarendem</a>
                <a href="/profil/hianyzas" class="profile-link">Hiányzásaim</a>
            @else
                <a href="/jegyek" class="profile-link">Jegyek beírása</a>
                <a href="/hianyzas" class="profile-link">Órarend és hiányzások</a>
            @endif
            <a href="/uzenetek" class="profile-link">Üzenetek</a>
        </div>

        <dl class="profile-details">
            <div>
                <dt>Felhasználónév</dt>
                <dd>{{ $user->username }}</dd>
            </div>
            @if($user->school_class_id)
                <div>
                    <dt>Osztály</dt>
                    <dd>{{ $user->schoolClass?->name }}</dd>
                </div>
            @endif
            <div>
                <dt>OM azonosító</dt>
                <dd>{{ $user->om_id }}</dd>
            </div>
            <div>
                <dt>Anyja neve</dt>
                <dd>{{ $user->mothers_name }}</dd>
            </div>
            <div>
                <dt>Lakcím</dt>
                <dd>{{ $user->address }}</dd>
            </div>
            @if($user->email)
                <div>
                    <dt>E-mail</dt>
                    <dd>{{ $user->email }}</dd>
                </div>
            @endif
        </dl>
    </div>
</x-layout>