<template>
        <el-row>
            <el-col :span="24" v-for="post in post" :key="post.id">
                <div class="content">
                    <div class="content-inner">
                        <h4 class="post-title">{{post.title}}</h4>
                        <p class="post-content">{{post.text}}</p>
                        <i class="el-icon-view"><span class="watch">{{post.watch}}</span></i>
                        <div>
                            <el-form label-width="100px" :model="formComment">
                                <el-form-item >
                                    <el-input type="text" v-model="formComment.subject" placeholder="Тема коментаря"></el-input>
                                </el-form-item>
                                <el-form-item>
                                    <el-input type="textarea" v-model="formComment.body" placeholder="Текст коментаря"></el-input>
                                </el-form-item>
                                <el-form-item>
                                    <el-button type="primary" @click="submitForm('formComment')">Відправити</el-button>
                                </el-form-item>
                            </el-form>
                        </div>
                    </div>
                </div>
            </el-col>
        </el-row>
</template>
<style>
    .el-row {
        margin-bottom: 20px;
    }

    .el-col {
        border-radius: 4px;
    }

    .content {
        border: 2px solid gray;
        border-radius: 25px;
    }

    .content-inner {
        margin: 10px 50px;
    }

    .post-title {
        text-align: center;
        text-transform: uppercase;
    }

    /* .post-content {
        
    } */
</style>
<script>
export default {
    props: [
        'postId'
    ],
    data() {
            return {
                post: [],
                formComment: {
                    subject: '',
                    body: ''
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
                    .get('/api/posts/'+this.postId)
                    .then(response => {
                        this.post = response.data
                    })
                    .catch(error => {
                        console.log(error)
                        this.errored = true;
                    })
            },
            submitForm() {
                axios
                    .post('/api/comments', {
                        subject: this.formComment.subject,
                        body: this.formComment.body
                    })
                    .then(response => {
                        this.replyComment = response
                        console.log(this.replyComment)
                    })
            }     
        }
}
</script>