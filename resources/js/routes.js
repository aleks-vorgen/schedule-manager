const GroupList = () => import('./components/admin/group/List.vue')
const GroupEdit = () => import('./components/admin/group/Form.vue')
const GroupCreate = () => import('./components/admin/group/Form.vue')

const StudentList = () => import('./components/admin/student/List.vue')
const StudentEdit = () => import('./components/admin/student/Form.vue')
const StudentCreate = () => import('./components/admin/student/Form.vue')

const TeacherList = () => import('./components/admin/teacher/List.vue')
const TeacherEdit = () => import('./components/admin/teacher/Form.vue')
const TeacherCreate = () => import('./components/admin/teacher/Form.vue')

const ScheduleList = () => import('./components/admin/schedule/List.vue')
const ScheduleEdit = () => import('./components/admin/schedule/Form.vue')
const ScheduleCreate = () => import('./components/admin/schedule/Form.vue')

export const routes = [
    {
        name: 'groupList',
        path: '/admin/group',
        component: GroupList
    },
    {
        name: 'groupEdit',
        path: '/admin/group/:id/edit',
        component: GroupEdit
    },
    {
        name: 'groupAdd',
        path: '/admin/group/edit',
        component: GroupCreate
    },

    {
        name: 'studentList',
        path: '/admin/student',
        component: StudentList
    },
    {
        name: 'studentEdit',
        path: '/admin/student/:id/edit',
        component: StudentEdit
    },
    {
        name: 'studentAdd',
        path: '/admin/student/edit',
        component: StudentCreate
    },

    {
        name: 'teacherList',
        path: '/admin/teacher',
        component: TeacherList
    },
    {
        name: 'teacherEdit',
        path: '/admin/teacher/:id/edit',
        component: TeacherEdit
    },
    {
        name: 'teacherAdd',
        path: '/admin/teacher/edit',
        component: TeacherCreate
    },

    {
        name: 'scheduleList',
        path: '/admin/schedule',
        component: ScheduleList
    },
    {
        name: 'scheduleEdit',
        path: '/admin/schedule/:id/edit',
        component: ScheduleEdit
    },
    {
        name: 'scheduleAdd',
        path: '/admin/schedule/edit',
        component: ScheduleCreate
    },
]
