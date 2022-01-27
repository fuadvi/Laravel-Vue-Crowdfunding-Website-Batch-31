<template>
    <div>
       <v-card v-if="campaign.id">
           <v-img
            :src="campaign.image"
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
                    <tr>
                        <td><v-icon>mdi-hand-heart</v-icon> Terkumpul</td>
                        <td class="yellow--text">{{ rupiah(campaign.collected) }}</td>
                    </tr>
                    <tr>
                        <td><v-icon>mdi-cash</v-icon> Dibutuhkan</td>
                        <td class="orange--text">{{ rupiah(campaign.required) }}</td>
                    </tr>
                </tbody>
           </v-simple-table>

            Description: <br>
            {{ campaign.description }}

       </v-card-text>

       <v-card-actions>
           <v-btn block color="primary" @click="donate" :disabled="campaign.collected >= campaign.required">
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
    computed:{

    },
    methods: {
        go(){
            let {id} = this.$route.params
            let url = '/api/campaign/'+id
            axios.get(url)
            .then((res) => {
                let {data} = res.data
                this.campaign = data.campaign
                console.log(this.campaign)

            })
            .catch((err) => {
                let {res} = err
                console.log(res)
            })
        },
        donate(){
            alert('Terimakasi telah melakukan donate')
            this.$store.commit('insert')
        },
          rupiah (number){
            return new Intl.NumberFormat("id-ID", {
            style: "currency",
            currency: "IDR"
            }).format(number);
        }
    },
}
</script>

