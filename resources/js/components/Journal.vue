<template>
    <div>
        <el-date-picker
                v-model="date"
                type="date"
                placeholder="Выберете день"
                @change="getScheduleByUser"
                value-format="yyyy-MM-dd HH:mm">
        </el-date-picker>
        <el-select v-model="selectedTeacher" placeholder="Преподователь" @change="getScheduleByUser" clearable>
            <el-option
                    v-for="item in teachers"
                    :key="item.user_id"
                    :label="fullName(item)"
                    :value="item.user_id">
            </el-option>
        </el-select>
        <el-select v-model="selectedSchedule" :disabled="!schedule" placeholder="Занятие">
            <el-option
                    v-for="item in []"
                    :key="item.value"
                    :label="item.label"
                    :value="item.value">
                <span style="float: left">{{ item.label }}</span>
                <span style="float: right; color: #8492a6; font-size: 13px">{{ item.value }}</span>
            </el-option>
        </el-select>
    </div>
</template>

<script>
    import {mapState} from "vuex";
    import get from 'lodash/get';

    export default {
        data() {
            return {
                date: '',
                selectedTeacher: '',
                selectedSchedule: '',
            }
        },

        methods: {
            getScheduleByUser() {
                if (this.getSchedule) {
                    this.$store.dispatch('getScheduleForTeacher', {
                        'day': this.dayOfTheWeek(this.selectedTeacher),
                        'user': this.selectedTeacher
                    })
                }
            },
            fullName(item) {
                return item.first_name + ' ' + item.last_name;
            },

            dayOfTheWeek(date) {
                date = new Date(date);
                let days = ['sunday','monday','tuesday','wednesday','thursday','friday','saturday'];

                return days[date.getDay()]
            },
        },

        computed: {
            ...mapState({
                teachers: state => get(state, 'journal.teachers.data'),
                schedule: state => get(state, 'journal.schedule'),
            }),

            getSchedule() {
                return this.date && this.selectedTeacher;
            },
        },

        mounted() {
            this.$store.dispatch('getTeachers');
        }
    }
</script>

<style lang="scss">
    button.el-picker-panel__icon-btn.el-date-picker__next-btn.el-icon-d-arrow-right,
    button.el-picker-panel__icon-btn.el-date-picker__prev-btn.el-icon-d-arrow-left {
        display: none;
    }
</style>