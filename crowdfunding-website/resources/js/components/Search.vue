<template>
    <v-card>
        <v-toolbar dark color="success">
            <v-btn icon dark @click.native="close">
                <v-icon>mdi-close</v-icon>
            </v-btn>
            <v-text-field
                hide-details
                append-icon="mdi-microphone"
                flat
                autofocus
                label="Search"
                prepend-inner-icon="mdi-magnify"
                v-model="keyword"
                @input="doSearch"
            ></v-text-field>
        </v-toolbar>
        <v-card-text>
            <v-subheader v-if="keyword.lenght>0">
                Result search "{{ keyword }}"
            </v-subheader>
            <v-alert
                :value="campaigns.lenght==0 && keyword.lenght > 0"
                color="warning"
                outlined
            >
                Sorry, but no results were found.
            </v-alert>

            <v-container class="ma-0 pa-0" grid-list-sm>
                <v-layout wrap>
                    <v-flex v-for="campaign in campaigns" :key="`campaign-`+campaign.id">
                        <campaign-item :campaign="campaign" @click.native="close"/>
                    </v-flex>
                </v-layout>
            </v-container>
        </v-card-text>
    </v-card>

</template>

<script>
export default {

name: 'search',
components:{
    campaignItem: () => import('../components/CampaignItem')
},
data() {
    return {
        keyword:'',
        campaigns: []
    }
},
methods: {
    doSearch(){
        let keyword = this.keyword
        if (keyword.length > 0) {
            let url = '/api/campaign/search/'+keyword
            axios.get(url)
            .then((res) =>{
                let { data } = res.data
                this.campaigns = data.campaigns
                console.log(this.campaigns)
            } )
            .catch((err) => console.log(err))
        }else{
            this.campaigns = []
        }
    },
    close(){
        this.$emit('closed',false)
    }
},

}
</script>
