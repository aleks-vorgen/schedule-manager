<template>
    <main>
        <div class="col-12 mb-2 text-end">
            <router-link :to='{name:"groupList"}' v-if="group_id" class='btn btn-primary'>Назад</router-link>
            <router-link :to='{name:"studentAdd"}' v-else class='btn btn-primary'>Добавить студента</router-link>
        </div>
        <div class="col-12">
            <table class="table table-responsive table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Имя</th>
                    <th v-if="!group_id">Группа</th>
                    <th>Опции</th>
                </tr>
                </thead>
                <tbody v-if="students.length > 0">
                <tr v-for="(student, key) in students" :key="key">
                    <td>{{ student.id }}</td>
                    <td>
                        <span class="link-secondary" style="cursor: pointer" @click="showStudent(student.id)">
                            {{ student.name }} {{ student.surname }}
                        </span>
                        <div  class="card" v-if="show_student_card === student.id">
                            <div class="card-body">
                                <h5 class="card-title">{{ student.name }} {{ student.surname }}</h5>
                                <p class="card-text">Студент учится в группе<br>{{ student.group_title }}</p>
                                <a href="#" class="btn btn-primary" @click="show_student_card = false">Закрыть</a>
                            </div>
                        </div>
                    </td>
                    <td v-if="!group_id">
                        {{ student.group_title }}
                    </td>
                    <td>
                        <router-link :to='{name:"studentEdit", params:{id:student.id}}' class="btn btn-success">
                            Редактировать
                        </router-link>
                        <button type="button" @click="deleteStudent(student.id)" class="btn btn-danger">Удалить</button>
                    </td>
                </tr>
                </tbody>
                <tbody v-else>
                <tr>
                    <td colspan="3" class="text-center">Список студентов пуст</td>
                </tr>
                </tbody>
            </table>


        </div>
    </main>
</template>

<script>
    export default {
        name: "studentList",
        data() {
            return {
                student: {
                    name: "",
                    surname: "",
                    group_title: "",
                },
                students: [],
                group_id: this.$route.params.group_id,
                show_student_card: "",
            }
        },
        mounted() {
            if(this.group_id)
                this.getStudentsByGroup(this.group_id)
            else
                this.getStudents()
        },
        methods: {
            getStudents() {
                this.axios.get('/api/admin/student').then(response => {
                    this.students = response.data
                }).catch(error => {
                    alert("Request failed")
                })
            },
            getStudentsByGroup(id) {
                this.axios.get(`/api/admin/student/?id=${id}`).then(response => {
                    this.students = response.data
                }).catch(error => {
                    alert("Request failed")
                })
            },
            deleteStudent(id) {
                if (confirm("Вы уверены, что хотите удалить студента?")) {
                    this.axios.delete(`/api/admin/student/${id}`).then(response => {
                        this.getStudents()
                        alert(response.data.message)
                    }).catch(error => {
                        alert("Request failed")
                    })
                }
            },
            showStudent(id) {
                this.axios.get(`/api/admin/student/${id}`).then(response => {
                    this.student = response.data
                    this.show_student_card = id
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
