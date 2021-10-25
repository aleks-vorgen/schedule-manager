<template>
    <main>
        <div class="col-12 mb-2 text-end">
            <router-link :to='{name:"teacherAdd"}' class='btn btn-primary'>Добавить преподавателя</router-link>
        </div>
        <div class="col-12">
            <table class="table table-responsive table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Имя</th>
                    <th>Предмет</th>
                    <th>Опции</th>
                </tr>
                </thead>
                <tbody v-if="teachers.length > 0">
                <tr v-for="(teacher, key) in teachers" :key="key">
                    <td>{{ teacher.id }}</td>
                    <td>
                        <span class="link-secondary" style="cursor: pointer" @click="showTeacher(teacher.id)">
                            {{ teacher.name }} {{ teacher.surname }}
                        </span>
                        <div  class="card" v-if="show_teacher_card === teacher.id">
                            <div class="card-body">
                                <h5 class="card-title">{{ teacher.name }} {{ teacher.surname }}</h5>
                                <p class="card-text">Преподаватель преподает предмет<br>{{ teacher.lesson_title }}</p>
                                <button type="button" class="btn btn-primary" @click="show_teacher_card = false">Закрыть</button>
                            </div>
                        </div>
                    </td>
                    <td>
                        {{ teacher.lesson_title }}
                    </td>
                    <td>
                        <router-link :to='{name:"teacherEdit", params:{id:teacher.id}}' class="btn btn-success">
                            Редактировать
                        </router-link>
                        <button type="button" @click="deleteTeacher(teacher.id)" class="btn btn-danger">Удалить</button>
                    </td>
                </tr>
                </tbody>
                <tbody v-else>
                <tr>
                    <td colspan="3" class="text-center">Список преподавателей пуст</td>
                </tr>
                </tbody>
            </table>


        </div>
    </main>
</template>

<script>
    export default {
        name: "teacherList",
        data() {
            return {
                teacher: {
                    name: "",
                    surname: "",
                    lesson_title: ""
                },
                teachers: [],
                show_teacher_card: "",
            }
        },
        mounted() {
            this.getTeachers()
        },
        methods: {
            getTeachers() {
                this.axios.get('/api/admin/teacher').then(response => {
                    this.teachers = response.data
                }).catch(error => {
                    alert("Request failed")
                })
            },
            deleteTeacher(id) {
                if (confirm("Вы уверены, что хотите удалить преподавателя?")) {
                    this.axios.delete(`/api/admin/teacher/${id}`).then(response => {
                        this.getTeachers()
                        alert(response.data.message)
                    }).catch(error => {
                        alert("Request failed")
                    })
                }
            },
            showTeacher(id) {
                this.axios.get(`/api/admin/teacher/${id}`).then(response => {
                    this.teacher = response.data
                    this.show_teacher_card = id
                }).catch(error => {
                    console.log(error)
                    alert("Request failed")
                })
            },
        },
    }
</script>

<style scoped>
    .btn {
        border: 1px solid black;
        color: black;
    }

    .btn-success {
        background: lightgray;
    }

    .btn-danger {
        background: darkgray;
    }
</style>
