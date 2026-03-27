<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Nom équipe</label>
        <input type="text" name="name" class="form-control" required
               oninvalid="this.setCustomValidity('Veuillez saisir le nom de l équipe')"
               oninput="this.setCustomValidity('')"
               value="{{ $team->name ?? '' }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">Chef d'équipe</label>
        <select  name="user_id" class="form-control" required
                 oninvalid="this.setCustomValidity('Veuillez saisir le chef d équipe')"
                 oninput="this.setCustomValidity('')">
            <option value=""> Choisir le chef d'équipe</option>
            @foreach($users as $user)
                <option value="{{$user->id}}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                    {{$user->name}}
                </option>
            @endforeach
        </select>
    </div>
</div>
