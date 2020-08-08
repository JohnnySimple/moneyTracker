<template>
    <div class="logout">
        
    </div>
</template>

<script>
import router from '../router';
export default {
    name: 'logout',
    data () {
        return {

        }
    },
    mounted () {
        if(sessionStorage.getItem('username')) {
            sessionStorage.removeItem('username');
            sessionStorage.removeItem('token');
            router.push('/');
            history.go();
        }
            
    }
}
</script>

<style scoped>

</style>