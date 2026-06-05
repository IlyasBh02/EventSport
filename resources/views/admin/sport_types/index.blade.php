@extends('layouts.app')
@section('title', 'Gestion des Catégories de Sport')
 
@section('content')
<div class="mb-8">
    <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-sm text-slate-500 hover:text-indigo-600 mb-2 transition-colors">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        Retour au Dashboard
    </a>
    <h1 class="text-2xl font-bold text-slate-800">Gestion des Catégories de Sport</h1>
    <p class="text-slate-500 text-sm mt-1">Gérez les types de sport disponibles pour la création d'événements</p>
</div>
 
<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
    {{-- Form card --}}
    <div class="md:col-span-1">
        <div class="border border-slate-200 rounded-2xl p-6 shadow-sm sticky top-20">
            <h3 class="text-base font-bold text-slate-800 mb-4" id="formTitle">Ajouter une Catégorie</h3>
            
            <form id="sportTypeForm" method="POST" action="{{ route('sport-types.store') }}">
                @csrf
                <div id="methodField"></div>
                <div class="mb-4">
                    <label for="name" class="block text-sm font-semibold text-slate-700 mb-1">Nom du sport</label>
                    <input type="text" name="name" id="name" required placeholder="Ex: Football, Tennis"
                           class="block w-full rounded-xl border border-slate-300 py-2 px-3 text-sm focus:border-indigo-500 focus:ring-indigo-500 @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="flex items-center gap-2">
                    <button type="submit" id="submitBtn" class="flex-1 justify-center inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-xl transition-colors shadow-sm shadow-indigo-200">
                        Ajouter
                    </button>
                    <button type="button" id="cancelBtn" onclick="resetForm()" class="hidden px-4 py-2 border border-slate-200 hover:bg-slate-50 text-slate-500 text-sm font-semibold rounded-xl transition-colors">
                        Annuler
                    </button>
                </div>
            </form>
        </div>
    </div>
 
    {{-- Listing card --}}
    <div class="md:col-span-2">
        <div class="border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100">
                <h3 class="font-bold text-slate-800 text-base">Catégories existantes</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-slate-50 text-xs font-semibold text-slate-500 uppercase tracking-wider border-b border-slate-100">
                            <th class="px-6 py-3 text-left">Nom de la catégorie</th>
                            <th class="px-6 py-3 text-center">Événements liés</th>
                            <th class="px-6 py-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($sportTypes as $sportType)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4 font-bold text-slate-800">
                                {{ $sportType->name }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-2.5 py-1 text-xs font-semibold bg-slate-100 text-slate-600 rounded-full">
                                    {{ $sportType->events_count }} événement(s)
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center flex items-center justify-center gap-2">
                                <button type="button" onclick="editSportType({{ $sportType->id }}, '{{ addslashes($sportType->name) }}')"
                                        class="px-3 py-1.5 border border-yellow-250 bg-yellow-50 hover:bg-yellow-100 text-yellow-700 text-xs font-bold rounded-lg transition-colors">
                                    Modifier
                                </button>
                                
                                @if($sportType->events_count === 0)
                                <form method="POST" action="{{ route('sport-types.destroy', $sportType) }}" onsubmit="return confirm('Voulez-vous supprimer cette catégorie ?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="px-3 py-1.5 border border-red-200 bg-red-50 hover:bg-red-100 text-red-650 text-xs font-bold rounded-lg transition-colors">
                                        Supprimer
                                    </button>
                                </form>
                                @else
                                <button disabled class="px-3 py-1.5 border border-slate-200 bg-slate-50 text-slate-400 text-xs font-bold rounded-lg cursor-not-allowed" title="Catégorie utilisée par des événements">
                                    Supprimer
                                </button>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-12 text-center text-slate-400">
                                Aucune catégorie de sport disponible.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
 
@push('scripts')
<script>
    function editSportType(id, name) {
        const form = document.getElementById('sportTypeForm');
        const formTitle = document.getElementById('formTitle');
        const submitBtn = document.getElementById('submitBtn');
        const cancelBtn = document.getElementById('cancelBtn');
        const methodField = document.getElementById('methodField');
        const nameInput = document.getElementById('name');
 
        // Set update action
        form.action = `/admin/sport-types/${id}`;
        formTitle.textContent = "Modifier la Catégorie";
        submitBtn.textContent = "Mettre à jour";
        cancelBtn.classList.remove('hidden');
        nameInput.value = name;
        methodField.innerHTML = `<input type="hidden" name="_method" value="PUT">`;
        
        nameInput.focus();
    }
 
    function resetForm() {
        const form = document.getElementById('sportTypeForm');
        const formTitle = document.getElementById('formTitle');
        const submitBtn = document.getElementById('submitBtn');
        const cancelBtn = document.getElementById('cancelBtn');
        const methodField = document.getElementById('methodField');
        const nameInput = document.getElementById('name');
 
        form.action = "{{ route('sport-types.store') }}";
        formTitle.textContent = "Ajouter une Catégorie";
        submitBtn.textContent = "Ajouter";
        cancelBtn.classList.add('hidden');
        nameInput.value = '';
        methodField.innerHTML = '';
    }
</script>
@endpush
@endsection
