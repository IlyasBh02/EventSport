@php $e = $event ?? null; @endphp

<div class="grid grid-cols-1 md:grid-cols-2 gap-5">
    <div class="md:col-span-2">
        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nom de l'événement</label>
        <input type="text" name="name" value="{{ old('name', $e?->name) }}"
               placeholder="Ex: Tournoi de Football Universitaire"
               class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition @error('name') border-red-400 bg-red-50 @enderror">
        @error('name')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
    </div>

    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Type de sport</label>
        <select name="sport_type_id"
                class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition bg-white @error('sport_type_id') border-red-400 @enderror">
            <option value="">-- Sélectionner --</option>
            @foreach($sportTypes as $st)
                <option value="{{ $st->id }}" {{ old('sport_type_id', $e?->sport_type_id) == $st->id ? 'selected' : '' }}>
                    {{ $st->name }}
                </option>
            @endforeach
        </select>
        @error('sport_type_id')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
    </div>

    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Lieu</label>
        <input type="text" name="lieu" value="{{ old('lieu', $e?->lieu) }}"
               placeholder="Ex: Stade Municipal, Casablanca"
               class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition @error('lieu') border-red-400 bg-red-50 @enderror">
        @error('lieu')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
    </div>

    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Date et heure</label>
        <input type="datetime-local" name="date" value="{{ old('date', $e?->date?->format('Y-m-d\TH:i')) }}"
               class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition @error('date') border-red-400 bg-red-50 @enderror">
        @error('date')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
    </div>

    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Capacité maximale</label>
        <input type="number" name="capacite_max" value="{{ old('capacite_max', $e?->capacite_max) }}"
               min="1" placeholder="Ex: 50"
               class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition @error('capacite_max') border-red-400 bg-red-50 @enderror">
        @error('capacite_max')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
    </div>

    <div class="md:col-span-2">
        <label class="block text-sm font-semibold text-slate-700 mb-1.5">
            Description <span class="text-slate-400 font-normal">(optionnel)</span>
        </label>
        <textarea name="description" rows="4" placeholder="Décrivez votre événement..."
                  class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition resize-none">{{ old('description', $e?->description) }}</textarea>
    </div>
</div>
