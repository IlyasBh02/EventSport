@php $e = $event ?? null; @endphp

<div style="display:grid;grid-template-columns:1fr;gap:1.25rem;">
    <div>
        <label class="form-label">Nom de l'événement</label>
        <input type="text" name="name" value="{{ old('name', $e?->name) }}"
               placeholder="Ex: Tournoi de Football Universitaire"
               class="form-input {{ $errors->has('name') ? 'error' : '' }}">
        @error('name')<p class="form-error">{{ $message }}</p>@enderror
    </div>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.25rem;">
        <div>
            <label class="form-label">Type de sport</label>
            <select name="sport_type_id" class="form-select {{ $errors->has('sport_type_id') ? 'error' : '' }}">
                <option value="">-- Sélectionner --</option>
                @foreach($sportTypes as $st)
                    <option value="{{ $st->id }}" {{ old('sport_type_id', $e?->sport_type_id) == $st->id ? 'selected' : '' }}>
                        {{ $st->name }}
                    </option>
                @endforeach
            </select>
            @error('sport_type_id')<p class="form-error">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="form-label">Capacité maximale</label>
            <input type="number" name="capacite_max"
                   value="{{ old('capacite_max', $e?->capacite_max) }}"
                   min="1" placeholder="Ex: 50"
                   class="form-input {{ $errors->has('capacite_max') ? 'error' : '' }}">
            @error('capacite_max')<p class="form-error">{{ $message }}</p>@enderror
        </div>
    </div>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.25rem;">
        <div>
            <label class="form-label">Lieu</label>
            <input type="text" name="lieu" value="{{ old('lieu', $e?->lieu) }}"
                   placeholder="Ex: Stade Municipal, Casablanca"
                   class="form-input {{ $errors->has('lieu') ? 'error' : '' }}">
            @error('lieu')<p class="form-error">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="form-label">Date et heure</label>
            <input type="datetime-local" name="date"
                   value="{{ old('date', $e?->date?->format('Y-m-d\TH:i')) }}"
                   class="form-input {{ $errors->has('date') ? 'error' : '' }}"
                   style="color-scheme:dark;">
            @error('date')<p class="form-error">{{ $message }}</p>@enderror
        </div>
    </div>

    <div>
        <label class="form-label">Description <span style="color:#475569;font-weight:400;">(optionnel)</span></label>
        <textarea name="description" rows="4" placeholder="Décrivez votre événement..."
                  class="form-input" style="resize:vertical;">{{ old('description', $e?->description) }}</textarea>
    </div>
</div>
