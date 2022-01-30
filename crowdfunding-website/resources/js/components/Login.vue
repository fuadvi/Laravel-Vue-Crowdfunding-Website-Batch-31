<template>
  <v-card>
    <v-toolbar dark color="success">
        <v-btn icon dark @click.native="close">
            <v-icon>mdi-close</v-icon>
        </v-btn>
    </v-toolbar>

    <v-divider></v-divider>

    <v-container fluid>
        <v-form ref="form" v-model="valid" lazy-validation>
            <v-text-field
                v-model="email"
                :rules="emailRules"
                label="E-email"
                required
                append-icon="mdi-email"
            ></v-text-field>

            <v-text-field
                v-model="password"
                :append-icon="showPassword ? 'mdi-aye' : 'mdi-aye-close'"
                :rules="passwordRules"
                :type="showPassword ? 'text':'password'"
                label="Password"
                hint="At least 6 character"
                counter
                @click:append = "showPassword = !showPassword"
            ></v-text-field>

            <div class="text-xs-center">
                <v-btn
                    color="success lighten-1"
                    :disabled="!valid"
                    @click="submit"
                >
                    Login
                    <v-icon right dark>mdi-lock-open</v-icon>
                </v-btn>
            </div>
        </v-form>
    </v-container>
  </v-card>
</template>

<script>
import axios from 'axios'
import { mapActions, mapGetters } from 'vuex'
export default {
    name:'login',
    data() {
        return {
            valid: true,
            email: "example@example.com",
            emailRules: [
                v => !!v || 'E-email is required',
                v =>  /([a-zA-Z0-9_]{1,})(@)([a-zA-Z0-9_]{2,}).([a-zA-Z0-9_]{2,})+/.test(v) || 'E-email must be valid'
            ],
            showPassword: false,
            password: '',
            passwordRules: [
                v => !!v || 'Password is required',
                v => (v && v.length >= 6) || 'Min 6 character'
            ]
        }
    },
    computed:{
        ...mapGetters({
            user: 'auth/user'
        })
    },
    methods: {
        ...mapActions({
            setAlert : 'alert/set',
            setAuth: 'auth/set'
        }),
        submit(){
            if (this.$refs.form.validate()) {
                let formData = {
                    'email' : this.email,
                    'password' : this.password
                }
                axios.post('/api/auth/login', formData)
                    .then((res)=>{
                        let {data} = res.data
                        this.setAuth(data)
                        if (this.user.user.id.length > 0) {
                            this.setAlert({
                                status : true,
                                color: 'success',
                                text : 'login berhasil'
                            })
                            this.close()
                        }else {
                            this.setAlert({
                                status : true,
                                color: 'error',
                                text : 'login failed'
                            })
                        }
                    })
                    .catch((err) => {
                        let response = err.response
                        this.setAlert({
                                status : true,
                                color : 'error',
                                text: response.data.error,
                            })
                    })
            }
        },
        close(){
            this.$emit('closed',false)
        }
    },
}
</script>
