<template>
    <el-container>
        <el-header>
            <el-menu :router="true" :default-active="activeIndex" class="el-menu-demo" mode="horizontal">
                <el-menu-item  index="/">Home</el-menu-item>
                <el-menu-item  index="articles">Articles</el-menu-item>
            </el-menu>
        </el-header>
        <el-main>
            <router-view></router-view>
        </el-main>
    </el-container> 
</template>

<script>
    export default {
        data() {
            return {
                activeIndex: '/',
            };
        },
        methods: {
           
        }
    }
</script>
