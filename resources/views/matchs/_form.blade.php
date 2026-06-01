@php $m = $match ?? null; @endphp

<div class="space-y-4">
    <div>
        <label class="block text-sm font-medium text-gray-700">Équipe A</label>
        <input type="text" name="equipe_a" value="{{ old('equipe_a', $m?->equipe_a) }}" class="mt-1 w-full border rounded px-3 py-2 @error('equipe_a') border-red-500 @enderror">
        @error('equipe_a')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700">Équipe B</label>
        <input type="text" name="equipe_b" value="{{ old('equipe_b', $m?->equipe_b) }}" class="mt-1 w-full border rounded px-3 py-2 @error('equipe_b') border-red-500 @enderror">
        @error('equipe_b')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700">Date du match</label>
        <input type="datetime-local" name="date_match" value="{{ old('date_match', $m?->date_match?->format('Y-m-d\TH:i')) }}" class="mt-1 w-full border rounded px-3 py-2 @error('date_match') border-red-500 @enderror">
        @error('date_match')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>
</div>
