<template>
    <div class="container" >
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit {{course.name}}
                    <span class="pull-right">
                        <button @click="updateCourse" class="btn btn-success">Save</button>
                    </span>
                    </div>

                    <div class="panel-body">
                        <form method="POST"  enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" v-model="course.name"  class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" class="form-control" v-model="course.description"></textarea>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Lessons</div>

                    <div class="panel-body">
                        <div v-for="(lesson,index) in course.lessons" class="form-inline">
                            <label>Name:</label>
                            <input type="text" v-model="lesson.name" class="form-control"/>&nbsp;
                            <label>Description:</label>
                            <textarea v-model="lesson.description" cols="40" class="form-control"></textarea>
                            <button @click="remove(index)" class="btn btn-danger pull-right">&times;</button>
                            <hr/>
                        </div>
                        <button @click="addLesson" class="btn pull-right">Add Lesson</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {put} from '../helpers/api'
    export default {
        name: 'edit-course',
        mounted() {
            this.course = this.info;
            this.auth_user = this.$store.state.auth_user;
        },
        data(){
            return {
                course : '',
                auth_user: ''
            }
        },
        props: ['info'],
        methods:{
            addLesson(){
                this.course.lessons.push({'name':'','description':''});
            },
            remove(index){
                this.course.lessons.splice(index,1);
            },
            updateCourse(){
                put('/courses/' + this.course.slug,this.course)
                    .then((res) => {
                        if(res.data.status == 'saved')
                            console.log('Update Successfully');
                    })
            }
        }
    }
</script>
