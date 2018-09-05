<template>
    <div class="login-box">
        <div class="login-logo">
            <a href=""><b>{{ title }}</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">login</p>

            <form action="" method="post">
                <div class="form-group has-feedback">  <!--  has-error  -->

                    <!--<label class="control-label"><i class="fa fa-times-circle-o"></i> </label>-->

                    <input v-model.trim="username" type="input" class="form-control" placeholder="" name="username" >
                    <span class="fa fa-envelope-o fa-fw form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">

                    <!--<label class="control-label"><i class="fa fa-times-circle-o"></i> </label>-->


                    <input v-model.trim="password" type="password" class="form-control" placeholder="" name="password">
                    <span class="fa fa-key fa-fw form-control-feedback"></span>
                </div>
                <div class="row">

                    <!-- /.col -->
                    <div class="col-sm-4 offset-sm-4">
                        <button type="button" @click="submit" class="btn btn-primary btn-block btn-flat">Login</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

        </div>
        <!-- /.login-box-body -->
    </div>
</template>

<script>
import { lang } from '../lang.js';
    export default {
        data() {
            return {
                title: 'Fay Admin',
                username: '',
                password: ''
            }
        },
        methods: {
            submit() {
                console.log(this.username,this.password);

                axios.post('/login',{
                    username: this.username,
                    password: this.password
                }).then(function (response) {

                    console.log(response);
                    if (response.data.id) {
                        swal(lang('zh_cn','loginSuccess'), '', 'success').then(() => {
                            location.href = '/dashboard';
                        });
                    }


                },function (error) {

                    if (error.response.status == 400) {
                        console.log(error.response.data.msg);
                        swal(error.response.data.msg, '', 'error');
                    }else {
                        swal(lang('zh_cn','systemError'), '', 'error');
                    }

                });
            }
        }
    }
</script>
