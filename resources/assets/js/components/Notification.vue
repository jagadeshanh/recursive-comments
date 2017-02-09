<template>
	<div></div>
</template>
<script>
	export default{
		mounted(){
			this.listen();
		},
		methods: {
			listen(){
				Echo.channel('status')
				.listen('StatusWasUpdated', (e) => {
					this.$store.commit('pushPost',e.post);
				});
			}
		}
	}
</script>