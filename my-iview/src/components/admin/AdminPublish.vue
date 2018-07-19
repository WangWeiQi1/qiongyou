<template>
    <div>
        <NewMenu :active_board='active_board' :active_main='active_main'>
            <div slot='menu_ceil'>
                <Input v-model="title" placeholder="请输入区域标题" style="width: 70%"></Input>


                <Select v-model="city" style="width:100px" placeholder='选择城市'>
                    <Option v-for="item in city_list" :value="item.value" :key="item.value" @change="changeMethod">{{ item.label }}</Option>
                </Select>

                <Select v-model="type" style="width:200px" @on-change="changeMethod" placeholder='选择区域'>
                    <Option v-for="item in region_list" :value="item.value" :key="item.value" @change="changeMethod">{{ item.label }}</Option>
                </Select>
                <Select v-model="ceil_type" v-show='ifScence' style="width:200px" @on-change="changeMethod" placeholder='景点类型'>
                    <Option v-for="item in region_ceil_list" :value="item.value" :key="item.value" @change="changeMethod">{{ item.label }}</Option>
                </Select>
                <br>
                <br>
                <Input v-model="info" type="textarea" :rows="4" placeholder="请输入相关介绍"></Input>
                <br>
                <br>

                <div class='upload-main'>
                    <div class="demo-upload-list" v-for="item in uploadList">
                        <template v-if="item.status === 'finished'">
                            <img :src="item.url">
                            <div class="demo-upload-list-cover">
                                <Icon type="ios-eye-outline" @click.native="handleView(item.name)"></Icon>
                                <Icon type="ios-trash-outline" @click.native="handleRemove(item)"></Icon>
                            </div>
                        </template>
                        <template v-else>
                            <Progress v-if="item.showProgress" :percent="item.percentage" hide-info></Progress>
                        </template>
                    </div>
                    <Upload
                        ref="upload"
                        :show-upload-list="false"
                        :default-file-list="defaultList"
                        :on-success="handleSuccess"
                        :format="['jpg','jpeg','png']"
                        :max-size="2048"
                        type="drag"
                        :action="upload_link"
                        style="display: inline-block;width:58px;">
                        <div style="width: 58px;height:58px;line-height: 58px;">
                            <Icon type="camera" size="20"></Icon>
                        </div>
                    </Upload>
                    上传一张封面
                    <Modal title="View Image" v-model="visible">
                        <img :src="`${domain}/assets/uploads/${imgName}`" v-if="visible" style="width: 100%">
                    </Modal>                                
                </div>


                <div class='upload-main'>
                    <div class="demo-upload-list" v-for="item in uploadList_more">
                        <template v-if="item.status === 'finished'">
                            <img :src="item.url">
                            <div class="demo-upload-list-cover">
                                <Icon type="ios-eye-outline" @click.native="handleView_more(item.name)"></Icon>
                                <Icon type="ios-trash-outline" @click.native="handleRemove_more(item)"></Icon>
                            </div>
                        </template>
                        <template v-else>
                            <Progress v-if="item.showProgress" :percent="item.percentage" hide-info></Progress>
                        </template>
                    </div>
                    <Upload
                        ref="upload_more"
                        :show-upload-list="false"
                        :default-file-list="defaultList_more"
                        :on-success="handleSuccess_more"
                        :format="['jpg','jpeg','png']"
                        :max-size="2048"
                        multiple
                        type="drag"
                        :action="upload_link"
                        style="display: inline-block;width:58px;">
                        <div style="width: 58px;height:58px;line-height: 58px;">
                            <Icon type="camera" size="20"></Icon>
                        </div>
                    </Upload>
                    上传多张相关图片
                    <Modal title="View Image" v-model="visible_more">
                        <img :src="`${domain}/assets/uploads/${imgName_more}`" v-if="visible_more" style="width: 100%">
                        
                    </Modal>                                
                </div>






                
                <br>
                <br>
                <Input v-model="price" :number='true' placeholder="请输入相关价格" style="width: 20%"></Input>
                <br>
                <br>
                <Button type="success" long @click='publishMethod'>发布</Button>
                {{warn_info}}
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

