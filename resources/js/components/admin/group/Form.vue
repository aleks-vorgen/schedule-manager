<template>
    <form @submit.prevent="updateOrCreate" class="card">
        <h5 class="card-header">Редактировать группу</h5>
        <div class="card-body">
            <label for="title" class="card-title form-label">Название группы</label>
            <div class="alert alert-danger card-title" role="alert" v-if="errors.length">
                Исправьте указанные ошибки:
                <ul>
                    <li v-for="error in errors">{{ error }}</li>
                </ul>
            </div>
            <input type="text" id="title" class="card-text form-control" v-model="group.title">
            <button class="btn btn-primary mt-3" type="submit">Сохранить</button>
            <router-link class="btn btn-secondary mt-3" :to="{name: 'groupList'}">Вернуться</router-link>
        </div>
    </form>
</template>

<script>
    export default {
        name: "groupEdit",
        data() {
            return {
                group: {
                    title: "",
                    _method: "",
                },
                errors: []
            }
        },
        mounted() {
            if(this.$route.params.id)
                this.showGroup()
        },
        methods: {
            showGroup() {
                this.axios.get(`/api/admin/group/${this.$route.params.id}/edit`).then(response=>{
                    this.group = response.data
                }).catch(error=>{
                    if (error.response.status === 404)
                        alert("Group not found")
                    else
                        alert("Request failed")

                    this.$router.push({name: "groupList"})
                })
            },
            updateOrCreate() {
                this.errors = []
                if (!this.group.title || this.group.title.length < 5 || this.group.title.length > 20)
                    this.errors.push('Название группы введено некорректно (5-20 символов')
                if (!this.errors.length) {
                    if (!this.$route.params.id)
                        this.create()
                    else
                        this.update()
                }
            },
            update() {
                this.group._method = "patch"
                this.axios.post(`/api/admin/group/${this.$route.params.id}`, this.group).then(response=>{
                    this.$router.push({name:"groupList"})
                    alert("Группа успешно обновлена")
                }).catch(error=>{
                    alert("Request failed")
                })
            },
            create() {
                this.group._method = "post"
                this.axios.post('/api/admin/group', this.group).then(response=>{
                    this.$router.push({name:"groupList"})
                    alert("Группа успешно добавлена")
                }).catch(error=>{
                    alert("Request failed")
                })
            }
        }
    }
</script>

<style scoped>

</style>
