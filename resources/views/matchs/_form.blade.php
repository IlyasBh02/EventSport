@php $m = $match ?? null; @endphp

<div class="grid grid-cols-1 md:grid-cols-2 gap-5">
    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Équipe A</label>
        <input type="text" name="equipe_a" value="{{ old('equipe_a', $m?->equipe_a) }}"
               placeholder="Nom de l'équipe A"
               class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition @error('equipe_a') border-red-400 bg-red-50 @enderror">
        @error('equipe_a')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Équipe B</label>
        <input type="text" name="equipe_b" value="{{ old('equipe_b', $m?->equipe_b) }}"
               placeholder="Nom de l'équipe B"
               class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition @error('equipe_b') border-red-400 bg-red-50 @enderror">
        @error('equipe_b')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
    </div>
    <div class="md:col-span-2">
        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Date et heure du match</label>
        <input type="datetime-local" name="date_match" value="{{ old('date_match', $m?->date_match?->format('Y-m-d\TH:i')) }}"
               class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition @error('date_match') border-red-400 bg-red-50 @enderror">
        @error('date_match')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
    </div>
</div>
