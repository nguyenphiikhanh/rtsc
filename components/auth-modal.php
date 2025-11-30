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
                            <input class="text tCenter fs20 f-svn_bjola" type="text" name="username" placeholder="Tài Khoản" />
                        </div>
                        <div class="form-control m__inline box-input tCenter mt-3per">
                            <input class="password tCenter fs20 f-svn_bjola" type="password" name="password" placeholder="Mật Khẩu" />
                        </div>

                        <div class="tCenter mt-3per">
                            <button name="submit" class="btn-log btLog fkufamB tUpper mt-2per c-white bd-black c-pointer btn-tranY">Đăng Nhập</button>
                        </div>
                        <div class="note m__inline c-black">
                            <p class="tCenter">
                                <a href="https://id.acegame.vn/ForgotInfo" class="c-red">Quên mật khẩu?</a> Chưa có tài khoản?
                                <a href="/dangky.php" target="_blank" class="c-blue">Đăng ký</a>
                            </p>
                        </div>

                        <p class="note m__inline tCenter  c-black">Hoặc đăng nhập bằng</p>
                        <div class="other-login tct dFlex aCenter jCenter tUpper">
                            <a href="javascript:;" data-href="https://id.acegame.vn/Oauth?partner=google&amp;Returnurl=https%3A%2F%2Frongthansieucap.vn%2Fauth%2Fopenid-oauth" class="btn-openid-login login-gg dFlex aCenter jCenter">
                                <img src="../assets/frontend/events/phucloinap2025/images/modal/img-gg.png" alt="" />
                            </a>
                            <a href="javascript:;" data-href="https://id.acegame.vn/Oauth?partner=facebook&amp;Returnurl=https%3A%2F%2Frongthansieucap.vn%2Fauth%2Fopenid-oauth" class="btn-openid-login login-fb2 dFlex aCenter jCenter">
                                <img src="../assets/frontend/events/phucloinap2025/images/modal/img-fb.png" alt="" />
                            </a>
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
                            <input id="username_register" class="text tCenter fs20 f-svn_bjola" pattern="[a-zA-Z0-9]+" title="Chỉ được nhập chữ và số" type="text" name="username" placeholder="Tài Khoản" required/>
                        </div>
                        <div class="form-control m__inline box-input tCenter mt-3per">
                            <input id="password_register" class="password tCenter fs20 f-svn_bjola" type="password" name="password" placeholder="Mật Khẩu" required/>
                        </div>

                        <div class="tCenter mt-3per">
                            <button name="submit_register" class="btn-log btLog fkufamB tUpper mt-2per c-white bd-black c-pointer btn-tranY">Đăng Ký</button>
                        </div>
                        <div class="note m__inline c-black">
                            <p class="tCenter">
                                <a href="https://id.acegame.vn/ForgotInfo" class="c-red">Quên mật khẩu?</a> Chưa có tài khoản?
                                <a href="/dangky.php" target="_blank" class="c-blue">Đăng ký</a>
                            </p>
                        </div>

                        <p class="note m__inline tCenter  c-black">Hoặc đăng nhập bằng</p>
                        <div class="other-login tct dFlex aCenter jCenter tUpper">
                            <a href="javascript:;" data-href="https://id.acegame.vn/Oauth?partner=google&amp;Returnurl=https%3A%2F%2Frongthansieucap.vn%2Fauth%2Fopenid-oauth" class="btn-openid-login login-gg dFlex aCenter jCenter">
                                <img src="../assets/frontend/events/phucloinap2025/images/modal/img-gg.png" alt="" />
                            </a>
                            <a href="javascript:;" data-href="https://id.acegame.vn/Oauth?partner=facebook&amp;Returnurl=https%3A%2F%2Frongthansieucap.vn%2Fauth%2Fopenid-oauth" class="btn-openid-login login-fb2 dFlex aCenter jCenter">
                                <img src="../assets/frontend/events/phucloinap2025/images/modal/img-fb.png" alt="" />
                            </a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="close_modal"></div>
        </div>
    </div>

</div>