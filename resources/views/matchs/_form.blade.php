@php $m = $match ?? null; @endphp
<div class="grid grid-cols-1 md:grid-cols-2 gap-5">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Équipe A</label>
        <input type="text" name="equipe_a" value="{{ old('equipe_a', $m?->equipe_a) }}" placeholder="Nom de l'équipe A"
               class="block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('equipe_a') border-red-500 @enderror">
        @error('equipe_a')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Équipe B</label>
        <input type="text" name="equipe_b" value="{{ old('equipe_b', $m?->equipe_b) }}" placeholder="Nom de l'équipe B"
               class="block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('equipe_b') border-red-500 @enderror">
        @error('equipe_b')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>
    <div class="md:col-span-2">
        <label class="block text-sm font-medium text-gray-700 mb-1">Date et heure du match</label>
        <input type="datetime-local" name="date_match" value="{{ old('date_match', $m?->date_match?->format('Y-m-d\TH:i')) }}"
               class="block w-full px-3 py-2 border border-gray-300 rounded-md text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('date_match') border-red-500 @enderror">
        @error('date_match')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>
</div>
