<template>
    <div class="wrapper">
        <router-link to="/">Home</router-link>
        <div class="container">
            <router-view></router-view>
        </div>

    </div>
</template>

<script>
export default {
    created(){
        console.log('component load')
    }

}
</script>
