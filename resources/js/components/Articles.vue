<template>
    <el-container>
        <!-- <el-aside >
            <div>
                <el-tag v-for="tag in tags" :key="tag.id">
                    <router-link :to="{name: 'showPostTag', params: {postTag: tag.tags}}">
                        {{tag.tags}}
                    </router-link>
                </el-tag>
            </div>
        </el-aside> -->
        <el-container>
            <el-main>
                <el-row>
                    <el-col :span="10" v-for="post in posts" :key="post.id">
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
            <el-footer>
                <el-pagination 
                    background
                    layout="prev, pager, next"
                    @current-change="handleCurrentChange"
                    @next-click="getPosts(pagination.next_page_url)"
                    @prev-click="getPosts(pagination.prev_page_url)"
                    :page-count="pagination.last_page"
                    >
                </el-pagination>
            </el-footer>
        </el-container>
    </el-container>
        
</template>
<style>
    .el-tag {
        margin: 5px;
    }

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

    .watch {
        padding-left: 5px;
    }
</style>
<script>
    export default {
        data() {
            return {
                posts: [],
                // tags: [],
                post: {
                    id: '',
                    title: '',
                    text: '',
                    watch: '',
                    likes: ''
                },
                post_id: '',
                pagination: {},
                errored: false
            }
        },
        mounted() {
            this.getPosts()
        },
        methods: {
            getPosts(page_url) {
                page_url = page_url || '/api/posts'

                axios
                    .get(page_url)
                    .then(response => {
                        this.posts = response.data.data
                        this.tags = response.data
                        this.makePagination(response.data)
                        // this.posts = response.data[0].data
                        // this.tags = response.data[1]
                        // this.makePagination(response.data[0])
                    })
                    .catch(error => {
                        console.log(error)
                        this.errored = true;
                    })
            },
            makePagination(response) {
                let pagination = {
                    current_page: response.current_page,
                    last_page: response.last_page,
                    prev_page_url: response.prev_page_url,
                    next_page_url: response.next_page_url,
                    path: response.path
                }

                this.pagination = pagination
            },
            handleCurrentChange(val) {
                if(val != undefined) {
                    this.currentPage = this.pagination.path+`?page=${val}`
                    this.getPosts(this.currentPage)
                }
      }      
        }
    }
</script>