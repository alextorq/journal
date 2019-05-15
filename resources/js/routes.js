import Home from './components/Home.vue'
import Lessons from './components/Lessons.vue'
import Schedule from  './components/Schedule.vue'
import Students from  './components/Students.vue'
import Journal from  './components/Journal.vue'

export default {
    mode: 'history',

    routes: [
        {
            path: '/',
            component: Journal,
            name: 'home'
        },
        {
            path: '/lessons',
            component: Lessons,
            name: 'lessons'
        },
        {
            path: '/schedule',
            component: Schedule,
            name: 'schedule'
        },
        {
            path: '/students',
            component: Students,
            name: 'students',
            props: (route) => ({ query: route.query.page })
        }
    ]
}