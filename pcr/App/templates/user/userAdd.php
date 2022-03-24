<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Пользователи</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Новые пользователи</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="row">
        <div class="col-xl-12 mx-auto">
            <h6 class="mb-0 text-uppercase">Новый пользователь</h6>
            <hr />
            <div class="card">
                <div class="card-body">
                    <form class="form-horizontal" method="post" action='add_user'>
                        <input hidden  name="id">

                        <label for="name">Имя фамилия </label>
                        <input class="form-control form-control-lg mb-3" required  type="text" placeholder="Name Lastname" id="name" name="name">
                        <label for="login">Логин</label>
                        <input class="form-control mb-3" required id='login' name="login" type="text" placeholder="Login">

                        <label for="password">Пароль</label>
                        <input class="form-control form-control-lg mb-3" type="text" placeholder="password" name="password" required id="password">

                        <label for="role">Роль</label>
                        <select class="form-select mb-3" id='role' name="role">

                            <option value="1">Admin</option>
                            <option value="2">Moderator</option>
                        </select>


                        <label for="status">Статус</label>
                        <select class="form-select mb-3" id='status' name="status">
                         

                            <option value="1">Активный</option>
                            <option value="2">Доступ закрыт</option>
                        </select>



                        <button class="btn btn-success">Подтвердить </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<!--end row-->
</div>