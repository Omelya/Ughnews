<template>
        <el-row>
            <el-col :span="24" v-for="post in post" :key="post.id">
                <div class="content">
                    <div class="content-inner">
                        <h4 class="post-title">{{post.title}}</h4>
                        <p class="post-content">{{post.text}}</p>
                        <i class="el-icon-view"><span class="watch">{{post.watch}}</span></i>
                        <i class="el-icon-star-off" id="el-icon-star" @click="likesCount(post.likes)"><span class="watch">{{post.likes}}</span></i>
                        <div class="form-container">
                            <div id="success" hidden>
                                <el-alert
                                    :title="sendComment"
                                    type="success"
                                    center
                                    show-icon>
                                </el-alert>
                            </div>
                            <h3 class="comment-title" id="title-comment" >Залишити коментар</h3>
                            <el-alert
                                v-if="errors"
                                effect="dark"
                                description="Наявні незаповнені поля"
                                type="error"
                                :closable="false">
                            </el-alert>
                            <div>
                                <div v-if="errored">
                                    <div v-for="error in errored" :key="error.lenght">
                                        <el-alert
                                        :title="String(error)"
                                        type="error"
                                        effect="dark"
                                        :closable="false">
                                        </el-alert>
                                    </div>
                                </div>
                                <div id="form-comment">
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
                    </div>
                </div>
            </el-col>
        </el-row>
</template>
<style>
    .el-row {
        margin-bottom: 20px;
    }

    .el-alert {
        margin-left: 100px;
        margin-bottom: 20px;
        max-width: 300px;
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

    .form-container {
        margin-top: 100px;
        margin-left: -100px;
    }
    
    #success {
        margin-left: 100px;
    }

    .comment-title {
        margin-left: 100px;
    }

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
                sendComment: '',
                errors: false,
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
                
                if(!this.formComment.subject || !this.formComment.body) {
                    this.errors = true;
                }

                if(this.formComment.subject && this.formComment.body) {
                    this.errors = false;
                    
                    document.getElementById('title-comment').hidden = true;

                    document.getElementById('form-comment').hidden = true;

                    document.getElementById('success').hidden = false;

                    axios
                        .post('/api/comments', {
                            subject: this.formComment.subject,
                            body: this.formComment.body
                        })
                        .then(response => {
                            this.sendComment = response.data
                        })
                        .catch(error => {
                            this.errored = true;
                            this.errored = error
                            this.errored = error.response.data.errors
                        })
                }
            },
            likesCount(response) {
                let icon = document.getElementById('el-icon-star');

                if(icon.className === 'el-icon-star-off') {
                    let likes = response + 1;

                    icon.className = 'el-icon-star-on';

                    axios
                    .patch('/api/posts/'+this.postId, {
                        likes
                    })
                    .then(response => {
                        this.like = response.data
                        this.getPost()
                    })
                    
                } else if(icon.className === 'el-icon-star-on') {
                    let likes = response - 1;

                    icon.className = 'el-icon-star-off';

                    axios
                    .patch('/api/posts/'+this.postId, {
                        likes
                    })
                    .then(response => {
                        this.like = response.data
                        this.getPost()
                    })
                }  
                
            }
        }
}
</script>