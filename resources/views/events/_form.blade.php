@php $e = $event ?? null; @endphp

<div class="space-y-4">
    <div>
        <label class="block text-sm font-medium text-gray-700">Nom</label>
        <input type="text" name="name" value="{{ old('name', $e?->name) }}" class="mt-1 w-full border rounded px-3 py-2 @error('name') border-red-500 @enderror">
        @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700">Lieu</label>
        <input type="text" name="lieu" value="{{ old('lieu', $e?->lieu) }}" class="mt-1 w-full border rounded px-3 py-2 @error('lieu') border-red-500 @enderror">
        @error('lieu')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700">Date</label>
        <input type="datetime-local" name="date" value="{{ old('date', $e?->date?->format('Y-m-d\TH:i')) }}" class="mt-1 w-full border rounded px-3 py-2 @error('date') border-red-500 @enderror">
        @error('date')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700">Capacité maximale</label>
        <input type="number" name="capacite_max" value="{{ old('capacite_max', $e?->capacite_max) }}" min="1" class="mt-1 w-full border rounded px-3 py-2 @error('capacite_max') border-red-500 @enderror">
        @error('capacite_max')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700">Type de sport</label>
        <select name="sport_type_id" class="mt-1 w-full border rounded px-3 py-2 @error('sport_type_id') border-red-500 @enderror">
            <option value="">-- Choisir --</option>
            @foreach($sportTypes as $st)
                <option value="{{ $st->id }}" {{ old('sport_type_id', $e?->sport_type_id) == $st->id ? 'selected' : '' }}>{{ $st->name }}</option>
            @endforeach
        </select>
        @error('sport_type_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700">Description</label>
        <textarea name="description" rows="3" class="mt-1 w-full border rounded px-3 py-2">{{ old('description', $e?->description) }}</textarea>
    </div>
</div>
