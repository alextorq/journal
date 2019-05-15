<template>
    <div>
        <header style="display: flex; align-items: center; margin-bottom: 20px;">
            <h1>Список занятий</h1>
            <div style="margin-right: 0; margin-left: auto;">

            </div>
        </header>
        <el-row :gutter="20">
            <el-col :span="12">
                <el-table
                        :data="lessons"
                        border>
                    <el-table-column
                            prop="name"
                            label="Название дисциплины">
                    </el-table-column>
                    <el-table-column prop="lesson_id"  :width="120">
                        <template slot-scope="lesson_id">
                            <el-button  type="primary" icon="el-icon-edit" circle @click="showEditForm(lesson_id)"></el-button>
                            <el-button type="danger" @click="deleteLesson(lesson_id)" icon="el-icon-delete" circle></el-button>
                        </template>
                    </el-table-column>
                </el-table>
            </el-col>
            <el-col :span="11" v-show="create">
                <h2 class="header">Добавление дисциплины</h2>
                <el-form class="form" ref="form" :model="form" @submit.native.prevent="storeLesson" label-width="120px" style="width: 100%" border>
                    <el-form-item label="Название">
                        <el-input v-model="form.name"></el-input>
                    </el-form-item>
                    <el-form-item style="margin-bottom: 0">
                        <el-button type="primary" @click="storeLesson" :disabled="inputIsEmpty">Создать</el-button>
                        <el-button>Сбросить</el-button>
                    </el-form-item>
                </el-form>
            </el-col>
            <el-col :span="11" v-show="!create">
                <h1 class="header">Редактирование дисциплины</h1>
                <el-form class="form" ref="form" :model="form" @submit.native.prevent="updateLesson" label-width="120px" style="width: 100%" border>
                    <el-form-item label="Название">
                        <el-input v-model="form.name"></el-input>
                    </el-form-item>
                    <el-form-item style="margin-bottom: 0">
                        <el-button type="primary" @click="updateLesson" :disabled="inputIsEmpty">Изменить</el-button>
                        <el-button>Сбросить</el-button>
                    </el-form-item>
                </el-form>
            </el-col>
        </el-row>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                form: {
                    name: ''
                },
                lessonId: '',
                create: true,
                emptyData: ''
            }
        },

        mounted() {
            this.$store.dispatch('getLessons');
        },

        computed: {
            lessons() {
                return this.$store.getters.lessonsList
            },

            inputIsEmpty() {
                return this.form.name.length === 0
            }
        },

        methods: {
            storeLesson() {
                this.$store.dispatch('saveLesson', { name: this.form.name });
                this.showNotification('Добавлено');
                this.form.name = '';
            },

            showEditForm(data) {
                this.create = !this.create;
                this.lessonId = data.row.lesson_id;
                this.form.name = this.create ? '' : data.row.name;
            },

            updateLesson() {
                this.$store.dispatch('updateLesson', { id: this.lessonId, name: this.form.name });
                this.showNotification('Обновлено');
                this.create = true;
                this.form.name = '';
            },

            deleteLesson(data) {
                this.$store.dispatch('deleteLesson', { id: data.row.lesson_id });
                this.showNotification('Дисциплина "'+ data.row.name +'" удалена');
            },

            showNotification(message) {
                this.$notify({
                    title: 'Успешно',
                    message: message,
                    type: 'success',
                    duration: 1500
                });
            },

        }
    }
</script>

<style>
    .form{
        padding: 20px;
        border: 1px solid #EBEEF5;
    }
    .header {
        font-size: 14px;
        color: #363636;
        font-weight: bold;
        padding: 13px 10px;
        border: 1px solid #EBEEF5;
        border-bottom: none;
        margin-bottom: 0;
    }
</style>