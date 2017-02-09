<template>
	<div class="panel panel-default">
		<div class="panel-heading">What's there in your mind?</div>
		<div class="panel-body">
			<div class="form-group" v-bind:class='[ errors.hasOwnProperty("content") ? "has-error" : "" ]'>
				<textarea v-model="content" rows="3" class="form-control"></textarea>
				<span v-if='[errors.hasOwnProperty("content")]' class="help-block" v-for="error in errors.content">{{ error }}</span>
			</div>
		</div>
		<div class="panel-footer">
			<button class="btn btn-info pull-right" @click="post"><span class="glyphicon glyphicon-share"></span> Share</button>
			<div class="clearfix"></div>
		</div>
	</div>
</template>
<style scoped>
	textarea{
		resize: vertical;
	}
</style>
<script>
	export default{
		data(){
			return {
				content: '',
				errors: []
			}
		},
		methods:{
			post(){
				axios.post('/api/post',{content: this.content}).then(response => {
					if(!response.data.error){
						this.content = '';
					}else{
						this.errors = response.data.data;
					}
				});
			}
		}
	}
</script>