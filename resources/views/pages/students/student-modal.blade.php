@extends('layouts.modal', [
    'id'    => 'student-modal',
    'title' => 'Informations étudiant',
])

@section('modal-content')
    <form class="space-y-4">
        <div>
            <label class="form-label" for="last_name">Nom</label>
            <input type="text" id="last_name" name="last_name" class="form-input" placeholder="Dupont">
        </div>

        <div>
            <label class="form-label" for="first_name">Prénom</label>
            <input type="text" id="first_name" name="first_name" class="form-input" placeholder="Jean">
        </div>

        <div>
            <label class="form-label" for="birth_date">Date de naissance</label>
            <input type="date" id="birth_date" name="birth_date" class="form-input">
        </div>

        <div>
            <label class="form-label" for="email">Adresse email</label>
            <input type="email" id="email" name="email" class="form-input" placeholder="jean.dupont@email.com">
        </div>

        <div>
            <label class="form-label" for="promotion">Promotion</label>
            <select id="promotion" name="promotion" class="form-select">
                <option value="">Sélectionnez une promotion</option>
                <option value="1">Promo 2025</option>
                <option value="2">Promo 2026</option>
                <option value="3">Promo 2027</option>
            </select>
        </div>

        <div class="flex justify-end gap-3 pt-4">
            <button type="button" class="btn btn-sm btn-light" data-modal-close>Annuler</button>
            <button type="submit" class="btn btn-sm btn-primary">Enregistrer</button>
        </div>
    </form>
@overwrite