export default {
    components: {
        NewMenu,  
    },
    data () {
        return {
            domain,
            active_board: '1-1',
            current_user_link: `${domain}/user/current_user`,
            msg: '这是 admin 管理的页面',
            title: '',
            // 这里的城市 id 先写死，后面会再换
            city_list: [
                {
                    value: '1',
                    label: '哈尔滨',
                },
                {
                    value: '2',
                    label: '北京',
                },
                {
                    value: '3',
                    label: '上海',
                },

            ],
            region_list: [
                {
                    value: 'A',
                    label: '酒店'
                },
                {
                    value: 'B',
                    label: '餐厅'
                },
                {
                    value: 'C',
                    label: '景点玩乐'
                },

            ],
            region_ceil_list: [
                {
                    value: 1,
                    label: '热门景点'
                },
                {
                    value: 0,
                    label: '普通景点'
                },
            ],
            price: '',
            type: '',
            city: '',
            ceil_type: '',
            info: '',
            ifScence: false,
            defaultList: [],
            defaultList_more: [],
            imgName: '',
            imgName_more: '',
            visible: false,
            visible_more: false,
            uploadList: [],
            uploadList_more: [],
            upload_link: `${domain}/upload/do_upload`,
            publish_link: `${domain}/region/add`,
            
            cover_str: '',
            pics_str: '',
            user_id: '',
            warn_info: '',
            active_main: ['1'],
            

        }
    },
    methods: {
        changeMethod() {
            log('正在选择')
            if (this.type == 'C') {
                this.ifScence = true
            } else {
                this.ifScence = false
            }
        },
        handleView (name) {
            this.imgName = name;
            this.visible = true;
        },
        handleView_more (name) {
            this.imgName_more = name;
            this.visible_more = true;
        },
        handleRemove (file) {
            const fileList = this.$refs.upload.fileList;
            this.$refs.upload.fileList.splice(fileList.indexOf(file), 1);
        },
        handleRemove_more (file) {
            const fileList = this.$refs.upload_more.fileList;
            this.$refs.upload_more.fileList.splice(fileList.indexOf(file), 1);
        },
        handleSuccess (res, file) {
            log('文件上传成功', res, file)
            const filename = res
            file.url = `${domain}/assets/uploads/${filename}`;
            file.name = filename;
            this.cover_str = filename
        },
        handleSuccess_more (res, file) {
            log('文件上传成功', res, file)
            const filename = res
            file.url = `${domain}/assets/uploads/${filename}`;
            file.name = filename;
            this.pics_str = this.pics_str + '==' + filename
        },
        go_publish(data) {
            log('data:', data)
            axios.post(this.publish_link, 

                qs.stringify(data),

            ).then(res => {
                log('发布请求成功, 这是给出的响应:', res.data)
                const status = res.data
                if (status == 1) {
                    this.warn_info = '发布成功'
                    this.cover_str = ''
                    this.pics_str = ''
                    const l = this.$refs.upload.fileList.length
                    const l_more = this.$refs.upload_more.fileList.length
      
                    for (let index = 0; index < l; index++) {
                        this.$refs.upload.fileList.pop()
                    }

                    for (let index = 0; index < l_more; index++) {
                        this.$refs.upload_more.fileList.pop()
                    }
                } else {
                    this.warn_info = '发布失败'
                }
            }).catch(res => {
                log('发布请求失败')
            })
        },
        publishMethod() {
            log('发布按钮被点击')
            // log('cover_str', this.cover_str)
            // log('pics_str', this.pics_str)
            const data = {
                city_id: this.city,
                user_id: this.user_id,
                region_type: this.type,
                region_name: this.title,
                region_price: this.price,
                region_cover: this.cover_str,
                region_pics: this.pics_str,
                region_info: this.info,
                region_type_ceil: this.ceil_type,
            }

            const data_main = {
                params: data,
            }
            // this.go_publish(data)
            this.go_publish(data_main)
        },
        clearMethod() {
            log('正在清空')
        },
        get_current_user() {
            axios.get(this.current_user_link).then(res => {
                // log('请求 current_user 成功', res.data)
                const user_id = res.data.user_id
                // log('user_id', user_id)
                // log('user_id', user_id == null)
                if (user_id == null) {
                    // log('没有登录')
                    this.$router.push({
                        name: 'user'
                    })
                } else {
                    // log('已经登录')
                    this.user_id = user_id
                }
                
            }).catch(res => {
                log('请求 session 失败')
            })   
        },
        // goEdit() {
        //     log('路由跳转被点击')
        //     this.$router.push({
        //         name: 'adminEdit'
        //     })
        // },
        // selectMethod(name) {
        //     log('selecting ', name)
        //     if (name == '1-2') {
        //         this.$router.push({
        //             name: 'adminEdit'
        //         })
        //     }
        // },



    },
    created() {
        this.get_current_user()
    },
    mounted () {
        this.uploadList = this.$refs.upload.fileList;
        this.uploadList_more = this.$refs.upload_more.fileList;
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


