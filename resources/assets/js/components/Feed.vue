<template>
	<div>
		<div class="panel panel-default" v-for="post in posts">
			<div class="panel-heading">
				{{ post.user.name }} updated status
			</div>
			<div class="panel-body">
				<h4>
					{{ post.content }}
				</h4>
			</div>
			<div class="panel-footer">
				<div class="col-md-12">
					<input type="text" class="form-control" v-model="post.reply" placeholder="leave a comment..." 
					v-on:keyup.enter="comment(post)">
				</div>
				<div class="col-md-12">
					<comment-list v-if="post.comments" :collection="post.comments" :comments="post.comments.root"></comment-list>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</template>
<script>
	import CommentList from './CommentList.vue';
	export default {
		data(){
			return {
				post: {
					reply: ''
				}
			}
		},
		computed: {
			posts(){
				return this.$store.state.posts;
			}
		},
		components: {
			'comment-list': CommentList
		},
		mounted(){
			this.getPosts();
		},
		methods: {
			getPosts(){
				axios.get('/api/post').then(response => {
					if(!response.data.error){
						response.data.data.forEach((post) => {
							this.$store.commit('pushPost',post);
						});
					}
				});
			},
			comment(post){
				axios.post('/api/comment', {content: post.reply, post_id: post.id}).then(response => {
					if (!response.data.error) {
						post.reply = '';
						let payLoad = {
							post_id: post.id,
							comments: response.data.data
						};
						this.$store.commit('updateComments',payLoad);
					}
				});
			}
		}
	}
</script>