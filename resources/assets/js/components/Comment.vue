<template>
    <li class="list-group-item">
        {{ comment.user.name }} said {{ comment.content }}
        <a @click="replyToComment = comment">Reply</a>
        <comment-form v-if="replyToComment == comment" :comment="comment"></comment-form>
        <comment-list v-if="collection[comment.id]" v-bind:comments="collection[comment.id]" v-bind:collection="collection"></comment-list>
    </li>
</template>
<script>
    import CommentList from './CommentList.vue';
    import CommentForm from './CommentForm.vue';

    export default{
        props: ['comment', 'collection'],
        data(){
            return {
                replyToComment: false
            }
        },
        mounted(){
        },
        components: {
            'comment-list': CommentList,
            'comment-form': CommentForm
        }
    }
</script>
