<template>
    <div>
       <div class="layout">
            <Sider :style="{position: 'fixed', height: '100vh', left: 0, overflow: 'auto'}">
                <Menu :active-name="active_board" theme="dark" width="auto" :open-names="active_main"  @on-select='selectMethod' :accordion='false'>
                    <Submenu name="1">
                        <template slot="title">
                            <Icon type="ios-navigate"></Icon>
                            区域
                        </template>
                        <MenuItem name="1-1">发布区域</MenuItem>
                        <MenuItem name="1-2">管理区域</MenuItem>
                        <MenuItem name="1-3">增删测试</MenuItem>
                    </Submenu>
                    <Submenu name="2">
                        <template slot="title">
                            <Icon type="ios-keypad"></Icon>
                            保险
                        </template>
                        <MenuItem name="2-1">发布保险</MenuItem>
                        <MenuItem name="2-2">管理保险</MenuItem>
                    </Submenu>
                    <Submenu name="3">
                        <template slot="title">
                            <Icon type="ios-analytics"></Icon>
                            深度旅行
                        </template>
                        <MenuItem name="3-1">发布</MenuItem>
                    </Submenu>
                </Menu>
            </Sider>
            <Layout :style="{marginLeft: '200px'}">
                <Header :style="{background: '#fff', boxShadow: '0 2px 3px 2px rgba(0,0,0,.1)'}"></Header>
                <Content :style="{padding: '0 16px 16px'}">
                    <Breadcrumb :style="{margin: '16px 0'}">
                        <BreadcrumbItem>Home</BreadcrumbItem>
                        <BreadcrumbItem>Components</BreadcrumbItem>
                        <BreadcrumbItem>Layout</BreadcrumbItem>
                    </Breadcrumb>
                    <Card>
                        <div style="height: 600px">
                            <slot name='menu_ceil'></slot>
                        </div>

                    </Card>
                </Content>
            </Layout>
        </div>
    </div>
</template>

<script>
import {
    Menu,
    Input,
    Select,
    Upload,
} from 'iview'

export default {
    props: [
        'active_board',
        'active_main',
    ],
    data () {
        return {
            msg: '这是 menu main 子组件',
        }
    },
    methods: {
        selectMethod(name) {
            const dicta = {
                '1-1': 'admin',
                '1-2': 'adminEdit',
                '1-3': 'AdminTest',
                '2-1': 'insurance',
                '2-2': 'insurancedelate',
                '3-1': 'show',
            }
            const path = dicta[name]
            // log('path', path)
            this.$router.push({
                name: path,
            })
            // log('菜单正在被选择:', name)
        },
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


