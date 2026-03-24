<div class="row g-3">
    <div class="col-md-6">
        <label>Client</label>
        <select name="client_id" class="form-control">
            @foreach($clients as $client)
                <option value="{{ $client->id }}"
                        @if(isset($ticket) && $ticket->client_id == $client->id) selected @endif>
                    {{ $client->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label>Titre</label>
        <input type="text" name="name_ticket" class="form-control"
               value="{{ $ticket->name_ticket ?? '' }}">
    </div>


    <div class="col-md-12">
        <label>Description</label>
        <textarea name="description" class="form-control">{{ $ticket->description ?? '' }}</textarea>
    </div>
    <div class="col-md-6">
        <label>Date</label>
        <input type="date" name="date_ticket" class="form-control"
               value="{{ old('date_ticket', isset($ticket) ? substr($ticket->date_ticket,0,10) : '') }}">
    </div>
    <div class="col-md-6">
        <label>
            <input type="checkbox" name="valide"
                   @if(isset($ticket) && $ticket->valide) checked @endif>
            Résolu
        </label>
    </div>
</div>
