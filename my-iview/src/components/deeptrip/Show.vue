<template>
    <div>
        <NewMenu :active_board='active_board' :active_main='active_main'>
            <div slot='menu_ceil'>
                  <div slot="menu_menu">
                    <AutoComplete
                      v-model="value4"
                      icon="ios-search"
                      placeholder="请输入关键字"
                      style="width:300px;margin:0 0 20px 10%;">
                    </AutoComplete>
                    <Select v-model="city" style="width:100px;position: relative;bottom:10px;" placeholder='选择国家'>
                      <Option v-for="item in city_list" :value="item.value" :key="item.value">{{ item.label }}</Option>
                    </Select>
                    <div class="gongneng">
                      <span class="search" @click="tosearch">搜索</span>
                      <span class="add" @click="toadd">添加</span>
                    </div>
                    <Table border :columns="columns7" :data="data6"></Table>
                    <!--<Page style="text-align: center;margin-top:20px;" :total="dataCount" :page-size="pageSize" show-total  @on-change="changepage"></Page>-->
                  </div>
            </div>
        </NewMenu>
    </div>
</template>
<script>
  import MenuMenu from '@/components/deeptrip/MenuMenu'
  import { AutoComplete,Select,Option,Page } from 'iview'
  import axios from 'axios'

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
        active_board: '3-1',
        active_main: ['3'],
        city_list: [
          {
            value: 'A',
            label: '中国',
          },
          {
            value: 'B',
            label: '日本',
          },
          {
            value: 'C',
            label: '西班牙',
          },
          {
            value: 'D',
            label: '法国',
          },
          {
            value: 'E',
            label: '美国',
          }

        ],
        dataList:[],
        dataCount:0,//初始化信息总条数
        pageSize:5,//每页显示多少条
        columns7: [
          {
            title: '标题',
            key: 'name'
          },
          {
            title: '内容',
            key: 'con'
          },
          {
            title: '开始时间',
            key: 'time'
          },
          {
            title: '价格',
            key: 'price'
          },
          {
            title: '操作',
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
          },

        ],
        data6:[

        ],
        value4:'',
        did:'',
        photo:'',
        city:'',
        del_link:`${domain}/Deeptrip/del`,
        show_link:`${domain}/Deeptrip/show`,
        search_link:`${domain}/Deeptrip/search`,
      }
    },
    created(){
        this.show_all();
    },

    methods: {
      show_all(){
        axios.get(this.show_link).then(res=>{
          log('接收到的数据',res.data);
          res.data.forEach((e) => {
            this.data6.push({
              did:e.deeptrip_id,
              name: e.deeptrip_title,
              con: e.deeptrip_info,
              time: e.deeptrip_time,
              price:e.deeptrip_price,
              photo:e.deeptrip_photo,
              content:e.deeptrip_conimg,

            })
          })
//          this.dataList = res.data;
//          this.dataCount = res.data.length;
//          // 初始化显示，小于每页显示条数，全显，大于每页显示条数，取前每页条数显示
//          if(this.dataCount < this.pageSize){
//            this.data6 = this.dataList;
//          }else{
//            this.data6 = this.dataList.slice(0,this.pageSize);
//          }
        }).catch(res=>{
          log('fail');
        })
      },
//      changepage(index){
//        var _start = ( index - 1 ) * this.pageSize;
//        var _end = index * this.pageSize;
//        this.data6 = this.dataList.slice(_start,_end);
//      },
      toadd(){
        this.$router.push('/Admin1');
      },
      tosearch(){
        this.search_link = `${domain}/Deeptrip/search`;
        axios.get(this.search_link,{
            params:{
                title:this.value4,
                city:this.city,
            }
        }).then(res=>{
            log('请求成功,返回的数据',res.data);
            this.data6 = [];
//            this.dataCount = res.data.length;
            res.data.forEach((e) => {
              log('inner', e)
              this.data6.push({
                did:e.deeptrip_id,
                name: e.deeptrip_title,
                con: e.deeptrip_info,
                time: e.deeptrip_time,
                price:e.deeptrip_price,
                photo:e.deeptrip_photo,
                content:e.deeptrip_conimg,
              })
            })
        }).catch(res=>{
           log('fail');
        });
      },
      show (index) {
//        this.data6 = this.dataList;
        const did = this.data6[index].did;
        const photo = this.data6[index].photo;
        const imgs = this.data6[index].content;
        log('imgsimimgsimgsgs', imgs)
        this.$router.push(`/update/${did}/${photo}/${imgs}`);
      },
      remove (index) {
//        this.data6 = this.dataList;
        const data = {
            did:this.data6[index].did
        };
        log('当前删除的id',data);
        axios.post(this.del_link,
          qs.stringify(data),
        ).then(res=>{
            log('success',res);
            this.data6.splice(index,1);
        }).catch(res=>{
            log('failed');
        })
      }
    }
  }
</script>

<style scoped>
  .demo-auto-complete-item{
    padding: 4px 0;
    border-bottom: 1px solid #F6F6F6;
  }
  .demo-auto-complete-group{
    font-size: 12px;
    padding: 4px 6px;
  }
  .demo-auto-complete-group span{
    color: #666;
    font-weight: bold;
  }
  .demo-auto-complete-group a{
    float: right;
  }
  .demo-auto-complete-count{
    float: right;
    color: #999;
  }
  .demo-auto-complete-more{
    display: block;
    margin: 0 auto;
    padding: 4px;
    text-align: center;
    font-size: 12px;
  }
  .gongneng{
    margin-bottom:20px;
  }
  .search{
    position: relative;
    left:10%;
    padding:8px 12px;
    background-color: lawngreen;
    border-radius: 12%;
    color:#fff;
    cursor:pointer;
  }
  .add{
    position: relative;
    left:11%;
    padding:8px 12px;
    background-color: #FA8072;
    border-radius: 12%;
    color:#fff;
    cursor:pointer;
  }
</style>
