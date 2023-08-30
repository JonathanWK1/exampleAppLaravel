<template>
    <div class="container">
        <button type="button" class="btn btn-primary " @click="followUser" v-text="buttonText"></button>
    </div>
</template>

<script>
    export default {
        props:['userId','follow'],
        mounted() {
            console.log('Component mounted.')
        },
        data: function(){
                return {
                    status: this.follow,
                }
            },

        methods:{
            followUser(){
                axios.post('/follow/' + this.userId)
                .then(response => {
                    this.status = !this.status;
                    console.log(response.data);
                }).catch(
                    error =>{
                        console.log(this.userId);
                        console.log(this.follow);
                        console.log(error);
                    }
                );
            }
        },
        computed:{
            buttonText(){
                return (this.status) ? 'Unfollow' : 'follow';
            }
        }
    }

</script>
