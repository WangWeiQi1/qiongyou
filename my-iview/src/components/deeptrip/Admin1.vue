<template>
  <div>
    <MenuMenu activename="1-1" :activeopen="['1']">
      <div slot="menu_menu">
        <Card>
          <div style="height: 600px">
            <Input v-model="title" placeholder="请输入深度旅行标题" style="width: 70%"></Input>

            <!-- city: {{city}} -->

            <Select v-model="city" style="width:300px" placeholder='选择国家'>
              <Option v-for="item in city_list" :value="item.value" :key="item.value" @change="changeMethod">{{ item.label }}</Option>
            </Select>
            <br>
            <br>
            <Input v-model="info" type="textarea" :rows="2" placeholder="请输入深度旅行相关介绍"></Input>
            <br>
            <br>
            <Input v-model="know" type="textarea" :rows="2" placeholder="深度旅行购买须知"></Input>
            <br>
            <br>
            <Input v-model="luxian" placeholder="请输入深度旅行路线" style="width: 70%"></Input>
            <br>
            <br>
            <Row>
              <Col span="12">
              <DatePicker v-model="date" type="date" @on-change="timeMethod"  placeholder="深度旅行开始时间" style="width: 200px"></DatePicker>
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
            <!--<br>-->
            <!--<br>-->
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
            <Input v-model="price" :number='true' placeholder="请输入深度旅行价格" style="width: 20%"></Input>
            <br>
            <br>
            <Button @click.native="insert" type="success" long>发布</Button>
            <!--<span v-show="warn">发布成功</span>-->
          </div>

        </Card>
      </div>
    </MenuMenu>
  </div>
</template>


<script>
  import MenuMenu from '@/components/deeptrip/MenuMenu'
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
        MenuMenu
      },
    data () {

      return {
//        warn:false,
        cover:'',
        content:'',
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

        ],
        defaultList_more:[

        ],
        imgName: '',
        visible: false,
        visible_more:false,
        uploadList: [],
        uploadList_more:[],
        upload_link: `${domain}/upload/do_upload`,
        add_link:`${domain}/Deeptrip/deeptrip`,
        current_user_link: `${domain}/user/current_user`,
        user_id: '',


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
//        log('fileList:',fileList);
        this.cover = this.cover.replace(this.$refs.upload.fileList[fileList.indexOf(file)].name,'');
//        log('this.cover:',this.cover);
        this.$refs.upload.fileList.splice(fileList.indexOf(file), 1);
      },
      handleRemove_more (file) {
        const fileList = this.$refs.upload_more.fileList;
        this.content = this.content.replace(this.$refs.upload_more.fileList[fileList.indexOf(file)].name,'');
//        log('this.content:',this.content);
        this.$refs.upload_more.fileList.splice(fileList.indexOf(file), 1);
      },
      handleSuccess (res, file) {
        log('文件上传成功', res, file)
        const filename = res
        this.cover = filename;
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
        const filename = res
        this.content = this.content + '==' +filename;
        // this.defaultList.push({
        //     'name': filename,
        //     'url': `${domain}/assets/uploads/${filename}`,
        // })
        // log('文件上传成功', res, file)
        file.url = `${domain}/assets/uploads/${filename}`;
        file.name = filename;
      },
      insert(){
        log('发布按钮被点击');
        const data = {
          deeptrip_title:this.title,
          deeptrip_city:this.city,
          deeptrip_info:this.info,
          deeptrip_message:this.know,
          deeptrip_line_info:this.luxian,
          deeptrip_time:this.date,
          deeptrip_price:this.price,
          deeptrip_photo:this.cover,
          deeptrip_conimg:this.content,
          user_id: this.user_id,
        }
        const params = {
            params:data
        }
        log(params)
        axios.post(this.add_link,
          qs.stringify(params),
        ).then(res=>{
          log('success aa', res.data);
          alert('添加成功');
//          this.warn = true;
          this.$router.push('/show');
        }).catch(res=>{
          log('fail');
        })
      },
      get_current_user() {
        axios.get(this.current_user_link).then(res => {
          log('请求 current_user 成功', res.data)
          this.user_id = res.data.user_id

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
      this.get_current_user();
      this.content = this.$route.params.imgs;
      this.cover = this.$route.params.photo;

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


