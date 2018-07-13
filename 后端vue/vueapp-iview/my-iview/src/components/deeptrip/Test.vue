<template>
  <div class="yes">
    <div>
      <button @click="shou">收藏</button>
      <button @click="del">删除</button>
    </div>
    <div class="no">
      <button @click="jieban">结伴</button>
      <button @click="deljie">删除</button>
    </div>
  </div>
</template>


<script>
import axios from 'axios'
// 这里设置是为了让后端保持 session 状态
axios.defaults.withCredentialsjieban=true;

// 这里是为了 php 可以收到 post 的值
var qs = require('qs');
export default {
  data(){
      return{
          region_id:1,
          travel_note_id:2,
          colection_type:0,
          colection_id:1,
          cpartner_id:1,
          cpartner_type:'A',
          cpartner_title:'hahahaha',
          cpartner_content:'sasdadsaddsadsa',
          cpartner_time:'',
          colection_link:`${domain}/Userya/colection`,
          del_link:`${domain}/Userya/del`,
          jieban_link:`${domain}/Userya/jieban`,
          deljie_link:`${domain}/Userya/deljie`,
      }
  },
  methods:{
      shou(){
        const data = {
          region_id:this.region_id,
          travel_note_id:this.travel_note_id,
          colection_type:this.colection_type,
        }
        axios.post(this.colection_link,
          qs.stringify(data),
        ).then(res=>{
            log('success');
            alert('收藏成功');
        }).catch(res=>{
            log('failed');
        })
      },
      del(){
        const params = {
          colection_id:this.colection_id,
        }
        axios.post(this.del_link,
          qs.stringify(params),
        ).then(res=>{
            alert('删除成功');
        }).catch(res=>{
            alert('删除失败');
        })
      },
      jieban(){
        const data = {
          cpartner_type:this.cpartner_type,
          cpartner_title:this.cpartner_title,
          cpartner_content:this.cpartner_content,
          cpartner_time:this.cpartner_time,
        }
        axios.post(this.jieban_link,
          qs.stringify(data),
        ).then(res=>{
            alert('结伴成功');
        }).catch(res=>{
            alert('结伴失败');
        })
      },
      deljie(){
        const params = {
          cpartner_id:this.cpartner_id,
        }
        axios.post(this.deljie_link,
          qs.stringify(params),
        ).then(res=>{
          alert('删除成功');
        }).catch(res=>{
          alert('删除失败');
        })
      }
  }
}
</script>

<style scoped>
  .yes{
    text-align: center;
    margin-top:20px;
  }
  .no{
    margin-top:10px;
  }
</style>


