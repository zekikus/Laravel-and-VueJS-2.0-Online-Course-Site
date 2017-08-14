<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{profile.user.name}}
                        <span v-if="myProfile"><button class="pull-right btn btn-xs btn-success" @click="updateProfile">Save</button></span>
                    </div>

                    <div class="panel-body">
                        <form method="POST"  enctype="multipart/form-data">
                            <div class="form-group">
                                <img :src="profile.avatar" class="pull-center" width="150px" height="150px"/>
                            </div>
                            <div class="form-group">
                                <label>Location</label>
                                <input type="text" v-model="profile.location" :disabled="!myProfile" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea v-model="profile.about" :disabled="!myProfile" class="form-control">
                                </textarea>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">Courses</div>
                    <div class="panel-body">

                        <div v-for="course in profile.courses">
                            <img class="image-side" :src="course.image" width="100px" height="100px"/>
                            <div class="text-side">
                                <label>Name:</label><a :href="courseLink(course)">{{course.name}}</a><br/>
                                <label>Description:</label><p>{{course.description}}</p>
                            </div>
                            <hr/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import {put} from '../helpers/api';

    export default {
        created(){
            this.profile = this.info;
        },
        data(){
            return {
                profile: {}
            }
        },
        computed:{
          myProfile(){
              return this.profile.user_id == this.$store.state.auth_user.id;
          }
        },
        methods:{
            courseLink(course){
                return '/courses/' + course.slug;
            },
            updateProfile(){
                var data = {'location':this.profile.location,'about':this.profile.about};
                put('/profiles/' + this.profile.user_id,data)
                    .then((res) => {
                        alert(res.data.message);
                    });
            }
        },
        props:['info']
    }

</script>

<style>
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