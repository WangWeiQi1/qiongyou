<template>
<div>
    消息
    <Button type="success" @click.native="letter">提交</Button>
   <Button type="error" @click.native="letterDelate">删除</Button>
   <br>
   <br>
   订单
   <Button type="success" @click.native="order">提交</Button>
   <Button type="error" @click.native="orderDelate">删除</Button>
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

// 这里是为了 php 可以收到 post 的值
var qs = require('qs');

export default {
    data () {
        return {
            numid:1,
        }
    },
    methods: {
        letter(){
            console.log('123');
            const data = {
                letter_content : 'xxxxxxxxxxxxxxxxxxx',
                letter_sid : 1,
                letter_rid : 2,
            };

            const arr = {
                params : data,
            }
            axios.post(`${domain}/Letter/do_insert`,
            qs.stringify(arr))
            .then(res => {
                console.log('success', res.data);
            }).catch(res => {
                console.log('fail');
            });
        },

        letterDelate(){
            console.log('删除');

            const data = {
                letter_id : this.numid++,
            };

            const arr = {
                params : data,
            }

            axios.post(`${domain}/Letter/do_delate`,
            qs.stringify(arr))
            .then(res => {
                console.log('success', res.data);
            }).catch(res => {
                console.log('fail');
            })
        },

        order(){
             console.log('123');
            const data = {
                region_id : 1,
                deeptrip_id:2,
                insurance_id:3,
                plane_ticket_id:4,
                order_user_id:5,
            };

            const arr = {
                params : data,
            }
            axios.post(`${domain}/Order/do_insert`,
            qs.stringify(arr))
            .then(res => {
                console.log('success', res.data);
            }).catch(res => {
                console.log('fail');
            });
        },

        orderDelate(){
            console.log('删除');

            const data = {
                order_id : this.numid++,
            };

            const arr = {
                params : data,
            }

            axios.post(`${domain}/Order/do_delate`,
            qs.stringify(arr))
            .then(res => {
                console.log('success', res.data);
            }).catch(res => {
                console.log('fail');
            })
        }

    },
    created() {
        
    },
    mounted () {

    },
}
</script>

