<template>
    <div class="container">
        
        <button type="button" class="btn btn-primary" @click="likePost" v-html="buttonText"></button>
    </div>
</template>

<script>
    export default {
        props:['postId','like'],
        mounted() {
            console.log('Component mounted.')
        },
        data: function(){
                return {
                    status: this.like,
                }
            },

        methods:{
            likePost(){
                axios.post('/like/' + this.postId)
                .then(response => {
                    this.status = !this.status;
                    console.log(response.data);
                }).catch(
                    error =>{
                        console.log(this.postId);
                        console.log(this.like);
                        console.log(error);
                    }
                );
            }
        },
        computed:{
            buttonText(){
                return (this.status) ? '<i class="fa-solid fa-heart"></i> Like' : '<i class="fa-regular fa-heart"></i> Like';
            }
        }
    }

</script>
