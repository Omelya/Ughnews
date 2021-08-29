<template>
    <div>
        <el-row>
            <el-col :span="9" v-for="post in posts" :key="post_id" >
                <el-card :body-style="{ padding: '0px' }">
                <img src="https://shadow.elemecdn.com/app/element/hamburger.9cf7b091-55e9-11e9-a976-7f4d0b07eef6.png" class="image">
                <div style="padding: 14px;">
                    <span>{{post.title}}</span>
                    <div class="bottom clearfix">
                    <span>{{post.text}}</span>
                    <span>{{post.watch}}</span>
                    </div>
                </div>
                </el-card>
            </el-col>
        </el-row>
    </div>
</template>
<style>
    .bottom {
        margin-top: 13px;
        line-height: 12px;
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
                pagination: {},
                edit: false,
                errored: false
            }
        },
        mounted() {
            this.getPosts()
        },
        methods: {
            getPosts() {
                axios.get('/api/posts')
                .then(response => {
                    this.posts = response.data.data
                    console.log(response.data.data)
                })
                .catch(error => {
                    console.log(error)
                    this.errored = true;
                })
            }
        }
    }
</script>