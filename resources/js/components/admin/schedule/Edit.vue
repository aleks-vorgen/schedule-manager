<template>
    <form @submit.prevent="updateOrCreate" class="card">
        <h5 class="card-header">Редактировать расписание</h5>
        <div class="card-body">
            <div class="alert alert-danger" role="alert" v-if="errors.length">
                Исправьте указанные ошибки:
                <ul>
                    <li v-for="error in errors">{{ error }}</li>
                </ul>
            </div>

            <label for="date">Дата</label>
            <input id="date" type="date" class="form-control mb-3" v-model="schedule.date">

            <label for="time_begin">Начало пары</label>
            <select id="time_begin" class="form-select mb-3" v-model="schedule.time_begin">
                <option v-for="item in time"
                        :value="item"
                        :class="{selected: item === schedule.time_begin}">
                    {{ item }}
                </option>
            </select>

            <label for="group">Группа</label>
            <select id="group" class="form-select mb-3" v-model="schedule.group_id">
                <option v-for="group in groups"
                        :value="group.id">
                    {{ group.id }}. {{ group.title }}
                </option>
            </select>

            <label for="teacher">Преподаватель</label>
            <select id="teacher" class="form-select" v-model="schedule.teacher_id">
                <option v-for="teacher in teachers"
                        :value="teacher.id">
                    {{ teacher.id }}. {{ teacher.name }} {{ teacher.surname }} ({{ teacher.lesson_title }})
                </option>
            </select>

            <button type="submit" class="btn btn-primary mt-3">Сохранить</button>
            <router-link class="btn btn-secondary mt-3" :to="{name: 'scheduleList'}">Вернуться</router-link>
        </div>
    </form>

</template>

<script>
    export default {
        name: "scheduleEdit",
        data() {
            return {
                time: ['08:30', '10:05', '11:40', '14:00', '15:35', '17:10'],
                schedule: {
                    date: "",
                    time_begin: "",
                    group_id: "",
                    teacher_id: "",
                    _method: "",
                },
                groups: [],
                teachers: [],
                errors: []
            }
        },
        mounted() {
            this.getGroups()
            this.getTeachers()
            if (this.$route.params.id)
                this.showSchedule()
        },
        methods: {
            showSchedule() {
                this.axios.get(`/api/admin/schedule/${this.$route.params.id}/edit`).then(response => {
                    const {date, time_begin, group_id, teacher_id} = response.data
                    this.schedule.date = date
                    this.schedule.time_begin = time_begin
                    this.schedule.group_id = group_id
                    this.schedule.teacher_id = teacher_id
                }).catch(error => {
                    console.log(error)
                })
            },
            getGroups() {
                this.axios.get('/api/admin/group/').then(response => {
                    this.groups = response.data
                })
            },
            getTeachers() {
                this.axios.get('/api/admin/teacher/').then(response => {
                    this.teachers = response.data
                })
            },
            updateOrCreate() {
                this.errors = [];
                if (!this.schedule.time_begin)
                    this.errors.push("Выберите время начала пары")
                if (!this.schedule.group_id)
                    this.errors.push("Выберите группу")
                if (!this.schedule.teacher_id)
                    this.errors.push("Выберите преподавателя")

                if (!this.errors.length) {
                    if (!this.$route.params.id)
                        this.create()
                    else
                        this.update()
                }
            },
            update() {
                this.schedule._method = 'patch'
                this.axios.post(`/api/admin/schedule/${this.$route.params.id}`, this.schedule).then(response => {
                    this.$router.push({name: "scheduleList"})
                    alert("Расписание успешно изменено")
                }).catch(error => {
                    alert("Request failed")
                })
            },
            create() {
                this.schedule._method = 'post'
                this.axios.post(`/api/admin/schedule/`, this.schedule).then(response => {
                    this.$router.push({name: "scheduleList"})
                    alert("Расписание успешно добавлено")
                }).catch(error => {
                    alert("Request failed")
                })
            }
        }
    }
</script>
