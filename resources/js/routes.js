const GroupList = () => import('./components/admin/group/List.vue')
const GroupEdit = () => import('./components/admin/group/Edit.vue')
const GroupCreate = () => import('./components/admin/group/Edit.vue')

const StudentList = () => import('./components/admin/student/List.vue')
const StudentEdit = () => import('./components/admin/student/Edit.vue')
const StudentCreate = () => import('./components/admin/student/Edit.vue')

const TeacherList = () => import('./components/admin/teacher/List.vue')
const TeacherEdit = () => import('./components/admin/teacher/Edit.vue')
const TeacherCreate = () => import('./components/admin/teacher/Edit.vue')

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
]
