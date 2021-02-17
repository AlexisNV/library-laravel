<template>
<p>{{ message }}</p>
</template>

<script>
    export default {
        props: ['message'],
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
