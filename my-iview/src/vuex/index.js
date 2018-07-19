import Vue from 'vue'
import Vuex from 'Vuex'
import axios from 'axios'


Vue.use(Vuex)

const log = console.log.bind(console)
const domain = 'http://127.0.0.1/phptest/travel1'

const state = {
    vuex_msg: '这是一条测试数据',
    user_id: '',
    current_user_link: `${domain}/user/current_user`,
    logout_link: `${domain}/user/logout`,
}

const mutations = {
    get_index(state) {
        state.vuex_msg = '通过 mutations 改变 state 数据'
    },
    get_current_user(state) {
        axios.get(state.current_user_link).then(res => {
            // log('请求 current_user 成功', res.data)
            const user_id = res.data.user_id
            if (user_id == null) {
                // log('没有登录')
            } else {
                log('已经登录')
                state.user_id = user_id
            }
            
        }).catch(res => {
            log('请求 session 失败')
        }) 
    },
    get_logout(state) {
        axios.get(state.logout_link).then(res => {
            log('请求 get_logout 成功', res.data)
            
        }).catch(res => {
            log('请求 session 失败')
        }) 
    },

}

const getters = {

}

const actions = {
    // get_logout({commit}) {
    //     axios.get(state.logout_link).then(res => {
    //         commit('get_index')
    //     }).catch(res => {
    //         log('解析失败')
    //     })
    // },
}


export default new Vuex.Store({
    state,
    mutations,
    getters,
    actions,
})