<template>
    <div>
        <header style="display: flex; align-items: center; margin-bottom: 20px;">
            <h1>Список студентов</h1>
            <div style="margin-right: 0; margin-left: auto;">

            </div>
        </header>
        <el-table
                :data="students"
                border>
            <el-table-column
                    prop="full_name"
                    label="ФИО">
            </el-table-column>
            <el-table-column
                    prop="group"
                    label="Группа">
            </el-table-column>
            <el-table-column prop="user"  :width="170">
                <template slot-scope="user">
                    <el-button type="success" icon="el-icon-info" circle @click="showUser(user)"></el-button>
                    <el-button type="primary" icon="el-icon-edit" circle @click="showEditForm(lesson_id)"></el-button>
                    <el-button type="danger" @click="deleteLesson(lesson_id)" icon="el-icon-delete" circle></el-button>
                </template>
            </el-table-column>
        </el-table>
        <el-pagination
                background
                @current-change="changePage"
                layout="prev, pager, next"
                :total="total_pages"
                :page-size="per_page"
                :current-page="current_page"
        >
        </el-pagination>
        <el-dialog
                title="Информация о студенте"
                :visible.sync="dialogVisible"
                width="50%">
                <div class="row"><span class="text">ФИО:</span> {{ this.student.full_name }}</div>
                <div class="row">
                    <h1 class="header">Зачетка</h1>
                    <el-table
                            :data="student.recordBook"
                            border>
                        <el-table-column
                                prop="name"
                                label="Название дисциплины">
                        </el-table-column>
                        <el-table-column
                                prop="mark"
                                label="Оценка">
                        </el-table-column>
                    </el-table>
                </div>
                <div class="row">
                    <h1 class="header">Посещения</h1>
                    <el-table
                            :data="student.visitLog"
                            border>
                        <el-table-column
                                prop="name"
                                label="Название дисциплины">
                        </el-table-column>
                        <el-table-column
                                prop="percentOfVisitedLessons"
                                label="Процент посещенных занятий">
                        </el-table-column>
                    </el-table>
                </div>
                <span slot="footer" class="dialog-footer">
                <el-button type="primary" @click="dialogVisible = false">Закрыть</el-button>
              </span>
        </el-dialog>
    </div>
</template>

<script>
    import {mapActions, mapState} from "vuex";
    import get from 'lodash/get';

    export default {
        name: "Students.vue",
        data() {
            return {
                student: {},
                dialogVisible: false
            }
        },

        mounted() {
            this.getStudents({ 'page': this.getQueryVariable('page') });
        },

        computed: {
            ...mapState({
                total_pages: state => get(state, 'students.students.meta.pagination.total'),
                per_page: state => get(state, 'students.students.meta.pagination.per_page'),
                current_page: state => get(state, 'students.students.meta.pagination.current_page'),
            }),

            students() {
                return this.$store.getters.studentsList.data
            },
            currentPage() {
                return this.$store.getters.studentsList.meta.pagination.current_page
            },
            pageSize() {
                return this.$store.getters.studentsList.meta.pagination.per_page
            },

            hasRecordBookRecords() {
                return (this.student.recordBook && this.student.recordBook.length) || false;
            },

            percentOfVisitedLessons() {
                // if (this.student.visitLog && this.student.visitLog.length) {
                //     return this.student.visitLog.visited / this.student.visitLog.lessons_count * 100;
                // }
                return '0';
            }
        },

        methods: {
            ...mapActions([
                'getStudents'
            ]),

            changePage(page) {
                this.$router.push({ name: 'students', query: {'page': page}});
                this.getStudents({ page });
            },

            showUser(user) {
                let result = this.$store.dispatch('getStudent', {id: user.row.user_id })
                result.then((result) => {
                    this.student = result.data;
                    this.dialogVisible = true;
                }).catch(error => {

                })
            },


            getQueryVariable(variable) {
                let query = window.location.search.substring(1);
                let vars = query.split("&");
                for (let i=0; i < vars.length; i++) {
                    let pair = vars[i].split("=");
                    if (pair[0] === variable) {
                        return pair[1];
                    }
                }

                return 1;
            }
        }
    }
</script>

<style scoped>
    .el-pagination.is-background {
        margin-top: 20px;
        margin-left: -10px;
    }
    .header {
        font-size: 14px;
        color: #363636;
        font-weight: bold;
        padding: 13px 10px;
        border: 1px solid #EBEEF5;
        border-bottom: none;
    }

    .text {
        font-size: 14px;
        color: #363636;
        font-weight: bold;
    }

    .row {
        margin-bottom: 10px;
    }
</style>