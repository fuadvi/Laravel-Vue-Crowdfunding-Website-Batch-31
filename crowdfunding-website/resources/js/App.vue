<template>
   <!-- App.vue -->

    <v-app>


        <alert></alert>

        <keep-alive>
            <v-dialog v-model="dialog" fullscreen hide-overlay persistent transition="dialog-bottom-transition">
                <component :is="currentComponent" @closed="setDialogStatus"></component>
            </v-dialog>
        </keep-alive>


        <v-navigation-drawer app v-model="drawer">
            <v-list>
                <v-list-item v-if="!guest">
                    <v-list-item-avatar>
                        <v-img :src="user.user.photo_profile"></v-img>
                    </v-list-item-avatar>
                    <v-list-item-content>
                        <v-list-item-title>{{  user.user.nama }}</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>

                <div class="pa-2" v-if="guest">
                    <v-btn block color="primary" class="mb-1"  @click="setComponent('login')">
                        <v-icon left>mdi-lock</v-icon>
                        Login
                    </v-btn>
                    <v-btn block color="success">
                        <v-icon left>mdi-account</v-icon>
                        Register
                    </v-btn>
                </div>
                <v-divider />

                <v-list-item
                    v-for="(item,index) in menus"
                    :key="`menu-`+index"
                    :to="item.route"
                >
                    <v-list-item-icon>
                        <v-icon left>{{ item.icon }}</v-icon>
                    </v-list-item-icon>

                    <v-list-item-content>
                        <v-list-item-title>{{ item.title }}</v-list-item-title>
                    </v-list-item-content>

                </v-list-item>

            </v-list>
                <template v-slot:append v-if="!guest">
                    <div class="pa-2">
                        <v-btn block color="red" dark @click="logout">
                            <v-icon left>mdi-lock</v-icon>
                            Logout
                        </v-btn>
                    </div>
                </template>


        </v-navigation-drawer>

        <v-app-bar app color="success" dark v-if="isHome">
            <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
            <v-toolbar-title>SanbercodeApp</v-toolbar-title>

            <v-spacer></v-spacer>

            <v-btn icon>
                <v-badge color="orange" overlap v-if="transaction > 0">
                    <template v-slot:badge>
                        <span>{{ transaction }}</span>
                    </template>
                    <v-icon>mdi-cash-multiple</v-icon>
                </v-badge>
                    <v-icon v-else>mdi-cash-multiple</v-icon>
            </v-btn>

            <v-text-field
                slot="extension"
                hide-details
                append-icon="mdi-microphone"
                flat
                label="Search"
                prepend-inner-icon="mdi-magnify"
                solo-inverted
                @click="setComponent('search')"
            />
        </v-app-bar>

        <v-app-bar app color="success" dark v-else>
            <v-btn icon @click.stop="$router.go(-1)">
                <v-icon>mdi-arrow-left-circle</v-icon>
            </v-btn>

            <v-spacer></v-spacer>

            <v-btn icon>
                <v-badge color="orange" overlap v-if="transaction > 0">
                    <template v-slot:badge>
                        <span>{{ transaction }}</span>
                    </template>
                    <v-icon>mdi-cash-multiple</v-icon>
                </v-badge>
                    <v-icon v-else>mdi-cash-multiple</v-icon>
            </v-btn>

        </v-app-bar>

        <!-- Sizes your content based upon application components -->
        <v-main>

            <!-- Provides the application the proper gutter -->
            <v-container fluid>

                <!-- If using vue-router -->
                <v-slide-y-transition>
                    <router-view></router-view>
                </v-slide-y-transition>
            </v-container>
        </v-main>

        <v-card>
            <v-footer absolute app>
                <v-card-text class="text-center">
                    &copy; {{ new Date().getFullYear() }} - <strong>Sanbercode</strong>
                </v-card-text>
            </v-footer>
        </v-card>
    </v-app>
</template>

<script>
import axios from 'axios'
import { mapActions, mapGetters } from 'vuex'
export default {
   name:'App',
   components : {
        Alert : () => import('./components/Alert'),
        Search : () => import('./components/Search.vue'),
        Login : () => import('./components/Login.vue'),


   },
   data: () =>({
       drawer: false,
       menus: [
           {title:'Home',icon:'mdi-home', route:'/'},
           {title:'Campigns',icon:'mdi-hand-heart', route:'/campigns'}
       ],
   }),
   computed: {
       isHome () {
           return (this.$route.path === '/' || this.$route.path ==='/home')
       },
       ...mapGetters({
           'transaction' : 'transaction/transactions',
            guest : 'auth/guest',
            user : 'auth/user',
            dialogStatus : 'dialog/status',
            currentComponent : 'dialog/component'

       }),
       dialog:{
           get(){
               return this.dialogStatus
           },
           set(value){
               this.dialogStatus(value)
           }
       }

   },
    methods: {
        ...mapActions({
            setDialogStatus: 'dialog/setStatus',
            setComponent: 'dialog/setComponent',
            setAlert : 'alert/set',
            setAuth: 'auth/set'
        }),
        logout(){
            let config = {
                headers : {
                    'Authorization' : 'Barrer' + this.user.token
                }
            }
            axios.post('/api/auth/logout',{},config)
            .then((res) => {
                this.setAuth({})
                this.setAlert({
                    status: true,
                    color: 'success',
                    text: 'Logout berhasil'
                })
            }).catch((err) =>{
                let {data} = err.message
                 this.setAlert({
                    status: true,
                    color: 'error',
                    text: data.message
                })
            })
        }
    }

}
</script>
