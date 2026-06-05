@extends('layouts.app')
@section('title', 'Gestion des Utilisateurs')
 
@section('content')
<div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-sm text-slate-500 hover:text-indigo-600 mb-2 transition-colors">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Retour au Dashboard
        </a>
        <h1 class="text-2xl font-bold text-slate-800">Gestion des Utilisateurs</h1>
        <p class="text-slate-500 text-sm mt-1">Gérez les rôles et les comptes des membres de la plateforme</p>
    </div>
</div>
 
<div class="border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-slate-50 text-xs font-semibold text-slate-500 uppercase tracking-wider border-b border-slate-100">
                    <th class="px-6 py-3 text-left">Nom / Email</th>
                    <th class="px-6 py-3 text-left">Date d'inscription</th>
                    <th class="px-6 py-3 text-left">Rôle Actuel</th>
                    <th class="px-6 py-3 text-left">Modifier le Rôle</th>
                    <th class="px-6 py-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($users as $user)
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="font-bold text-slate-850">{{ $user->name }}</div>
                        <div class="text-xs text-slate-400 mt-0.5">{{ $user->email }}</div>
                    </td>
                    <td class="px-6 py-4 text-slate-500">
                        {{ $user->created_at->format('d M Y') }}
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-block text-xs font-bold px-2.5 py-1 rounded-full 
                            @if($user->isAdmin()) bg-purple-100 text-purple-700 
                            @elseif($user->isOrganisateur()) bg-green-100 text-green-700 
                            @else bg-blue-100 text-blue-700 @endif">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <form method="POST" action="{{ route('users.update', $user) }}" class="flex items-center gap-2">
                            @csrf
                            @method('PUT')
                            <select name="role" onchange="this.form.submit()" class="block text-xs rounded-lg border-slate-350 bg-white py-1 px-2 text-slate-700 focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="participant" {{ $user->role === 'participant' ? 'selected' : '' }}>Participant</option>
                                <option value="organisateur" {{ $user->role === 'organisateur' ? 'selected' : '' }}>Organisateur</option>
                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                        </form>
                    </td>
                    <td class="px-6 py-4 text-center">
                        @if($user->id !== auth()->id())
                        <form method="POST" action="{{ route('users.destroy', $user) }}" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ? Cette action est irréversible.')" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-xs font-semibold text-red-600 hover:text-red-800 bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded-lg transition-colors">
                                Supprimer
                            </button>
                        </form>
                        @else
                        <span class="text-xs text-slate-400 italic">Votre Compte</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
 
<div class="mt-6">
    {{ $users->links() }}
</div>
@endsection
