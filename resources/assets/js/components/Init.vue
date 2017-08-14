<template>

</template>
<script>
    import {get} from 'axios';
    export default {
        mounted(){
            get('/auth_user')
                .then((res) => {
                    this.$store.commit('addAuthUser',res.data);
                });
        }
    }
</script>