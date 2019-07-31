<template>

    <span> {{ this.count }} </span>

</template>

<script>
    export default {
        data() {
            return {
                count: 0
            }
        },
        mounted() {
            setTimeout(this.listen(), 1000);
        },
        methods: {
            listen() {
                Echo.join('counter')
                    .here(users => this.count = users.length)
                    .joining(user => this.count++)
                    .leaving(user => this.count--);
            }
        }
    }
</script> 
