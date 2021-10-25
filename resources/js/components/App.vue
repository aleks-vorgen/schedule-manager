<template>
    <main>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <router-link class="navbar-brand" to="/">Schedule<br>Manager</router-link>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <router-link exact-active-class="active" class="nav-link" :to="{name: 'groupList'}">Groups</router-link>
                        <router-link exact-active-class="active" class="nav-link" :to="{name: 'studentList'}">Students</router-link>
                        <router-link exact-active-class="active" class="nav-link" :to="{name: 'teacherList'}">Teachers</router-link>
                        <router-link exact-active-class="active" class="nav-link disabled" to="/admin/schedule">Schedules</router-link>
                    </div>
                </div>
            </div>
        </nav>

        <div class="container mt-3" v-if="$route.path !== '/'">
            <router-view></router-view>
        </div>
    </main>
</template>

<script>
    export default {
        //
    }
</script>

<style scoped>

</style>
