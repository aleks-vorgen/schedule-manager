<template>
    <form @submit.prevent="updateOrCreate" class="card">
        <h5 class="card-header">Редактировать студента</h5>
        <div class="card-body">
            <div class="alert alert-danger card-title" role="alert" v-if="errors.length">
                Исправьте указанные ошибки:
                <ul>
                    <li v-for="error in errors">{{ error }}</li>
                </ul>
            </div>

            <label for="name" class="card-title form-label">Имя</label>
            <input type="text" id="name" class="card-text form-control mb-3" v-model="student.name">

            <label for="surname" class="card-title form-label">Фамилия</label>
            <input type="text" id="surname" class="card-text form-control mb-3" v-model="student.surname">

            <label for="group-id" class="card-title form-label">Группа</label>
            <select id="group-id" class="form-select" v-model="student.group_id">
                <option v-for="(group, key) in groups"
                        :value="group.id"
                        :key="key">
                    {{ group.id }}. {{ group.title }}
                </option>
            </select>

            <button class="btn btn-primary mt-3" type="submit">Сохранить</button>
            <router-link class="btn btn-secondary mt-3" :to="{name: 'studentList'}">Вернуться</router-link>
        </div>
    </form>
</template>

<script>
    export default {
        name: "studentEdit",
        data() {
            return {
                student: {
                    name: "",
                    surname: "",
                    group_id: "",
                    _method: "",
                },
                groups: [],
                errors: []
            }
        },
        mounted() {
            this.getGroups()
            if(this.$route.params.id)
                this.showStudent()
        },
        methods: {
            showStudent() {
                this.axios.get(`/api/admin/student/${this.$route.params.id}/edit`).then(response=>{
                    this.student = response.data
                }).catch(error=> {
                    if (error.response.status === 404)
                        alert("Student not found")
                    else
                        alert("Request failed")

                    this.$router.push({name: "studentList"})
                })
            },
            getGroups() {
                this.axios.get('/api/admin/group').then(response => {
                    this.groups = response.data
                }).catch(error => {
                    alert("Request failed")
                })
            },
            updateOrCreate() {
                this.errors = []
                if (!this.student.name || this.student.name.length < 3 || this.student.name.length > 20)
                    this.errors.push('Имя студента введено некорректно (3-20 символов)')
                if (!this.student.surname || this.student.surname.length < 3 || this.student.surname.length > 20)
                    this.errors.push('Фамилия студента введена некорректно (3-20 символов)')
                if (!this.student.group_id)
                    this.errors.push('Выберите группу студента')

                if (!this.errors.length) {
                    if (!this.$route.params.id)
                        this.create()
                    else
                        this.update()
                }
            },
            update() {
                this.student._method = "patch"
                this.axios.post(`/api/admin/student/${this.$route.params.id}`, this.student).then(response=>{
                    this.$router.push({name:"studentList"})
                    alert("Студент успешно обновлен")
                }).catch(error=>{
                    alert("Request failed")
                })
            },
            create() {
                this.student._method = "post"
                this.axios.post('/api/admin/student', this.student).then(response=>{
                    this.$router.push({name:"studentList"})
                    alert("Студент успешно добавлен")
                }).catch(error=>{
                    alert("Request failed")
                })
            }
        }
    }
</script>

<style scoped>

</style>
