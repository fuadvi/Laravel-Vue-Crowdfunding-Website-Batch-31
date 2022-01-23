<template>
    <div>
       <v-card v-if="campaign.id">
           <v-img
            :src="campaign"
            class="white--text"
            height="200px"
            >
                <v-card-title
                    class="fill-height align-end"
                    v-text="campaign.title">
                </v-card-title>
           </v-img>
       </v-card>
       <v-card-text>
           <v-simple-table dense>
                <tbody>
                    <tr>
                        <td><v-icon>mdi-home-city</v-icon> Alamat</td>
                        <td>{{ campaign.address }}</td>
                    </tr>
                </tbody>
           </v-simple-table>

            Description: <br>
            {{ campaign.description }}

       </v-card-text>
       <v-card-actions>
           <v-btn color="primary" @click="donate" :disabled="campaign.collected >= campaign.required">
               <v-icon>mdi-money</v-icon> &nbsp;
               Donate
           </v-btn>
       </v-card-actions>
    </div>
</template>

<script>

export default {
    data: () => ({
        campaign: {},

    }),
    created(){
        this.go()
    },
    methods: {
        go(){
            let {id} = this.$route.params
            let url = 'api/campaign'+id
            axios.get(url)
            .then((res) => {
                let {data} = res.data
                this.campaign = data.campaign

            })
            .catch((err) => {
                let {res} = err
                console.log(res)
            })
        },
        donate(){
            alert('donate')
        }
    },
}
</script>

