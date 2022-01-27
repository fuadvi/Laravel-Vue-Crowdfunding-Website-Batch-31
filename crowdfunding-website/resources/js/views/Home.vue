<template>
    <div>
        <v-container class="ma-0 pa-0" grid-list-sm>
            <div class="text-right">
                <v-btn small text to="/campaigns" class="blue--text">
                    All Campaigns <v-icon>mdi-chevron-right</v-icon>
                </v-btn>
            </div>
            <v-layout wrap>
                <v-flex v-for="(campaign,index) in campaigns" :key="`category-`+campaign.id" xs6>
                    <campaign-item :campaign="campaign" />
                </v-flex>
            </v-layout>
        </v-container>

        <!-- blog -->
        <v-container class="ma-0 pa-0" grid-list-sm>
            <div class="text-right">
                <v-btn small text to="/campaigns" class="blue--text">
                    All Blogs <v-icon>mdi-chevron-right</v-icon>
                </v-btn>
            </div>
            <v-layout wrap>
              <v-carousel hide-delimiters height="250px">
                  <v-carousel-item v-for="(blog, index) in blogs" :key="`blog-`+blog.id">
                      <v-img :src="blog.image" class="fill-height">
                          <v-container fill-height fluid pa="0" ma-0>
                              <v-layout fill-height align-end>
                                  <v-flex xs12 mx-2>
                                      <span class="headline while--text" v-text="blog.title"></span>
                                  </v-flex>
                              </v-layout>
                          </v-container>
                      </v-img>
                  </v-carousel-item>
              </v-carousel>
            </v-layout>
        </v-container>
    </div>
</template>

<script>

export default {
    data: () => ({
        campaigns: [],
        blogs: []
    }),
    components:{
        campaignItem : () => import('../components/CampaignItem')
    },
    created(){
        axios.get('api/campaign/random/2')
        .then((res) => {
            console.log(res.data)
            let {data} = res.data
            this.campaigns = data.campaigns
        }).catch((err) => {
            let {res} = err
            console.log(res)
        })

        axios.get('api/blog/random/2')
        .then((res) => {
            console.log(res.data)
            let {data} = res.data
            this.blogs = data.blogs
        }).catch((err) => {
            let {res} = err
            console.log(res)
        })
    }
}
</script>
