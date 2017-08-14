<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{course.name}}
                        <span class="pull-right">
                            <a class="btn btn-xs btn-primary" v-if="isMyCourse" :href="editLink">Edit</a>
                            <button class="btn btn-xs btn-danger" v-if="isMyCourse" @click="deleteCourse">Remove</button>
                            <a class="btn btn-xs btn-primary" v-if="isJoined" @click="joinCourse">Join</a>
                        </span>
                    </div>

                    <div class="panel-body">
                        <form method="POST"  enctype="multipart/form-data">
                            <div class="form-group">
                                <img :src="imageLink" class="pull-center" width="150px" height="150px"/>
                            </div>
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name"  v-model="course.name" disabled="true" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" v-model="course.description" disabled="true" class="form-control">
                                </textarea>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Lessons</div>
                    <div class="panel-body">

                        <div v-for="lesson in course.lessons">
                            <label>Name:</label><p>{{lesson.name}}</p>
                            <label>Description:</label><p>{{lesson.description}}</p>
                            <hr/>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6" v-if="course.users.length > 0">
                <div class="panel panel-default">
                    <div class="panel-heading">Registered Users</div>
                    <div class="panel-body">
                        <div v-for="user in course.users">
                            <label>Name:</label><p>{{user.name}}</p>
                            <label>Email:</label><p>{{user.email}}</p>
                            <hr/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import {get,del} from '../helpers/api';

    export default {
        name:'show-course',
        mounted(){
            this.course = this.info;
        },
        data(){
            return {
                course : {}
            }
        },
        computed:{
            editLink(){
              return '/courses/' + this.course.slug + '/edit';
            },
            imageLink(){
              return this.course.image;
            },
            isMyCourse(){
                return this.$store.state.auth_user.id == this.course.user_id ;
            },
            isJoined(){
                var check = true;

                if(this.isMyCourse) check = false;

                this.course.users.forEach((user) => {
                    if(this.$store.state.auth_user.name == user.name){
                        check = false;
                    }
                });


                return check;
            }
        },
        methods:{
            joinCourse(){
                get('/courses/' + this.course.id + '/join')
                    .then((res) => {
                        if(res.data.status == 'joined'){
                            this.course.users.push({'name':this.$store.state.auth_user.name, 'email':this.$store.state.auth_user.email});
                        }
                    });
            },
            deleteCourse(){
                del('/courses/' + this.course.id)
                    .then((res) => {
                        if(res.data.status == 'deleted'){
                            console.log(res.data.message);
                        }
                    })
            }
        },
        props:['info']
    }

</script>