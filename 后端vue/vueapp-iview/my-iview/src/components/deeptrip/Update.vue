


<template>
    <div>
        <NewMenu :active_board='active_board' :active_main='active_main'>
            <div slot='menu_ceil'>
                标题:<Input v-model="title" style="width: 70%"></Input>

                <!-- city: {{city}} -->

                <Select v-model="city" style="width:100px">
                  <Option v-for="item in city_list" :value="item.value" :key="item.value">{{ item.label }}</Option>
                </Select>
                <br>
                <br>
                介绍:<Input v-model="info" type="textarea" :rows="2"></Input>
                <br>
                <br>
                购买须知:<Input v-model="know" type="textarea" :rows="2"></Input>
                <br>
                <br>
                路线:<Input v-model="luxian" style="width: 70%"></Input>
                <br>
                <br>
                <Row>
                  <Col span="12">
                  开始时间:<DatePicker v-model="date" type="date" @on-change="timeMethod" style="width: 200px"></DatePicker>
                  </Col>
                </Row>
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
                  上传多张图片
                  <Modal title="View Image" v-model="visible_more">
                    <img :src="`${domain}/assets/uploads/${imgName_more}`" v-if="visible_more" style="width: 100%">

                  </Modal>
                </div>
                <br>
                <br>
                价格:<Input v-model="price" :number='true' style="width: 20%"></Input>
                <br>
                <br>
                <Button @click.native="update" type="success" long>更新</Button>
              </div>
        </NewMenu>
    </div>
</template>

<script>
  import NewMenu from "@/components/admin/MenuMain"
  
  import {
    Menu,
    Input,
    Select,
    Upload,
    DatePicker
  } from 'iview'
  import axios from 'axios'
  axios.defaults.withCredentials=true;
  var qs = require('qs');
  export default {
    components:{
      NewMenu,
    },
    data () {
      return {
        active_board: '3-1',
        active_main: ['3'],
        domain,
        msg: '这是 admin 管理的页面',
        title: '',
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
        price: '',
        type: '',
        city: '',
        info: '',
        date:'',
        know:'',
        luxian:'',
        ifScence: false,
        defaultList: [
          {
              url:'',
          }
        ],
        defaultList_more: [

        ],
        detail_id:'',
        detailList:{},
        imgName: '',
        imgName_more:'',
        cover:this.$route.params.photo,
        content:this.$route.params.imgs,
        photo:'',
        visible: false,
        visible_more:false,
        uploadList: [],
        uploadList_more:[],
        upload_link: `${domain}/upload/do_upload`,
        update_link:`${domain}/Admin/update`,
        current_user_link: `${domain}/user/current_user`,
        detail_link:`${domain}/Admin/detail?detail_id=${this.$route.params.did}`,
        imgList: '',
        pics: '',
      }
    },

    methods: {
      handleView (name) {
        this.imgName = name;
        log('this.imgName', this.imgName)
        this.visible = true;
      },
      handleView_more (name) {
        this.imgName_more = name;
        log('this.imgName', this.imgName_more)
        this.visible_more = true;
      },
      handleRemove (file) {
        const fileList = this.$refs.upload.fileList;
        this.cover = this.cover.replace(this.$refs.upload.fileList[fileList.indexOf(file)].name,'');
        log('this.cover:',this.cover);
        this.$refs.upload.fileList.splice(fileList.indexOf(file), 1);
      },
      handleRemove_more (file) {

        const fileList = this.$refs.upload_more.fileList;
        log('indexOf:',fileList.indexOf(file));
        this.content = this.content.replace(this.$refs.upload_more.fileList[fileList.indexOf(file)].name,'');
        log('this.content',this.content);

//        log('indexOf aa:',this.$refs.upload_more.fileList[fileList.indexOf(file)].name);


        this.$refs.upload_more.fileList.splice(fileList.indexOf(file), 1);
//        log('fileList:',this.$refs.upload_more.fileList);
        this.update();
      },
      handleSuccess (res, file) {
        log('文件上传成功', res, file)
        const filename = res
        this.cover += filename;
        // this.defaultList.push({
        //     'name': filename,
        //     'url': `${domain}/assets/uploads/${filename}`,
        // })
        // log('文件上传成功', res, file)
        file.url = `${domain}/assets/uploads/${filename}`;
        file.name = filename;
      },
      handleSuccess_more (res, file) {
        log('文件上传成功', res, file)
        const filename = res;
        this.content = this.content+ '==' +filename;
        // this.defaultList.push({
        //     'name': filename,
        //     'url': `${domain}/assets/uploads/${filename}`,
        // })
        // log('文件上传成功', res, file)
        file.url = `${domain}/assets/uploads/${filename}`;
        file.name = filename;
      },
      update(){
        log('更新按钮被点击');
        const data = {
          title:this.title,
          city:this.city,
          info:this.info,
          know:this.know,
          luxian:this.luxian,
          date:this.date,
          price:this.price,
          cover:this.cover,
          content:this.content,
          did:this.$route.params.did
        }
        log(data);
        axios.post(this.update_link,
          qs.stringify(data),
        ).then(res=>{
          log('success', res.data);
//          this.$router.push('/show');
//          alert('更新成功');
        }).catch(res=>{
          log('fail');
        })
      },
      get_current_user() {
        axios.get(this.current_user_link).then(res => {
          log('请求 current_user 成功', res.data)
          if (res.data == '') {
            this.current_user = '游客'
          } else {
            this.current_user = res.data
            this.ifLogout = true
          }

        }).catch(res => {
          log('请求 session 失败')
        })
      },
      timeMethod(a, b) {
        log('time change', a)
        this.date = a
      }
    },
    created() {
      this.get_current_user()
      log('id:', this.$route.params.did);
      this.detail_link = `${domain}/Admin/detail`;
      this.cover = this.$route.params.photo;
      this.content = this.$route.params.imgs

      axios.get(this.detail_link,{
          params:{
              detail_id:this.$route.params.did,
              photo:this.$route.params.photo,
              imgs:this.$route.params.imgs,
          },
      }).then(res=>{
        log('接受到的数据:',res.data);
        this.title = res.data.deeptrip_title;
        this.city = res.data.deeptrip_city;
        this.info = res.data.deeptrip_info;
        this.luxian = res.data.deeptrip_line_info;
        this.know = res.data.deeptrip_message;
        this.date = res.data.deeptrip_time;
        this.price = res.data.deeptrip_price;
        this.cover = res.data.deeptrip_photo;
        this.content = res.data.deeptrip_conimg;
      }).catch(res=>{
        log('failed');
      });


      this.defaultList = [
        {
            url: `${domain}/assets/uploads/${this.$route.params.photo}`,
            name: `${this.$route.params.photo}`,
        }
      ]

//      log('this.imgList', this.$route.params.imgs)
      this.imgList = this.$route.params.imgs.split('==').slice(1)
      this.imgList.forEach(e=>{
//          log('e inner', e)
          if(e!=''){
//            log('e != inner', e)
            this.defaultList_more.push({
                url:`${domain}/assets/uploads/${e}`,
                name:e,
              })
          }
      })


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
