<template>
    <el-main>
        <el-row>
            <el-col :span="9" v-for="post in posts" :key="post.id">
                <router-link class="post-link" :to="{name: 'showPost', params: {postId: post.id}}">
                    <el-card :body-style="{ padding: '15px'}">
                    <img src="https://shadow.elemecdn.com/app/element/hamburger.9cf7b091-55e9-11e9-a976-7f4d0b07eef6.png" class="image">
                    <div style="padding: 14px;">
                        <h4 class="title">{{post.title}}</h4>
                        <div class="bottom clearfix">
                        <p>{{post.text.substring(0, 100)+ '...'}}</p>
                        <i class="el-icon-view"><span class="watch">{{post.watch}}</span></i>
                        </div>
                    </div>
                    </el-card>
                </router-link>
            </el-col>
        </el-row>
    </el-main>
</template>
<script>
export default {
    props: [
        'postTag'
    ],
    data() {
        return {
            posts: [],
            post: {
                    id: '',
                    title: '',
                    text: '',
                    watch: '',
                    likes: ''
                },
            errored: false
        }
    },
    mounted() {
        this.getPost()
    },
    methods: {
        getPost() {
                axios
                    .get('/api/posts/'+this.postTag)
                    .then(response => {
                        this.posts = response.data
                    })
                    .catch(error => {
                        console.log(error)
                        this.errored = true;
                    })
            },
    }
}
</script>