<template>
  <div>
  </div>
</template>

<script>
import axios from 'axios'
import { mapActions, mapGetters } from 'vuex'
export default {
    data() {
        return {
            code : '',
            provider: ''
        }
    },
    computed:{
        ...mapGetters({
            user : 'auth/user'
        })
    },
    methods: {
        ...mapActions({
            setAlert : 'alert/set',
            setAuth: 'auth/set',
            setDialogStatus : 'dialog/setStatus'
        }),
        go(provider,code){
            let url = '/api/auth/social/'+provider+'/callback?code='+code
            axios.get(url)
                .then((res)=> {
                    let {data} = res.data
                    console.log(res)
                    this.setAuth(data)
                    if (this.user.user.id.length > 0) {
                        this.setAlert({
                            status : true,
                            color: 'success',
                            text : 'login berhasil'
                        })
                        this.setDialogStatus(false)
                        this.$router.push({ name: 'home' })
                    }else {
                        this.setAlert({
                            status : true,
                            color: 'error',
                            text : 'login failed'
                        })
                    }
                }).catch((err)=>{
                    this.setAlert({
                        status:true,
                        color:'error',
                        text:'login failed'
                    })
                })
        }
    },

    mounted() {
        this.code = this.$route.query.code
        this.provider = this.$route.path.split('/')[3]
        this.go(this.provider,this.code)
    },

}
</script>
