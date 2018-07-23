
<template>
    <div>
        {{msg}}
        <NewMenu :active_board='active_board' :active_main='active_main'>
            <div slot='menu_ceil'>
                <Input v-model="title" placeholder="请输入公司名称" style="width: 70%"></Input>

                <!-- city: {{city}}   -->

                <Select v-model="city" style="width:150px" placeholder='选择类型'>
                    <Option v-for="item in city_list" :value="item.value" :key="item.value" @change="changeMethod">{{ item.label }}</Option>
                </Select>
                <br>
                <br>
                <Input v-model="phone" placeholder="请输入公司联系方式" style="width: 70%"></Input>
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
                        multiple
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
                <br>
                <br>
                <Input v-model="price" :number='true' placeholder="请输入相关价格" style="width: 30%"></Input>
                <br>
                <br>
                <Button type="success" success @click.native="updataText">更新</Button>
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



import axios from 'axios'


// 这里设置是为了让后端保持 session 状态
axios.defaults.withCredentials=true;

import NewMenu from "@/components/admin/MenuMain"

// 这里是为了 php 可以收到 post 的值
var qs = require('qs');

export default {
    components: {
        NewMenu,  
    },
    data () {
        return {
            active_board: '2-2',
            active_main: ['2'],
            phone:'',
            domain,
            msg: '这是 insurance 管理的页面',
            title: '',
            city_list: [
                {
                    value: 'A',
                    label: '旅游人身意外伤害险',
                },
                {
                    value: 'B',
                    label: '旅游意外伤害险',
                },
                {
                    value: 'C',
                    label: '旅游求救险',
                },

            ],
            price: '',
            type: '',
            city: '',
            info: '',
            ifScence: false,
            defaultList: [

            ],
            imgName: '',
            visible: false,
            uploadList: [],
            upload_link: `${domain}/upload/do_upload`,
            

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
        handleRemove (file) {
            const fileList = this.$refs.upload.fileList;
            this.$refs.upload.fileList.splice(fileList.indexOf(file), 1);
        },
        handleSuccess (res, file) {
            log('文件上传成功', res, file)
            const filename = res
            // this.defaultList.push({
            //     'name': filename,
            //     'url': `${domain}/assets/uploads/${filename}`,
            // })
            // log('文件上传成功', res, file)
            file.url = `${domain}/assets/uploads/${filename}`;
            file.name = filename;
        },
        
        updataText(){
            const data = {
                insurance_phone:this.phone,
                insurance_type:this.city,
                insurance_price:this.price,
                insurance_content:this.info,
                insurance_company:this.title,
                insurance_id :this.$route.params.u,
            };
            
            const arr = {
                params: data,
            };
            axios.post(`${domain}/Insurance/updata_data`,
                qs.stringify(arr))
            .then(res=>{
                if(res.data){
                    alert('更新成功');
                }
                console.log('success', res.data);

                this.$router.push(`/Insurancedelate`);
            }).catch(res=>{
                console.log('fail');
            });
        },

    },
    created() {
        console.log(this.$route.params.u);
        const data = {
            insurance_id:this.$route.params.u
        }
        console.log(data);
        axios.post(`${domain}/Insurance/show_data`,qs.stringify(data))
        .then(res=>{
            console.log('success',res.data);
            this.price = res.data.insurance_price;
            this.city= res.data.insurance_type;
            this.info= res.data.insurance_content;
            this.phone= res.data.insurance_phone;
            this.title = res.data.insurance_company;
        }).catch(res=>{
            console.log('fail');
        });
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


