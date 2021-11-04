<template>
    <form @submit.prevent="updateOrCreate" class="card">
        <h5 class="card-header">Редактировать преподавателя</h5>
        <div class="card-body">
            <div class="alert alert-danger card-title" role="alert" v-if="errors.length">
                Исправьте указанные ошибки:
                <ul>
                    <li v-for="error in errors">{{ error }}</li>
                </ul>
            </div>

            <label for="name" class="card-title form-label">Имя</label>
            <input type="text" id="name" class="card-text form-control mb-3" v-model="teacher.name">

            <label for="surname" class="card-title form-label">Фамилия</label>
            <input type="text" id="surname" class="card-text form-control mb-3" v-model="teacher.surname">

            <label for="lesson_title" class="card-title form-label">Предмет</label>
            <input type="text" id="lesson_title" class="card-text form-control" v-model="teacher.lesson_title">

            <button class="btn btn-primary mt-3" type="submit">Сохранить</button>
            <router-link class="btn btn-secondary mt-3" :to="{name: 'teacherList'}">Вернуться</router-link>
        </div>
    </form>
</template>

<script>
    export default {
        name: "teacherEdit",
        data() {
            return {
                teacher: {
                    name: "",
                    surname: "",
                    lesson_title: "",
                    _method: "",
                },
                errors: []
            }
        },
        mounted() {
            if(this.$route.params.id)
                this.showTeacher()
        },
        methods: {
            showTeacher() {
                this.axios.get(`/api/admin/teacher/${this.$route.params.id}/edit`).then(response=>{
                    this.teacher = response.data
                }).catch(error=>{
                    alert("Request failed")
                })
            },
            updateOrCreate() {
                this.errors = []
                if (!this.teacher.name || this.teacher.name.length < 3 || this.teacher.name.length > 20)
                    this.errors.push('Имя студента введено некорректно (длинна 3-20 символов)')
                if (!this.teacher.surname || this.teacher.surname.length < 3 || this.teacher.surname.length > 20)
                    this.errors.push('Фамилия студента введена некорректно (длинна 3-20 символов)')
                if (!this.teacher.lesson_title || this.teacher.lesson_title < 3 || this.teacher.lesson_title > 20)
                    this.errors.push('Предмет введён некорректно (длинна 3-20 символов)')

                if (!this.errors.length) {
                    if (!this.$route.params.id)
                        this.create()
                    else
                        this.update()
                }
            },
            update() {
                this.teacher._method = "patch"
                this.axios.post(`/api/admin/teacher/${this.$route.params.id}`, this.teacher).then(response=>{
                    this.$router.push({name:"teacherList"})
                    alert("Преподаватель успешно обновлен")
                }).catch(error=>{
                    alert("Request failed")
                })
            },
            create() {
                this.teacher._method = "post"
                this.axios.post('/api/admin/teacher/', this.teacher).then(response=>{
                    this.$router.push({name:"teacherList"})
                    alert("Преподаватель успешно добавлен")
                }).catch(error=>{
                    alert("Request failed")
                })
            }
        }
    }
</script>

<style scoped>

</style>
