import Vue from 'vue'
import Router from 'vue-router'
import Test from '@/components/Test'
import User from '@/components/user/User'

// 区域部分
import Admin from '@/components/admin/Admin'
import AdminPublish from '@/components/admin/AdminPublish'
import AdminUpdate from '@/components/admin/AdminUpdate'
import AdminLook from '@/components/admin/AdminLook'
import AdminTest from '@/components/admin/AdminTest'


//  保险部分
import Insurance from '@/components/insurance/Insurance'
import Insurancedelate from '@/components/insurance/Insurancedelate'
import InsuranceCon from '@/components/insurance/InsuranceCon'
import Letter from '@/components/insurance/Letter'


// 深度旅行

import Admin1 from '@/components/deeptrip/Admin1'
import Show from '@/components/deeptrip/Show'
import Update from '@/components/deeptrip/Update'



Vue.use(Router)

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'test',
      component: Test,
    },
    {
      path: '/user',
      name: 'user',
      component: User,
    },
    {
      path: '/admin',
      name: 'admin',
      // component: Admin,
      component: AdminPublish,
    },
    {
      path: '/admin/edit',
      name: 'adminEdit',
      component: AdminLook,
    },
    {
      path: '/admin/update/:region_id/:datas',
      name: 'adminUpdate',
      component: AdminUpdate,
    },
    {
      path: '/admin/test',
      name: 'AdminTest',
      component: AdminTest,
    },


    // 保险部分
    {
      path:'/insurance',
      name:'insurance',
      component: Insurance,
    },
    {
      path:'/insurancedelate',
      name:'insurancedelate',
      component:Insurancedelate,
    },
    {
      path:'/insuranceCon/:u',
      name:'insuranceCon',
      component:InsuranceCon
    },
    {
      path:'/letter',
      name:'letter',
      component:Letter
    },

    // 深度旅行

    {
      path:'/show',
      name:'show',
      component:Show,
    },{
      path:'/admin1',
      name:'Admin1',
      component:Admin1,
    },{
      path:'/update/:did/:photo/:imgs',
      name:'Update',
      component:Update,
    }

    
  ]
})
