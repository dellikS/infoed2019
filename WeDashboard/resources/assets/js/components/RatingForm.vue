<template>

<form @submit.prevent="postRating">

    <div class="row mb-4">
        <div class="col">
            <star-rating v-model="formData.score" border-color="#192B4F" :increment="0.5" :star-size="36" active-color="#CBB956"></star-rating>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <button type="submit" class="btn btn-light">Rate this business!</button>        
        </div>
    </div>
</form>

</template>

<script>

export default {
    props:['business', 'url'],
    data(){
        return {
            formData:{}
        }
    },
    methods: {
        postRating(){
            this.formData.business_id=this.business.id;
            axios.post(this.url, this.formData)
                .then(data=>{
                    location.reload();
                })
                .catch(error=>{
                    console.log(error);
                })
        }
    }

}

</script>