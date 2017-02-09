<template>
    <div>
        <input type="text" v-model="content" class="form-control" v-on:keyup.enter="replyTo(comment)">
    </div>
</template>
<style>
</style>
<script>
    export default{
        props: ['comment'],
        data(){
            return{
                content: ''
            }
        },
        methods:{
            replyTo(comment){
                axios.post('/api/comment', {content: this.content, post_id: comment.post_id, parent_id: comment.id}).then(response => {
                   this.content = '';
                   if (!response.data.error) {
                    this.content = '';
                    let payLoad = {
                        post_id: comment.post_id,
                        comments: response.data.data
                    };
                    this.$store.commit('updateComments',payLoad);
                }
            });
            }
        }
    }
</script>
