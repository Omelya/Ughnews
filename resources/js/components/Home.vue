<template>
    <div>
        <el-row>
            <el-col :span="9" v-for="post in posts" :key="post.id" >
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
            </el-col>
        </el-row>
    </div>
</template>
<style>
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