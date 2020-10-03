<template>
    <div class="profile">
        {{username}}
        {{id}}
    </div>
</template>

<script>
export default {
    name: 'profile',
    data () {
        return {
            username: sessionStorage.getItem('username'),
            id: sessionStorage.getItem('id')
        }
    }
}
</script>

<style scoped>

</style>