<template>
    <div>
        {{msg}}

        <Slider v-model="value" range></Slider>
    </div>      
</template>


<script>
import {Slider} from 'iview'


export default {
    components: {
        Slider,
    },
    data () {
        return {
            msg: '测试一下数据',
            value: [20, 50],
        }
    },
    methods: {

    },
    created() {
        log('created')
    },
}
</script>

<style scoped>

</style>


