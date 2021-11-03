<template>
    <main>
        <div class="col-12 mb-2 text-end">
            <router-link :to='{name:"scheduleAdd"}' class='btn btn-primary'>Добавить расписание</router-link>
        </div>
        <div class="col-12">
            <table class="table table-responsive table-hover">
                <thead>
                <tr id="day-of-week">
                    <th>Время</th>
                    <th v-for="(weekday, key) in weekdays_ru" :key="key">{{ weekday }}</th>
                </tr>
                </thead>
                <tbody v-if="schedules.length >= 0">
                <tr v-for="time in uniqueSchedules()">

                    <td>
                        {{ time.time_begin }}<br>{{ time.time_end }}
                    </td>

                    <td v-for="weekday in weekdays_en">

                        <span  v-for="schedule in schedules" v-if="schedule.day === weekday && schedule.time_begin === time.time_begin">
                            {{ schedule.date }}<br>
                            <strong>
                                {{ schedule.group_title }}<br>
                                {{ schedule.lesson_title }}<br>
                            </strong>
                            {{ schedule.teacher_name }}<br>
                            {{ schedule.teacher_surname }}

                        </span>
                        <span v-else></span>

                    </td>

                </tr>
                </tbody>
                <tbody v-else>
                <tr>
                    <td colspan="4" align="center">Расписание занятий отсутствует</td>
                </tr>
                </tbody>
            </table>
        </div>
    </main>
</template>

<script>
    export default {
        name: "scheduleList",
        data() {
            return {
                schedules: [],
                weekdays_ru: [
                    'Понедельник',
                    'Вторник',
                    'Среда',
                    'Четверг',
                    'Пятница',
                    'Суббота',
                ],
                weekdays_en: [
                    'Monday',
                    'Tuesday',
                    'Wednesday',
                    'Thursday',
                    'Friday',
                    'Saturday',
                ]
            }
        },
        mounted() {
            this.getSchedules()
        },
        methods: {
            getSchedules() {
                this.axios.get('/api/admin/schedule').then(response => {
                    this.schedules = response.data
                }).catch(error => {
                    alert("Request failed")
                })
            },
            uniqueSchedules() {
                let times = []
                this.schedules.forEach(value => {
                    times.push({'time_begin': value.time_begin, 'time_end': value.time_end})
                })

                let time_begin = new Set(times.map(value => value.time_begin))
                times = times.filter(value => time_begin.delete(value.time_begin))
                    .map(value => { return {time_begin: value.time_begin, time_end: value.time_end}})

                times.sort((cur, next) => cur.time_begin > next.time_begin ? 1 : -1)

                return times
            },
            deleteSchedule(id) {
                if (confirm("Вы уверены, что хотите удалить расписание?")) {
                    this.axios.delete(`/api/admin/schedule/${id}`).then(response => {
                        this.getSchedules()
                        alert(response.data.message)
                    }).catch(error => {
                        alert("Request failed")
                    })
                }
            }
        }
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
