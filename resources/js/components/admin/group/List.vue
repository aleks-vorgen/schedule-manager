<template>
    <main>
        <div class="col-12 mb-2 text-end">
            <router-link :to='{name:"groupAdd"}' class='btn btn-primary'>Добавить группу</router-link>
        </div>
        <div class="col-12">
            <table class="table table-responsive table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Название группы</th>
                    <th>Опции</th>
                </tr>
                </thead>
                <tbody v-if="groups.length > 0">
                <tr v-for="(group, key) in groups" :key="key">
                    <td>{{ group.id }}</td>
                    <td>
                        <router-link :to='{name:"studentList", params:{group_id:group.id}}' class="link-secondary">
                            {{ group.title }}
                        </router-link>
                    </td>
                    <td>
                        <router-link :to='{name:"groupEdit", params:{id:group.id}}' class="btn btn-success">
                            Редактировать
                        </router-link>
                        <button type="button" @click="deleteGroup(group.id)" class="btn btn-danger">Удалить</button>
                    </td>
                </tr>
                </tbody>
                <tbody v-else>
                <tr>
                    <td colspan="3" class="text-center">Список групп пуст</td>
                </tr>
                </tbody>
            </table>
        </div>
    </main>
</template>

<script>
    export default {
        name: "groupList",
        data() {
            return {
                groups: [],
            }
        },
        mounted() {
            this.getGroups()
        },
        methods: {
            getGroups() {
                this.axios.get('/api/admin/group').then(response => {
                    this.groups = response.data
                }).catch(error => {
                    alert("Request failed")
                })
            },
            deleteGroup(id) {
                if (confirm("Это действие удалит всех студентов, привязанных к группе!\nВы уверены, что хотите удалить группу?")) {
                    this.axios.delete(`/api/admin/group/${id}`).then(response => {
                        this.getGroups()
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
