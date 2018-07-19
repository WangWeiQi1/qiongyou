



<template>
    <div>
        {{msg}}
        <NewMenu :active_board='active_board' :active_main='active_main'>
            <div slot='menu_ceil'>
                <div>
                    <Input v-model="title" placeholder="请输入公司名称" style="width: 70%"></Input>

                    <!-- type: {{type}}   -->

                    <Select v-model="type" style="width:150px" placeholder='选择类型'>
                        <Option v-for="item in type_list" :value="item.value" :key="item.value" @change="changeMethod">{{ item.label }}</Option>
                    </Select>
                    <br>
                    <br>

                    <Button type="success" success @click.native="search">搜索</Button>
                </div>
                <br>
                <br>
                <Table border :columns="columns7" :data="data6"></Table>
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

import NewMenu from "@/components/admin/MenuMain"



// 这里设置是为了让后端保持 session 状态
axios.defaults.withCredentials=true;

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
            domain,
            msg: '这是 insurance 管理的页面',
            title: '',
            type_list: [
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
            type: '',
            info: '',
            ifScence: false,
            defaultList: [

            ],
            imgName: '',
            visible: false,
            uploadList: [],
            upload_link: `${domain}/upload/do_upload`,

            columns7: [
                {
                    title: '公司名称',
                    key: 'name',
                    render: (h, params) => {
                        return h('div', [
                            h('Icon', {
                                props: {
                                    type: 'person'
                                }
                            }),
                            h('strong', params.row.name)
                        ]);
                    }
                },
                {
                    title: '保险类别',
                    key: 'type'
                },
                {
                    title: '公司联系方式',
                    key: 'phone'
                },
                {
                    title: '保险价格',
                    key: 'price'
                },
                {
                    title: 'Action',
                    key: 'action',
                    width: 150,
                    align: 'center',
                    render: (h, params) => {
                        return h('div', [
                             h('Button', {
                                    props: {
                                        type: 'primary',
                                        size: 'small'
                                    },
                                    style: {
                                        marginRight: '5px'
                                    },
                                    on: {
                                        click: () => {
                                            this.show(params.index)
                                        }
                                    }
                                }, '编辑'),
                            h('Button', {
                                props: {
                                    type: 'error',
                                    size: 'small'
                                },
                                on: {
                                    click: () => {
                                        this.remove(params.index)
                                    }
                                }
                            }, '删除')
                        ]);
                    }
                }
            ],
            data6: [],
            show_link:`${domain}`,
        }

    },
    methods: {
        show (index,u) {
            u = this.data6[index].id;
            this.$router.push(`/InsuranceCon/${u}`);
        },
        remove (index) {
            console.log(index);
            const data = {
                params:this.data6[index]
            };
            // console.log(this.data6[index]);
            axios.post(`${domain}/Insurance/delate_data`,
            qs.stringify(data)).then(res=>{
                console.log('success');
                if(res.data){
                    this.data6.splice(index, 1);
                    alert('删除成功！')
                }else{
                    alert('删除失败');
                }
            }).catch(res=>{
                console.log('fail');
            });
        },
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
        search(){
            this.data6 = [];
            const data = {
                type:this.type,
                title:this.title,
            };

            const arr = {
                params: data,
            };
            axios.post(`${domain}/Insurance/search`,
                qs.stringify(arr))
            .then(res=>{
                // console.log('success', res.data);
                // {
                //     name: 'John Brown',
                //     type: 18,
                //     phone: 'New York No. 1 Lake Park',
                //     price: 'price',
                // },
                const dicta = {
                    A: '旅游人身意外伤害险',
                    B: '旅游意外伤害险',
                    C: '旅游求救险',
                }
                res.data.forEach(e => {
                    this.data6.push({
                        name: e.insurance_company,
                        type: dicta[e.insurance_type],
                        phone: e.insurance_phone,
                        price: e.insurance_price,
                        id:e.insurance_id,
                    })
                });
                console.log(this.data6);
            }).catch(res=>{
                console.log('fail');
            });
        },

    },
    created() {
        axios.get('')
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


