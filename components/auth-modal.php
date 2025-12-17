<?php
require_once __DIR__ . '/../auth/auth.php';
?>

<div class="modal" id="modal__login2" style="display: none;">
    <div class="content-modal p-r" id="login-form">
        <div class="wrapper-modal">
            <div class="title-modal tCenter tUpper fkufamB dFlex aCenter jCenter">
                <span>đăng nhập</span>
            </div>
            <div class="m--modal f-svn-freude mt-3per">
                <form action="" method="POST">
                    <div>
                        <div class="form-control m__inline box-input tCenter mt-3per">
                            <input class="text text-white tCenter fs20 f-svn_bjola" type="text" name="username" placeholder="Tài Khoản" />
                        </div>
                        <div class="form-control m__inline box-input tCenter mt-3per">
                            <input class="password text-white tCenter fs20 f-svn_bjola" type="password" name="password" placeholder="Mật Khẩu" />
                        </div>

                        <div class="tCenter mt-3per">
                            <button name="submit" class="btn-log btLog fkufamB tUpper mt-2per c-white bd-black c-pointer btn-tranY">Đăng Nhập</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="close_modal"></div>
        </div>
    </div>
    <div class="content-modal p-r" id="register-form">
        <div class="wrapper-modal">
            <div class="title-modal tCenter tUpper fkufamB dFlex aCenter jCenter">
                <span>đăng ký</span>
            </div>
            <div class="m--modal f-svn-freude mt-3per">
                <form action="" method="POST">
                    <div>
                        <div class="form-control m__inline box-input tCenter mt-3per">
                            <input id="username_register" class="text text-white tCenter fs20 f-svn_bjola" pattern="[a-zA-Z0-9]+" title="Chỉ được nhập chữ và số" type="text" name="username" placeholder="Tài Khoản" required/>
                        </div>
                        <div class="form-control m__inline box-input tCenter mt-3per">
                            <input id="password_register" class="password text-white tCenter fs20 f-svn_bjola" type="password" name="password" placeholder="Mật Khẩu" required/>
                        </div>

                        <div class="tCenter mt-3per">
                            <button name="submit_register" class="btn-log btLog fkufamB tUpper mt-2per c-white bd-black c-pointer btn-tranY">Đăng Ký</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="close_modal"></div>
        </div>
    </div>

</div>