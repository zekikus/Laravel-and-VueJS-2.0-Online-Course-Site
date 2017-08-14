<template>
    <div class="col-lg-8 col-lg-offset-2">
        <input type="text" v-model="query" class="form-control" @keyup.enter="search" placeholder="Search Course.."/>
        <hr/>
        <div v-for="course in results">
            <div class="resultBox">
                <img :src="course.image" class="image-side" width="100px" height="100px"/>
                <div class="text-side">
                    <p><a :href="courseLink(course)">{{course.name}}</a></p>
                    <p>{{course.description.substring(0,75)}}...</p>
                    <span style="color: darkred" v-if="isMyCourse(course)"><b>Your Course</b></span>
                    <span  style="color: darkred" v-if="!isMyCourse(course)"><a :href="profileLink(course)">{{course.user.name}}</a></span>
                </div>
            </div>
            <hr/>
        </div>
    </div>
</template>

<script>

    var algoliasearch = require('algoliasearch');
    var client = algoliasearch("QXYA9H4J43", "de6b7177a3dc135b0ced70a63c91a0e9");
    var index = client.initIndex('courses');

    export default {
        data(){
            return{
                query:'',
                results: []
            }
        },
        methods:{
            search(){
                index.search(this.query, (err,content) => {
                    this.results = content.hits;
                });
            },
            courseLink(course){
                return '/courses/' + course.slug;
            },
            profileLink(course){
                return '/profiles/' + course.user_id;
            },
            isMyCourse(course){
                console.log(course);
                return this.$store.state.auth_user.id == course.user_id;
            }
        }
    }
</script>

<style>
    .resultBox{
        background: rgba(255, 255, 255, 0.15);
        padding: 15px;
        box-shadow: 1px 1px 10px 1px black;
    }

    .image-side{
        display:inline-block;
        float:left;
    }

    .text-side{
        display: inline-block;
        margin-left: 15px;
        clear: right;
    }
</style>