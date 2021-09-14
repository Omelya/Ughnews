<template>
    <el-container>
        <el-row>
            <el-col :span="9" v-for="post in posts" :key="post.id" >
                <router-link class="post-link" :to="{name: 'showPost', params: {postId: post.id}}">
                    <el-card :body-style="{ padding: '15px'}">
                    <img src="https://shadow.elemecdn.com/app/element/hamburger.9cf7b091-55e9-11e9-a976-7f4d0b07eef6.png" class="image">
                    <div style="padding: 14px;">
                        <h4 class="title">{{post.title}}</h4>
                        <div class="bottom clearfix">
                        <p>{{post.text.substring(0, 100)+ '...'}}</p>
                        <div class="icon-post">
                            <i class="el-icon-view"><span class="watch">{{post.watch}}</span></i>
                            <i class="el-icon-star-off"><span class="watch">{{post.likes}}</span></i>
                        </div>
                        </div>
                    </div>
                    </el-card>
                </router-link>
            </el-col>
        </el-row>
    </el-container>
</template>
<style>
    .post-link {
        text-decoration: none;
    }

    .el-row {
        margin: 20px;
    }

    .el-col {
        margin: 10px;
    }

    .title {
        text-align: center;
        text-transform: uppercase;
    }

    .bottom {
        margin-top: 13px;
        line-height: 20px;
    }

    .image {
        width: 100%;
        display: block;
    }

    .clearfix:before,
    .clearfix:after {
        display: table;
        content: "";
    }

    .clearfix:after {
        clear: both
    }

    .icon-post {
        display: flex;
        justify-content: space-around;
    }

    .watch {
        padding-left: 5px;
    }
</style>
<script>
    export default {
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
                post_id: '',
                edit: false,
                errored: false
            }
        },
        mounted() {
            this.getPosts()
        },
        methods: {
            getPosts() {
                axios.get('/api/last_posts')
                .then(response => {
                    this.posts = response.data
                })
                .catch(error => {
                    console.log(error)
                    this.errored = true;
                })
            }
        }
    }
</script>