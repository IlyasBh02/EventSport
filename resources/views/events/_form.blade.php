@php $e = $event ?? null; @endphp

<div class="grid grid-cols-1 md:grid-cols-2 gap-5">
    <div class="md:col-span-2">
        <label class="block text-sm font-medium text-gray-700 mb-1">Nom de l'événement</label>
        <input type="text" name="name" value="{{ old('name', $e?->name) }}" placeholder="Ex: Tournoi de Football Universitaire"
               class="block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('name') border-red-500 @enderror">
        @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Type de sport</label>
        <select name="sport_type_id"
                class="block w-full pl-3 pr-10 py-2 border border-gray-300 rounded-md text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-white @error('sport_type_id') border-red-500 @enderror">
            <option value="">-- Sélectionner --</option>
            @foreach($sportTypes as $st)
                <option value="{{ $st->id }}" {{ old('sport_type_id', $e?->sport_type_id) == $st->id ? 'selected' : '' }}>{{ $st->name }}</option>
            @endforeach
        </select>
        @error('sport_type_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Lieu</label>
        <input type="text" name="lieu" value="{{ old('lieu', $e?->lieu) }}" placeholder="Ex: Stade Municipal, Casablanca"
               class="block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('lieu') border-red-500 @enderror">
        @error('lieu')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Date et heure</label>
        <input type="datetime-local" name="date" value="{{ old('date', $e?->date?->format('Y-m-d\TH:i')) }}"
               class="block w-full px-3 py-2 border border-gray-300 rounded-md text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('date') border-red-500 @enderror">
        @error('date')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Capacité maximale</label>
        <input type="number" name="capacite_max" value="{{ old('capacite_max', $e?->capacite_max) }}" min="1" placeholder="Ex: 50"
               class="block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('capacite_max') border-red-500 @enderror">
        @error('capacite_max')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>

    <div class="md:col-span-2">
        <label class="block text-sm font-medium text-gray-700 mb-1">Description <span class="text-gray-400 font-normal">(optionnel)</span></label>
        <textarea name="description" rows="4" placeholder="Décrivez votre événement..."
                  class="block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm resize-none">{{ old('description', $e?->description) }}</textarea>
    </div>
</div>
