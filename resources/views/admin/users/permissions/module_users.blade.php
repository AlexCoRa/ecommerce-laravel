<div class="col-md-4 d-flex">
    <div class="panel shadow">
        <div class="header">
            <h2 class="title"><i class="fas fa-users"></i> Modulo Usuarios</h2>
        </div>
        <div class="inside">
            <div class="container">
                <div class="form-check">
                    <input type="checkbox" value="true" name="users_list" @if(kvfj($u->permissions, 'users_list')) checked @endif>
                    <label for="users_list">Puede ver el listado de los usuarios.</label>
                </div>

                <div class="form-check">
                    <input type="checkbox" value="true" name="users_edit" @if(kvfj($u->permissions, 'users_edit')) checked @endif>
                    <label for="users_edit">Puede editar usuarios.</label>
                </div>

                <div class="form-check">
                    <input type="checkbox" value="true" name="user_banned" @if(kvfj($u->permissions, 'user_banned')) checked @endif>
                    <label for="user_banned">Puede banear usuarios.</label>
                </div>

                <div class="form-check">
                    <input type="checkbox" value="true" name="user_permission" @if(kvfj($u->permissions, 'user_permission')) checked @endif>
                    <label for="user_permission">Puede dar permisos a usuarios.</label>
                </div>
            </div>
        </div>
    </div>
</div>
