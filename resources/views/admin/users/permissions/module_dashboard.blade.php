<div class="col-md-4">
    <div class="panel shadow">
        <div class="header">
            <h2 class="title"><i class="fas fa-home"></i> Modulo Dashboard</h2>
        </div>
        <div class="inside">
            <div class="form-check">
                <input type="checkbox" value="true" name="dashboard" @if(kvfj($u->permissions, 'dashboard')) checked @endif >
                <label for="dashboard">Puede ver el dashboard.</label>
            </div>
        </div>
    </div>
</div>
