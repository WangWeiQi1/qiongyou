<template>
    <div>
        <NewMenu :active_board='active_board'  :active_main='active_main'>
            <div slot='menu_ceil'>
                <Table border :columns="columns7" :data="data6"></Table>
            </div>
        </NewMenu>
    </div>
</template>

<script>

import NewMenu from "@/components/admin/MenuMain"

import {
    Table,
} from 'iview'



import axios from "axios"

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
            region_link: `${domain}/region/all`,
            delete_link: `${domain}/region/delete`,
            active_board: '1-2',
            active_main: ['1'],
            data6: [


            ],
            columns7: [
                {
                    title: '所属城市',
                    key: 'city',
                },
                {
                    title: '区域类型',
                    key: 'region_type'
                },
                {
                    title: '标题',
                    key: 'title'
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
                            }, 'Delete')
                        ]);
                    }
                }
            ],
            region_id: '',
        }
        
    },
    methods: {
        show (index) {
            this.region_id = this.data6[index].region_id

            const region_cover = this.regions[index].region_cover
            const region_pics = this.regions[index].region_pics
            const datas = {
                region_cover: region_cover,
                region_pics: region_pics,

            }
            this.$router.push({
                name: 'adminUpdate',
                params: {
                    region_id: this.region_id,
                    datas: JSON.stringify(datas),
                }
            })
            
        },
        remove (index) {
            log('正在删除 this.data6[index]', this.data6[index].region_id)
            this.region_id = this.data6[index].region_id
            this.delete_method()
            this.data6.splice(index, 1);
        },
        delete_method() {
            // log('正在删除 region_id', this.region_id)
            axios.get(this.delete_link, {
                params: {
                    region_id: this.region_id,
                }
            }).then(res => {
                log('删除成功, 这是给出的响应:', res.data)
            }).catch(res => {
                log('删除 region 失败')
            })
        },
        get_region() {
            axios.get(this.region_link).then(res => {
                log('请求所有的 region 成功, 这是给出的响应:', res.data)
                // {
                //     city: 'John Brown',
                //     region_type: 18,
                //     title: 'New York No. 1 Lake Park'
                // },
                const regions = res.data
                this.regions = regions
                const dicta = {
                    'A': '酒店',
                    'B': '餐厅',
                    'C': '景点玩乐',
                }
                regions.forEach(e => {
                    this.data6.push({
                        city: e.city_name,
                        region_type: dicta[e.region_type],
                        title: e.region_name,
                        region_id: e.region_id,
                    })
                });
            }).catch(res => {
                log('请求所有的 region 失败:')
            })
        }

    },
    created() {
        this.get_region()
    }

}
</script>

<style scoped>

</style>


