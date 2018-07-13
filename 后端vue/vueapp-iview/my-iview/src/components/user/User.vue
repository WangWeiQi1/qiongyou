<template>
    <div>
        <router-link to="/admin">管理界面</router-link>
        <br>
        <input type="input" v-model='username_r' placeholder="用户名">
        
        <br>
        <input type="password" v-model='password_r' placeholder="密码">
        <br>
        <button @click='registMethod'>注册</button>
        <br>
        {{regist_info}}
        <br>
        <br>
        <br>
        <hr>

        <br>
        你好！{{current_user}}
        <a v-show='ifLogout' @click='logoutMethod'>注销</a>
        <br>
        <br>

        <input type="input" v-model='username_l' placeholder="用户名">
        
        <br>
        <input type="password" v-model='password_l' placeholder="密码">
        <br>
        <button @click='loginMethod'>登录</button>
        <br>
        {{login_info}}
        
        <!-- <button @click='sessionMethod'>测试session</button> -->

        
    </div>
</template>


<script>

import {
    Menu,
} from 'iview'

import axios from "axios"

// 这里设置是为了让后端保持 session 状态
axios.defaults.withCredentials=true;

// 这里是为了 php 可以收到 post 的值
var qs = require('qs');


export default {
    components: {
        Menu,
    },
    data () {
        return {
            theme2: 'dark',
            username_r: '',
            username_l: '',
            password_r: '',
            password_l: '',
            test_link: `${domain}/user/test`,
            regist_link: `${domain}/user/regist`,
            login_link: `${domain}/user/login`,
            logout_link: `${domain}/user/logout`,
            current_user_link: `${domain}/user/current_user`,
            regist_info: '',
            login_info: '',
            current_user: '游客',
            ifLogout: false,
        }
    },
    methods: {
        registMethod() {
            log('注册按钮被点击', this.username_r, this.password_r)
            axios.get(this.regist_link, {
                params: {
                    username: this.username_r,
                    password: this.password_r,
                }
            }).then(res => {
                // log(this.test_link)
                log('请求测试数据成功, 这是给出的响应:', res.data)
                const status = res.data
                if (status == 1) {
                    this.regist_info = '注册成功'
                } else {
                    this.regist_info = '注册失败'
                }
            }).catch(res => {
                log('请求测试数据失败')
            })
        },
        loginMethod() {
            log('登录按钮被点击', this.username_l, this.password_l)
            const data = {
                username: this.username_l,
                password: this.password_l,
            }

   
            axios.post(this.login_link, 

                qs.stringify(data),
                // {
                //     headers: {
                //         "Content-Type":"application/json;charset=utf-8"
                //     },
                //     withCredentials : true
                // }

            ).then(res => {
                log('请求登录成功, 这是给出的响应:', res.data)
                const status = res.data
                if (status == 0) {
                    this.login_info = '登录失败'
                } else {
                    this.login_info = '登录成功'
                    this.current_user = status
                    this.ifLogout = true
                    
                }
            }).catch(res => {
                log('请求测试数据失败')
            })
        },
        logoutMethod() {
            axios.get(this.logout_link).then(res => {
                log('请求 logout 成功, 这是给出的响应:', res.data)
                this.current_user = '游客'
                this.ifLogout = false
                
            }).catch(res => {
                log('请求 logout 失败:')
            })
        },
        sessionMethod() {
            log('测试 session 按钮被点击')
            axios.get(this.test_link).then(res => {
                log('请求 session 成功', res.data)
                this.current_user = res.data
            }).catch(res => {
                log('请求 session 失败')
            })
        },
        get_current_user() {
            axios.get(this.current_user_link).then(res => {
                log('请求 current_user 成功', res.data)
                const username = res.data.username
                const user_id = res.data.user_id
                if (username == null) {
                    this.current_user = '游客'
                } else {
                    this.current_user = username
                    this.ifLogout = true
                }
                
            }).catch(res => {
                log('请求 session 失败')
            })   
        }
    },
    created() {
        log('created', domain)
        this.get_current_user()
    },
    computed: {
        // menuitemClasses: function () {
        //     return [
        //         'menu-item',
        //         this.isCollapsed ? 'collapsed-menu' : ''
        //     ]
        // }
    }
}
</script>

<style scoped>
    .layout-con{
        height: 100%;
        width: 100%;
    }
    .menu-item span{
        display: inline-block;
        overflow: hidden;
        width: 69px;
        text-overflow: ellipsis;
        white-space: nowrap;
        vertical-align: bottom;
        transition: width .2s ease .2s;
    }
    .menu-item i{
        transform: translateX(0px);
        transition: font-size .2s ease, transform .2s ease;
        vertical-align: middle;
        font-size: 16px;
    }
    .collapsed-menu span{
        width: 0px;
        transition: width .2s ease;
    }
    .collapsed-menu i{
        transform: translateX(5px);
        transition: font-size .2s ease .2s, transform .2s ease .2s;
        vertical-align: middle;
        font-size: 22px;
    }
</style>


