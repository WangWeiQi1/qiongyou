<template>
    <div>
        <NewMenu :active_board='active_board' :active_main='active_main'>
            <div slot='menu_ceil'>
                <Button type="success" long @click='add_partner_reply'>增加结伴回复</Button>
                <br>
                <br>
                <Button type="success" long @click='delete_partner_reply'>删除结伴回复</Button>
                <br>
                <br>
                <Button type="success" long @click='add_partner_list'>增加结伴列表</Button>
                <br>
                <br>
                <Button type="success" long @click='delete_partner_list'>删除结伴列表</Button>
                <br>
                <br>
                <Button type="success" long @click='get_region_list'>获取区域列表</Button>
                <br>
                <br>
                <Button type="success" long @click='get_region_detail'>获取区域详情</Button>
                <br>
                <br>
                <Button type="success" long @click='get_cpartner_list'>获取结伴列表</Button>
                <br>
                <br>
                <Button type="success" long @click='get_cpartner_detail'>获取结伴详情</Button>

            </div>
        </NewMenu>
    </div>
</template>

<script>
import {
    Menu,
    Input,
    Select,
    Upload,
} from 'iview'

import axios from "axios"

// 这里设置是为了让后端保持 session 状态
axios.defaults.withCredentials=true;

// 这里是为了 php 可以收到 post 的值
var qs = require('qs');

import NewMenu from "@/components/admin/MenuMain"
import {
    Button,
} from "iview"

import {
    test,
} from "../../utils/utils"



import store from '@/vuex/index'
import {mapState, mapMutations, mapGetters, mapActions} from 'vuex'

export default {
    store,
    components: {
        NewMenu,
    },
    data () {
        return {
            domain,
            active_board: '1-3',
            active_main: ['1'],
        }
    },
    methods: {
        ...mapMutations(['get_index', 'get_current_user', 'get_logout']),
        post_method(request_link, data) {
            axios.post(request_link, 

                qs.stringify(data),

            ).then(res => {
                log('发布请求成功, 这是给出的响应:', res.data)
                const status = res.data
                if (status == 1) {
                } else {
                    this.warn_info = '发布失败'
                }
            }).catch(res => {
                log('发布请求失败')
            })
        },
        get_method(request_link, data) {
            axios.get(request_link, 
                data,
                
            ).then(res => {
                log('删除成功, 这是给出的响应:', res.data)
            }).catch(res => {
                log('删除 region 失败')
            })  
        },
        add_partner_reply() {
            // log('增加结伴回复按钮被点击:', this.user_id)
            const data = {
                cpartner_reply_user_id: this.user_id,
                cpartner_reply_content: '测试内容',
                cpartner_reply_type: 'A',
                cpartner_id: 1,
            }

            const data_main = {
                params: data,
            }
            const request_link = `${domain}/cpartner/reply_add`
            this.post_method(request_link, data_main)
        },
        delete_partner_reply() {
            const data = {
                cpartner_reply_id: '1',
            }

            const data_main = {
                params: data,
            }
            const request_link = `${domain}/cpartner/reply_delete`
            this.get_method(request_link, data_main)
        },
        add_partner_list() {
            const data = {
                cpartner_id: 1,
                cpartnerlist_user_id: this.user_id,
                cpartnerlist_type: 'A',
                cpartnerlist_success: '0',
            }

            const data_main = {
                params: data,
            }
            const request_link = `${domain}/cpartner/list_add`
            this.post_method(request_link, data_main)
        },
        delete_partner_list() {
            const data = {
                cpartnerlist_id: '1',
            }

            const data_main = {
                params: data,
            }

            const request_link = `${domain}/cpartner/list_delete`
            this.get_method(request_link, data_main)
        },
        get_region_list() {
            // log('获取区域列表按钮被点击')
            const data = {
                region_type: 'A',
            }

            const data_main = {
                params: data,
            }

            const request_link = `${domain}/region/condition_all`
            this.get_method(request_link, data_main)
        },
        get_region_detail() {
            // log('获取区域详情按钮被点击')
            const data = {
                region_id: 1,
            }

            const data_main = {
                params: data,
            }

            const request_link = `${domain}/region/detail`
            this.get_method(request_link, data_main)
        },
        get_cpartner_list() {
            // log('获取结伴列表按钮被点击')
            const data = {
                cpartner_type: 'A',
            }

            const data_main = {
                params: data,
            }

            const request_link = `${domain}/cpartner/condition_all`
            this.get_method(request_link, data_main)
        },
        get_cpartner_detail() {
            const data = {
                cpartner_id: 1,
            }

            const data_main = {
                params: data,
            }

            const request_link = `${domain}/cpartner/detail`
            this.get_method(request_link, data_main)
        },

        
    },
    computed: {
        ...mapState(['vuex_msg', 'user_id']),
    },
    created() {
        this.get_current_user()
    },
    mounted () {
    },

}
</script>

<style scoped>
    .layout{
        border: 1px solid #d7dde4;
        background: #f5f7f9;
        position: relative;
        border-radius: 4px;
        overflow: hidden;
    }
    .layout-header-bar{
        background: #fff;
        box-shadow: 0 1px 1px rgba(0,0,0,.1);
    }
    .demo-upload-list{
        display: inline-block;
        width: 60px;
        height: 60px;
        text-align: center;
        line-height: 60px;
        border: 1px solid transparent;
        border-radius: 4px;
        overflow: hidden;
        background: #fff;
        position: relative;
        box-shadow: 0 1px 1px rgba(0,0,0,.2);
        margin-right: 4px;
    }
    .demo-upload-list img{
        width: 100%;
        height: 100%;
    }
    .demo-upload-list-cover{
        display: none;
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0,0,0,.6);
    }
    .demo-upload-list:hover .demo-upload-list-cover{
        display: block;
    }
    .demo-upload-list-cover i{
        color: #fff;
        font-size: 20px;
        cursor: pointer;
        margin: 0 2px;
    }
</style>


